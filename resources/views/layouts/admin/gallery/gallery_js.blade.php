<script>
    function showLoader() {
        $("#modalLoader").fadeIn(200);
    }

    function hideLoader() {
        $("#modalLoader").fadeOut(200);
    }

    function clearFormErrors() {
        $('[id^=message_]').text('');
        $('.is-invalid').removeClass('is-invalid');
    }

    function resetForm() {
        $('#form_gallery')[0].reset();
        $('#form_gallery input[name="id"]').remove();
        clearFormErrors();

        // Reset image preview
        $('#currentMainImage').remove();
        $('#existingImages').empty();

        // Reset detail images field
        $('#imageFields').empty().append(`
            <div class="col-12 col-md-6 image-item">
                <div class="input-group">
                    <input type="file" name="gallery_image_detail[]" class="form-control" accept="image/*">
                    <button class="btn btn-outline-danger remove-field" type="button">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
        `);
    }

    $(function () {
        var $imageFields = $('#imageFields');

        // ============================================
        // CREATE GALLERY
        // ============================================
        $('#create_gallery').on('click', function () {
            resetForm();

            $('#modalGalleryLabel').html('<i class="ti ti-plus"></i> Form Create Gallery');

            // Set default status
            $("input[name='gallery_status'][value='1']").prop("checked", true);

            $('#button_action_gallery').empty().append(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_gallery">
                    <i class="ti ti-device-floppy"></i> Submit
                </button>
            `);
        });

        // ============================================
        // MANAGE DETAIL IMAGES
        // ============================================

        // Add new image field
        $('#addImage').on('click', function () {
            var $div = $(`
                <div class="col-12 col-md-6 image-item">
                    <div class="input-group">
                        <input type="file" name="gallery_image_detail[]" class="form-control" accept="image/*">
                        <button class="btn btn-outline-danger remove-field" type="button">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>
            `);
            $imageFields.append($div);
        });

        // Remove image field
        $imageFields.on('click', '.remove-field', function () {
            $(this).closest('.image-item').remove();
        });

        // Sortable for image fields
        if (typeof Sortable !== 'undefined') {
            Sortable.create(document.getElementById('imageFields'), {
                animation: 150,
                handle: '.input-group'
            });
        }

        // ============================================
        // SUBMIT CREATE GALLERY
        // ============================================
        $(document).on('click', '#submit_gallery', function (e) {
            e.preventDefault();
            clearFormErrors();

            var formData = new FormData($('#form_gallery')[0]);
            var $btn = $(this);

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
                    $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
                    showLoader();
                },
                success: function(res){
                    hideLoader();
                    $btn.prop('disabled', false).html('<i class="ti ti-device-floppy"></i> Submit');

                    if(res.meta && res.meta.status === 'success'){
                        $('#modalGallery').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.meta.message || 'Gallery created successfully',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.meta?.message || 'Failed to create gallery'
                        });
                    }
                },
                error: function(xhr){
                    hideLoader();
                    $btn.prop('disabled', false).html('<i class="ti ti-device-floppy"></i> Submit');

                    if(xhr.status === 422 && xhr.responseJSON.data){
                        var errors = xhr.responseJSON.data;

                        $.each(errors, function (key, val) {
                            var errorMsg = Array.isArray(val) ? val[0] : val;
                            var fieldId = '#message_' + key.replace(/\./g, '_');
                            $(fieldId).text(errorMsg);

                            // Add is-invalid class to input
                            var inputName = key.replace(/\./g, '[') + ']';
                            $('[name="' + inputName + '"]').addClass('is-invalid');
                        });

                        Swal.fire({
                            icon: 'warning',
                            title: 'Validation Error',
                            text: 'Please check the form for errors',
                            timer: 2000
                        });
                    } else {
                        var errorMessage = xhr.responseJSON?.meta?.message ||
                                         xhr.responseJSON?.message ||
                                         'Server error occurred';

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                }
            });
        });

        // ============================================
        // EDIT GALLERY
        // ============================================
        $(document).on('click', '.action_edit_gallery', function(e) {
            e.preventDefault();
            resetForm();

            let gallery_id = $(this).data('gallery_id');

            $('#modalGalleryLabel').html('<i class="ti ti-pencil"></i> Form Edit Gallery');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-gallery-id') }}",
                method: "GET",
                data: { id: gallery_id },
                beforeSend: function(){
                    showLoader();
                },
                success: function(res) {
                    hideLoader();

                    if(res.meta && res.meta.status === 'success') {
                        let gallery = res.data;

                        // Add hidden ID field
                        $('#form_gallery').prepend(`<input type="hidden" name="id" value="${gallery.id}">`);

                        // Set form values
                        $('#gallery_topic').val(gallery.topic_id).trigger('change');
                        $('#gallery_video_url').val(gallery.url_video || '');
                        $("input[name='gallery_status'][value='" + (gallery.is_active ? 1 : 0) + "']").prop("checked", true);

                        // Set translations
                        if(gallery.translations_by_locale) {
                            $.each(gallery.translations_by_locale, function(locale, trans) {
                                $('#news_title_' + locale).val(trans.title || '');
                            });
                        }

                        // Show current main image
                        if(gallery.image) {
                            let imageUrl = "{{ asset('uploads/gallery/') }}/" + gallery.image;
                            $('#gallery_main_image').after(`
                                <div id="currentMainImage" class="mt-2">
                                    <p class="small text-muted">Current Image:</p>
                                    <img src="${imageUrl}" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            `);
                            $('#gallery_main_image').removeAttr('required');
                        }

                        // Show existing detail images
                        if(gallery.images && gallery.images.length > 0) {
                            let imagesHtml = '<div class="row g-2 mt-2" id="existingImages">';
                            gallery.images.forEach(function(img) {
                                let imgUrl = "{{ asset('uploads/gallery/') }}/" + img.image;
                                imagesHtml += `
                                    <div class="col-4" id="img-${img.id}">
                                        <div class="position-relative">
                                            <img src="${imgUrl}" class="img-thumbnail" style="height: 100px; width: 100%; object-fit: cover;">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-detail-image" data-image-id="${img.id}">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </div>
                                    </div>
                                `;
                            });
                            imagesHtml += '</div>';
                            $('.card-body').prepend(imagesHtml);
                        }

                        // Update button
                        $('#button_action_gallery').empty().append(`
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update_gallery">
                                <i class="ti ti-device-floppy"></i> Update
                            </button>
                        `);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.meta?.message || 'Failed to fetch gallery data'
                        });
                    }
                },
                error: function(xhr) {
                    hideLoader();

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.meta?.message || 'Failed to load gallery data'
                    });
                }
            });
        });

        // ============================================
        // SUBMIT UPDATE GALLERY
        // ============================================
        $(document).on('click', '#update_gallery', function (e) {
            e.preventDefault();
            clearFormErrors();

            var formData = new FormData($('#form_gallery')[0]);
            var $btn = $(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('update-gallery') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Updating...');
                    showLoader();
                },
                success: function(res){
                    hideLoader();
                    $btn.prop('disabled', false).html('<i class="ti ti-device-floppy"></i> Update');

                    if(res.meta && res.meta.status === 'success'){
                        $('#modalGallery').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.meta.message || 'Gallery updated successfully',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.meta?.message || 'Failed to update gallery'
                        });
                    }
                },
                error: function(xhr){
                    hideLoader();
                    $btn.prop('disabled', false).html('<i class="ti ti-device-floppy"></i> Update');

                    if(xhr.status === 422 && xhr.responseJSON.data){
                        var errors = xhr.responseJSON.data;

                        $.each(errors, function (key, val) {
                            var errorMsg = Array.isArray(val) ? val[0] : val;
                            var fieldId = '#message_' + key.replace(/\./g, '_');
                            $(fieldId).text(errorMsg);
                        });

                        Swal.fire({
                            icon: 'warning',
                            title: 'Validation Error',
                            text: 'Please check the form for errors',
                            timer: 2000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.meta?.message || 'Server error occurred'
                        });
                    }
                }
            });
        });

        // ============================================
        // DELETE DETAIL IMAGE
        // ============================================
        $(document).on('click', '.delete-detail-image', function() {
            let imageId = $(this).data('image-id');
            let $imageContainer = $('#img-' + imageId);

            Swal.fire({
                title: 'Delete this image?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('delete-gallery-image') }}",
                        method: "POST",
                        data: { image_id: imageId },
                        success: function(res) {
                            if(res.meta && res.meta.status === 'success') {
                                $imageContainer.fadeOut(300, function() {
                                    $(this).remove();
                                });

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Image has been deleted',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to delete image'
                            });
                        }
                    });
                }
            });
        });

        // ============================================
        // VIEW GALLERY DETAIL (Modal atau halaman baru)
        // ============================================
        $(document).on('click', '.action_view_gallery', function(e) {
            e.preventDefault();
            let gallery_id = $(this).data('gallery_id');

            // Redirect ke halaman detail atau buka modal
            window.location.href = "{{ url('admin/gallery') }}/" + gallery_id;
            // Atau gunakan modal untuk preview
        });

        // ============================================
        // DELETE GALLERY
        // ============================================
        $(document).on('click', '.action_delete_gallery', function(e) {
            e.preventDefault();
            let gallery_id = $(this).data('gallery_id');

            Swal.fire({
                title: 'Delete this gallery?',
                text: "All images and data will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('delete-gallery') }}",
                        method: "POST",
                        data: { id: gallery_id },
                        beforeSend: function() {
                            showLoader();
                        },
                        success: function(res) {
                            hideLoader();

                            if(res.meta && res.meta.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Gallery has been deleted',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            hideLoader();

                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to delete gallery'
                            });
                        }
                    });
                }
            });
        });

        // ============================================
        // MODAL CLOSE HANDLER
        // ============================================
        $('#modalGallery').on('hidden.bs.modal', function () {
            resetForm();
        });
    });
</script>