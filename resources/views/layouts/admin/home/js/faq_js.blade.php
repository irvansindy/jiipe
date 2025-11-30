<script>
    $(document).ready(function() {
        const locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];

        // Initialize DataTable
        var table_faq = $('#table_faq').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-faq') }}",
                type: 'GET'
            },
            columns: [{
                    data: null,
                    title: 'Question',
                    render: function(item) {
                        if (item.translations && item.translations.length > 0) {
                            return item.translations[0].question || '<i>Not set</i>';
                        }
                        return '<i>Not set</i>';
                    }
                },
                {
                    data: 'position',
                    name: 'position',
                    title: 'Position',
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
                            return '<span class="badge text-bg-danger">Inactive</span>'
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
                            <button type="button" data-faq_id="${item.id}" class="btn btn-outline-info btn-sm mt-2 detail_faq" data-toggle="modal" data-target="#faqModal">
                                <i class="ti ti-eye"></i> View
                            </button>
                            <button type="button" data-id="${item.id}" class="btn btn-outline-danger btn-sm mt-2 btn-delete-faq">
                                <i class="ti ti-trash"></i> Delete
                            </button>
                        </div>
                    `;
                    }
                },
            ],
            order: [
                [1, 'asc']
            ] // Sort by position
        });

        // ============================================
        // HELPER FUNCTIONS
        // ============================================

        function resetForm() {
            $('#faqForm')[0].reset();
            $('#faq_id').val('');
            $('#method').val('POST');
            $('#faqModalLabel').text('Add FAQ');
            $('.text-danger').text('');

            // Reset semua textarea dan destroy summernote
            locales.forEach(locale => {
                $(`#question_${locale}`).val('');
                if ($(`#answer_${locale}`).summernote) {
                    $(`#answer_${locale}`).summernote('code', '');
                }
            });

            // Set default position
            $('#position').val(1);
            $('#is_active').prop('checked', true);
        }

        function showLoading() {
            $('#loadingOverlayFaq').fadeIn();
            $('#btnSubmitFaq .btn-text').addClass('d-none');
            $('#btnSubmitFaq .spinner-border').removeClass('d-none');
            $('#btnSubmitFaq').prop('disabled', true);
        }

        function hideLoading() {
            $('#loadingOverlayFaq').fadeOut();
            $('#btnSubmitFaq .btn-text').removeClass('d-none');
            $('#btnSubmitFaq .spinner-border').addClass('d-none');
            $('#btnSubmitFaq').prop('disabled', false);
        }

        // Initialize Summernote
        function initSummernote() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }

        // ============================================
        // EVENT HANDLERS
        // ============================================

        // Add button
        $('#btnAddFaq').click(function() {
            resetForm();
            initSummernote();
            $('#faqModal').modal('show');
        });

        // Submit form (Create/Update)
        $('#faqForm').submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const faqId = $('#faq_id').val();
            const url = faqId ? `/admin/faq/${faqId}` : '/admin/faq';

            if (faqId) {
                formData.append('_method', 'PUT');
            }

            // Convert checkbox to boolean
            formData.set('is_active', $('#is_active').is(':checked') ? 1 : 0);

            // Get summernote content
            locales.forEach(locale => {
                const answerContent = $(`#answer_${locale}`).summernote('code');
                formData.set(`answer_${locale}`, answerContent);
            });

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
                    if (response.meta?.status === 'success' || response.success) {
                        $('#faqModal').modal('hide');

                        // Destroy summernote before hiding modal
                        $('.summernote').summernote('destroy');

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.meta?.message || response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            table_faq.ajax.reload();
                        });
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.data || xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $(`#error-${key}`).text(value[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.meta?.message || xhr
                                .responseJSON?.message || 'Something went wrong!'
                        });
                    }
                }
            });
        });

        // Edit button
        $(document).on('click', '.detail_faq', function() {
            const id = $(this).data('faq_id');
            showLoading();

            $.ajax({
                url: `/admin/faq/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    hideLoading();
                    resetForm();
                    initSummernote();

                    $('#faq_id').val(response.id);
                    $('#method').val('PUT');
                    $('#faqModalLabel').text('Edit FAQ');
                    $('#position').val(response.position);
                    $('#is_active').prop('checked', response.is_active);

                    // Set translations untuk semua bahasa
                    locales.forEach(locale => {
                        const trans = response.translations.find(t => t.locale ===
                            locale);
                        if (trans) {
                            $(`#question_${locale}`).val(trans.question);
                            $(`#answer_${locale}`).summernote('code', trans.answer);
                        }
                    });

                    $('#faqModal').modal('show');
                },
                error: function() {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load FAQ data'
                    });
                }
            });
        });

        // Delete button
        $(document).on('click', '.btn-delete-faq', function() {
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
                        url: `/admin/faq/${id}`,
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
                                    table_faq.ajax.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            hideLoading();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON.message ||
                                    'Failed to delete FAQ'
                            });
                        }
                    });
                }
            });
        });

        // Toggle status
        $(document).on('change', '.toggle-status-faq', function() {
            const id = $(this).data('id');
            const isChecked = $(this).is(':checked');

            showLoading();

            $.ajax({
                url: `/admin/faq/${id}/toggle-status`,
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
                            table_faq.ajax.reload();
                        });
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    // Revert checkbox
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
        $('#refresh_table_faq').click(function() {
            table_faq.ajax.reload();
        });

        // Clean up summernote when modal is hidden
        $('#faqModal').on('hidden.bs.modal', function() {
            $('.summernote').summernote('destroy');
        });
    });
</script>