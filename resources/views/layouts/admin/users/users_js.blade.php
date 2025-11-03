<script>
    $(() => {
        // Initialize DataTable for Users
        var table_users = $('#table_users').DataTable({
            processing: true,
            ajax: {
                url: '{{ route('fetch-users') }}',
                type: 'GET',
                dataType: 'json'
            },
            columns: [
                {
                    data: 'name',
                    name: 'name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'roles',
                    name: 'roles',
                    render: function(data) {
                        if (data && data.length > 0) {
                            return '<span class="badge bg-primary">' + data[0].name + '</span>';
                        }
                        return '<i>Not set</i>';
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    render: function(item) {
                        return `
                            <button type="button" data-user_id="${item.id}" class="btn btn-info btn-sm detail_user" title="Edit User">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button type="button" data-user_id="${item.id}" class="btn btn-danger btn-sm delete_user" title="Delete User">
                                <i class="ti ti-trash"></i>
                            </button>
                        `;
                    }
                }
            ]
        });

        // Initialize DataTable for Roles
        var table_roles = $('#table_roles').DataTable({
            processing: true,
            ajax: {
                url: '{{ route('fetch-roles') }}',
                type: 'GET',
                dataType: 'json'
            },
            columns: [
                {
                    data: 'name',
                    name: 'name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    render: function(item) {
                        return `
                            <button type="button" data-role_id="${item.id}" class="btn btn-info btn-sm detail_role" title="View Role">
                                <i class="ti ti-eye"></i>
                            </button>
                        `;
                    }
                }
            ]
        });

        // Refresh Table Users
        $('#refresh_table_users').click(() => {
            table_users.ajax.reload(null, false);
        });

        // Refresh Table Roles
        $('#refresh_table_roles').click(() => {
            table_roles.ajax.reload(null, false);
        });

        // Load roles for select dropdown
        function loadRoles() {
            $.ajax({
                url: '{{ route('fetch-roles') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let options = '<option value="">Select Role</option>';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(role => {
                            options += `<option value="${role.id}">${role.name}</option>`;
                        });
                    }
                    $('#user_role').html(options);
                },
                error: function(xhr) {
                    console.error('Failed to load roles');
                }
            });
        }

        // Clear form errors
        function clearErrors() {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }

        // Show errors
        function showErrors(errors) {
            clearErrors();
            $.each(errors, function(key, value) {
                $(`#${key}`).addClass('is-invalid');
                $(`#error_${key}`).text(value[0]);
            });
        }

        // Create User Button Click
        $(document).on('click', '#create_users', function(e) {
            e.preventDefault();
            $('#form_users')[0].reset();
            $('#user_id').val('');
            $('#ModalUsersLabel').html('Create New User');
            clearErrors();

            // Show password fields and make them required
            $('#password_field').show();
            $('#password_confirmation_field').show();
            $('#password_required').show();
            $('#password_confirmation_required').show();

            loadRoles();
            $('#ModalUsers').modal('show');
        });

        // Detail/Edit User Button Click
        $(document).on('click', '.detail_user', function(e) {
            e.preventDefault();
            let user_id = $(this).data('user_id');

            $('#form_users')[0].reset();
            $('#user_id').val(user_id);
            $('#ModalUsersLabel').html('Edit User');
            clearErrors();

            // Password optional on edit
            $('#password_required').hide();
            $('#password_confirmation_required').hide();

            // Load user data
            $.ajax({
                url: `/admin/users/detail/${user_id}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#user_name').val(response.data.name);
                    $('#user_email').val(response.data.email);

                    // Load roles and select current role
                    $.ajax({
                        url: '{{ route('fetch-roles') }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function(roleResponse) {
                            let options = '<option value="">Select Role</option>';
                            if (roleResponse.data && roleResponse.data.length > 0) {
                                roleResponse.data.forEach(role => {
                                    let selected = '';
                                    if (response.data.roles && response.data.roles.length > 0 &&
                                        response.data.roles[0].id === role.id) {
                                        selected = 'selected';
                                    }
                                    options += `<option value="${role.id}" ${selected}>${role.name}</option>`;
                                });
                            }
                            $('#user_role').html(options);
                        }
                    });

                    $('#ModalUsers').modal('show');
                },
                error: function(xhr) {
                    alert('Failed to load user data');
                }
            });
        });

        // Submit Form
        $(document).on('submit', '#form_users', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = '{{ route('store-users') }}';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#ModalUsers').modal('hide');
                        $('#form_users')[0].reset();
                        table_users.ajax.reload(null, false);

                        // Show success message
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.data;
                        showErrors(errors);
                    } else {
                        alert(xhr.responseJSON?.message || 'An error occurred');
                    }
                }
            });
        });

        // Delete User Button Click
        $(document).on('click', '.delete_user', function(e) {
            e.preventDefault();
            let user_id = $(this).data('user_id');
            $('#delete_user_id').val(user_id);
            $('#ModalDeleteUser').modal('show');
        });

        // Confirm Delete User
        $(document).on('click', '#confirm_delete_user', function(e) {
            e.preventDefault();
            let user_id = $('#delete_user_id').val();

            $.ajax({
                url: `/admin/users/delete/${user_id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#ModalDeleteUser').modal('hide');
                        table_users.ajax.reload(null, false);
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message || 'Failed to delete user');
                }
            });
        });
    });
</script>