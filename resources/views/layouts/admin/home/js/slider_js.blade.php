<script>
$(function() {
    // ============================================
    // HELPER FUNCTIONS
    // ============================================

    function showLoading() {
        $('#loadingOverlaySlider').fadeIn();
        $('#action_slider .btn-text').addClass('d-none');
        $('#action_slider .spinner-border').removeClass('d-none');
        $('#action_slider').prop('disabled', true);
    }

    function hideLoading() {
        $('#loadingOverlaySlider').fadeOut();
        $('#action_slider .btn-text').removeClass('d-none');
        $('#action_slider .spinner-border').addClass('d-none');
        $('#action_slider').prop('disabled', false);
    }

    function resetForm() {
        $('#slider_form')[0].reset();
        $('#slider_id').val('');

        // Clear all error messages
        $('[id^="message_"]').text('');

        // Clear preview
        $('#current_image, #current_video').html('');

        // Reset summernote
        $('.slider_description').each(function() {
            $(this).summernote('code', '');
        });

        // Check is_active by default
        $('#is_active').prop('checked', true);
    }

    // Initialize Summernote
    function initSummernote() {
        $('.slider_description').summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    }

    // ============================================
    // INITIALIZE
    // ============================================

    // Initialize DataTable
    var table_slider = $('#table_slider').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('fetch-home-slider') }}",
            type: 'GET',
            dataSrc: function(json) {
                if (json.meta && json.meta.status === 'success') {
                    return json.data;
                }
                return [];
            },
            error: function(xhr) {
                console.error('DataTable error:', xhr);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load slider data'
                });
            }
        },
        columns: [
            {
                data: null,
                title: 'Preview',
                orderable: false,
                render: function(item) {
                    if (!item.file) return '<i class="text-muted">No file</i>';

                    var fullUrl = item.file.startsWith('http') ? item.file : '{{ url("/") }}/' + item.file;

                    // Check if video
                    if (fullUrl.match(/\.(mp4|webm|ogg)$/i)) {
                        return '<video src="' + fullUrl + '" style="max-width:80px;max-height:60px;" muted></video>';
                    }
                    // Image
                    return '<img src="' + fullUrl + '" style="max-width:80px;max-height:60px;" class="img-thumbnail">';
                }
            },
            {
                data: null,
                title: 'Title',
                render: function(item) {
                    if (item.translations && item.translations.length > 0) {
                        return item.translations[0].title || '<i class="text-muted">No title</i>';
                    }
                    return '<i class="text-muted">No title</i>';
                }
            },
            {
                data: 'created_at',
                title: 'Created At',
                render: function(data) {
                    return data ? moment(data).format('LL') : '-';
                }
            },
            {
                data: null,
                title: 'Status',
                render: function(item) {
                    if (item.translations && item.translations.length > 0) {
                        var isActive = item.translations.some(t => t.is_active == 1);
                        return isActive
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-secondary">Inactive</span>';
                    }
                    return '<span class="badge bg-secondary">Inactive</span>';
                }
            },
            {
                data: null,
                title: 'Action',
                orderable: false,
                render: function(item) {
                    return `
                        <div class="btn-group" role="group">
                            <button type="button"
                                data-slider_id="${item.id}"
                                class="btn btn-sm btn-outline-info detail_slider"
                                title="Edit">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button type="button"
                                data-id="${item.id}"
                                class="btn btn-sm btn-outline-danger btn-delete-slider"
                                title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        order: [[2, 'desc']], // Order by created_at descending
        language: {
            processing: "Loading...",
            emptyTable: "No sliders found"
        }
    });

    // AJAX setup
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Initialize Summernote on page load
    initSummernote();

    // ============================================
    // EVENT HANDLERS
    // ============================================

    // Refresh table button
    $('#refresh_table_slider').on('click', function() {
        table_slider.ajax.reload();
    });

    // Create slider button
    $('#create_slider').on('click', function(e) {
        e.preventDefault();
        $('#ModalSliderLabel').text('Create New Slider');
        resetForm();
        initSummernote();
        $('#ModalSlider').modal('show');
    });

    // Edit slider button
    $(document).on('click', '.detail_slider', function() {
        let btn = $(this);
        let id = btn.data('slider_id');

        $('#slider_id').val(id);
        $('[id^="message_"]').text('');

        showLoading();

        $.ajax({
            url: "{{ route('fetch-home-slider-id') }}",
            type: 'GET',
            data: { id: id },
            success: function(res) {
                hideLoading();

                if (res.meta && res.meta.status === 'success') {
                    var slider = res.data;

                    // Display current file
                    $('#current_image, #current_video').html('');
                    if (slider.file) {
                        var fullUrl = slider.file.startsWith('http')
                            ? slider.file
                            : '{{ url("/") }}/' + slider.file;

                        if (fullUrl.match(/\.(mp4|webm|ogg)$/i)) {
                            $('#current_video').html(
                                '<video src="' + fullUrl + '" controls style="max-width:100%;max-height:200px;"></video>' +
                                '<p class="text-muted small mt-1">Current video (upload new to replace)</p>'
                            );
                        } else if (fullUrl.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
                            $('#current_image').html(
                                '<img src="' + fullUrl + '" class="img-thumbnail" style="max-width:100%;max-height:200px;">' +
                                '<p class="text-muted small mt-1">Current image (upload new to replace)</p>'
                            );
                        }
                    }

                    // Reinitialize summernote
                    $('.slider_description').summernote('destroy');
                    initSummernote();

                    // Fill translation fields
                    var translations = slider.translations;
                    if (translations) {
                        $.each(translations, function(locale, t) {
                            $('#slider_title_' + t.locale).val(t.title || '');
                            $('#slider_description_' + t.locale).summernote('code', t.description || '');
                        });

                        // Set is_active based on first translation
                        var firstTranslation = Object.values(translations)[0];
                        if (firstTranslation) {
                            $('#is_active').prop('checked', firstTranslation.is_active == 1);
                        }
                    }

                    $('#ModalSliderLabel').text('Edit Slider');
                    $('#ModalSlider').modal('show');
                }
            },
            error: function(xhr) {
                hideLoading();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: xhr.responseJSON?.meta?.message || 'Failed to load slider data'
                });
            }
        });
    });

    // Submit form
    $('#slider_form').on('submit', function(e) {
        e.preventDefault();

        var form = this;
        var id = $('#slider_id').val();
        var url = id ? '{{ route("update-home-slider") }}' : '{{ route("store-home-slider") }}';
        var formData = new FormData(form);

        // Clear previous errors
        $('[id^="message_"]').text('');

        showLoading();

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {
                hideLoading();

                if (res.meta && res.meta.status === 'success') {
                    $('#ModalSlider').modal('hide');

                    // Destroy summernote before hiding modal
                    $('.slider_description').summernote('destroy');

                    table_slider.ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: res.meta.message || 'Slider saved successfully',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                hideLoading();

                if (xhr.status === 422 && xhr.responseJSON?.data) {
                    // Validation errors
                    var errors = xhr.responseJSON.data;
                    $.each(errors, function(key, messages) {
                        var fieldName = key.replace(/\./g, '_');
                        var selector = '#message_' + fieldName;
                        if ($(selector).length) {
                            $(selector).text(messages[0]);
                        }
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error!',
                        text: 'Please check all required fields'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.meta?.message || 'Server error occurred'
                    });
                }
            }
        });
    });

    // Delete slider
    $(document).on('click', '.btn-delete-slider', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();

                $.ajax({
                    url: '{{ route("delete-home-slider", ":id") }}'.replace(':id', id),
                    type: 'POST',
                    data: { _method: 'DELETE' },
                    dataType: 'json',
                    success: function(res) {
                        hideLoading();

                        if (res.meta && res.meta.status === 'success') {
                            table_slider.ajax.reload();

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Slider has been deleted.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        hideLoading();

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.meta?.message || 'Failed to delete slider'
                        });
                    }
                });
            }
        });
    });

    // Clean up summernote when modal is hidden
    $('#ModalSlider').on('hidden.bs.modal', function () {
        $('.slider_description').summernote('destroy');
    });
});
</script>