<script>
$(document).ready(function() {
    let currentZoneIdDev = null;
    let currentZoneNameDev = null;
    let developmentTable = null;

    // Initialize Summernote for development descriptions
    function initSummernoteDevelopment() {
        // Destroy existing summernote instances first
        $('.summernote-development').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        // Initialize fresh summernote
        $('.summernote-development').summernote({
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    }

    // Open Sub Development List Modal
    window.openSubDevelopmentModal = function(zoneId, zoneName) {
        currentZoneIdDev = zoneId;
        currentZoneNameDev = zoneName;

        $('#selected_zone_name_dev').text(zoneName);
        $('#modalListSubDevelopment').modal('show');

        // Small delay to ensure modal is visible
        setTimeout(() => {
            loadSubDevelopments();
        }, 200);
    };

    // Load Sub Developments
    function loadSubDevelopments() {
        if (developmentTable) {
            developmentTable.destroy();
        }

        developmentTable = $('#tableSubDevelopment').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: `/admin/sub-developments/zone/${currentZoneIdDev}`,
                type: 'GET',
                dataSrc: function(response) {
                    console.log('Development Response:', response);
                    if (response.meta && response.meta.status == 'success') {
                        return response.data;
                    } else if (response.status == 'success') {
                        return response.data;
                    }
                    return [];
                },
                error: function(xhr) {
                    console.error('Error loading developments:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load developments'
                    });
                }
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'translations',
                    render: function(data) {
                        return data && data.length > 0 ? data[0].name : '-';
                    }
                },
                {
                    data: 'translations',
                    render: function(data) {
                        if (data && data.length > 0 && data[0].description) {
                            let desc = data[0].description;
                            // Strip HTML tags and truncate
                            let text = desc.replace(/<[^>]*>/g, '');
                            return text.length > 100 ? text.substr(0, 100) + '...' : text;
                        }
                        return '-';
                    }
                },
                {
                    data: 'id',
                    className: 'text-end',
                    render: function(data) {
                        return `
                            <button type="button" class="btn btn-sm btn-warning btn-edit-development" data-id="${data}" title="Edit">
                                <i class="ti ti-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger btn-delete-development" data-id="${data}" title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            order: [[0, 'asc']],
            pageLength: 10,
            language: {
                emptyTable: "No developments available",
                zeroRecords: "No matching developments found"
            }
        });
    }

    // Add Development Button
    $(document).on('click', '#btnAddDevelopment', function() {
        console.log('Add Development clicked');
        $('#modalListSubDevelopment').modal('hide');

        setTimeout(() => {
            $('#development_id').val('');
            $('#development_zone_id').val(currentZoneIdDev);
            $('#modalSubDevelopmentLabel').text('Add Sub Development');
            $('#formSubDevelopment')[0].reset();

            // Clear all error messages
            $('[id^="error_development_"]').text('');

            // Initialize summernote
            initSummernoteDevelopment();

            $('#modalSubDevelopment').modal('show');
        }, 300);
    });

    // Edit Development - Using event delegation
    $(document).on('click', '.btn-edit-development', function() {
        let id = $(this).data('id');
        console.log('Edit Development clicked, ID:', id);

        $('#modalListSubDevelopment').modal('hide');

        setTimeout(() => {
            $.ajax({
                url: `/admin/sub-developments/${id}`,
                type: 'GET',
                success: function(response) {
                    console.log('Edit Response:', response);

                    if (response.status === 'success' || (response.meta && response.meta.status === 'success')) {
                        let data = response.data;

                        $('#development_id').val(data.id);
                        $('#development_zone_id').val(data.zone_id);
                        $('#modalSubDevelopmentLabel').text('Edit Sub Development');

                        // Clear form first
                        $('#formSubDevelopment')[0].reset();

                        // Clear error messages
                        $('[id^="error_development_"]').text('');

                        // Initialize summernote first
                        initSummernoteDevelopment();

                        // Fill translations after a small delay to ensure summernote is ready
                        setTimeout(() => {
                            $.each(data.translations, function(locale, trans) {
                                $(`#development_name_${locale}`).val(trans.name);
                                $(`#development_description_${locale}`).summernote('code', trans.description || '');
                            });
                        }, 100);

                        $('#modalSubDevelopment').modal('show');
                    }
                },
                error: function(xhr) {
                    console.error('Error loading development:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load development data'
                    });

                    // Show list modal again
                    setTimeout(() => {
                        $('#modalListSubDevelopment').modal('show');
                    }, 300);
                }
            });
        }, 300);
    });

    // Delete Development - Using event delegation
    $(document).on('click', '.btn-delete-development', function() {
        let id = $(this).data('id');
        console.log('Delete Development clicked, ID:', id);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/sub-developments/delete/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Delete Response:', response);

                        if (response.status === 'success' || (response.meta && response.meta.status === 'success')) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message || 'Development deleted successfully',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            loadSubDevelopments();
                        }
                    },
                    error: function(xhr) {
                        console.error('Error deleting development:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Failed to delete development'
                        });
                    }
                });
            }
        });
    });

    // Submit Form Sub Development
    $('#formSubDevelopment').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');

        let developmentId = $('#development_id').val();
        let url = developmentId ? `/admin/sub-developments/update/${developmentId}` : '/admin/sub-developments/store';
        let formData = new FormData(this);

        // Get summernote content for all locales
        @foreach(config('laravellocalization.supportedLocales') as $locale => $properties)
        formData.set('description[{{ $locale }}]', $('#development_description_{{ $locale }}').summernote('code'));
        @endforeach

        // Clear previous errors
        $('[id^="error_development_"]').text('');

        $('#btnSaveDevelopment').prop('disabled', true).html('<i class="ti ti-loader me-1"></i> Saving...');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Save Response:', response);

                if (response.status === 'success' || (response.meta && response.meta.status === 'success')) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message || 'Development saved successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#modalSubDevelopment').modal('hide');

                    setTimeout(() => {
                        $('#modalListSubDevelopment').modal('show');
                        loadSubDevelopments();
                    }, 300);
                }
            },
            error: function(xhr) {
                console.error('Error saving development:', xhr);
                let errorMessage = 'Failed to save development';

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let errors = xhr.responseJSON.errors;

                    // Display field-specific errors
                    $.each(errors, function(key, messages) {
                        let fieldName = key.replace(/\./g, '_');
                        let errorElement = $(`#error_development_${fieldName}`);

                        if (errorElement.length) {
                            errorElement.text(Array.isArray(messages) ? messages[0] : messages);
                        }
                    });

                    errorMessage = Object.values(errors).flat().join('<br>');
                } else if (xhr.responseJSON?.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: errorMessage
                });
            },
            complete: function() {
                $('#btnSaveDevelopment').prop('disabled', false).html('<i class="ti ti-device-floppy me-1"></i> Save');
            }
        });
    });

    // Clean up on modal close
    $('#modalSubDevelopment').on('hidden.bs.modal', function() {
        console.log('Modal development form closed');
        $('#formSubDevelopment')[0].reset();
        $('.summernote-development').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        // Clear errors
        $('[id^="error_development_"]').text('');
    });

    $('#modalListSubDevelopment').on('hidden.bs.modal', function() {
        console.log('Modal list development closed');
        if (developmentTable) {
            developmentTable.destroy();
            developmentTable = null;
        }
    });

    // Debug: Check if modals exist
    console.log('Modal List Development exists:', $('#modalListSubDevelopment').length > 0);
    console.log('Modal Form Development exists:', $('#modalSubDevelopment').length > 0);
});
</script>