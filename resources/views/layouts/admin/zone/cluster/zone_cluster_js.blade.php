<script>
$(document).ready(function() {
    let currentZoneId = null;
    let currentZoneName = null;
    let clusterTable = null;

    // Initialize Summernote for cluster descriptions
    function initSummernoteCluster() {
        // Destroy existing summernote instances first
        $('.summernote-cluster').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        // Initialize fresh summernote
        $('.summernote-cluster').summernote({
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

    // Open Zone Cluster List Modal
    window.openZoneClusterModal = function(zoneId, zoneName) {
        currentZoneId = zoneId;
        currentZoneName = zoneName;

        $('#selected_zone_name').text(zoneName);
        $('#modalListZoneCluster').modal('show');

        // Small delay to ensure modal is visible
        setTimeout(() => {
            loadZoneClusters();
        }, 200);
    };

    // Load Zone Clusters
    function loadZoneClusters() {
        if (clusterTable) {
            clusterTable.destroy();
        }

        clusterTable = $('#tableZoneCluster').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: `/admin/zone-clusters/zone/${currentZoneId}`,
                type: 'GET',
                dataSrc: function(response) {
                    console.log('Cluster Response:', response);
                    if (response.meta && response.meta.status == 'success') {
                        return response.data;
                    } else if (response.status == 'success') {
                        return response.data;
                    }
                    return [];
                },
                error: function(xhr) {
                    console.error('Error loading clusters:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load clusters'
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
                            <button type="button" class="btn btn-sm btn-warning btn-edit-cluster" data-id="${data}" title="Edit">
                                <i class="ti ti-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger btn-delete-cluster" data-id="${data}" title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            order: [[0, 'asc']],
            pageLength: 10,
            language: {
                emptyTable: "No clusters available",
                zeroRecords: "No matching clusters found"
            }
        });
    }

    // Add Cluster Button
    $(document).on('click', '#btnAddCluster', function() {
        console.log('Add Cluster clicked');
        $('#modalListZoneCluster').modal('hide');

        setTimeout(() => {
            $('#cluster_id').val('');
            $('#cluster_zone_id').val(currentZoneId);
            $('#modalZoneClusterLabel').text('Add Zone Cluster');
            $('#formZoneCluster')[0].reset();

            // Clear all error messages
            $('[id^="error_cluster_"]').text('');

            // Initialize summernote
            initSummernoteCluster();

            $('#modalZoneCluster').modal('show');
        }, 300);
    });

    // Edit Cluster - Using event delegation
    $(document).on('click', '.btn-edit-cluster', function() {
        let id = $(this).data('id');
        console.log('Edit Cluster clicked, ID:', id);

        $('#modalListZoneCluster').modal('hide');

        setTimeout(() => {
            $.ajax({
                url: `/admin/zone-clusters/${id}`,
                type: 'GET',
                success: function(response) {
                    console.log('Edit Response:', response);

                    if (response.status === 'success' || (response.meta && response.meta.status === 'success')) {
                        let data = response.data;

                        $('#cluster_id').val(data.id);
                        $('#cluster_zone_id').val(data.zone_id);
                        $('#modalZoneClusterLabel').text('Edit Zone Cluster');

                        // Clear form first
                        $('#formZoneCluster')[0].reset();

                        // Clear error messages
                        $('[id^="error_cluster_"]').text('');

                        // Initialize summernote first
                        initSummernoteCluster();

                        // Fill translations after a small delay to ensure summernote is ready
                        setTimeout(() => {
                            $.each(data.translations, function(locale, trans) {
                                $(`#cluster_name_${locale}`).val(trans.name);
                                $(`#cluster_description_${locale}`).summernote('code', trans.description || '');
                            });
                        }, 100);

                        $('#modalZoneCluster').modal('show');
                    }
                },
                error: function(xhr) {
                    console.error('Error loading cluster:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load cluster data'
                    });

                    // Show list modal again
                    setTimeout(() => {
                        $('#modalListZoneCluster').modal('show');
                    }, 300);
                }
            });
        }, 300);
    });

    // Delete Cluster - Using event delegation
    $(document).on('click', '.btn-delete-cluster', function() {
        let id = $(this).data('id');
        console.log('Delete Cluster clicked, ID:', id);

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
                    url: `/admin/zone-clusters/delete/${id}`,
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
                                text: response.message || 'Cluster deleted successfully',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            loadZoneClusters();
                        }
                    },
                    error: function(xhr) {
                        console.error('Error deleting cluster:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Failed to delete cluster'
                        });
                    }
                });
            }
        });
    });

    // Submit Form Zone Cluster
    $('#formZoneCluster').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');

        let clusterId = $('#cluster_id').val();
        let url = clusterId ? `/admin/zone-clusters/update/${clusterId}` : '/admin/zone-clusters/store';
        let formData = new FormData(this);

        // Get summernote content for all locales
        @foreach(config('laravellocalization.supportedLocales') as $locale => $properties)
        formData.set('description[{{ $locale }}]', $('#cluster_description_{{ $locale }}').summernote('code'));
        @endforeach

        // Clear previous errors
        $('[id^="error_cluster_"]').text('');

        $('#btnSaveCluster').prop('disabled', true).html('<i class="ti ti-loader me-1"></i> Saving...');

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
                        text: response.message || 'Cluster saved successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#modalZoneCluster').modal('hide');

                    setTimeout(() => {
                        $('#modalListZoneCluster').modal('show');
                        loadZoneClusters();
                    }, 300);
                }
            },
            error: function(xhr) {
                console.error('Error saving cluster:', xhr);
                let errorMessage = 'Failed to save cluster';

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let errors = xhr.responseJSON.errors;

                    // Display field-specific errors
                    $.each(errors, function(key, messages) {
                        let fieldName = key.replace(/\./g, '_');
                        let errorElement = $(`#error_cluster_${fieldName}`);

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
                $('#btnSaveCluster').prop('disabled', false).html('<i class="ti ti-device-floppy me-1"></i> Save');
            }
        });
    });

    // Clean up on modal close
    $('#modalZoneCluster').on('hidden.bs.modal', function() {
        console.log('Modal cluster form closed');
        $('#formZoneCluster')[0].reset();
        $('.summernote-cluster').each(function() {
            if ($(this).data('summernote')) {
                $(this).summernote('destroy');
            }
        });

        // Clear errors
        $('[id^="error_cluster_"]').text('');
    });

    $('#modalListZoneCluster').on('hidden.bs.modal', function() {
        console.log('Modal list cluster closed');
        if (clusterTable) {
            clusterTable.destroy();
            clusterTable = null;
        }
    });

    // Debug: Check if modals exist
    console.log('Modal List exists:', $('#modalListZoneCluster').length > 0);
    console.log('Modal Form exists:', $('#modalZoneCluster').length > 0);
});
</script>