<script>
$(document).ready(function() {
    // ============================================
    // HELPER FUNCTIONS
    // ============================================

    function showLoading() {
        $('#loadingOverlayContact').css('display', 'flex').hide().fadeIn(200);
    }

    function hideLoading() {
        $('#loadingOverlayContact').fadeOut(200);
    }

    // Initialize Summernote
    function initSummernote() {
        $('.summernote-contact').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        $('.summernote-contact').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    }

    // Preview image upload
    function previewImage(input, previewElementId) {
        const file = input.files[0];
        const previewElement = $(`#${previewElementId}`);

        if (file) {
            if (file.type.match(/^image\/(jpeg|jpg|png|webp)$/)) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.html(`
                        <img src="${e.target.result}" class="img-thumbnail" style="max-width:300px;max-height:300px;">
                        <p class="text-muted small mt-1">New image selected</p>
                    `);
                };
                reader.readAsDataURL(file);
            } else {
                previewElement.html(`
                    <div class="alert alert-danger py-2 mb-0">
                        <i class="ti ti-alert-circle me-2"></i>
                        Please select a valid image (JPG, PNG, WebP)
                    </div>
                `);
            }
        } else {
            previewElement.html('');
        }
    }

    // Handle image preview
    $('#contact_image').on('change', function() {
        previewImage(this, 'preview_contact_image');
    });

    // ============================================
    // LOAD DATA
    // ============================================

    function loadContactData() {
        showLoading();

        $.ajax({
            url: '{{ route("fetch-contact-overview") }}',
            method: 'GET',
            success: function(res) {
                hideLoading();

                if (res.status === 'success' || (res.meta && res.meta.status === 'success')) {
                    let data = res.data;

                    if (data) {
                        $('#contact_id').val(data.id);

                        // Show current image
                        if (data.image) {
                            let imageUrl = '{{ url('/uploads') }}/' + data.image;
                            $('#preview_contact_image').html(`
                                <img src="${imageUrl}" class="img-thumbnail" style="max-width:300px;max-height:300px;">
                                <p class="text-muted small mt-1">Current image (upload new to replace)</p>
                            `);
                        }

                        // Initialize summernote first
                        initSummernote();

                        // Fill translations after summernote is ready
                        setTimeout(() => {
                            $.each(data.translations, function(locale, trans) {
                                $(`#title_${locale}`).val(trans.title);
                                $(`#subtitle_${locale}`).val(trans.subtitle);
                                $(`#description_${locale}`).summernote('code', trans.description || '');
                                $(`#office_name_${locale}`).val(trans.office_name);
                                $(`#phone_${locale}`).val(trans.phone);
                                $(`#address_${locale}`).val(trans.address);
                                $(`#map_link_${locale}`).val(trans.map_link);
                            });
                        }, 100);
                    } else {
                        // No data yet, just initialize summernote
                        initSummernote();
                    }
                }
            },
            error: function(xhr) {
                hideLoading();
                console.error('Error loading data:', xhr);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load contact data'
                });
                // Still initialize summernote on error
                initSummernote();
            }
        });
    }

    // Load data on page ready
    loadContactData();

    // Refresh button
    $('#btnRefreshContact').on('click', function() {
        loadContactData();
    });

    // ============================================
    // SUBMIT FORM
    // ============================================

    $('#formContactOverview').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        // Get summernote content for all locales
        @foreach(config('laravellocalization.supportedLocales') as $locale => $properties)
        formData.set('description[{{ $locale }}]', $('#description_{{ $locale }}').summernote('code'));
        @endforeach

        // Clear previous errors
        $('[id^="error_contact_"]').text('');

        showLoading();
        $('#btnSaveContact').prop('disabled', true).html('<i class="ti ti-loader me-1"></i> Saving...');

        $.ajax({
            url: '{{ route("store-contact-overview") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                hideLoading();
                $('#btnSaveContact').prop('disabled', false).html('<i class="ti ti-device-floppy me-1"></i> Save Changes');

                if (res.status === 'success' || (res.meta && res.meta.status === 'success')) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: res.message || 'Contact overview saved successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Reload data after save
                    setTimeout(() => {
                        loadContactData();
                    }, 2000);
                }
            },
            error: function(xhr) {
                hideLoading();
                $('#btnSaveContact').prop('disabled', false).html('<i class="ti ti-device-floppy me-1"></i> Save Changes');

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let errors = xhr.responseJSON.errors;

                    // Display field-specific errors
                    $.each(errors, function(key, messages) {
                        let fieldName = key.replace(/\./g, '_');
                        let errorElement = $(`#error_contact_${fieldName}`);

                        if (errorElement.length) {
                            errorElement.text(Array.isArray(messages) ? messages[0] : messages);
                        }
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error!',
                        text: 'Please check all fields'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Server error occurred'
                    });
                }
            }
        });
    });

    // Debug
    console.log('Contact Overview module loaded');
});
</script>