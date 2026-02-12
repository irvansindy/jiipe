<script>
$(document).ready(function() {
    // ============================================
    // HELPER FUNCTIONS
    // ============================================

    function showLoading() {
        $('#loadingOverlayBrochure').css('display', 'flex').hide().fadeIn(200);
    }

    function hideLoading() {
        $('#loadingOverlayBrochure').fadeOut(200);
    }

    function resetForm() {
        $('#formBrochure')[0].reset();
        $('#brochure_id').val('');

        // Clear all error messages
        $('[id^="error_brochure_"]').text('');

        // Clear image preview
        $('#preview_brochure_image').html('');

        // Clear PDF previews and file indicators
        @foreach(config('laravellocalization.supportedLocales') as $locale => $properties)
        $('#preview_brochure_file_{{ $locale }}').html('');
        $('#current_file_{{ $locale }}').html('');
        @endforeach

        // Reset status to active
        $('#status_active').prop('checked', true);

        // Image is required for create
        $('#brochure_image').prop('required', true);
    }

    // Preview image upload (PNG/WebP only)
    function previewImage(input, previewElementId) {
        const file = input.files[0];
        const previewElement = $(`#${previewElementId}`);

        if (file) {
            // Check if file is PNG or WebP
            if (file.type === 'image/png' || file.type === 'image/webp') {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.html(`
                        <img src="${e.target.result}" class="img-thumbnail" style="max-width:300px;max-height:300px;" loading="lazy" decoding="async">
                        <p class="text-muted small mt-1">New image selected</p>
                    `);
                };
                reader.readAsDataURL(file);
            } else {
                previewElement.html(`
                    <div class="alert alert-danger py-2 mb-0">
                        <i class="ti ti-alert-circle me-2"></i>
                        Please select a valid PNG or WebP image
                    </div>
                `);
            }
        } else {
            previewElement.html('');
        }
    }

    // Preview PDF upload
    function previewPDF(input, previewElementId) {
        const file = input.files[0];
        const previewElement = $(`#${previewElementId}`);

        if (file) {
            // Get file size in MB
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

            // Check if file is PDF
            if (file.type === 'application/pdf') {
                previewElement.html(`
                    <div class="alert alert-success py-2 mb-0">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-file-pdf" style="font-size: 2rem; color: #dc3545;"></i>
                            <div class="ms-3">
                                <strong>${file.name}</strong><br>
                                <small class="text-muted">Size: ${fileSizeMB} MB</small>
                            </div>
                        </div>
                        <p class="text-muted small mb-0 mt-2">New PDF file selected</p>
                    </div>
                `);
            } else {
                previewElement.html(`
                    <div class="alert alert-danger py-2 mb-0">
                        <i class="ti ti-alert-circle me-2"></i>
                        Please select a valid PDF file
                    </div>
                `);
            }
        } else {
            previewElement.html('');
        }
    }

    // Handle image upload preview
    $('#brochure_image').on('change', function() {
        previewImage(this, 'preview_brochure_image');
    });

    // Handle PDF upload preview for all locales
    $('.brochure-pdf-input').on('change', function() {
        const locale = $(this).data('locale');
        previewPDF(this, `preview_brochure_file_${locale}`);
    });

    // ============================================
    // EVENT HANDLERS
    // ============================================

    // Create brochure button
    $('#create_brochure').on('click', function() {
        resetForm();
        $('#modalBrochureLabel').text('Add Brochure');
        $('#modalBrochure').modal('show');
    });

    // Edit brochure button
    $(document).on('click', '.btn-edit-brochure', function() {
        let brochureId = $(this).data('id');

        showLoading();

        $.ajax({
            url: "{{ route('fetch-brochure-id') }}",
            method: 'GET',
            data: { id: brochureId },
            success: function(res) {
                hideLoading();

                if (res.status === 'success' || (res.meta && res.meta.status === 'success')) {
                    let data = res.data;

                    $('#brochure_id').val(data.id);
                    $('#modalBrochureLabel').text('Edit Brochure');

                    // Clear form first
                    $('#formBrochure')[0].reset();

                    // Clear error messages
                    $('[id^="error_brochure_"]').text('');

                    // Image is not required for update
                    $('#brochure_image').prop('required', false);

                    // Set status
                    $(`input[name='is_active'][value='${data.is_active}']`).prop('checked', true);

                    // Show current image
                    if (data.image && data.image !== 'default.jpg') {
                        let imageUrl = data.image.startsWith('http') ? data.image : '{{ url('/uploads') }}/' + data.image;
                        $('#preview_brochure_image').html(`
                            <img src="${imageUrl}" class="img-thumbnail" style="max-width:300px;max-height:300px;" loading="lazy" decoding="async">
                            <p class="text-muted small mt-1">Current image (upload new to replace)</p>
                        `);
                    }

                    // Fill translations
                    $.each(data.translations, function(locale, trans) {
                        $(`#brochure_title_${locale}`).val(trans.title);
                        $(`#brochure_subtitle_${locale}`).val(trans.subtitle);

                        // Show current translation PDF file if exists
                        if (trans.file) {
                            let fileName = trans.file.split('/').pop();
                            $(`#current_file_${locale}`).html(`
                                <div class="alert alert-info py-2 mb-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-file-pdf me-2" style="font-size: 1.5rem; color: #dc3545;"></i>
                                            <div>
                                                <strong>${fileName}</strong><br>
                                                <small class="text-muted">Current PDF file</small>
                                            </div>
                                        </div>
                                        <a href="{{ url('/uploads') }}/${trans.file}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-external-link"></i> View
                                        </a>
                                    </div>
                                </div>
                            `);
                        }
                    });

                    $('#modalBrochure').modal('show');
                }
            },
            error: function(xhr) {
                hideLoading();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: xhr.responseJSON?.message || 'Failed to load brochure data'
                });
            }
        });
    });

    // Delete brochure button
    $(document).on('click', '.btn-delete-brochure', function() {
        let brochureId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();

                $.ajax({
                    url: `/admin/brochure/${brochureId}/delete`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        hideLoading();

                        if (res.status === 'success' || (res.meta && res.meta.status === 'success')) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: res.message || 'Brochure has been deleted.',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            // Reload page or update UI
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Failed to delete brochure'
                        });
                    }
                });
            }
        });
    });

    // Submit form
    $('#formBrochure').on('submit', function(e) {
        e.preventDefault();

        let brochureId = $('#brochure_id').val();
        let url = brochureId ? `/admin/brochure/${brochureId}/update` : '{{ route("store-brochure") }}';
        let formData = new FormData(this);

        // Clear previous errors
        $('[id^="error_brochure_"]').text('');

        showLoading();
        $('#btnSaveBrochure').prop('disabled', true).html('<i class="ti ti-loader me-1"></i> Saving...');

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                hideLoading();
                $('#btnSaveBrochure').prop('disabled', false).html('<i class="ti ti-device-floppy me-1"></i> Save');

                if (res.status === 'success' || (res.meta && res.meta.status === 'success')) {
                    $('#modalBrochure').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: res.message || (brochureId ? 'Brochure updated successfully!' : 'Brochure created successfully!'),
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Reload page or update UI
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function(xhr) {
                hideLoading();
                $('#btnSaveBrochure').prop('disabled', false).html('<i class="ti ti-device-floppy me-1"></i> Save');

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let errors = xhr.responseJSON.errors;

                    // Display field-specific errors
                    $.each(errors, function(key, messages) {
                        let fieldName = key.replace(/\./g, '_');
                        let errorElement = $(`#error_brochure_${fieldName}`);

                        if (errorElement.length) {
                            errorElement.text(Array.isArray(messages) ? messages[0] : messages);
                        }
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error!',
                        text: 'Please check all required fields'
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

    // Clean up on modal close
    $('#modalBrochure').on('hidden.bs.modal', function() {
        resetForm();
    });

    // Debug: Check if modal exists
    console.log('Modal Brochure exists:', $('#modalBrochure').length > 0);
    console.log('Loading overlay exists:', $('#loadingOverlayBrochure').length > 0);
});
</script>