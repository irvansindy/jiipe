<script>
    // ============================================
    // SweetAlert Configuration - Z-index fix
    // ============================================
    const SwalConfig = {
        customClass: {
            container: 'swal-on-top'
        },
        heightAuto: false, // Prevent body scroll issues
        allowOutsideClick: false,
        allowEscapeKey: true
    };

    // Helper function untuk SweetAlert
    const showSwal = (icon, title, text, options = {}) => {
        return Swal.fire({
            ...SwalConfig,
            icon: icon,
            title: title,
            text: text,
            ...options
        });
    };

    // ============================================
    // Modal Loader Manager - Loading di dalam modal
    // ============================================
    const ModalLoaderManager = {
        loaderHtml: `
            <div class="modal-loading-overlay">
                <div class="modal-loading-spinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="modal-loading-text">Loading data...</div>
                </div>
            </div>
        `,

        show: function(modalId, text = 'Loading data...') {
            const modal = $(`#${modalId}`);

            // Remove existing loader jika ada
            modal.find('.modal-loading-overlay').remove();

            // Inject loader
            modal.find('.modal-content').prepend(this.loaderHtml);

            // Update text
            modal.find('.modal-loading-text').text(text);

            // Show loader
            setTimeout(() => {
                modal.find('.modal-loading-overlay').addClass('show');
            }, 10);
        },

        hide: function(modalId) {
            const modal = $(`#${modalId}`);
            const loader = modal.find('.modal-loading-overlay');

            loader.removeClass('show');
            setTimeout(() => {
                loader.remove();
            }, 200);
        },

        showSubmitting: function(modalId) {
            this.show(modalId, 'Submitting data...');
        }
    };

    // ============================================
    // DataTable Manager
    // ============================================
    const DataTableManager = {
        table: null,

        init: function() {
            this.table = $('#table_menu_permission').DataTable({
                processing: true,
                language: {
                    processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                },
                ajax: {
                    url: '{{ route('fetch-menu-permission-v2') }}',
                    type: 'GET',
                    dataType: 'json'
                },
                columns: [
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'name', name: 'name' },
                    { data: 'url', name: 'url' },
                    { data: 'icon', name: 'icon' },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(item) {
                            const statusBadge = item.is_active
                                ? '<span class="badge bg-success">Active</span>'
                                : '<span class="badge bg-secondary">Inactive</span>';

                            return `
                                <div class="d-flex justify-content-end gap-1">
                                    ${statusBadge}
                                    <button type="button"
                                        data-menu_id="${item.id}"
                                        class="btn btn-sm btn-outline-info detail_menu"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalMenuPermission"
                                        title="Detail Menu">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button type="button"
                                        data-menu_id="${item.id}"
                                        class="btn btn-sm btn-outline-secondary list_sub_menu"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalChildMenu"
                                        title="List Submenu">
                                        <i class="ti ti-list"></i>
                                    </button>
                                    <div class="form-check form-switch d-inline-block ms-2">
                                        <input class="form-check-input toggle_status"
                                               type="checkbox"
                                               role="switch"
                                               data-menu_id="${item.id}"
                                               ${item.is_active ? 'checked' : ''}
                                               title="Toggle Status">
                                    </div>
                                </div>
                            `;
                        }
                    }
                ]
            });
        },

        reload: function() {
            this.table.ajax.reload(null, false);
        }
    };

    // ============================================
    // Modal Manager
    // ============================================
    const ModalManager = {
        resetForm: function() {
            $('#form_menu_permission')[0].reset();
            $('#parent_menu').empty();
            $('#list_role').empty();
            $('.text-danger').text('');
            $('input[name="id"]').remove();
        },

        setTitle: function(title) {
            $('#modalMenuPermissionLabel').text(title);
        },

        setButtons: function(buttons) {
            $('#button_action_menu').html(buttons);
        },

        showCreate: function() {
            this.resetForm();
            this.setTitle('Create New Menu Permission');
            this.setButtons(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_menu_permission">
                    <i class="ti ti-device-floppy me-1"></i> Create
                </button>
            `);
            $('.parent_child_menu_section').show();
        },

        showEdit: function() {
            this.setButtons(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="update_menu_permission">
                    <i class="ti ti-device-floppy me-1"></i> Update
                </button>
            `);
        }
    };

    // ============================================
    // API Manager
    // ============================================
    const ApiManager = {
        fetchInitialData: function() {
            return $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '{{ route('fetch-menu-permission') }}',
                type: 'GET'
            });
        },

        fetchMenuDetail: function(menuId) {
            return $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '{{ route('fetch-detail-menu') }}',
                type: 'GET',
                data: { id: menuId }
            });
        },

        fetchChildMenus: function(parentId) {
            return $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '{{ route('fetch-child-menu') }}',
                type: 'GET',
                data: { parent_id: parentId }
            });
        },

        createMenu: function(formData) {
            return $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '{{ route('store-menu-permission') }}',
                type: 'POST',
                data: formData
            });
        },

        updateMenu: function(formData) {
            return $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '{{ route('update-menu-permission') }}',
                type: 'POST',
                data: formData
            });
        },

        toggleStatus: function(menuId, isActive) {
            return $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '{{ route('toggle-menu-status') }}',
                type: 'POST',
                data: {
                    id: menuId,
                    is_active: isActive ? 1 : 0
                }
            });
        }
    };

    // ============================================
    // Form Manager
    // ============================================
    const FormManager = {
        populateParentDropdown: function(parentMenus) {
            $('[name="parent_child_menu"]').off('change').on('change', function() {
                if ($('[name="parent_child_menu"]:checked').val() === 'child_menu') {
                    $('#parent_menu').html(`
                        <label for="parent_id">Parent Menu</label>
                        <select class="form-control parent_id" name="parent_id" id="parent_id" style="width: 100%">
                            <option value="">Select One</option>
                        </select>
                    `);

                    $('#parent_id').select2({
                        dropdownParent: $('#modalMenuPermission'),
                        data: parentMenus.map(parent => ({
                            id: parent.id,
                            text: parent.name
                        })),
                        placeholder: 'Select One'
                    });
                } else {
                    $('#parent_menu').empty();
                }
            });
        },

        populateRoleDropdown: function(roles) {
            $('#list_role').html(`
                <label for="user_role">Role</label>
                <select class="form-control user_role" name="user_role[]" id="user_role" multiple style="width: 100%">
                    <option value="">Select One</option>
                </select>
            `);

            $('#user_role').select2({
                dropdownParent: $('#modalMenuPermission'),
                data: roles.map(role => ({
                    id: role.name,
                    text: role.name
                })),
                placeholder: 'Select One'
            });
        },

        loadParentMenuDropdown: function(selectedId = null) {
            return $.ajax({
                url: '{{ route('fetch-menu-permission-v2') }}',
                type: 'GET',
                success: function(res) {
                    let html = `
                        <label class="form-label">Parent Menu</label>
                        <select class="form-select" name="parent_id" id="parent_id">
                            <option value="">-- Select Parent Menu --</option>
                    `;

                    $.each(res.data, function(i, menu) {
                        let selected = (selectedId && selectedId == menu.id) ? 'selected' : '';
                        html += `<option value="${menu.id}" ${selected}>${menu.name}</option>`;
                    });

                    html += `</select>`;
                    $('#parent_menu').html(html);

                    $('#parent_id').select2({
                        dropdownParent: $('#modalMenuPermission'),
                        placeholder: 'Select One'
                    });
                }
            });
        },

        populateEditForm: function(menu) {
            // Set title
            ModalManager.setTitle("Detail Menu: " + menu.name);

            // Populate translations
            if (menu.translations) {
                $.each(menu.translations, function(locale, name) {
                    $(`#menu-name-${locale} input[name="menu_name[${locale}]"]`).val(name);
                });
            }

            // Populate basic fields
            $('#menu_icon').val(menu.icon);
            $(`input[name="menu_type"][value="${menu.type}"]`).prop('checked', true);

            // Handle parent/child
            if (menu.parent_id == null) {
                $('#parent_menu_1').prop('checked', true);
                $('.parent_child_menu_section').hide();
            } else {
                $('#parent_menu_2').prop('checked', true);
                $('.parent_child_menu_section').show();
                return this.loadParentMenuDropdown(menu.parent_id);
            }

            return $.Deferred().resolve();
        },

        setMenuId: function(menuId) {
            if ($('#form_menu_permission input[name="id"]').length === 0) {
                $('#form_menu_permission').append(`<input type="hidden" name="id" value="${menuId}">`);
            } else {
                $('#form_menu_permission input[name="id"]').val(menuId);
            }
        },

        handleValidationErrors: function(errors) {
            $('.text-danger').text('');
            $.each(errors, function(field, messages) {
                const fieldName = field.replace(/\./g, '_');
                $(`#message_${fieldName}`).text(messages[0]);
            });
        }
    };

    // ============================================
    // Child Menu Manager
    // ============================================
    const ChildMenuManager = {
        childTable: null,

        init: function() {
            if ($.fn.DataTable.isDataTable('#table_child_menu')) {
                $('#table_child_menu').DataTable().destroy();
            }

            this.childTable = $('#table_child_menu').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true
            });
        },

        show: function(parentId) {
            ModalLoaderManager.show('modalChildMenu', 'Loading child menus...');

            ApiManager.fetchChildMenus(parentId)
                .done((res) => {
                    this.populateTable(res.data);
                    $('#modalChildMenu').modal('show');
                })
                .fail((xhr) => {
                    showSwal('error', 'Error!', 'Failed to load child menus');
                })
                .always(() => {
                    ModalLoaderManager.hide('modalChildMenu');
                });
        },

        populateTable: function(menus) {
            $('#modalChildMenuLabel').text('Detail Child Menu');

            if (this.childTable) {
                this.childTable.clear().destroy();
            }

            $('#table_child_menu tbody').empty();

            $.each(menus, (i, menu) => {
                const statusBadge = menu.is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>';

                $('#table_child_menu tbody').append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${menu.name}</td>
                        <td>${menu.url}</td>
                        <td>${menu.icon}</td>
                        <td class="text-end">
                            ${statusBadge}
                            <button class="btn btn-sm btn-outline-primary edit_child_menu ms-1"
                                    data-menu_id="${menu.id}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalMenuPermission">
                                <i class="ti ti-edit"></i>
                            </button>
                            <div class="form-check form-switch d-inline-block ms-2">
                                <input class="form-check-input toggle_status"
                                       type="checkbox"
                                       role="switch"
                                       data-menu_id="${menu.id}"
                                       ${menu.is_active ? 'checked' : ''}
                                       title="Toggle Status">
                            </div>
                        </td>
                    </tr>
                `);
            });

            this.init();
        }
    };

    // ============================================
    // Event Handlers
    // ============================================
    $(document).ready(function() {
        // Initialize DataTable
        DataTableManager.init();

        // Refresh table button
        $('#refresh_table_menu_permission').on('click', function() {
            DataTableManager.reload();
        });

        // Create menu button
        $(document).on('click', '#create_menu_permission', function() {
            ModalManager.showCreate();
            ModalLoaderManager.show('modalMenuPermission', 'Loading form data...');

            ApiManager.fetchInitialData()
                .done((res) => {
                    FormManager.populateParentDropdown(res.data.menus);
                    FormManager.populateRoleDropdown(res.data.roles);
                })
                .fail(() => {
                    showSwal('error', 'Error!', 'Failed to load form data');
                })
                .always(() => {
                    ModalLoaderManager.hide('modalMenuPermission');
                });
        });

        // Save menu button
        $(document).on('click', '#save_menu_permission', function() {
            const formData = $('#form_menu_permission').serialize();

            ModalLoaderManager.showSubmitting('modalMenuPermission');

            ApiManager.createMenu(formData)
                .done((res) => {
                    $('#modalMenuPermission').modal('hide');
                    DataTableManager.reload();
                    showSwal('success', 'Success!', 'Menu permission created successfully!');
                })
                .fail((xhr) => {
                    const response = JSON.parse(xhr.responseText);
                    if (response.meta && response.meta.message && response.meta.message.errors) {
                        FormManager.handleValidationErrors(response.meta.message.errors);
                        showSwal('error', 'Validation Error!', 'Please check the form fields');
                    } else {
                        showSwal('error', 'Error!', 'Failed to create menu');
                    }
                })
                .always(() => {
                    ModalLoaderManager.hide('modalMenuPermission');
                });
        });

        // Detail/Edit menu button
        $(document).on('click', '.detail_menu, .edit_child_menu', function() {
            const menuId = $(this).data('menu_id');

            $('#modalChildMenu').modal('hide');
            ModalManager.resetForm();

            ModalLoaderManager.show('modalMenuPermission', 'Loading menu data...');

            ApiManager.fetchMenuDetail(menuId)
                .done((res) => {
                    const menu = res.data;

                    // Populate form dan tunggu parent dropdown selesai
                    FormManager.populateEditForm(menu).done(() => {
                        // Set menu ID
                        FormManager.setMenuId(menu.id);

                        // Populate roles
                        FormManager.populateRoleDropdown(menu.role_existing);
                        $('[name="user_role[]"]').val(menu.roles.map(role => role.name)).trigger('change');

                        // Show edit buttons
                        ModalManager.showEdit();

                        ModalLoaderManager.hide('modalMenuPermission');
                    });
                })
                .fail(() => {
                    ModalLoaderManager.hide('modalMenuPermission');
                    showSwal('error', 'Error!', 'Failed to load menu detail');
                });
        });

        // Update menu button
        $(document).on('click', '#update_menu_permission', function(e) {
            e.preventDefault();
            const formData = $('#form_menu_permission').serialize();

            ModalLoaderManager.showSubmitting('modalMenuPermission');

            ApiManager.updateMenu(formData)
                .done((res) => {
                    $('#modalMenuPermission').modal('hide');
                    DataTableManager.reload();
                    showSwal('success', 'Success!', 'Menu permission updated successfully!');
                })
                .fail((xhr) => {
                    const response = JSON.parse(xhr.responseText);
                    if (response.meta && response.meta.message && response.meta.message.errors) {
                        FormManager.handleValidationErrors(response.meta.message.errors);
                        showSwal('error', 'Validation Error!', 'Please check the form fields');
                    } else {
                        showSwal('error', 'Error!', 'Failed to update menu');
                    }
                })
                .always(() => {
                    ModalLoaderManager.hide('modalMenuPermission');
                });
        });

        // List submenu button
        $(document).on('click', '.list_sub_menu', function(e) {
            e.preventDefault();
            const menuId = $(this).data('menu_id');

            if (!menuId) {
                showSwal('info', 'Info', 'No child menu available');
                return;
            }

            ChildMenuManager.show(menuId);
        });

        // Toggle status switch
        $(document).on('change', '.toggle_status', function(e) {
            const checkbox = $(this);
            const menuId = checkbox.data('menu_id');
            const newStatus = checkbox.is(':checked');

            // Disable checkbox sementara
            checkbox.prop('disabled', true);

            ApiManager.toggleStatus(menuId, newStatus)
                .done((res) => {
                    DataTableManager.reload();

                    // Reload child menu table jika sedang terbuka
                    if ($('#modalChildMenu').is(':visible')) {
                        const parentId = $('#modalChildMenu').data('parent_id');
                        if (parentId) {
                            ChildMenuManager.show(parentId);
                        }
                    }

                    const message = newStatus ? 'Menu activated successfully' : 'Menu deactivated successfully';
                    showSwal('success', 'Success!', message, {
                        timer: 1500,
                        showConfirmButton: false
                    });
                })
                .fail(() => {
                    // Revert checkbox state
                    checkbox.prop('checked', !newStatus);
                    showSwal('error', 'Error!', 'Failed to toggle menu status');
                })
                .always(() => {
                    checkbox.prop('disabled', false);
                });
        });

        // Store parent_id saat modal child dibuka
        $(document).on('shown.bs.modal', '#modalChildMenu', function(e) {
            const button = $(e.relatedTarget);
            const parentId = button.data('menu_id');
            $(this).data('parent_id', parentId);
        });
    });
</script>