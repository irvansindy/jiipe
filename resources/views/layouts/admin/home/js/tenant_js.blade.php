<script>
    $(document).ready(function() {
        var table = $('#table_tenant').DataTable({
            processing: true,
            // serverSide: true,
            ajax: '{{ route('fetch-tenant') }}',
            columns: [{
                    data: 'translations[0].name',
                    name: 'translations[0].name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data) {
                        return moment(data).format('LL');
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    wrap: true,
                    render: function(item) {
                        return `
                            <div class="btn-group" role="group">
                                <button type="button" data-tenant_id="${item.id}"
                                    class="btn btn-outline-info detail_tenant" title="View">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button type="button" data-id="${item.id}"
                                    class="btn btn-outline-danger btn-delete-tenant" title="Delete">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        `;
                    }
                },
            ]
        });

        // Ensure SweetAlert2 is rendered above Bootstrap modals (same approach as slider)
        if ($('head').find('#swal2-zindex-style').length === 0) {
            $('head').append(
                '<style id="swal2-zindex-style">.swal2-container{z-index:2147483647!important}.swal2-popup{z-index:2147483647!important}</style>'
                );
        }

        // Loading helpers (use overlay + btn-text pattern like slider)
        function showLoading() {
            $('#loadingOverlayTenant').fadeIn();
            $('#action_tenant .btn-text').addClass('d-none');
            $('#action_tenant .spinner-border').removeClass('d-none');
            $('#action_tenant').prop('disabled', true);
        }

        function hideLoading() {
            $('#loadingOverlayTenant').fadeOut();
            $('#action_tenant .btn-text').removeClass('d-none');
            $('#action_tenant .spinner-border').addClass('d-none');
            $('#action_tenant').prop('disabled', false);
        }

        function showConfirmDeleteLoading() {
            $('#confirmDeleteBtn').prop('disabled', true);
            $('#confirmDeleteSpinner').removeClass('d-none');
        }

        function hideConfirmDeleteLoading() {
            $('#confirmDeleteBtn').prop('disabled', false);
            $('#confirmDeleteSpinner').addClass('d-none');
        }

        $(document).on('click', '#refresh_table_tenant', function() {
            table.ajax.reload();
        });

        $(document).on('click', '#create_tenant', function() {
            // Clear previous messages
            $('[id^="message_"]').text('');
            // Clear form fields
            @foreach ($locales as $locale => $properties)
                $('#tenant_name_{{ $locale }}').val('');
                $('#tenant_description_{{ $locale }}').val('');
            @endforeach
            $('#is_active').prop('checked', true);
            $('#tenant_id').val('');
            $('#tenantForm')[0].reset();
            $('#action_tenant').removeData('tenant_id');
            $('#section_current_logo').hide();
            $('#ModalTenant').modal('show');
        });

        $(document).on('click', '.detail_tenant', function() {
            var tenant_id = $(this).data('tenant_id');
            // Clear previous messages
            $('[id^="message_"]').text('');

            // Fetch tenant data via AJAX
            showLoading();
            $.ajax({
                url: 'fetch-tenant-by-id/' + tenant_id,
                method: 'GET',
                dataType: 'json',
                success: function(res) {
                    hideLoading();
                    $('#tenant_id').val(tenant_id);
                    let assetBase =
                        "{{ asset('uploads/tenant-logo/') }}"; // base URL to public folder
                    let defaultImage = "{{ asset('images/no-image.png') }}";

                    let current_image = defaultImage;
                    if (res.data.logo) {
                        // If backend returned an absolute URL or path starting with '/', use it as-is
                        if (res.data.logo.startsWith('http') || res.data.logo.startsWith(
                                '/')) {
                            current_image = res.data.logo;
                        } else {
                            // Otherwise prefix with asset base (public path)
                            current_image = assetBase + '/' + res.data.logo.replace(/^\/+/,
                                '');
                        }
                    }

                    $('#section_current_logo').show();
                    $('#current_logo').attr('src', current_image);

                    $.each(res.data.translations, function(index, translation) {
                        $('#tenant_name_' + translation.locale).val(translation
                            .name || '');
                        $('#tenant_description_' + translation.locale).val(
                            translation.description || '');
                    });

                    $('#is_active').prop('checked', res.data.is_active);
                    $('#action_tenant').data('tenant_id', tenant_id);
                    $('#ModalTenant').modal('show');
                },
                error: function() {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to fetch tenant data'
                    });
                }
            });
        });

        // Delete tenant - use SweetAlert confirm (like slider)
        $(document).on('click', '.btn-delete-tenant', function() {
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
                        url: 'tenant/' + id,
                        type: 'POST',
                        data: {
                            _method: 'DELETE'
                        },
                        dataType: 'json',
                        success: function(res) {
                            hideLoading();
                            if (res.meta && res.meta.status === 'success') {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: res.meta.message ||
                                        'Tenant has been deleted.',
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
                                text: xhr.responseJSON?.message ||
                                    'Failed to delete tenant'
                            });
                        }
                    });
                }
            });
        });

        $('#tenantForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var tenant_id = $('#action_tenant').data('tenant_id');
            var url = tenant_id ? 'update-tenant' : 'store-tenant';

            if (tenant_id) {
                formData.append('tenant_id', tenant_id);
            }

            showLoading();
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    hideLoading();

                    if (res.meta && res.meta.status === 'success') {
                        $('#ModalTenant').modal('hide');
                        table.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.meta.message || 'Tenant saved successfully',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    // Prefer structured validation errors under `errors`, but fall back to `data`.
                    var errors = xhr.responseJSON?.errors || xhr.responseJSON?.data || null;

                    if (xhr.status === 422 && errors) {
                        $.each(errors, function(key, messages) {
                            var message = (messages && messages.length) ? messages[
                                0] : (xhr.responseJSON.message ||
                                'Invalid input');

                            // Map validation key to span id used in the modal, similar to slider_js mapping
                            var selector = null;

                            if (key.indexOf('name.') === 0) {
                                var locale = key.split('.')[1];
                                selector = '#message_name_' + locale;
                            } else if (key.indexOf('description.') === 0) {
                                var locale = key.split('.')[1];
                                selector = '#message_description_' + locale;
                            } else if (key === 'logo' || key === 'logo[]') {
                                selector = '#message_logo';
                            } else {
                                // generic fallback: replace dots with underscores
                                var fieldName = key.replace(/\./g, '_');
                                selector = '#message_' + fieldName;
                            }

                            if ($(selector).length) {
                                $(selector).text(message);
                            } else {
                                // fallback: show alert once
                                if (!$('.validation-toast-shown').length) {
                                    alert(message);
                                    $('body').append(
                                        '<div class="validation-toast-shown" style="display:none"></div>'
                                    );
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message ||
                                'Server error occurred'
                        });
                    }
                },
                complete: function() {
                    hideLoading();
                }
            });
        });
    });
</script>
