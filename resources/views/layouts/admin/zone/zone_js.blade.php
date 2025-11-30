<script>
    $(document).ready(function() {
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
                url: "{{ route('fetch-zone-class') }}",
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

        // ============================================
        // INITIALIZE
        // ============================================

        // Initialize DataTables
        var table_zone = $('#table_zone').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-zone') }}",
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
                    render: function(item) {
                        return `
                    <div class="btn-group" role="group">
                        <button type="button"
                            data-zone_id="${item.id}"
                            class="btn btn-outline-info detail_zone"
                            title="Edit">
                            <i class="ti ti-edit"></i>
                        </button>
                        <button type="button"
                            data-id="${item.id}"
                            class="btn btn-outline-danger btn-delete-zone"
                            title="Delete">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                `;
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
                url: "{{ route('fetch-special-zone') }}",
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
                    render: function(item) {
                        return `
                    <div class="btn-group" role="group">
                        <button type="button"
                            data-zone_id="${item.id}"
                            class="btn btn-outline-info detail_zone"
                            title="Edit">
                            <i class="ti ti-edit"></i>
                        </button>
                        <button type="button"
                            data-id="${item.id}"
                            class="btn btn-outline-danger btn-delete-zone"
                            title="Delete">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                `;
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
                                '" class="img-thumbnail" style="max-width:100%;max-height:200px;">' +
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
                "{{ route('store-zone') }}";

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

                    if (xhr.status === 422 && xhr.responseJSON?.data) {
                        // Validation errors
                        var errors = xhr.responseJSON.data;
                        $.each(errors, function(key, messages) {
                            var fieldName = key.replace(/\./g, '_');
                            var selector = '#message_' + fieldName;
                            if ($(selector).length) {
                                $(selector).text(messages[0]);
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
                            text: xhr.responseJSON?.meta?.message ||
                                'Server error occurred'
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
