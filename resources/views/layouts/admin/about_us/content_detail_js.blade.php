<script>
    if (!$.fn.tooltip) {
        $.fn.tooltip = function() {
            return this; // dummy tooltip agar Summernote gak error
        };
    }
    $('.summernote').summernote({
        height: 200
    });
    $('#table_list_content_detail').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('about-us-fetch-content-detail') }}",
            type: 'GET',
        },
        columns: [{
                data: 'translations[0].title',
                name: 'title'
            },
            {
                data: 'icon',
                name: 'icon'
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    return moment(data).format('LL');
                }
            },
            {
                data: null,
                title: 'Action',
                orderable: false,
                searchable: false,
                render: function(item) {
                    return `
                    <button type="button" data-id="${item.id}" class="btn btn-outline-info me-1 mt-2 detail_news" data-bs-toggle="modal" data-bs-target="#modalNews" title="Detail Zone"><i class="ti ti-edit"></i></button>
                `;
                }
            }
        ],
    });

    $(document).on('click', '#create_content_detail', function() {
        $('#form_content_detail')[0].reset()
        $('#button_action_content_detail').empty().append(`
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="submit_content_detail">Submit</button>
        `)
    })

    $(document).on('click', '#submit_content_detail', function(e) {
        e.preventDefault()
        let formData = new FormData($('#form_content_detail')[0])
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('store-about-us-content-detail') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                $('#modalContentDetail').modal('hide');
                $('#table_list_content_detail').DataTable().ajax.reload();

            },
            error: function(xhr) {
                let errors = xhr.responseJSON.meta.message;
                console.log(errors);

                $('.text-danger').text('');
                $.each(errors, function(key, value) {
                    console.log(value[0]);

                    $('#message_' + key.replace(/\./g, '_')).text(value[0]);
                });
            }
        })
    })
</script>
