<script>
$(document).ready(function() {
    let currentZoneIdEnergy = null;
    let currentZoneNameEnergy = null;
    let energyTable = null;

    // Initialize Summernote for energy descriptions
    function initSummernoteEnergy() {
        // Destroy existing summernote instances first
        $('.summernote-energy').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        // Initialize fresh summernote
        $('.summernote-energy').summernote({
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
    function previewImageEnergy(input, previewElementId) {
        const file = input.files[0];
        const previewElement = $(`#${previewElementId}`);

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewElement.html(`
                    <img src="${e.target.result}" class="img-thumbnail" style="max-width:200px;max-height:200px;">
                    <p class="text-muted small mt-1">New ${previewElementId.includes('image') ? 'image' : 'icon'} selected</p>
                `);
            };
            reader.readAsDataURL(file);
        } else {
            previewElement.html('');
        }
    }

    // Handle image upload preview
    $('#energy_image').on('change', function() {
        previewImageEnergy(this, 'preview_energy_image');
    });

    $('#energy_icon').on('change', function() {
        previewImageEnergy(this, 'preview_energy_icon');
    });

    // Open Resource Energy List Modal
    window.openResourceEnergyModal = function(zoneId, zoneName) {
        currentZoneIdEnergy = zoneId;
        currentZoneNameEnergy = zoneName;

        $('#selected_zone_name_energy').text(zoneName);
        $('#modalListResourceEnergy').modal('show');

        // Small delay to ensure modal is visible
        setTimeout(() => {
            loadResourceEnergies();
        }, 200);
    };

    // Load Resource Energies
    function loadResourceEnergies() {
        if (energyTable) {
            energyTable.destroy();
        }

        energyTable = $('#tableResourceEnergy').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: `/admin/resource-energies/zone/${currentZoneIdEnergy}`,
                type: 'GET',
                dataSrc: function(response) {
                    console.log('Energy Response:', response);
                    if (response.meta && response.meta.status == 'success') {
                        return response.data;
                    } else if (response.status == 'success') {
                        return response.data;
                    }
                    return [];
                },
                error: function(xhr) {
                    console.error('Error loading energies:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load resource energies'
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
                            let imageUrl = data.startsWith('http') ? data : '{{ url('/uploads/zones/facilities') }}/' + data;
                            return `<img src="${imageUrl}" class="img-thumbnail" style="max-width:60px;max-height:60px;">`;
                        }
                        return '<span class="text-muted">No image</span>';
                    }
                },
                {
                    data: 'icon',
                    render: function(data) {
                        if (data) {
                            let iconUrl = data.startsWith('http') ? data : '{{ url('/uploads/zones/facilities') }}/' + data;
                            return `<img src="${iconUrl}" class="img-thumbnail" style="max-width:40px;max-height:40px;">`;
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
                            <button type="button" class="btn btn-sm btn-warning btn-edit-energy" data-id="${data}" title="Edit">
                                <i class="ti ti-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger btn-delete-energy" data-id="${data}" title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            order: [[5, 'asc']], // Order by 'order' column
            pageLength: 10,
            language: {
                emptyTable: "No resource energies available",
                zeroRecords: "No matching resource energies found"
            }
        });
    }

    // Add Energy Button
    $(document).on('click', '#btnAddEnergy', function() {
        console.log('Add Energy clicked');
        $('#modalListResourceEnergy').modal('hide');

        setTimeout(() => {
            $('#energy_id').val('');
            $('#energy_zone_id').val(currentZoneIdEnergy);
            $('#modalResourceEnergyLabel').text('Add Resource & Energy');
            $('#formResourceEnergy')[0].reset();

            // Clear all error messages and previews
            $('[id^="error_energy_"]').text('');
            $('#preview_energy_image').html('');
            $('#preview_energy_icon').html('');

            // Set default order
            $('#energy_order').val(0);

            // Image is required for create
            $('#energy_image').prop('required', true);

            // Initialize summernote
            initSummernoteEnergy();

            $('#modalResourceEnergy').modal('show');
        }, 300);
    });

    // Edit Energy - Using event delegation
    $(document).on('click', '.btn-edit-energy', function() {
        let id = $(this).data('id');
        console.log('Edit Energy clicked, ID:', id);

        $('#modalListResourceEnergy').modal('hide');

        setTimeout(() => {
            $.ajax({
                url: `/admin/resource-energies/${id}`,
                type: 'GET',
                success: function(response) {
                    console.log('Edit Response:', response);

                    if (response.status === 'success' || (response.meta && response.meta.status === 'success')) {
                        let data = response.data;

                        $('#energy_id').val(data.id);
                        $('#energy_zone_id').val(data.zone_id);
                        $('#energy_order').val(data.order || 0);
                        $('#modalResourceEnergyLabel').text('Edit Resource & Energy');

                        // Clear form first
                        $('#formResourceEnergy')[0].reset();
                        $('#energy_order').val(data.order || 0);

                        // Clear error messages
                        $('[id^="error_energy_"]').text('');

                        // Image is not required for update
                        $('#energy_image').prop('required', false);

                        // Show current image/icon
                        if (data.image) {
                            let imageUrl = data.image.startsWith('http') ? data.image : '{{ url('/uploads/zones/facilities') }}/' + data.image;
                            $('#preview_energy_image').html(`
                                <img src="${imageUrl}" class="img-thumbnail" style="max-width:200px;max-height:200px;">
                                <p class="text-muted small mt-1">Current image (upload new to replace)</p>
                            `);
                        }

                        if (data.icon) {
                            let iconUrl = data.icon.startsWith('http') ? data.icon : '{{ url('/uploads/zones/facilities') }}/' + data.icon;
                            $('#preview_energy_icon').html(`
                                <img src="${iconUrl}" class="img-thumbnail" style="max-width:150px;max-height:150px;">
                                <p class="text-muted small mt-1">Current icon (upload new to replace)</p>
                            `);
                        }

                        // Initialize summernote first
                        initSummernoteEnergy();

                        // Fill translations after a small delay to ensure summernote is ready
                        setTimeout(() => {
                            $.each(data.translations, function(locale, trans) {
                                $(`#energy_name_${locale}`).val(trans.name);
                                $(`#energy_description_${locale}`).summernote('code', trans.description || '');
                            });
                        }, 100);

                        $('#modalResourceEnergy').modal('show');
                    }
                },
                error: function(xhr) {
                    console.error('Error loading energy:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load energy data'
                    });

                    // Show list modal again
                    setTimeout(() => {
                        $('#modalListResourceEnergy').modal('show');
                    }, 300);
                }
            });
        }, 300);
    });

    // Delete Energy - Using event delegation
    $(document).on('click', '.btn-delete-energy', function() {
        let id = $(this).data('id');
        console.log('Delete Energy clicked, ID:', id);

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
                    url: `/admin/resource-energies/delete/${id}`,
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
                                text: response.message || 'Resource energy deleted successfully',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            loadResourceEnergies();
                        }
                    },
                    error: function(xhr) {
                        console.error('Error deleting energy:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Failed to delete resource energy'
                        });
                    }
                });
            }
        });
    });

    // Submit Form Resource Energy
    $('#formResourceEnergy').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');

        let energyId = $('#energy_id').val();
        let url = energyId ? `/admin/resource-energies/update/${energyId}` : '/admin/resource-energies/store';
        let formData = new FormData(this);

        // Get summernote content for all locales
        @foreach(config('laravellocalization.supportedLocales') as $locale => $properties)
        formData.set('description[{{ $locale }}]', $('#energy_description_{{ $locale }}').summernote('code'));
        @endforeach

        // Clear previous errors
        $('[id^="error_energy_"]').text('');

        $('#btnSaveEnergy').prop('disabled', true).html('<i class="ti ti-loader me-1"></i> Saving...');

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
                        text: response.message || 'Resource energy saved successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#modalResourceEnergy').modal('hide');

                    setTimeout(() => {
                        $('#modalListResourceEnergy').modal('show');
                        loadResourceEnergies();
                    }, 300);
                }
            },
            error: function(xhr) {
                console.error('Error saving energy:', xhr);
                let errorMessage = 'Failed to save resource energy';

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let errors = xhr.responseJSON.errors;

                    // Display field-specific errors
                    $.each(errors, function(key, messages) {
                        let fieldName = key.replace(/\./g, '_');
                        let errorElement = $(`#error_energy_${fieldName}`);

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
                $('#btnSaveEnergy').prop('disabled', false).html('<i class="ti ti-device-floppy me-1"></i> Save');
            }
        });
    });

    // Clean up on modal close
    $('#modalResourceEnergy').on('hidden.bs.modal', function() {
        console.log('Modal energy form closed');
        $('#formResourceEnergy')[0].reset();
        $('.summernote-energy').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        // Clear errors and previews
        $('[id^="error_energy_"]').text('');
        $('#preview_energy_image').html('');
        $('#preview_energy_icon').html('');
    });

    $('#modalListResourceEnergy').on('hidden.bs.modal', function() {
        console.log('Modal list energies closed');
        if (energyTable) {
            energyTable.destroy();
            energyTable = null;
        }
    });

    // Debug: Check if modals exist
    console.log('Modal List Energy exists:', $('#modalListResourceEnergy').length > 0);
    console.log('Modal Form Energy exists:', $('#modalResourceEnergy').length > 0);
});
</script>