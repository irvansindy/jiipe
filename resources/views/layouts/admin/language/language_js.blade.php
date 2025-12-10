<script>
    $(function() {
        'use strict';

        // Ensure SweetAlert2 is rendered above Bootstrap modals
        if ($('head').find('#swal2-zindex-style').length === 0) {
            $('head').append(
                '<style id="swal2-zindex-style">.swal2-container{z-index:2147483647!important}.swal2-popup{z-index:2147483647!important}</style>'
            );
        }

        // ============================================
        // HELPER FUNCTIONS
        // ============================================

        function showLoading() {
            $('#loadingOverlayLanguage').fadeIn();
            $('#action_language .btn-text').addClass('d-none');
            $('#action_language .spinner-border').removeClass('d-none');
            $('#action_language').prop('disabled', true);
        }

        function hideLoading() {
            $('#loadingOverlayLanguage').fadeOut();
            $('#action_language .btn-text').removeClass('d-none');
            $('#action_language .spinner-border').addClass('d-none');
            $('#action_language').prop('disabled', false);
        }

        function resetForm() {
            $('#language_form')[0].reset();
            $('#language_id').val('');
            $('[id^="message_"]').text('');
            $('#script').val('Latn'); // Reset to Latin
            $('#locale').prop('readonly', false); // Enable locale input
        }

        // ============================================
        // INITIALIZE DATATABLE
        // ============================================

        var table_language = $('#table_language').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-language') }}",
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
                        text: 'Failed to load language data'
                    });
                }
            },
            columns: [
                {
                    data: 'locale',
                    title: 'Locale',
                    render: function(data) {
                        return '<code class="bg-light px-2 py-1 rounded">' + data + '</code>';
                    }
                },
                {
                    data: 'name',
                    title: 'English Name'
                },
                {
                    data: 'native',
                    title: 'Native Name',
                    render: function(data) {
                        return '<strong>' + data + '</strong>';
                    }
                },
                {
                    data: 'regional',
                    title: 'Regional',
                    render: function(data) {
                        return data ? '<code class="bg-light px-2 py-1 rounded">' + data + '</code>' : '<span class="text-muted">-</span>';
                    }
                },
                {
                    data: 'script',
                    title: 'Script',
                    render: function(data) {
                        return '<span class="badge bg-secondary">' + data + '</span>';
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
                    title: 'Action',
                    orderable: false,
                    className: 'text-end',
                    render: function(item) {
                        var isDefault = item.locale === 'id';
                        var deleteBtn = isDefault ?
                            '<button type="button" class="btn btn-outline-secondary btn-sm" disabled title="Cannot delete default language"><i class="ti ti-lock"></i></button>' :
                            '<button type="button" data-id="' + item.id + '" class="btn btn-outline-danger btn-sm btn-delete-language" title="Delete"><i class="ti ti-trash"></i></button>';

                        return `
                            <div class="btn-group" role="group">
                                <button type="button"
                                    data-language_id="${item.id}"
                                    class="btn btn-outline-info btn-sm detail_language"
                                    title="Edit">
                                    <i class="ti ti-edit"></i>
                                </button>
                                ${deleteBtn}
                            </div>
                        `;
                    }
                }
            ],
            order: [[0, 'asc']], // Order by locale ascending
            language: {
                processing: "Loading...",
                emptyTable: "No languages found"
            }
        });

        // AJAX setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // ============================================
        // EVENT HANDLERS
        // ============================================

        // Refresh table button
        $('#refresh_table_language').on('click', function() {
            table_language.ajax.reload();
        });

        // Sync from config button
        $('#sync_config_btn').on('click', function() {
            Swal.fire({
                title: 'Sync from Config?',
                text: "This will sync database with laravellocalization.php config file",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, sync it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();

                    $.ajax({
                        url: "{{ route('sync-language-config') }}",
                        type: 'POST',
                        success: function(res) {
                            hideLoading();

                            if (res.meta && res.meta.status === 'success') {
                                table_language.ajax.reload();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Synced!',
                                    text: res.meta.message || 'Languages synced successfully',
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
                                text: xhr.responseJSON?.meta?.message || 'Failed to sync languages'
                            });
                        }
                    });
                }
            });
        });

        // Create language button
        $('#create_language').on('click', function(e) {
            e.preventDefault();
            $('#ModalLanguageLabel').text('Create New Language');
            resetForm();
            $('#ModalLanguage').modal('show');
        });

        // Edit language button
        $(document).on('click', '.detail_language', function() {
            let btn = $(this);
            let id = btn.data('language_id');

            $('#language_id').val(id);
            $('[id^="message_"]').text('');

            showLoading();

            $.ajax({
                url: "{{ route('fetch-language-id') }}",
                type: 'GET',
                data: { id: id },
                success: function(res) {
                    hideLoading();

                    if (res.meta && res.meta.status === 'success') {
                        var language = res.data;

                        $('#locale').val(language.locale);
                        $('#name').val(language.name);
                        $('#native').val(language.native);
                        $('#regional').val(language.regional || '');
                        $('#script').val(language.script || 'Latn');

                        // Disable locale edit for default language
                        if (language.locale === 'id') {
                            $('#locale').prop('readonly', true);
                            Swal.fire({
                                icon: 'info',
                                title: 'Default Language',
                                text: 'You are editing the default language. Locale code cannot be changed.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        } else {
                            $('#locale').prop('readonly', false);
                        }

                        $('#ModalLanguageLabel').text('Edit Language');
                        $('#ModalLanguage').modal('show');
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.meta?.message || 'Failed to load language data'
                    });
                }
            });
        });

        // Submit form
        $('#language_form').on('submit', function(e) {
            e.preventDefault();

            var form = this;
            var id = $('#language_id').val();
            var url = id ? '{{ route('update-language') }}' : '{{ route('store-language') }}';
            var formData = $(form).serialize();

            // Clear previous errors
            $('[id^="message_"]').text('');

            showLoading();

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    hideLoading();

                    if (res.meta && res.meta.status === 'success') {
                        $('#ModalLanguage').modal('hide');
                        table_language.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.meta.message || 'Language saved successfully',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    hideLoading();

                    var errors = xhr.responseJSON?.data || null;

                    if (xhr.status === 422 && errors) {
                        $.each(errors, function(key, messages) {
                            var message = messages && messages.length ? messages[0] : 'Invalid input';
                            var selector = '#message_' + key;

                            if ($(selector).length) {
                                $(selector).text(message);
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

        // Delete language
        $(document).on('click', '.btn-delete-language', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete the language and update the config file. You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();

                    $.ajax({
                        url: '{{ route('delete-language', ':id') }}'.replace(':id', id),
                        type: 'POST',
                        data: { _method: 'DELETE' },
                        dataType: 'json',
                        success: function(res) {
                            hideLoading();

                            if (res.meta && res.meta.status === 'success') {
                                table_language.ajax.reload();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Language has been deleted.',
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
                                text: xhr.responseJSON?.meta?.message || 'Failed to delete language'
                            });
                        }
                    });
                }
            });
        });
    });
</script>