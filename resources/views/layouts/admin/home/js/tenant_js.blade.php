<script>
$(document).ready(function(){
    var table = $('#table_tenant').DataTable({
        processing: true,
        // serverSide: true,
        ajax: '{{ route('fetch-tenant') }}',
        columns: [
            {
                data: 'translations[0].name',
                name: 'translations[0].name',
                defaultContent: '<i>Not set</i>'
            },
            { data: 'created_at', name: 'created_at', render: function(data) {
                        return moment(data).format('LL');
                    }},
            {
                data: null,
                title: 'Action',
                wrap: true,
                render: function(item) {
                    return '<button type="button" data-tenant_id="' + item.id +
                        '" class="btn btn-outline-info btn-sm mt-2 detail_tenant" data-toggle="modal" data-target="#ModalTenant">View</button>'
                }
            },
        ]
    });

    $(document).on('click', '#refresh_table_tenant', function(){
        table.ajax.reload();
    });

    $(document).on('click', '#create_tenant', function(){
        // Clear previous messages
        $('[id^="message_"]').text('');
        // Clear form fields
        @foreach ($locales as $locale => $properties)
            $('#tenant_name_{{ $locale }}').val('');
            $('#tenant_description_{{ $locale }}').val('');
        @endforeach
        $('#is_active').prop('checked', true);
        $('#action_tenant').removeData('tenant_id');
    });

    $(document).on('click', '.detail_tenant', function(){
        var tenant_id = $(this).data('tenant_id');
        // Clear previous messages
        $('[id^="message_"]').text('');

        // Fetch tenant data via AJAX
        $.ajax({
            url: 'fetch-tenant-by-id/' + tenant_id,
            method: 'GET',
            success: function(response) {
                // Populate the modal fields with the fetched data
                console.log(response);
                
                @foreach ($locales as $locale => $properties)
                    $('#tenant_name_{{ $locale }}').val(response.translations['{{ $locale }}'].name || '');
                    $('#tenant_description_{{ $locale }}').val(response.translations['{{ $locale }}'].description || '');
                @endforeach
                $('#is_active').prop('checked', response.is_active);
                $('#action_tenant').data('tenant_id', tenant_id);
                $('#ModalTenant').modal('show');
            },
            error: function() {
                alert('Failed to fetch tenant data.');
            }
        });
    });
});
</script>