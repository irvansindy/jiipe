<script>
$(document).ready(function(){
    var table = $('#table_zone_showcase').DataTable({
        processing: true,
        // serverSide: true,
        ajax: '{{ route('fetch-zone') }}',
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
                    return '<button type="button" data-zone_show_case_id="' + item.id +
                        '" class="btn btn-outline-info btn-sm mt-2 detail_zone_show_case" data-toggle="modal" data-target="#ModalZoneShowCase">View</button>'
                }
            },
        ]
    });
});
</script>