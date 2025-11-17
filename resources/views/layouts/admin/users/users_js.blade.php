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
                    className: 'text-end',
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
                    className: 'text-end',
                    render: function(item) {
                        return `
                            <button type="button" data-role_id="${item.id}" class="btn btn-info btn-sm detail_role" title="Manage Permissions">
                                <i class="ti ti-shield-lock"></i>
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

        // ============================================
        // USER MANAGEMENT
        // ============================================

        // Create User Button Click
        $(document).on('click', '#create_users', function(e) {
            e.preventDefault();
            $('#form_users')[0].reset();
            $('#user_id').val('');
            $('#ModalUsersLabel').html('Create New User');
            clearErrors();

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

            $('#password_required').hide();
            $('#password_confirmation_required').hide();

            $.ajax({
                url: `/admin/users/detail/${user_id}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#user_name').val(response.data.name);
                    $('#user_email').val(response.data.email);

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

        // Submit User Form
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

        // ============================================
        // ROLE PERMISSIONS MANAGEMENT
        // ============================================

        // Detail Role Button Click - Show Permissions Modal
        $(document).on('click', '.detail_role', function(e) {
            e.preventDefault();
            let role_id = $(this).data('role_id');

            console.log('Opening permissions modal for role:', role_id);

            // Set role ID
            $('#role_id').val(role_id);

            // Show loading state
            $('#permissions_table_body').html('<tr><td colspan="3" class="text-center"><i class="ti ti-loader"></i> Loading permissions...</td></tr>');

            // Open modal
            $('#ModalRolePermissions').modal('show');

            // Load role permissions
            $.ajax({
                url: `roles/detail/${role_id}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Role detail response:', response);

                    let data = response.data;

                    // Set role name in modal header
                    $('#role_name_display').text(data.role.name);

                    // Build permissions table
                    let html = '';
                    if (data.all_permissions && data.all_permissions.length > 0) {
                        data.all_permissions.forEach(permission => {
                            let isChecked = data.role_permissions.includes(permission.id) ? 'checked' : '';
                            html += `
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox"
                                            class="form-check-input permission-checkbox"
                                            name="permissions[]"
                                            value="${permission.name}"
                                            ${isChecked}>
                                    </td>
                                    <td>${permission.name}</td>
                                    <td><span class="badge bg-secondary">${permission.guard_name}</span></td>
                                </tr>
                            `;
                        });
                    } else {
                        html = '<tr><td colspan="3" class="text-center text-muted">No permissions available</td></tr>';
                    }

                    $('#permissions_table_body').html(html);
                    // $('#permissions_table').dataTable();
                    // Update check all checkbox state
                    updateCheckAllState();
                },
                error: function(xhr) {
                    console.error('Error loading role permissions:', xhr);
                    $('#permissions_table_body').html('<tr><td colspan="3" class="text-center text-danger">Failed to load permissions</td></tr>');
                    alert('Failed to load role permissions. Please try again.');
                }
            });
        });

        // Check All Permissions checkbox
        $(document).on('change', '#check_all_permissions', function() {
            let isChecked = $(this).is(':checked');
            $('.permission-checkbox').prop('checked', isChecked);
            console.log('Check all permissions:', isChecked);
        });

        // Update check all state when individual checkbox changes
        $(document).on('change', '.permission-checkbox', function() {
            updateCheckAllState();
        });

        // Select All Button
        $(document).on('click', '#select_all_permissions', function(e) {
            e.preventDefault();
            $('.permission-checkbox').prop('checked', true);
            $('#check_all_permissions').prop('checked', true);
            console.log('All permissions selected');
        });

        // Deselect All Button
        $(document).on('click', '#deselect_all_permissions', function(e) {
            e.preventDefault();
            $('.permission-checkbox').prop('checked', false);
            $('#check_all_permissions').prop('checked', false);
            console.log('All permissions deselected');
        });

        // Function to update check all checkbox state
        function updateCheckAllState() {
            let total = $('.permission-checkbox').length;
            let checked = $('.permission-checkbox:checked').length;
            $('#check_all_permissions').prop('checked', total > 0 && total === checked);
        }

        // Submit Role Permissions Form
        $(document).on('submit', '#form_role_permissions', function(e) {
            e.preventDefault();

            let role_id = $('#role_id').val();
            let formData = new FormData(this);

            console.log('Submitting permissions for role:', role_id);

            // Get all checked permissions
            let selectedPermissions = [];
            $('.permission-checkbox:checked').each(function() {
                selectedPermissions.push($(this).val());
            });
            console.log('Selected permissions:', selectedPermissions);

            // Show loading state
            $('#submit_role_permissions').prop('disabled', true).html('<i class="ti ti-loader"></i> Saving...');

            $.ajax({
                url: `/roles/${role_id}/permissions`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Update permissions response:', response);

                    $('#ModalRolePermissions').modal('hide');
                    table_roles.ajax.reload(null, false);
                    $('#ModalRolePermissions').modal('hide');
                    alert(response.meta.message);
                },
                error: function(xhr) {
                    console.error('Error updating permissions:', xhr);
                    let errorMessage = 'Failed to update permissions';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    alert(errorMessage);
                },
                complete: function() {
                    // Reset button state
                    $('#submit_role_permissions').prop('disabled', false).html('<i class="ti ti-device-floppy"></i> Save Permissions');
                }
            });
        });

        // Reset modal when closed
        $('#ModalRolePermissions').on('hidden.bs.modal', function() {
            console.log('Modal closed, resetting form');
            $('#form_role_permissions')[0].reset();
            $('#permissions_table_body').html('');
            $('#check_all_permissions').prop('checked', false);
            $('#role_id').val('');
            $('#role_name_display').text('');
        });

        // Log when modal is shown
        $('#ModalRolePermissions').on('shown.bs.modal', function() {
            console.log('Permissions modal opened');
        });
    });
</script>