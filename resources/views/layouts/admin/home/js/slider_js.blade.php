<script>
    $(function() {

        // Ensure SweetAlert2 is rendered above Bootstrap modals
        // Adds a style tag with a very high z-index so swal dialogs aren't hidden.
        if ($('head').find('#swal2-zindex-style').length === 0) {
            $('head').append(
                '<style id="swal2-zindex-style">.swal2-container{z-index:2147483647!important}.swal2-popup{z-index:2147483647!important}</style>'
            );
        }
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
            columns: [{
                    data: null,
                    title: 'Preview',
                    orderable: false,
                    render: function(item) {
                        if (!item.file) return '<i class="text-muted">No file</i>';

                        // Build URL
                        var fullUrl = item.file.startsWith('http') ?
                            item.file :
                            '{{ asset('uploads/home-slider') }}/' + item.file;

                        // Check if video
                        if (fullUrl.match(/\.(mp4|webm|ogg)$/i)) {
                            return `
                                <video src="${fullUrl}"
                                    preload="metadata"
                                    style="max-width:80px;max-height:60px;"
                                    muted>
                                </video>`;
                        }

                        // Image with lazy load + async decoding
                        return `
                            <img src="${fullUrl}"
                                loading="lazy"
                                decoding="async"
                                style="max-width:80px;max-height:60px;"
                                class="img-thumbnail">
                        `;
                    }
                },
                {
                    data: null,
                    title: 'Title',
                    render: function(item) {
                        if (item.translations && item.translations.length > 0) {
                            return item.translations[0].title ||
                                '<i class="text-muted">No title</i>';
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
                        var isActive = item.is_active;
                        return isActive == 1 ?
                            '<span class="badge bg-success">Active</span>' :
                            '<span class="badge bg-secondary">Inactive</span>';
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
                                class="btn btn-outline-info detail_slider"
                                title="Edit">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button type="button"
                                data-id="${item.id}"
                                class="btn btn-outline-danger btn-delete-slider"
                                title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    `;
                    }
                }
            ],
            order: [
                [2, 'desc']
            ], // Order by created_at descending
            language: {
                processing: "Loading...",
                emptyTable: "No sliders found"
            }
        });

        // AJAX setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                data: {
                    id: id
                },
                success: function(res) {
                    hideLoading();

                    if (res.meta && res.meta.status === 'success') {
                        var slider = res.data;

                        // Display current file
                        $('#current_image, #current_video').html('');
                        if (slider.file) {
                            var fullUrl = slider.file.startsWith('http') ?
                                slider.file :
                                "{{ asset('uploads/home-slider') }}/" + slider.file;

                            if (fullUrl.match(/\.(mp4|webm|ogg)$/i)) {
                                $('#current_video').html(
                                    '<video src="' + fullUrl +
                                    '" preload="metadata" controls style="max-width:100%;max-height:200px;"></video>' +
                                    '<p class="text-muted small mt-1">Current video (upload new to replace)</p>'
                                );
                            } else if (fullUrl.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
                                $('#current_image').html(
                                    '<img src="' + fullUrl +
                                    '" class="img-thumbnail" style="max-width:100%;max-height:200px;">' +
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
                                $('#slider_description_' + t.locale).summernote(
                                    'code', t.description || '');
                            });

                            // Set is_active based on first translation
                            var firstTranslation = Object.values(translations)[0];
                            if (firstTranslation) {
                                $('#is_active').prop('checked', firstTranslation
                                    .is_active == 1);
                            }
                        }
                        // Set is_active based on slider-level flag
                        $('#is_active').prop('checked', slider.is_active == 1 || slider
                            .is_active === true);

                        $('#ModalSliderLabel').text('Edit Slider');
                        $('#ModalSlider').modal('show');
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.meta?.message ||
                            'Failed to load slider data'
                    });
                }
            });
        });

        // Submit form
        $('#slider_form').on('submit', function(e) {
            e.preventDefault();

            var form = this;
            var id = $('#slider_id').val();
            var url = id ? '{{ route('update-home-slider') }}' : '{{ route('store-home-slider') }}';
            var formData = new FormData(form);

            // Ensure is_active always sent: 1 if checked, 0 if unchecked
            formData.set('is_active', $('#is_active').is(':checked') ? 1 : 0);

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

                    // Prefer structured validation errors under `errors`,
                    // but fall back to `data` for older formats.
                    var errors = xhr.responseJSON?.errors || xhr.responseJSON?.data || null;

                    if (xhr.status === 422 && errors) {
                        // errors is an object: { "title.id": ["..."], "slider_file": ["..."] }
                        $.each(errors, function(key, messages) {
                            var message = messages && messages.length ? messages[
                                0] : (xhr.responseJSON.message ||
                                'Invalid input');

                            // Map keys to the span IDs used in the modal
                            var selector = null;

                            if (key === 'slider_file' || key === 'slider_file[]') {
                                selector = '#message_slider_file';
                            } else if (key.indexOf('title.') === 0) {
                                var locale = key.split('.')[1];
                                selector = '#message_title_' + locale;
                            } else if (key.indexOf('description.') === 0) {
                                var locale = key.split('.')[1];
                                selector = '#message_description_' + locale;
                            } else {
                                // generic fallback: replace dots with underscores
                                var fieldName = key.replace(/\./g, '_');
                                selector = '#message_' + fieldName;
                            }

                            if ($(selector).length) {
                                $(selector).text(message);
                            } else {
                                // If no specific field exists, show toast for first error
                                // but avoid spamming multiple toasts
                                if (!$('.validation-toast-shown').length) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Validation Error!',
                                        text: message
                                    });
                                    // add a temporary element to mark we've shown the toast
                                    $('body').append(
                                        '<div class="validation-toast-shown" style="display:none"></div>'
                                    );
                                }
                            }
                        });

                        // Ensure user sees that there are validation errors
                        // (if no toast already shown above)
                        if (!$('.validation-toast-shown').length) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error!',
                                text: 'Please check all required fields'
                            });
                            $('body').append(
                                '<div class="validation-toast-shown" style="display:none"></div>'
                            );
                        }

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.meta?.message || xhr
                                .responseJSON?.message || 'Server error occurred'
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
                        url: '{{ route('delete-home-slider', ':id') }}'.replace(':id',
                            id),
                        type: 'POST',
                        data: {
                            _method: 'DELETE'
                        },
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
                                text: xhr.responseJSON?.meta?.message ||
                                    'Failed to delete slider'
                            });
                        }
                    });
                }
            });
        });

        // Clean up summernote when modal is hidden
        $('#ModalSlider').on('hidden.bs.modal', function() {
            $('.slider_description').summernote('destroy');
        });
    });
</script>
