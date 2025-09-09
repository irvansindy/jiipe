<script>
    function showLoader() {
        $("#modalLoader").fadeIn(200);
    }

    function hideLoader() {
        $("#modalLoader").fadeOut(200);
    }
    $(document).ready(function() {
        // Simpan DataTable ke variabel supaya tidak dipanggil ulang
        var tableMenuPermission = $('#table_menu_permission').DataTable({
            processing: true,
            ajax: {
                url: '{{ route('fetch-menu-permission') }}',
                type: 'GET',
                dataType: 'json'
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'url',
                    name: 'url'
                },
                {
                    data: 'icon',
                    name: 'icon'
                },
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    searchable: false,
                    render: function(item) {
                        return `
                        <button type="button" 
                            data-menu_id="${item.id}" 
                            class="btn btn-outline-info me-1 mt-2 detail_menu" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalMenuPermission" 
                            title="Detail Menu">
                            <i class="ti ti-edit"></i>
                        </button>
                        <button type="button" 
                            data-menu_id="${item.id}" 
                            class="btn btn-outline-secondary me-1 mt-2 list_sub_menu" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalChildMenu"
                            title="List Submenu">
                            <i class="ti ti-list"></i>
                        </button>
                    `;
                    }
                }
            ]
        });

        // Tombol refresh table
        $('#refresh_table_menu_permission').on('click', function() {
            tableMenuPermission.ajax.reload(null, false); // false biar stay di halaman aktif
        });

        $(document).on('click', '#create_menu_permission', function() {
            $('#modalMenuPermissionLabel').text('');
            $('#modalMenuPermissionLabel').text('Create New Menu Permission');
            $('#form_menu_permission')[0].reset();
            $('#button_action_menu').empty();
            $('#button_action_menu').html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_menu_permission">Create</button>
            `);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-menu-permission') }}',
                type: 'get',

                success: function(res) {
                    const parent_menu = res.data
                    dynamicDropDownParent(parent_menu);
                }
            })
        });

        // Klik detail menu (delegasi event)
        $(document).on('click', '.detail_menu', function() {
            var menu_id = $(this).data('menu_id');
            // pakai modal loader biar ga berat blocking
            $('#modalMenuPermissionLabel').text('');
            $('#modalMenuPermissionLabel').text('Detail Menu Permission');
            $('#button_action_menu').html(`
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update_menu_permission">Update</button>
        `);
        });

        function dynamicDropDownParent(parent_menu) {
            $('[name="parent_child_menu"]').on('change', function() {
                if ($('[name="parent_child_menu"]:checked').val() === 'child_menu') {
                    $('#parent_menu').empty();
                    $('#parent_menu').html(`
                    <label for="parent_id">Permission</label>
                    <select class="form-control parent_id" name="parent_id" id="parent_id" style="width: 100%">
    
                    </select>
                `);
                    $('#parent_id').append(`
                    <option value="">Select One</option>
                `)
                    $('#parent_id').select2({
                        dropdownParent: $('#modalMenuPermission'),
                        data: parent_menu.map(parent => ({
                            id: parent.id,
                            text: parent.name
                        })),
                        placeholder: 'Select One',
                        // allowClear: true,
                    })
                } else {
                    $('#parent_menu').empty();
                }
            });
        }

        $(document).on('click', '#save_menu_permission', function() {
            var formData = $('#form_menu_permission').serialize();
            // var formData = new FormData($('#form_menu_permission')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('store-menu-permission') }}',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    showLoader();
                },
                success: function(res) {
                    $('#modalMenuPermission').modal('hide');
                    tableMenuPermission.ajax.reload(null, false);
                    // Tampilkan notifikasi sukses
                    alert('Menu permission created successfully!');
                },
                error: function(xhr) {
                    // Tampilkan notifikasi error
                    let response_error = JSON.parse(xhr.responseText)
                    $('.text-danger').text('')
                    $.each(response_error.meta.message.errors, function(i, value) {
                        $('#message_' + i.replace('.', '_')).text(value)
                    })
                },
                complete: function() {
                    // Loader selalu hilang setelah request selesai
                    hideLoader();
                }
            });
        });

        $(document).on('click', '.detail_menu, .edit_child_menu', function() {
            let menuId = $(this).data('menu_id');
            $('#modalChildMenu').hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-detail-menu') }}',
                type: 'GET',        // kalau pakai request->id, lebih aman pakai GET dengan param
                data: { id: menuId },
                beforeSend: function() {
                    showLoader();
                },
                success: function(res) {
                    let menu = res.data;

                    // Set judul modal
                    $('#modalMenuPermissionLabel').text("Detail Menu: " + menu.name);

                    // isi translations ke tab input
                    if (menu.translations) {
                        $.each(menu.translations, function(locale, name) {
                            $(`#menu-name-${locale} input[name="menu_name[${locale}]"]`).val(name);
                        });
                    }

                    // isi field biasa
                    $('#menu_icon').val(menu.icon);

                    // radio menu_type
                    $(`input[name="menu_type"][value="${menu.type}"]`).prop('checked', true);

                    // cek parent/child
                    if (menu.parent_id === null) {
                        $('#parent_menu_1').prop('checked', true); // Parent
                        $('.parent_child_menu_section').hide()
                    } else {
                        $('#parent_menu_2').prop('checked', true); // Child
                        $('.parent_child_menu_section').show()
                        // kalau Child → isi dropdown parent menu
                        loadParentMenuDropdown(menu.parent_id);
                    }

                    // simpan id menu di form (hidden input)
                    if ($('#form_menu_permission input[name="id"]').length === 0) {
                        $('#form_menu_permission').append(`<input type="hidden" name="id" value="${menu.id}">`);
                    } else {
                        $('#form_menu_permission input[name="id"]').val(menu.id);
                    }

                    $('#button_action_menu').empty();
                    $('#button_action_menu').append(`
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="update_menu_permission">Update</button>
                    `);

                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat ambil detail menu.');
                },
                complete: function() {
                    // Loader selalu hilang setelah request selesai
                    hideLoader();
                }
            });
        });

        // fungsi load parent menu dropdown
        function loadParentMenuDropdown(selectedId = null) {
            $.ajax({
                url: '{{ route('fetch-menu-permission') }}',
                type: 'GET',
                success: function(res) {
                    let html = `<label class="form-label">Pilih Parent Menu</label>
                                <select class="form-select" name="parent_id" id="parent_id">
                                    <option value="">-- Pilih Parent Menu --</option>`;
                    $.each(res.data, function(i, menu) {
                        let selected = (selectedId && selectedId == menu.id) ? 'selected' : '';
                        html += `<option value="${menu.id}" ${selected}>${menu.name}</option>`;
                    });
                    html += `</select>`;
                    $('#parent_menu').html(html);
                    $('#parent_id').select2({
                        dropdownParent: $('#modalMenuPermission'),
                        placeholder: 'Select One',
                        // allowClear: true,
                    })
                }
            });
        }

        $(document).on('click', '.list_sub_menu', function(e) {
            e.preventDefault();

            let menu_id = $(this).data('menu_id');
            if (!menu_id) {
                alert('Tidak ada child menu');
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-child-menu') }}',
                type: 'GET',
                data: {
                    parent_id: menu_id
                },
                beforeSend: function() {
                    showLoader();
                },
                success: function(res) {
                    $('#modalChildMenuLabel').text('Detail Child Menu');
                    $('#table_child_menu').DataTable().clear().destroy();
                    $('#table_child_menu tbody').empty();

                    $.each(res.data, function(i, menu) {
                        $('#table_child_menu tbody').append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${menu.name}</td>
                        <td>${menu.url}</td>
                        <td>${menu.icon}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary edit_child_menu" data-menu_id="${menu.id}" data-bs-toggle="modal" data-bs-target="#modalMenuPermission"><i class="ti ti-edit"></i></button>
                        </td>
                    </tr>
                `);
                    });

                    $('#table_child_menu').DataTable().draw();
                    $('#modalChildMenu').modal('show');
                },
                error: function(xhr) {
                    alert('Error fetching sub menu: ' + xhr.responseText);
                },
                complete: function() {
                    // Loader selalu hilang setelah request selesai
                    hideLoader();
                }
            });
        });

    });
</script>
