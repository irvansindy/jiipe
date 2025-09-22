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
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
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
                        return '<button type="button" data-user_id="'+item.id+'" class="btn btn-outline-info btn-sm mt-2 detail_user" data-toggle="modal" data-target="#formUpdateUser">View</button> <button type="button" data-user_id="'+item.id+'" data-user_name="'+item.name+'" data-role_user="'+item.roles[0].name+'" class="btn btn-outline-danger btn-sm mt-2 delete_user" data-toggle="modal" data-target="#confirmDeleteUser">Delete</button>'
                    }
                },
            ]
        })
    })
</script>