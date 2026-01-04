<script>
    $(document).ready(function() {
        const locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];

        var table_review = $('#table_user_review').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-reviews') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'name',
                    name: 'name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'position',
                    name: 'position',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: null,
                    title: 'Status',
                    wrap: true,
                    render: function(item) {
                        if (item.is_active == 1) {
                            return '<span class="badge text-bg-success">Active</span>'
                        } else {
                            return '<span class="badge text-bg-danger">Nonactive</span>'
                        }
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    wrap: true,
                    render: function(item) {
                        return `
                    <div class="btn-group" role="group">
                        <button type="button" data-review_id="${item.id}" class="btn btn-outline-info mt-2 detail_user_review" data-toggle="modal" data-target="#reviewModal">
                            <i class="ti ti-edit"></i>
                        </button>
                        <button type="button" data-id="${item.id}" class="btn btn-outline-danger mt-2 btn-delete">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                    `;
                    }
                },
            ]
        });

        // ============================================
        // HELPER FUNCTIONS
        // ============================================

        function resetForm() {
            $('#reviewForm')[0].reset();
            $('#review_id').val('');
            $('#method').val('POST');
            $('#reviewModalLabel').text('Add Review');
            $('#photo-preview').hide();
            $('.text-danger').text('');
            $('#reviewForm').find('.is-invalid').removeClass('is-invalid');
            $('#reviewForm').find('.ajax-error').remove();
            $('#photo').val('');
            $('.custom-file-label').text('Choose file');
            $('#photo-preview img').attr('src', '');

            // PERBAIKAN: Gunakan ID yang spesifik
            $('#review_is_active').prop('checked', true);

            // Reset semua textarea
            locales.forEach(locale => {
                $(`#description_${locale}`).val('');
            });
        }

        // Ensure form is cleaned when modal is hidden
        $('#reviewModal').on('hidden.bs.modal', function() {
            resetForm();
        });

        function showLoading() {
            $('#loadingOverlay').fadeIn();
            $('#btnSubmit .btn-text').addClass('d-none');
            $('#btnSubmit .spinner-border').removeClass('d-none');
            $('#btnSubmit').prop('disabled', true);
        }

        function hideLoading() {
            $('#loadingOverlay').fadeOut();
            $('#btnSubmit .btn-text').removeClass('d-none');
            $('#btnSubmit .spinner-border').addClass('d-none');
            $('#btnSubmit').prop('disabled', false);
        }

        // ============================================
        // EVENT HANDLERS
        // ============================================

        // Add button
        $('#btnAdd').click(function() {
            resetForm();
            $('#reviewModal').modal('show');
        });

        // Photo preview
        $('#photo').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#photo-preview img').attr('src', e.target.result);
                    $('#photo-preview').show();
                }
                reader.readAsDataURL(file);
                $('.custom-file-label').text(file.name);
            }
        });

        // Submit form (Create/Update)
        $('#reviewForm').submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const reviewId = $('#review_id').val();
            const url = reviewId ? `/admin/reviews/${reviewId}` : '/admin/reviews';

            if (reviewId) {
                formData.append('_method', 'PUT');
            }

            // Biarkan FormData natural handle is_active dari hidden input + checkbox
            // TIDAK perlu manipulasi manual lagi

            // Debug log
            console.log('=== REVIEW FORM DEBUG ===');
            console.log('Checkbox Status:', $('#review_is_active').is(':checked'));
            console.log('FormData entries:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            showLoading();
            $('.text-danger').text('');

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    hideLoading();
                    if (response.success) {
                        $('#reviewModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            table_review.ajax.reload();
                        });
                    }
                },
                error: function(xhr) {
                    hideLoading();

                    $('.text-danger').text('');
                    $('#reviewForm').find('.is-invalid').removeClass('is-invalid');

                    if (xhr.status === 422) {
                        const errors = (xhr.responseJSON && (xhr.responseJSON.errors || xhr
                            .responseJSON.data)) || {};
                        let firstMsg = null;

                        $.each(errors, function(key, value) {
                            const msg = Array.isArray(value) ? value[0] : value;
                            $(`#error-${key}`).text(msg);

                            const nameSelectors = [
                                `[name="${key}"], [name="${key}[]"]`,
                                `[name="${key.replace(/\./g,'_')}"]`
                            ];
                            let marked = false;
                            nameSelectors.forEach(function(sel) {
                                const $field = $('#reviewForm').find(sel);
                                if ($field.length) {
                                    $field.addClass('is-invalid');
                                    marked = true;
                                }
                            });

                            if (!marked) {
                                const $firstInput = $('#reviewForm').find(
                                    'input, textarea, select').first();
                                if ($firstInput.length) {
                                    $firstInput.addClass('is-invalid');
                                }
                            }

                            if (!firstMsg) firstMsg = msg;
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: firstMsg || 'Please check the highlighted fields',
                        });
                    } else {
                        const message = (xhr.responseJSON && (xhr.responseJSON.message ||
                                xhr.responseJSON.meta && xhr.responseJSON.meta.message)) ||
                            'Something went wrong!';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: message
                        });
                    }
                }
            });
        });

        // Edit button
        $(document).on('click', '.detail_user_review', function() {
            const id = $(this).data('review_id');
            showLoading();

            $.ajax({
                url: `/admin/reviews/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    hideLoading();
                    resetForm();

                    $('#review_id').val(response.id);
                    $('#method').val('PUT');
                    $('#reviewModalLabel').text('Edit Review');
                    $('#name').val(response.name);
                    $('#position').val(response.position);

                    // PERBAIKAN: Gunakan ID yang spesifik
                    const isActive = parseInt(response.is_active) === 1;
                    $('#review_is_active').prop('checked', isActive);

                    // Debug log
                    console.log('=== EDIT REVIEW DEBUG ===');
                    console.log('Response is_active:', response.is_active);
                    console.log('Parsed isActive:', isActive);
                    console.log('Checkbox after set:', $('#review_is_active').is(':checked'));

                    // Set translations untuk semua bahasa
                    locales.forEach(locale => {
                        const trans = response.translations.find(t => t.locale === locale);
                        if (trans) {
                            $(`#description_${locale}`).val(trans.description);
                        }
                    });

                    // Show photo preview
                    if (response.photo) {
                        $('#photo-preview img').attr('src',
                            `/uploads/review/${response.photo}`);
                        $('#photo-preview').show();
                    }

                    $('#reviewModal').modal('show');
                },
                error: function() {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load review data'
                    });
                }
            });
        });

        // Delete button
        $(document).on('click', '.btn-delete', function() {
            const id = $(this).data('id');

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
                        url: `/admin/reviews/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    table_review.ajax.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            hideLoading();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON.message ||
                                    'Failed to delete review'
                            });
                        }
                    });
                }
            });
        });

        // Toggle status
        $(document).on('change', '.toggle-status', function() {
            const id = $(this).data('id');
            const isChecked = $(this).is(':checked');

            showLoading();

            $.ajax({
                url: `/admin/reviews/${id}/toggle-status`,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    hideLoading();
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            table_review.ajax.reload();
                        });
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    $(`#status${id}`).prop('checked', !isChecked);

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON.message || 'Failed to update status'
                    });
                }
            });
        });

        // Refresh table
        $('#refresh_table_review').click(function() {
            table_review.ajax.reload();
        });
    });
</script>