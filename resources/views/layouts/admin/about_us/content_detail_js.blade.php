<script>
    (function() {
        'use strict';

        // Initialize Summernote (with tooltip fix)
        if (!$.fn.tooltip) {
            $.fn.tooltip = function() {
                return this;
            };
        }

        // Initialize DataTable
        const contentDetailTable = $('#table_list_content_detail').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('about-us-fetch-content-detail') }}",
                type: 'GET',
                dataSrc: function(json) {
                    return json.data || json;
                },
                error: function(xhr, error, code) {
                    console.error('DataTable Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to load data'
                    });
                }
            },
            columns: [{
                    data: 'translations',
                    name: 'title',
                    render: function(data, type, row) {
                        return data && data.length > 0 && data[0].title
                            ? data[0].title
                            : '-';
                    }
                },
                {
                    data: 'icon',
                    name: 'icon',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        const iconUrl = `{{ asset('uploads/about-us/content_detail/') }}/${data}`;
                        return `<img src="${iconUrl}" alt="Icon" style="max-height: 40px;" class="img-thumbnail" loading="lazy" decoding="async">`;
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data) {
                        return data ? moment(data).format('LL') : '-';
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    searchable: false,
                    render: function(row) {
                        return `
                            <button type="button"
                                data-id="${row.id}"
                                class="btn btn-outline-info btn-sm edit-content-detail"
                                title="Edit">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button type="button"
                                data-id="${row.id}"
                                class="btn btn-outline-danger btn-sm delete-content-detail ms-1"
                                title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            language: {
                emptyTable: "No data available",
                processing: "Loading..."
            }
        });

        // Initialize Summernote after modal is shown
        $('#modalContentDetail').on('shown.bs.modal', function() {
            $('.summernote').each(function() {
                if (!$(this).next('.note-editor').length) {
                    $(this).summernote({
                        height: 200,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });
                }
            });
        });

        // ==================== Create Content Detail ====================
        $(document).on('click', '#create_content_detail', function() {
            resetForm();
            $('#content_id').val('');
            $('#modalContentDetailLabel').text('Create Content Detail');
            $('#current_image_preview').hide();

            $('#button_action_content_detail').html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_content_detail">Submit</button>
            `);
        });

        // ==================== Edit Content Detail ====================
        $(document).on('click', '.edit-content-detail', function() {
            const id = $(this).data('id');
            resetForm();

            $('#content_id').val(id);
            $('#modalContentDetailLabel').text('Edit Content Detail');

            // PENTING: Jangan hide modal dulu, biarkan tetap terbuka
            // Tutup modal setelah data berhasil di-load

            // Show loading dengan z-index yang lebih tinggi dari modal
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    // Set z-index SweetAlert lebih tinggi dari Bootstrap modal
                    $('.swal2-container').css('z-index', '9999');
                }
            });

            // Fetch detail data
            $.ajax({
                url: "{{ route('about-us-fetch-content-detail') }}",
                type: 'GET',
                success: function(response) {
                    const data = response.data || response;
                    const item = data.find(d => d.id == id);

                    if (item) {
                        // Fill category
                        $('#category_id').val(item.category_id || '');

                        // Show current image if exists
                        if (item.icon) {
                            const iconUrl = `{{ asset('uploads/about-us/content_detail/') }}/${item.icon}`;
                            $('#current_image').attr('src', iconUrl);
                            $('#current_image_preview').show();
                        }

                        // Fill translations
                        if (item.translations && item.translations.length > 0) {
                            item.translations.forEach(trans => {
                                const locale = trans.locale;

                                // Set title
                                $(`#content_detail_title_${locale}`).val(trans.title || '');

                                // Set summernote content
                                const $summernote = $(`#content_detail_sub_content_${locale}`);
                                if ($summernote.length) {
                                    if ($summernote.next('.note-editor').length) {
                                        $summernote.summernote('code', trans.description || '');
                                    } else {
                                        $summernote.val(trans.description || '');
                                    }
                                }
                            });
                        }

                        // Close loading setelah data terisi
                        Swal.close();

                        // Buka modal setelah loading selesai
                        $('#modalContentDetail').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Data not found'
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching detail:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to load data'
                    });
                }
            });

            $('#button_action_content_detail').html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_content_detail">Update</button>
            `);
        });

        // ==================== Submit Content Detail (Create/Update) ====================
        $(document).on('click', '#submit_content_detail', function(e) {
            e.preventDefault();

            // Clear previous errors
            $('.text-danger').text('');
            $('.is-invalid').removeClass('is-invalid');

            const formData = new FormData($('#form_content_detail')[0]);
            const contentId = $('#content_id').val();

            if (contentId) {
                formData.append('id', contentId);
            }

            // Update summernote content to FormData
            $('.summernote').each(function() {
                const name = $(this).attr('name');
                if ($(this).next('.note-editor').length) {
                    const content = $(this).summernote('code');
                    formData.set(name, content);
                }
            });

            // Disable submit button
            const $btn = $(this);
            const originalText = $btn.text();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('store-about-us-content-detail') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $btn.prop('disabled', false).text(originalText);

                    $('#modalContentDetail').modal('hide');
                    contentDetailTable.ajax.reload(null, false);

                    const message = res.meta?.message || res.message || 'Success';
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).text(originalText);

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON?.meta?.message || xhr.responseJSON?.errors;

                        if (errors) {
                            $.each(errors, function(key, value) {
                                const cleanKey = key.replace(/\./g, '_');
                                const $errorElement = $('#message_' + cleanKey);
                                const $field = $(`[name="${key}"]`).length
                                    ? $(`[name="${key}"]`)
                                    : $(`[name="${key.replace(/\./g, '[')}]"]`);

                                const errorMsg = Array.isArray(value) ? value[0] : value;

                                if ($errorElement.length) {
                                    $errorElement.text(errorMsg);
                                }

                                if ($field.length) {
                                    $field.addClass('is-invalid');
                                }
                            });
                        }
                    } else {
                        const errorMsg = xhr.responseJSON?.meta?.message || xhr.responseJSON?.message || 'An error occurred';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMsg
                        });
                    }
                }
            });
        });

        // ==================== Delete Content Detail ====================
        $(document).on('click', '.delete-content-detail', function() {
            const id = $(this).data('id');
            const $btn = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Deleting...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('delete-about-us-content-detail') }}",
                        type: 'DELETE',
                        data: { id: id },
                        success: function(res) {
                            contentDetailTable.ajax.reload(null, false);

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: res.meta?.message || res.message || 'Data has been deleted.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        },
                        error: function(xhr) {
                            const errorMsg = xhr.responseJSON?.meta?.message || xhr.responseJSON?.message || 'Failed to delete data';
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorMsg
                            });
                        }
                    });
                }
            });
        });

        // ==================== Helper Function ====================
        function resetForm() {
            $('#form_content_detail')[0].reset();

            // Clear errors
            $('.text-danger').text('');
            $('.is-invalid').removeClass('is-invalid');

            // Reset summernote
            $('.summernote').each(function() {
                if ($(this).next('.note-editor').length) {
                    $(this).summernote('code', '');
                } else {
                    $(this).val('');
                }
            });
        }

        // Clean up Summernote when modal is hidden
        $('#modalContentDetail').on('hidden.bs.modal', function() {
            $('.summernote').each(function() {
                if ($(this).next('.note-editor').length) {
                    $(this).summernote('destroy');
                }
            });
        });

    })();
</script>