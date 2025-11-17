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
            success: function(res) {
                $('#tenant_id').val(tenant_id);
                let baseUrl = "{{ asset('storage/tenant-logo') }}";
                let defaultImage = "{{ asset('images/no-image.png') }}";

                let current_image = res.data.logo
                ? baseUrl + '/' + res.data.logo
                : defaultImage;
                    console.log(current_image);

                $('#current_logo').attr('src', current_image);

                $.each(res.data.translations, function(index, translation) {
                    $('#tenant_name_' + translation.locale).val(translation.name || '');
                    $('#tenant_description_' + translation.locale).val(translation.description || '');
                });

                $('#is_active').prop('checked', res.data.is_active);
                $('#action_tenant').data('tenant_id', tenant_id);
                $('#ModalTenant').modal('show');
            },
            error: function() {
                alert('Failed to fetch tenant data.');
            }
        });
    });

    $('#tenantForm').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var tenant_id = $('#action_tenant').data('tenant_id');
        var url = tenant_id ? 'update-tenant' : 'store-tenant';

        if (tenant_id) {
            formData.append('tenant_id', tenant_id);
        }

        $('#action_tenant .spinner-border').removeClass('d-none');

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                $('#ModalTenant').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, messages) {
                    $('#message_' + key).text(messages[0]);
                });
            },
            complete: function() {
                $('#action_tenant .spinner-border').addClass('d-none');
            }
        });
    });
});
</script>