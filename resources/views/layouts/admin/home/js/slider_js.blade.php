<script>
$(function() {
    var table_slider = $('#table_slider').dataTable({
        processing: true,
        ajax: {
            url: "{{ route('fetch-home-slider') }}",
            type: 'GET',
                dataType: 'json'
        },
        columns: [{
                data: 'translations[0].title',
                name: 'translations[0].title',
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
                    return '<button type="button" data-slider_id="' + item.id +
                        '" class="btn btn-outline-info btn-sm mt-2 detail_slider" data-toggle="modal" data-target="#ModalSlider">View</button>'
                }
            },
        ]
    })
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('.slider_description').summernote()

    $('#create_slider').on('click', function(e) {
        $('#ModalSliderLabel').text('Create Slider');
        // alert('bisa modal')
        $('#slider_form')[0].reset();
        $('#slider_id').val('');
        $('[id^="message_"]').text('');
        $('#current_image, #current_video').html('');
        $('.slider_description').summernote('code', '');
        $('#ModalSlider').modal('show');
    });

    $(document).on('click', '.detail_slider', function() {
        let btn = $(this);
        let id = btn.data('slider_id');
        $('#slider_id').val(id);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{ route('fetch-home-slider-id') }}",
            type: 'GET',
            data: {
                id: id
            },
            success: function(res) {
                var fileUrl = res.data.file;
                if (fileUrl) {
                    // Tambahkan base URL jika fileUrl masih berupa path relatif
                    // Sesuaikan dengan base URL aplikasi Anda
                    var fullUrl = fileUrl;
                    if (!fileUrl.startsWith('http')) {
                        fullUrl = window.location.origin + '/' + fileUrl;
                        // Atau gunakan base URL spesifik:
                        // fullUrl = 'https://yourdomain.com/' + fileUrl;
                    }

                    if (fullUrl.match(/\.(mp4|webm|ogg)$/i)) {
                        $('#current_video').html('<video src="'+fullUrl+'" controls style="max-width:300px;max-height:180px;"></video>');
                        $('#current_image').html('');
                    } else if (fullUrl.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
                        $('#current_image').html('<img src="'+fullUrl+'" style="max-width:200px;max-height:120px;">');
                        $('#current_video').html('');
                    }
                } else {
                    $('#current_image, #current_video').html('');
                }
                console.log('File URL:', fileUrl);
                console.log('Full URL:', fullUrl);
                
                var translations = res.data.translations
                if (translations) {
                    Object.keys(translations).forEach(function(locale){
                        var t = translations[locale];

                        $('#slider_title_'+t.locale).val(t.title);
                        $('#slider_description_'+t.locale).val(t.description);
                        $('#slider_description_'+t.locale).summernote('code', t.description);
                        $('#is_active_'+t.locale).prop('checked', t.is_active == 1);
                    });
                }

                $('#ModalSlider .modal-title').text('Edit Slider');
                $('#ModalSlider').modal('show');
            }
        })
    });

    $('#slider_form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var $form = $(form);
        var id = $('#slider_id').val();
        var url = id ? '{{ route("update-home-slider") }}' : '{{ route("store-home-slider") }}';
        var method = id ? 'POST' : 'POST';
        var formData = new FormData(form);

        // if (id) {
        //     formData.append('_method', 'PUT');
        // }

        $('[id^="message_"]').text('');

        $.ajax({
            url: url,
            type: method,
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {
                if (res.meta && res.meta.status === 'success') {
                    $('#ModalSliderVideo').modal('hide');
                    location.reload();
                } else {
                    alert(res.meta.message || 'Unexpected response');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.data) {
                    var errors = xhr.responseJSON.data;
                    Object.keys(errors).forEach(function(key){
                        var name = key.replace(/\./g, '_');
                        var selector = '#message_' + name;
                        if ($(selector).length) {
                            $(selector).text(errors[key][0]);
                        } else {
                            console.warn('Unhandled error key', key, errors[key]);
                        }
                    });
                } else {
                    var msg = (xhr.responseJSON && xhr.responseJSON.meta && xhr.responseJSON.meta.message) ? xhr.responseJSON.meta.message : 'Server error';
                    alert(msg);
                }
            }
        });
    });

    $(document).on('click', '.btn-delete-slider', function(){
        if (!confirm('Delete this slider?')) return;
        var id = $(this).data('id');
        $.ajax({
            url: '/admin/home-sliders/' + id,
            type: 'POST',
            data: { _method: 'DELETE' },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'json',
            success: function(res){
                if (res.meta && res.meta.status === 'success') {
                    location.reload();
                } else {
                    alert(res.meta.message || 'Delete failed');
                }
            },
            error: function(xhr){
                alert('Delete failed');
            }
        });
    });
});
</script>