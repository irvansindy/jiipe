<script>
    $(() => {
        var table_users = $('#table_users').DataTable({
            processing: true,
            ajax: {
                url: '{{ route('fetch-users') }}',
                type: 'GET',
                dataType: 'json'
            },
            columns : [
                {
                    data: 'name',
                    name: 'name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'roles[0].name',
                    name: 'roles',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-user_id="'+item.id+'" class="btn btn-outline-info btn-sm mt-2 detail_user" data-toggle="modal" data-target="#modalUsers">View</button>'
                    }
                },
            ]
        })

        var table_roles = $('#table_roles').DataTable({
            processing: true,
            ajax: {
                url: '{{ route('fetch-roles') }}',
                type: 'GET',
                dataType: 'json'
            },
            columns : [
                {
                    data: 'name',
                    name: 'name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-role_id="'+item.id+'" class="btn btn-outline-info btn-sm mt-2 detail_role" data-toggle="modal" data-target="#formUpdateUser">View</button>'
                    }
                },
            ]
        })
        
        $('#refresh_table_users').click(() => {
            table_users.ajax.reload(null, false);
        })

        $('#refresh_table_roles').click(() => {
            table_roles.ajax.reload(null, false);
        })

        $(document).on('click', '#create_users', function(e) {
            e.preventDefault()
            $('#form_users')[0].reset()
            $('#ModalUsersLabel').html('Create New User')
            $('#select_user_role').empty().append(`
                <label for="user_role">Role</label>
                <select class="form-control" name="user_role" id="user_role"></select>
            `)
        })

        $(document).on('click', '.detail_user', function(e) {
            e.preventDefault()
            let user_id = $(this).data('user_id')
            $('#ModalUsers').modal('hide')
            $('#form_users')[0].reset()
            $('#ModalUsers').modal('show')
            $('#ModalUsersLabel').html('Detail User')
            $('#select_user_role').empty().append(`
                <label for="user_role">Role</label>
                <select class="form-control" name="user_role" id="user_role"></select>
            `)
            if ($('#form_users input[name="id"]').length === 0) {
                $('#form_users').append(`<input type="hidden" name="id" value="${user_id}">`);
            } else {
                $('#form_users input[name="id"]').val(user_id);
            }
        })
    })
</script>