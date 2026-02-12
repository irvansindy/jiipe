<script>
    $(document).ready(function() {

        // Ensure SweetAlert2 is rendered above Bootstrap modals
        // Adds a style tag with a very high z-index so swal dialogs aren't hidden.
        if ($('head').find('#swal2-zindex-style').length === 0) {
            $('head').append(
                '<style id="swal2-zindex-style">.swal2-container{z-index:2147483647!important}.swal2-popup{z-index:2147483647!important}</style>'
            );
        }
        // ============================================
        // HELPER FUNCTIONS
        // ============================================

        function showLoading() {
            $('#loadingOverlayZone').fadeIn();
            $('#action_zone .btn-text').addClass('d-none');
            $('#action_zone .spinner-border').removeClass('d-none');
            $('#action_zone').prop('disabled', true);
        }

        function hideLoading() {
            $('#loadingOverlayZone').fadeOut();
            $('#action_zone .btn-text').removeClass('d-none');
            $('#action_zone .spinner-border').addClass('d-none');
            $('#action_zone').prop('disabled', false);
        }

        function resetForm() {
            $('#zone_form')[0].reset();
            $('#zone_id').val('');

            // Clear all error messages
            $('[id^="message_"]').text('');

            // Clear image preview
            $('#current_zone_image').html('');

            // Reset summernote
            $('.zone_description').each(function() {
                if ($(this).summernote) {
                    $(this).summernote('code', '');
                }
            });

            // Reset select2
            $('#zone_class').val('').trigger('change');
        }

        // Initialize Summernote
        function initSummernote() {
            $('.zone_description').summernote({
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

        // Load Zone Classes for dropdown
        function loadZoneClasses() {
            $.ajax({
                url: "{{ route('fetch-zone-class-data') }}",
                method: 'GET',
                success: function(res) {
                    if (res.meta && res.meta.status === 'success') {
                        $('#zone_class').empty().append(
                            '<option value="">-- Select Zone Class --</option>');

                        res.data.forEach(function(zone) {
                            let name = zone.translations && zone.translations.length > 0 ?
                                zone.translations[0].name :
                                'Unknown';
                            $('#zone_class').append(
                                `<option value="${zone.id}">${name}</option>`);
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Failed to load zone classes:', xhr);
                }
            });
        }

        // Fungsi untuk render action buttons dengan dropdown Zone Cluster dan Sub Development
        function renderZoneActionButtons(item) {
            let buttons = '<div class="btn-group" role="group">';

            // Button Edit Zone
            buttons += `
                <button type="button"
                    data-zone_id="${item.id}"
                    class="btn btn-outline-info detail_zone"
                    title="Edit">
                    <i class="ti ti-edit"></i>
                </button>
            `;

            // Button Delete Zone
            buttons += `
                <button type="button"
                    data-id="${item.id}"
                    class="btn btn-outline-danger btn-delete-zone"
                    title="Delete">
                    <i class="ti ti-trash"></i>
                </button>
            `;

            // Dropdown untuk Zone Management (hanya untuk zone_class_id = 1)
            if (item.zone_class_id === 1) {
                // Escape single quotes in zone name
                let zoneName = (item.translations && item.translations.length > 0 ?
                    item.translations[0].name : 'Unknown').replace(/'/g, "\\'");

                buttons += `
                    <button type="button"
                            class="btn btn-outline-primary dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            title="Zone Management">
                        <i class="ti ti-sitemap"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <h6 class="dropdown-header">Zone Management</h6>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item"
                               href="javascript:void(0)"
                               onclick="openZoneClusterModal(${item.id}, '${zoneName}')">
                                <i class="ti ti-list me-2"></i> Manage Clusters
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                               href="javascript:void(0)"
                               onclick="openSubDevelopmentModal(${item.id}, '${zoneName}')">
                                <i class="ti ti-building me-2"></i> Manage Developments
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                               href="javascript:void(0)"
                               onclick="openRegionalAdvantagesModal(${item.id}, '${zoneName}')">
                                <i class="ti ti-award me-2"></i> Manage Advantages
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                               href="javascript:void(0)"
                               onclick="openResourceEnergyModal(${item.id}, '${zoneName}')">
                                <i class="ti ti-bolt me-2"></i> Manage Resources
                            </a>
                        </li>
                    </ul>
                `;
            }

            buttons += '</div>';
            return buttons;
        }

        // ============================================
        // INITIALIZE
        // ============================================

        // Initialize DataTables
        var table_zone = $('#table_zone').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-zone-data') }}",
                type: 'GET',
                dataSrc: function(json) {
                    if (json.meta && json.meta.status === 'success') {
                        return json.data;
                    }
                    return [];
                }
            },
            columns: [{
                    data: 'translations[0].name',
                    name: 'name',
                    render: function(data) {
                        return data || '<i class="text-muted">No name</i>';
                    }
                },
                {
                    data: 'translations[0].subtitle',
                    name: 'subtitle',
                    render: function(data) {
                        return data || '<i class="text-muted">No subtitle</i>';
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, item) {
                        return renderZoneActionButtons(item);
                    }
                }
            ],
            order: [
                [0, 'asc']
            ],
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            responsive: true,
        });

        var table_special_zone = $('#table_special_zone').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-special-zone-data') }}",
                type: 'GET',
                dataSrc: function(json) {
                    if (json.meta && json.meta.status === 'success') {
                        return json.data;
                    }
                    return [];
                }
            },
            columns: [{
                    data: 'translations[0].name',
                    name: 'name',
                    render: function(data) {
                        return data || '<i class="text-muted">No name</i>';
                    }
                },
                {
                    data: 'translations[0].subtitle',
                    name: 'subtitle',
                    render: function(data) {
                        return data || '<i class="text-muted">No subtitle</i>';
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, item) {
                        return renderZoneActionButtons(item);
                    }
                }
            ],
            order: [
                [0, 'asc']
            ],
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            responsive: true,
        });

        // AJAX setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize Summernote
        initSummernote();

        // ============================================
        // EVENT HANDLERS
        // ============================================

        // Refresh table button
        $('#refresh_table_zone').on('click', function() {
            table_zone.ajax.reload();
            table_special_zone.ajax.reload();
        });

        // Create zone button
        $('#create_zone').on('click', function() {
            resetForm();
            initSummernote();
            loadZoneClasses();

            $('#modalZoneLabel').text('Create Zone');
            $('#modalZone').modal('show');
        });

        // Edit zone button
        $(document).on('click', '.detail_zone', function() {
            let zoneId = $(this).data('zone_id');

            showLoading();

            $.ajax({
                url: "{{ url('admin/zone') }}/" + zoneId + "/detail",
                method: 'GET',
                success: function(res) {
                    hideLoading();

                    if (res.meta && res.meta.status === 'success') {
                        var zone = res.data;

                        // Set zone ID
                        $('#zone_id').val(zone.id);

                        // Load zone classes and set selected value
                        loadZoneClasses();
                        setTimeout(function() {
                            $('#zone_class').val(zone.zone_class_id).trigger(
                                'change');
                        }, 300);

                        // Display current image
                        $('#current_zone_image').html('');
                        if (zone.image) {
                            var imageUrl = zone.image.startsWith('http') ?
                                zone.image :
                                '{{ url('/uploads/zones/') }}/' + zone.image;

                            $('#current_zone_image').html(
                                '<img src="' + imageUrl +
                                '" class="img-thumbnail" style="max-width:100%;max-height:200px;" loading="lazy" decoding="async">' +
                                '<p class="text-muted small mt-1">Current image (upload new to replace)</p>'
                            );
                        }

                        // Reinitialize summernote
                        $('.zone_description').summernote('destroy');
                        initSummernote();

                        // Fill translation fields
                        Object.keys(zone.translations).forEach(function(locale) {
                            $('#zone_name_' + locale).val(zone.translations[locale]
                                .name);
                            $('#zone_subtitle_' + locale).val(zone.translations[
                                locale].subtitle);
                            $('#zone_description_' + locale).summernote('code', zone
                                .translations[locale].description);
                            $('#zone_note_' + locale).val(zone.translations[locale]
                                .note);
                        });

                        $('#modalZoneLabel').text('Edit Zone');
                        $('#modalZone').modal('show');
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.meta?.message ||
                            'Failed to load zone data'
                    });
                }
            });
        });

        // Submit form
        $('#zone_form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var zoneId = $('#zone_id').val();
            var url = zoneId ?
                "{{ url('admin/zone') }}/" + zoneId + "/update" :
                "{{ route('store-zone-data') }}";

            // Clear previous errors
            $('[id^="message_"]').text('');

            showLoading();

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    hideLoading();

                    if (res.meta && res.meta.status === 'success') {
                        $('#modalZone').modal('hide');

                        // Destroy summernote before hiding modal
                        $('.zone_description').summernote('destroy');

                        table_zone.ajax.reload();
                        table_special_zone.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.meta.message || (zoneId ?
                                'Zone updated successfully!' :
                                'Zone created successfully!'),
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    hideLoading();

                    // Prefer structured validation errors under `errors`,
                    // but fall back to `data` for older formats.
                    var errors = xhr.responseJSON?.errors || xhr.responseJSON?.data || null;

                    if (xhr.status === 422 && errors) {
                        // errors is an object: { "zone_class": ["..."], "zone_name.id": ["..."] }
                        $.each(errors, function(key, messages) {
                            var messageText = '';

                            if (Array.isArray(messages)) {
                                messageText = messages.length ? messages[0] : '';
                            } else if (typeof messages === 'string') {
                                messageText = messages;
                            } else if (messages && messages[0]) {
                                messageText = messages[0];
                            }

                            var fieldName = key.replace(/\./g, '_');
                            var selector = '#message_' + fieldName;

                            if ($(selector).length) {
                                $(selector).text(messageText);
                            }
                        });

                        // Show a generic toast if no specific span was updated
                        if (!$('[id^="message_"]').filter(function() {
                                return $(this).text().trim() !== '';
                            }).length) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error!',
                                text: xhr.responseJSON?.message ||
                                    'Please check all required fields'
                            });
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.meta?.message || xhr
                                .responseJSON?.message || 'Server error occurred'
                        });
                    }
                }
            });
        });

        // Delete zone
        $(document).on('click', '.btn-delete-zone', function() {
            var id = $(this).data('id');

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
                        url: "{{ url('admin/zone') }}/" + id + "/delete",
                        method: 'DELETE',
                        success: function(res) {
                            hideLoading();

                            if (res.meta && res.meta.status === 'success') {
                                table_zone.ajax.reload();
                                table_special_zone.ajax.reload();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Zone has been deleted.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function(xhr) {
                            hideLoading();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON?.meta?.message ||
                                    'Failed to delete zone'
                            });
                        }
                    });
                }
            });
        });

        // Clean up summernote when modal is hidden
        $('#modalZone').on('hidden.bs.modal', function() {
            $('.zone_description').summernote('destroy');
        });
    });
</script>