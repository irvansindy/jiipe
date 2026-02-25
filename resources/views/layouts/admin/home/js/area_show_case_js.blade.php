<script>
    $(function() {

        // Ensure SweetAlert2 renders above Bootstrap modals
        if ($('head').find('#swal2-zindex-style').length === 0) {
            $('head').append(
                '<style id="swal2-zindex-style">.swal2-container{z-index:2147483647!important}.swal2-popup{z-index:2147483647!important}</style>'
            );
        }

        // ============================================
        // HELPER FUNCTIONS
        // ============================================

        function showLoading() {
            $('#loadingOverlayAreaShowCase').fadeIn();
            $('#action_area_show_case .btn-text').addClass('d-none');
            $('#action_area_show_case .spinner-border').removeClass('d-none');
            $('#action_area_show_case').prop('disabled', true);
        }

        function hideLoading() {
            $('#loadingOverlayAreaShowCase').fadeOut();
            $('#action_area_show_case .btn-text').removeClass('d-none');
            $('#action_area_show_case .spinner-border').addClass('d-none');
            $('#action_area_show_case').prop('disabled', false);
        }

        function resetForm() {
            $('#area_show_case_form')[0].reset();
            $('#area_show_case_id').val('');
            $('[id^="message_"]').text('');
            $('#current_area_show_case_image').html('');
            $('#current_area_show_case_image_mobile').html('');
            $('.area_show_case_description').each(function() {
                $(this).summernote('code', '');
            });
            $('#area_show_case_is_active').prop('checked', true);
            $('#area_show_case_position').val(0);
        }

        function initSummernote() {
            $('.area_show_case_description').summernote({
                height: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        }

        function handleValidationErrors(xhr) {
            var errors = xhr.responseJSON?.errors || xhr.responseJSON?.data || null;

            if (xhr.status === 422 && errors) {
                $.each(errors, function(key, messages) {
                    var message = messages && messages.length ?
                        messages[0] :
                        (xhr.responseJSON.message || 'Invalid input');

                    var selector = null;

                    if (key === 'image') {
                        selector = '#message_image';
                    } else if (key === 'position') {
                        selector = '#message_position';
                    } else if (key.indexOf('title.') === 0) {
                        var locale = key.split('.')[1];
                        selector = '#message_title_' + locale;
                    } else if (key.indexOf('description.') === 0) {
                        var locale = key.split('.')[1];
                        selector = '#message_description_' + locale;
                    } else {
                        selector = '#message_' + key.replace(/\./g, '_');
                    }

                    if ($(selector).length) {
                        $(selector).text(message);
                    } else if (!$('.validation-toast-shown').length) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error!',
                            text: message
                        });
                        $('body').append(
                            '<div class="validation-toast-shown" style="display:none"></div>');
                    }
                });

                if (!$('.validation-toast-shown').length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error!',
                        text: 'Please check all required fields'
                    });
                    $('body').append('<div class="validation-toast-shown" style="display:none"></div>');
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: xhr.responseJSON?.meta?.message || xhr.responseJSON?.message ||
                        'Server error occurred'
                });
            }
        }

        // ============================================
        // INITIALIZE
        // ============================================

        var table_area_show_case = $('#table_area_show_case').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-area-show-case') }}",
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
                        text: 'Failed to load area showcase data'
                    });
                }
            },
            columns: [{
                    data: null,
                    title: 'Preview',
                    orderable: false,
                    render: function(item) {
                        if (!item.image) return '<i class="text-muted">No image</i>';

                        var fullUrl = item.image.startsWith('http') ?
                            item.image :
                            '{{ asset('uploads/showcase') }}/' + item.image;

                        return `<img src="${fullUrl}" loading="lazy" decoding="async"
                                    style="max-width:80px;max-height:60px;" class="img-thumbnail">`;
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
                    data: 'position',
                    title: 'Position',
                    render: function(data) {
                        return data !== null ? data : '-';
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
                        return item.is_active == 1 ?
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
                                    data-area_show_case_id="${item.id}"
                                    class="btn btn-outline-info btn-edit-area-show-case"
                                    title="Edit">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button type="button"
                                    data-id="${item.id}"
                                    class="btn btn-outline-danger btn-delete-area-show-case"
                                    title="Delete">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            order: [
                [2, 'asc']
            ],
            language: {
                processing: 'Loading...',
                emptyTable: 'No area showcases found'
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        initSummernote();

        // ============================================
        // EVENT HANDLERS
        // ============================================

        // Refresh table
        $('#refresh_table_area_show_case').on('click', function() {
            table_area_show_case.ajax.reload();
        });

        // Open create modal
        $('#create_area_show_case').on('click', function(e) {
            e.preventDefault();
            resetForm();
            initSummernote();
            $('#ModalAreaShowCaseLabel').text('Create New Area ShowCase');
            $('#ModalAreaShowCase').modal('show');
        });

        // Open edit modal
        $(document).on('click', '.btn-edit-area-show-case', function() {
            var id = $(this).data('area_show_case_id');

            resetForm();
            $('#area_show_case_id').val(id);
            $('[id^="message_"]').text('');

            showLoading();

            $.ajax({
                url: "{{ route('fetch-area-show-case-id') }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(res) {
                    hideLoading();

                    if (res.meta && res.meta.status === 'success') {
                        var item = res.data;

                        // Show current image preview
                        $('#current_area_show_case_image').html('');
                        $('#current_area_show_case_image_mobile').html('');

                        if (item.image) {
                            var fullUrl = item.image.startsWith('http') ?
                                item.image :
                                "{{ asset('uploads/showcase') }}/" + item.image;

                            $('#current_area_show_case_image').html(
                                '<img src="' + fullUrl + '" class="img-thumbnail" ' +
                                'style="max-width:100%;max-height:200px;" loading="lazy" decoding="async">' +
                                '<p class="text-muted small mt-1">Current desktop image (upload new to replace)</p>'
                            );
                        }

                        if (item.image_mobile) {
                            var fullUrlMobile = item.image_mobile.startsWith('http') ?
                                item.image_mobile :
                                "{{ asset('uploads/showcase') }}/" + item
                                .image_mobile;

                            $('#current_area_show_case_image_mobile').html(
                                '<img src="' + fullUrlMobile +
                                '" class="img-thumbnail" ' +
                                'style="max-width:100%;max-height:200px;" loading="lazy" decoding="async">' +
                                '<p class="text-muted small mt-1">Current mobile image (upload new to replace)</p>'
                            );
                        }

                        // Reinitialize Summernote before filling
                        $('.area_show_case_description').summernote('destroy');
                        initSummernote();

                        // Fill translations
                        if (item.translations) {
                            $.each(item.translations, function(locale, t) {
                                $('#area_show_case_title_' + t.locale).val(t
                                    .title || '');
                                $('#area_show_case_description_' + t.locale)
                                    .summernote('code', t.description || '');
                            });
                        }

                        // Fill settings
                        $('#area_show_case_position').val(item.position ?? 0);
                        $('#area_show_case_is_active').prop('checked', item.is_active ==
                            1 || item.is_active === true);

                        $('#ModalAreaShowCaseLabel').text('Edit Area ShowCase');
                        $('#ModalAreaShowCase').modal('show');
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.meta?.message ||
                            'Failed to load area showcase data'
                    });
                }
            });
        });

        // Submit form (create or update)
        $('#area_show_case_form').on('submit', function(e) {
            e.preventDefault();

            var id = $('#area_show_case_id').val();
            var url = id ?
                '{{ route('update-area-show-case') }}' :
                '{{ route('store-area-show-case') }}';

            var formData = new FormData(this);
            formData.set('is_active', $('#area_show_case_is_active').is(':checked') ? 1 : 0);

            $('[id^="message_"]').text('');
            $('.validation-toast-shown').remove();

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
                        $('#ModalAreaShowCase').modal('hide');
                        table_area_show_case.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.meta.message ||
                                'Area ShowCase saved successfully',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    handleValidationErrors(xhr);
                }
            });
        });

        // Delete
        $(document).on('click', '.btn-delete-area-show-case', function() {
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
                        url: '{{ route('delete-area-show-case', ':id') }}'.replace(
                            ':id', id),
                        type: 'POST',
                        data: {
                            _method: 'DELETE'
                        },
                        dataType: 'json',
                        success: function(res) {
                            hideLoading();

                            if (res.meta && res.meta.status === 'success') {
                                table_area_show_case.ajax.reload();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Area ShowCase has been deleted.',
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
                                    'Failed to delete area showcase'
                            });
                        }
                    });
                }
            });
        });

        // Cleanup Summernote when modal closes
        $('#ModalAreaShowCase').on('hidden.bs.modal', function() {
            $('.area_show_case_description').summernote('destroy');
        });
    });
</script>
