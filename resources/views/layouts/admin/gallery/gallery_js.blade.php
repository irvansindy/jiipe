<script>
    function showLoader() {
        $("#modalLoader").fadeIn(200);
    }

    function hideLoader() {
        $("#modalLoader").fadeOut(200);
    }
    
    $(function () {
        $('#create_gallery').on('click', function () {
            // set title form
            $('#modalGalleryLabel').html('Form Create Gallery')
            // Kosongkan semua field upload yang ada
            $('#imageFields').empty();

            // Tambahkan kembali 1 field upload awal
            $('#imageFields').append(`
                <div class="col-12 col-md-6 image-item">
                    <div class="input-group">
                        <input type="file" name="images[]" class="form-control">
                        <button class="btn btn-outline-danger remove-field" type="button">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>
            `);

            $('#button_action_gallery').empty().append(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_gallery">Submit</button>
            `)
        });

        var $imageFields = $('#imageFields');

        // Tambah field upload baru
        $('#addImage').on('click', function () {
            var $div = $('<div class="col-12 col-md-6 image-item">\
                <div class="input-group">\
                    <input type="file" name="gallery_image_detail[]" class="form-control">\
                    <button class="btn btn-outline-danger remove-field" type="button">\
                        <i class="ti ti-x"></i>\
                    </button>\
                </div>\
            </div>');
            $imageFields.append($div);
        });

        // Hapus field upload
        $imageFields.on('click', '.remove-field', function () {
            $(this).closest('.image-item').remove();
        });

        // Drag & drop sorting
        Sortable.create(document.getElementById('imageFields'), {
            animation: 150,
            handle: '.input-group' // drag di area input group
        });

        // submit create gallery
        $(document).on('click', '#submit_gallery', function (e) {
            e.preventDefault();

            var formData = new FormData($('#form_gallery')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('store-gallery') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#submit_gallery').prop('disabled', true).text('Saving...');
                    // bersihkan error
                    $('[id^=message_]').text('');
                    showLoader()
                },
                success: function(res){
                    $('#submit_gallery').prop('disabled', false).text('Submit');

                    if(res.status){
                        $('#modalGallery').modal('hide');
                        // opsional: refresh datatable atau list
                        Swal.fire('Berhasil', res.message, 'success');
                    }else{
                        Swal.fire('Gagal', res.message, 'error');
                    }
                    $('#modalGallery').modal('hide')
                },
                error: function(xhr){
                    $('#submit_gallery').prop('disabled', false).text('Submit');
                    if(xhr.status === 422){
                        var errors = xhr.responseJSON.errors;
                        // tampilkan pesan per field
                        $.each(errors, function (key, val) {
                            $('#message_' + key.replace('.', '_')).text(val[0]);
                        });
                    }else{
                        Swal.fire('Error', 'Terjadi kesalahan server', 'error');
                    }
                    hideLoader()
                },
                complete: function() {
                    hideLoader();
                }
            });
        });

        $(document).on('click', '.action_edit_gallery', function(e) {
            e.preventDefault()
            let gallery_id = $(this).data('gallery_id')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-gallery-id') }}",
                method: "GET",
                data: {
                    id: gallery_id
                },
                beforeSend: function(){
                    showLoader()
                },
                success: function(res) {
                    let gallery = res.data
                    $('#form_gallery')[0].reset()
                    $('#gallery_topic').val(gallery.topic_id).trigger('change');
                    $('#gallery_video_url').val(gallery.url_video);
                    $("input[name='gallery_status'][value='" + gallery.is_active + "']").prop("checked", true);
                    $.each(res.data.translations, (i, data) => {
                        $('#news_title_'+data.locale).val(data.title)
                    })
                    $('#button_action_gallery').empty().append(`
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update_gallery">Update</button>
                    `)
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    alert(errors)
                },
                complete: function() {
                    hideLoader();
                }
            })
        })
        
        $(document).on('click', '.action_view_gallery', function(e) {
            e.preventDefault()
            let gallery_id = $(this).data('gallery_id')
            alert(gallery_id)
        })
    });
</script>
