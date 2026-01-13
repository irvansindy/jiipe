<script>
    $(document).ready(function() {
        const locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];
        let summernoteInitialized = false;
        let isSortMode = false;

        // Initialize DataTable with loading indicator
        var table_faq = $('#table_faq').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-faq') }}",
                type: 'GET',
                beforeSend: function() {
                    showTableLoading();
                },
                complete: function() {
                    hideTableLoading();
                },
                error: function(xhr, error, code) {
                    hideTableLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load FAQ data. Please try again.'
                    });
                }
            },
            columns: [{
                    data: null,
                    title: '<i class="ti ti-grip-vertical"></i> Question',
                    className: 'drag-handle',
                    render: function(item) {
                        const dragIcon =
                            '<i class="ti ti-grip-vertical me-2 text-muted drag-icon" style="cursor: move;"></i>';
                        if (item.translations && item.translations.length > 0) {
                            return dragIcon + (item.translations[0].question ||
                                '<i class="text-muted">Not set</i>');
                        }
                        return dragIcon + '<i class="text-muted">Not set</i>';
                    }
                },
                {
                    data: 'position',
                    name: 'position',
                    title: 'Position',
                    className: 'text-center',
                    render: function(data) {
                        return data ? `<span class="badge bg-info">${data}</span>` :
                            '<i class="text-muted">Not set</i>';
                    }
                },
                {
                    data: null,
                    title: 'Status',
                    className: 'text-center',
                    render: function(item) {
                        if (item.is_active == 1) {
                            return '<span class="badge bg-success">Active</span>';
                        } else {
                            return '<span class="badge bg-danger">Inactive</span>';
                        }
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    className: 'text-center',
                    orderable: false,
                    render: function(item) {
                        return `
                        <div class="btn-group" role="group">
                            <button type="button" data-faq_id="${item.id}" class="btn btn-sm btn-outline-info detail_faq" data-bs-toggle="modal" data-bs-target="#faqModal" title="Edit">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button type="button" data-id="${item.id}" class="btn btn-sm btn-outline-danger btn-delete-faq" title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    `;
                    }
                },
            ],
            order: [
                [1, 'asc']
            ],
            language: {
                processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                emptyTable: 'No FAQ data available',
                zeroRecords: 'No matching FAQs found'
            },
            drawCallback: function() {
                // Re-initialize sortable and manage drag icons after table redraw
                if (isSortMode) {
                    // Ensure table has active class so CSS enables drag icons
                    $('#table_faq').addClass('sortable-active');
                    $('.drag-icon').show();
                    initSortable();
                } else {
                    // Hide drag icons when not in sort mode (new rows might be rendered)
                    $('.drag-icon').hide();
                    $('#table_faq').removeClass('sortable-active');
                }
            }
        });

        // Hide drag icons initially
        $('.drag-icon').hide();

        // ============================================
        // SORTABLE FUNCTIONS
        // ============================================

        function initSortable() {
            // Destroy existing sortable first
            if ($('#table_faq tbody').hasClass('ui-sortable')) {
                $('#table_faq tbody').sortable('destroy');
            }

            $('#table_faq tbody').sortable({
                items: 'tr',
                handle: '.drag-icon',
                cursor: 'move',
                opacity: 0.7,
                placeholder: 'sortable-placeholder',
                axis: 'y',
                helper: function(e, tr) {
                    var $originals = tr.children();
                    var $helper = tr.clone();
                    $helper.children().each(function(index) {
                        $(this).width($originals.eq(index).width());
                    });
                    return $helper;
                },
                start: function(e, ui) {
                    ui.placeholder.height(ui.item.height());
                    ui.placeholder.css('background', '#f8f9fa');
                },
                update: function(e, ui) {
                    // Auto save after sorting
                    saveNewOrder();
                }
            }).disableSelection();
        }

        function saveNewOrder() {
            let order = [];

            $('#table_faq tbody tr').each(function(index) {
                const faqId = $(this).find('.detail_faq').data('faq_id');
                if (faqId) {
                    order.push(faqId);
                }
            });

            if (order.length === 0) return;

            showTableLoading();

            $.ajax({
                url: '/admin/faq/reorder',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order: order
                },
                success: function(response) {
                    hideTableLoading();

                    if (response.success) {
                        // Reload table to show new positions
                        table_faq.ajax.reload(null, false);

                        // Show success toast
                        showToast('success', 'Order updated successfully!');
                    }
                },
                error: function(xhr) {
                    hideTableLoading();

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Failed to update order'
                    });

                    // Reload to revert changes
                    table_faq.ajax.reload(null, false);
                }
            });
        }

        // Toggle sort mode
        $('#btnToggleSortMode').click(function() {
            isSortMode = !isSortMode;

            if (isSortMode) {
                // Enter sort mode
                $(this).removeClass('btn-outline-secondary').addClass('btn-warning');
                $(this).html('<i class="ti ti-lock"></i> Finish Sorting');

                // Disable DataTable features
                table_faq.order([]).draw();
                table_faq.page.len(-1).draw(); // Show all records

                // Hide search and pagination
                $('.dataTables_filter, .dataTables_length, .dataTables_paginate, .dataTables_info')
                    .hide();

                // Disable action buttons
                $('.detail_faq, .btn-delete-faq').prop('disabled', true).addClass('disabled');

                // Show drag icons and mark table active so CSS enables full cursor/opacity
                $('.drag-icon').show();
                $('#table_faq').addClass('sortable-active');

                // Initialize sortable
                initSortable();

                Swal.fire({
                    icon: 'info',
                    title: 'Sort Mode Active',
                    text: 'Drag and drop rows to reorder. Changes will be saved automatically.',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                // Exit sort mode
                $(this).removeClass('btn-warning').addClass('btn-outline-secondary');
                $(this).html('<i class="ti ti-arrows-sort"></i> Sort Order');

                // Destroy sortable
                if ($('#table_faq tbody').hasClass('ui-sortable')) {
                    $('#table_faq tbody').sortable('destroy');
                }

                // Re-enable DataTable features
                $('.dataTables_filter, .dataTables_length, .dataTables_paginate, .dataTables_info')
                    .show();

                // Enable action buttons
                $('.detail_faq, .btn-delete-faq').prop('disabled', false).removeClass('disabled');

                // Hide drag icons
                $('#table_faq').removeClass('sortable-active');
                $('.drag-icon').hide();

                // Reload table with default settings
                table_faq.page.len(10).draw();
                table_faq.order([
                    [1, 'asc']
                ]).draw();
            }
        });

        // ============================================
        // HELPER FUNCTIONS
        // ============================================

        function showTableLoading() {
            $('#table_faq').addClass('opacity-50');
            $('#loadingOverlayFaq').fadeIn();
        }

        function hideTableLoading() {
            $('#table_faq').removeClass('opacity-50');
            $('#loadingOverlayFaq').fadeOut();
        }

        function showToast(icon, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: icon,
                title: message
            });
        }

        function resetForm() {
            $('#faqForm')[0].reset();
            $('#faq_id').val('');
            $('#method').val('POST');
            $('#faqModalLabel').text('Add FAQ');
            $('.text-danger').text('');

            if (summernoteInitialized) {
                locales.forEach(locale => {
                    const editor = $(`#answer_${locale}`);
                    if (editor.summernote && editor.summernote('codeview.isActivated') !== undefined) {
                        editor.summernote('destroy');
                    }
                });
                summernoteInitialized = false;
            }

            locales.forEach(locale => {
                $(`#question_${locale}`).val('');
                $(`#answer_${locale}`).val('');
            });

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

        function showModalLoading() {
            $('#loadingOverlayFaq').fadeIn();
        }

        function hideModalLoading() {
            $('#loadingOverlayFaq').fadeOut();
        }

        function initSummernote() {
            if (!summernoteInitialized) {
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
                    ],
                    callbacks: {
                        onInit: function() {
                            console.log('Summernote initialized');
                        }
                    }
                });
                summernoteInitialized = true;
            }
        }

        function destroySummernote() {
            if (summernoteInitialized) {
                locales.forEach(locale => {
                    const editor = $(`#answer_${locale}`);
                    if (editor.length && editor.summernote) {
                        try {
                            editor.summernote('destroy');
                        } catch (e) {
                            console.warn('Error destroying summernote:', e);
                        }
                    }
                });
                summernoteInitialized = false;
            }
        }

        // ============================================
        // EVENT HANDLERS
        // ============================================

        $('#btnAddFaq').click(function() {
            if (isSortMode) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sort Mode Active',
                    text: 'Please finish sorting before adding new FAQ'
                });
                return;
            }
            resetForm();
            initSummernote();
            $('#faqModal').modal('show');
        });

        $('#faqForm').submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const faqId = $('#faq_id').val();
            const url = faqId ? `/admin/faq/${faqId}` : '/admin/faq';

            if (faqId) {
                formData.append('_method', 'PUT');
            }

            formData.set('is_active', $('#is_active').is(':checked') ? 1 : 0);

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

                    const isSuccess = response.meta?.status === 'success' || response
                        .success === true;
                    const message = response.meta?.message || response.message ||
                        'FAQ saved successfully!';

                    if (isSuccess) {
                        $('#faqModal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            table_faq.ajax.reload(null, false);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: message
                        });
                    }
                },
                error: function(xhr) {
                    hideLoading();

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON?.data || xhr.responseJSON?.errors ||
                        {};
                        let hasErrors = false;

                        $.each(errors, function(key, value) {
                            const errorElement = $(`#error-${key}`);
                            if (errorElement.length) {
                                errorElement.text(Array.isArray(value) ? value[0] :
                                    value);
                                hasErrors = true;
                            }
                        });

                        if (hasErrors) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Validation Error',
                                text: 'Please check the form for errors.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    } else {
                        const errorMessage = xhr.responseJSON?.meta?.message ||
                            xhr.responseJSON?.message ||
                            'Something went wrong! Please try again.';

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                }
            });
        });

        $(document).on('click', '.detail_faq', function() {
            if (isSortMode) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sort Mode Active',
                    text: 'Please finish sorting before editing'
                });
                return;
            }

            const id = $(this).data('faq_id');

            showModalLoading();
            resetForm();

            $.ajax({
                url: `/admin/faq/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    hideModalLoading();

                    initSummernote();

                    $('#faq_id').val(response.id);
                    $('#method').val('PUT');
                    $('#faqModalLabel').text('Edit FAQ');
                    $('#position').val(response.position || 1);
                    $('#is_active').prop('checked', response.is_active == 1);

                    if (response.translations && Array.isArray(response.translations)) {
                        locales.forEach(locale => {
                            const trans = response.translations.find(t => t
                                .locale === locale);
                            if (trans) {
                                $(`#question_${locale}`).val(trans.question || '');
                                $(`#answer_${locale}`).summernote('code', trans
                                    .answer || '');
                            }
                        });
                    }

                    $('#faqModal').modal('show');
                },
                error: function(xhr) {
                    hideModalLoading();

                    const errorMessage = xhr.responseJSON?.message ||
                        'Failed to load FAQ data';

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage
                    });
                }
            });
        });

        $(document).on('click', '.btn-delete-faq', function() {
            if (isSortMode) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sort Mode Active',
                    text: 'Please finish sorting before deleting'
                });
                return;
            }

            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    showTableLoading();

                    $.ajax({
                        url: `/admin/faq/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            hideTableLoading();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message ||
                                        'FAQ has been deleted.',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    table_faq.ajax.reload(null, false);
                                });
                            }
                        },
                        error: function(xhr) {
                            hideTableLoading();

                            const errorMessage = xhr.responseJSON?.message ||
                                'Failed to delete FAQ';

                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: errorMessage
                            });
                        }
                    });
                }
            });
        });

        $('#refresh_table_faq').click(function() {
            table_faq.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Refreshed!',
                text: 'Table data has been refreshed.',
                timer: 1000,
                showConfirmButton: false
            });
        });

        $('#faqModal').on('hidden.bs.modal', function() {
            destroySummernote();
        });

        $('#faqModal').on('hide.bs.modal', function(e) {
            if ($('#loadingOverlayFaq').is(':visible')) {
                e.preventDefault();
                return false;
            }
        });

        // Prevent sorting when not in sort mode
        $(document).on('mousedown', '.drag-icon', function(e) {
            if (!isSortMode) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>

<style>
    /* Sortable Styles */
    .sortable-active {
        cursor: move;
    }

    .sortable-placeholder {
        height: 50px;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
    }

    .ui-sortable-helper {
        background: #ffffff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        opacity: 0.9;
    }

    .drag-icon {
        cursor: move;
        color: #6c757d;
        transition: color 0.2s;
    }

    .sortable-active .drag-icon {
        color: #0d6efd;
    }

    .drag-icon:hover {
        color: #0d6efd;
    }

    #table_faq tbody tr {
        transition: background-color 0.2s;
    }

    .sortable-active tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Disable pointer events when not in sort mode */
    #table_faq:not(.sortable-active) .drag-icon {
        cursor: default;
        opacity: 0.3;
    }

    /* Loading overlay */
    #loadingOverlayFaq {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loadingOverlayFaq .spinner {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Disabled state */
    .disabled {
        pointer-events: none;
        opacity: 0.5;
    }
</style>
