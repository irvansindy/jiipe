<script>
    $(document).ready(function() {
        function showLoader() {
        $("#modalLoader").fadeIn(200);
        }

        function hideLoader() {
            $("#modalLoader").fadeOut(200);
        }

        var table_zone = $('#table_zone').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('fetch-zone') }}",
                type: 'GET',
            },
            columns: [
                { data: 'translations[0].name', name: 'name' },
                { data: 'translations[0].subtitle', name: 'subtitle' },
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    searchable: false,
                    render: function(item) {
                        return `
                        <button type="button" 
                            data-menu_id="${item.id}" 
                            class="btn btn-outline-info me-1 mt-2 detail_zone" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ModalZone" 
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
            ],
            order: [[0, 'asc']],
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            responsive: true,
        });

        var table_special_zone = $('#table_special_zone').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('fetch-special-zone') }}",
                type: 'GET',
            },
            columns: [
                { data: 'translations[0].name', name: 'name' },
                { data: 'translations[0].subtitle', name: 'subtitle' },
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
            ],
            order: [[0, 'asc']],
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            responsive: true,
        });
        
        $('#refresh_table_zone').on('click', function() {
            table_special_zone.ajax.reload();
            table_zone.ajax.reload();
        });
        
        $(document).on('click', '#create_zone', function() {
            $('.form_zone').attr('id', 'form_zone'); // Set id ke form_zone
            $('#form_zone')[0].reset();
            $('#modalZoneLabel').text('Create Zone');
            $('#zone_class').val(2);
            $('.zone_summernote').summernote({
                height: 200,
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-zone-class') }}",
                method: 'GET',
                success: function(res) {
                    $('.zone_class').empty();
                    $('.zone_class').select2({
                        dropdownParent: $('#modalZone'),
                        data: res.data.map(zone => ({
                            id: zone.id,
                            text: zone.translations[0].name
                        })),
                        placeholder: 'Select One',
                    })
                }
            })
        })

        // $('#form_zone').on('submit', function(e) {
        //     e.preventDefault();
        //     var formData = new FormData(this);
        //     $.ajax({
        //         url: "{{ route('store-zone') }}",
        //         method: 'POST',
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         beforeSend: function() {
        //             showLoader();
        //         },
        //         success: function(response) {
        //             $('#modalZone').modal('hide');
        //             table_zone.ajax.reload();
        //             table_special_zone.ajax.reload();
        //             alert('Zone created successfully!');
        //         },
        //         error: function(xhr) {
        //             // Tampilkan notifikasi error
        //             let response_error = JSON.parse(xhr.responseText)
        //             $('.text-danger').text('')
        //             $.each(response_error.meta.message.errors, function(i, value) {
        //                 $('#message_' + i.replace('.', '_')).text(value)
        //             })
        //         },
        //         complete: function() {
        //             hideLoader();
        //         }
        //     });
        // });
        $('.form_zone').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            let zoneId = $(this).data('zone-id');
            let url = zoneId ? "zone/" + zoneId + "/update" : "{{ route('store-zone') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() { showLoader(); },
                success: function(response) {
                    $('#modalZone').modal('hide');
                    table_zone.ajax.reload();
                    table_special_zone.ajax.reload();
                    alert(zoneId ? 'Zone updated successfully!' : 'Zone created successfully!');
                    $('#form_zone').removeData('zone-id');
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    $('.text-danger').text('')
                    $.each(response_error.meta.message.errors, function(i, value) {
                        $('#message_' + i.replace('.', '_')).text(value)
                    })
                },
                complete: function() { hideLoader(); }
            });
        });
    });
</script>