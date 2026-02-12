<script>
$(document).ready(function() {
    let currentZoneIdAdv = null;
    let currentZoneNameAdv = null;
    let advantageTable = null;

    // Initialize Summernote for advantage descriptions
    function initSummernoteAdvantage() {
        // Destroy existing summernote instances first
        $('.summernote-advantage').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        // Initialize fresh summernote
        $('.summernote-advantage').summernote({
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

    // Preview image upload
    function previewImage(input, previewElementId) {
        const file = input.files[0];
        const previewElement = $(`#${previewElementId}`);

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewElement.html(`
                    <img src="${e.target.result}" class="img-thumbnail" style="max-width:200px;max-height:200px;" loading="lazy" decoding="async">
                    <p class="text-muted small mt-1">New ${previewElementId.includes('image') ? 'image' : 'icon'} selected</p>
                `);
            };
            reader.readAsDataURL(file);
        } else {
            previewElement.html('');
        }
    }

    // Handle image upload preview
    $('#advantage_image').on('change', function() {
        previewImage(this, 'preview_advantage_image');
    });

    $('#advantage_icon').on('change', function() {
        previewImage(this, 'preview_advantage_icon');
    });

    // Open Regional Advantages List Modal
    window.openRegionalAdvantagesModal = function(zoneId, zoneName) {
        currentZoneIdAdv = zoneId;
        currentZoneNameAdv = zoneName;

        $('#selected_zone_name_adv').text(zoneName);
        $('#modalListRegionalAdvantages').modal('show');

        // Small delay to ensure modal is visible
        setTimeout(() => {
            loadRegionalAdvantages();
        }, 200);
    };

    // Load Regional Advantages
    function loadRegionalAdvantages() {
        if (advantageTable) {
            advantageTable.destroy();
        }

        advantageTable = $('#tableRegionalAdvantages').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: `/admin/regional-advantages/zone/${currentZoneIdAdv}`,
                type: 'GET',
                dataSrc: function(response) {
                    console.log('Advantage Response:', response);
                    if (response.meta && response.meta.status == 'success') {
                        return response.data;
                    } else if (response.status == 'success') {
                        return response.data;
                    }
                    return [];
                },
                error: function(xhr) {
                    console.error('Error loading advantages:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load advantages'
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
                    data: 'image',
                    render: function(data) {
                        if (data) {
                            let imageUrl = data.startsWith('http') ? data : '{{ url('/uploads/zones/feature') }}/' + data;
                            return `<img src="${imageUrl}" class="img-thumbnail" style="max-width:60px;max-height:60px;" loading="lazy" decoding="async">`;
                        }
                        return '<span class="text-muted">No image</span>';
                    }
                },
                {
                    data: 'icon',
                    render: function(data) {
                        if (data) {
                            let iconUrl = data.startsWith('http') ? data : '{{ url('/uploads/zones/feature') }}/' + data;
                            return `<img src="${iconUrl}" class="img-thumbnail" style="max-width:40px;max-height:40px;" loading="lazy" decoding="async">`;
                        }
                        return '<span class="text-muted">No icon</span>';
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
                            return text.length > 80 ? text.substr(0, 80) + '...' : text;
                        }
                        return '-';
                    }
                },
                {
                    data: 'order',
                    className: 'text-center',
                    render: function(data) {
                        return data || '0';
                    }
                },
                {
                    data: 'id',
                    className: 'text-end',
                    render: function(data) {
                        return `
                            <button type="button" class="btn btn-sm btn-warning btn-edit-advantage" data-id="${data}" title="Edit">
                                <i class="ti ti-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger btn-delete-advantage" data-id="${data}" title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            order: [[5, 'asc']], // Order by 'order' column
            pageLength: 10,
            language: {
                emptyTable: "No advantages available",
                zeroRecords: "No matching advantages found"
            }
        });
    }

    // Add Advantage Button
    $(document).on('click', '#btnAddAdvantage', function() {
        console.log('Add Advantage clicked');
        $('#modalListRegionalAdvantages').modal('hide');

        setTimeout(() => {
            $('#advantage_id').val('');
            $('#advantage_zone_id').val(currentZoneIdAdv);
            $('#modalRegionalAdvantageLabel').text('Add Regional Advantage');
            $('#formRegionalAdvantage')[0].reset();

            // Clear all error messages and previews
            $('[id^="error_advantage_"]').text('');
            $('#preview_advantage_image').html('');
            $('#preview_advantage_icon').html('');

            // Set default order
            $('#advantage_order').val(0);

            // Remove required attribute from image (for edit mode)
            $('#advantage_image').prop('required', true);

            // Initialize summernote
            initSummernoteAdvantage();

            $('#modalRegionalAdvantage').modal('show');
        }, 300);
    });

    // Edit Advantage - Using event delegation
    $(document).on('click', '.btn-edit-advantage', function() {
        let id = $(this).data('id');
        console.log('Edit Advantage clicked, ID:', id);

        $('#modalListRegionalAdvantages').modal('hide');

        setTimeout(() => {
            $.ajax({
                url: `/admin/regional-advantages/${id}`,
                type: 'GET',
                success: function(response) {
                    console.log('Edit Response:', response);

                    if (response.status === 'success' || (response.meta && response.meta.status === 'success')) {
                        let data = response.data;

                        $('#advantage_id').val(data.id);
                        $('#advantage_zone_id').val(data.zone_id);
                        $('#advantage_order').val(data.order || 0);
                        $('#modalRegionalAdvantageLabel').text('Edit Regional Advantage');

                        // Clear form first
                        $('#formRegionalAdvantage')[0].reset();
                        $('#advantage_order').val(data.order || 0);

                        // Clear error messages
                        $('[id^="error_advantage_"]').text('');

                        // Image is not required for update
                        $('#advantage_image').prop('required', false);

                        // Show current image/icon
                        if (data.image) {
                            let imageUrl = data.image.startsWith('http') ? data.image : '{{ url('/uploads/zones/feature') }}/' + data.image;
                            $('#preview_advantage_image').html(`
                                <img src="${imageUrl}" class="img-thumbnail" style="max-width:200px;max-height:200px;" loading="lazy" decoding="async">
                                <p class="text-muted small mt-1">Current image (upload new to replace)</p>
                            `);
                        }

                        if (data.icon) {
                            let iconUrl = data.icon.startsWith('http') ? data.icon : '{{ url('/uploads/zones/feature') }}/' + data.icon;
                            $('#preview_advantage_icon').html(`
                                <img src="${iconUrl}" class="img-thumbnail" style="max-width:150px;max-height:150px;" loading="lazy" decoding="async">
                                <p class="text-muted small mt-1">Current icon (upload new to replace)</p>
                            `);
                        }

                        // Initialize summernote first
                        initSummernoteAdvantage();

                        // Fill translations after a small delay to ensure summernote is ready
                        setTimeout(() => {
                            $.each(data.translations, function(locale, trans) {
                                $(`#advantage_name_${locale}`).val(trans.name);
                                $(`#advantage_description_${locale}`).summernote('code', trans.description || '');
                            });
                        }, 100);

                        $('#modalRegionalAdvantage').modal('show');
                    }
                },
                error: function(xhr) {
                    console.error('Error loading advantage:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load advantage data'
                    });

                    // Show list modal again
                    setTimeout(() => {
                        $('#modalListRegionalAdvantages').modal('show');
                    }, 300);
                }
            });
        }, 300);
    });

    // Delete Advantage - Using event delegation
    $(document).on('click', '.btn-delete-advantage', function() {
        let id = $(this).data('id');
        console.log('Delete Advantage clicked, ID:', id);

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
                    url: `/admin/regional-advantages/delete/${id}`,
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
                                text: response.message || 'Advantage deleted successfully',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            loadRegionalAdvantages();
                        }
                    },
                    error: function(xhr) {
                        console.error('Error deleting advantage:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Failed to delete advantage'
                        });
                    }
                });
            }
        });
    });

    // Submit Form Regional Advantage
    $('#formRegionalAdvantage').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');

        let advantageId = $('#advantage_id').val();
        let url = advantageId ? `/admin/regional-advantages/update/${advantageId}` : '/admin/regional-advantages/store';
        let formData = new FormData(this);

        // Get summernote content for all locales
        @foreach(config('laravellocalization.supportedLocales') as $locale => $properties)
        formData.set('description[{{ $locale }}]', $('#advantage_description_{{ $locale }}').summernote('code'));
        @endforeach

        // Clear previous errors
        $('[id^="error_advantage_"]').text('');

        $('#btnSaveAdvantage').prop('disabled', true).html('<i class="ti ti-loader me-1"></i> Saving...');

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
                        text: response.message || 'Advantage saved successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#modalRegionalAdvantage').modal('hide');

                    setTimeout(() => {
                        $('#modalListRegionalAdvantages').modal('show');
                        loadRegionalAdvantages();
                    }, 300);
                }
            },
            error: function(xhr) {
                console.error('Error saving advantage:', xhr);
                let errorMessage = 'Failed to save advantage';

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let errors = xhr.responseJSON.errors;

                    // Display field-specific errors
                    $.each(errors, function(key, messages) {
                        let fieldName = key.replace(/\./g, '_');
                        let errorElement = $(`#error_advantage_${fieldName}`);

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
                $('#btnSaveAdvantage').prop('disabled', false).html('<i class="ti ti-device-floppy me-1"></i> Save');
            }
        });
    });

    // Clean up on modal close
    $('#modalRegionalAdvantage').on('hidden.bs.modal', function() {
        console.log('Modal advantage form closed');
        $('#formRegionalAdvantage')[0].reset();
        $('.summernote-advantage').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        // Clear errors and previews
        $('[id^="error_advantage_"]').text('');
        $('#preview_advantage_image').html('');
        $('#preview_advantage_icon').html('');
    });

    $('#modalListRegionalAdvantages').on('hidden.bs.modal', function() {
        console.log('Modal list advantages closed');
        if (advantageTable) {
            advantageTable.destroy();
            advantageTable = null;
        }
    });

    // Debug: Check if modals exist
    console.log('Modal List Advantages exists:', $('#modalListRegionalAdvantages').length > 0);
    console.log('Modal Form Advantage exists:', $('#modalRegionalAdvantage').length > 0);
});
</script>