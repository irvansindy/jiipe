<script>
    $(document).ready(function() {
        // Data storage untuk client-side
        let allData = {
            locations: [],
            educations: [],
            jobLevels: [],
            companies: []
        };

        // Configuration object
        const selectConfig = {
            location: {
                selector: '#master_career_location',
                url: '{{ route('company-location') }}',
                dataKey: 'locations',
                placeholder: 'Select Location'
            },
            education: {
                selector: '#master_career_education',
                url: '{{ route('company-education') }}',
                dataKey: 'educations',
                placeholder: 'Select Education'
            },
            jobLevel: {
                selector: '#master_career_job_level',
                url: '{{ route('company-job-level') }}',
                dataKey: 'jobLevels',
                placeholder: 'Select Job Level'
            },
            company: {
                selector: '#master_career_company',
                url: '{{ route('company') }}',
                dataKey: 'companies',
                placeholder: 'Select Company'
            }
        };

        // Load all data first
        loadAllData();

        function loadAllData() {
            const loadPromises = Object.keys(selectConfig).map(key => {
                const config = selectConfig[key];

                return $.ajax({
                    url: config.url,
                    dataType: 'json',
                    method: 'GET'
                }).done(function(data) {
                    // Handle berbagai format response
                    let results = [];

                    if (Array.isArray(data)) {
                        results = data;
                    } else if (data.data && Array.isArray(data.data)) {
                        results = data.data;
                    } else if (data.results && Array.isArray(data.results)) {
                        results = data.results;
                    }

                    // Normalisasi data
                    allData[config.dataKey] = results.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name || item.text || item.title
                        };
                    });

                }).fail(function(xhr, status, error) {
                    console.error(`Error loading ${key}:`, error);
                    showToast('Error', `Failed to load ${config.placeholder}`, 'danger');
                });
            });

            // Initialize Select2 setelah semua data loaded
            Promise.all(loadPromises).then(function() {
                initSelect2();
            }).catch(function(error) {
                console.error('Error loading data:', error);
            });
        }

        function initSelect2() {
            Object.keys(selectConfig).forEach(key => {
                const config = selectConfig[key];
                const data = allData[config.dataKey];

                $(config.selector).select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    placeholder: config.placeholder,
                    allowClear: true,
                    data: data,
                    // Client-side searching
                    matcher: function(params, data) {
                        // If there are no search terms, return all data
                        if ($.trim(params.term) === '') {
                            return data;
                        }

                        // Do not display the item if there is no 'text' property
                        if (typeof data.text === 'undefined') {
                            return null;
                        }

                        // `params.term` is the user's search term
                        var term = params.term.toLowerCase();
                        var text = data.text.toLowerCase();

                        // Check if the text contains the term
                        if (text.indexOf(term) > -1) {
                            return data;
                        }

                        // Return `null` if the term should not be displayed
                        return null;
                    },
                    language: {
                        noResults: function() {
                            return 'No results found';
                        },
                        searching: function() {
                            return 'Searching...';
                        }
                    }
                });
                // Set nilai awal kosong dengan placeholder
                $(config.selector).val(null).trigger('change');
            });
        }

        // Inisialisasi DataTable dengan filter
        var tableCareerList = $('#table_career_list').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('fetch-career-list') }}",
                data: function(d) {
                    d.location_id = $('#master_career_location').val();
                    d.education_id = $('#master_career_education').val();
                    d.job_level_id = $('#master_career_job_level').val();
                    d.company_id = $('#master_career_company').val();
                }
            },
            columns: [{
                    data: 'position',
                    name: 'position',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'factory.name',
                    name: 'factory.name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'location.name',
                    name: 'location.name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'job_level.name',
                    name: 'job_level.name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'education.name',
                    name: 'education.name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: null,
                    title: 'Action',
                    wrap: true,
                    render: function(item) {
                        return '<button type="button" data-career_id="' + item.id +
                            '" class="btn btn-outline-info btn-sm mt-2 detail_career" data-toggle="modal" data-target="#">View</button>'
                    }
                },
            ]
        });

        // NOTE: removed automatic reload on select change. Table will reload only on form submit.

        // Handle form submit (Apply Filters)
        $('#filterCareerForm').on('submit', function(e) {
            e.preventDefault();
            tableCareerList.ajax.reload();
        });

        // Reset filters
        $('#resetCareerFilters').on('click', function() {
            // clear select2 selects
            $('#master_career_location').val(null).trigger('change');
            $('#master_career_education').val(null).trigger('change');
            $('#master_career_job_level').val(null).trigger('change');
            $('#master_career_company').val(null).trigger('change');
            tableCareerList.ajax.reload();
        });

        $('#refresh_table_career_list').click(function() {
            tableCareerList.ajax.reload();
        });

        $('#create_career_list').click(function() {
            // Clear form fields
            $('#modalCareer form')[0].reset();
            $('#modalCareerLabel').text('Create Career');
            $('#for-id').empty();
            $('#modalCareer').modal('show');
            $('#career_description').summernote('reset');
            $('#button_action_news_category').empty();
            $('#button_action_news_category').append(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save_career_btn">Submit</button>
            `);
        });

        // Store or update career
        $(document).on('click', '#save_career_btn, #update_career_btn', function(e) {
            e.preventDefault();
            let formData = $('#modalCareer form').serialize();
            $.ajax({
                url: "{{ route('store-or-update-career') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    // Handle success
                    $('#modalCareer').modal('hide');
                    tableCareerList.ajax.reload();
                },
                error: function(xhr) {
                    // Handle error
                }
            });
        });

        $(document).on('click', '.detail_career', function(e) {
            e.preventDefault();
            let career_id = $(this).data('career_id');
            $('#form_career')[0].reset();
            // Fetch and populate data based on career_id
            // Update modal title and buttons accordingly
            $('#modalCareerLabel').text('Career Details');
            $('#for-id').empty().append(`
                <input type="hidden" id="career_id" name="career_id">
            `);
            $('#career_id').val(career_id)
            $('#modalCareer').modal('show');
            $('#button_action_news_category').empty();
            $('#button_action_news_category').append(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_career_btn" data-career_id="${career_id}">Update</button>
            `);
            $.ajax({
                url: "{{ route('get-career-details') }}",
                type: "GET",
                data: {
                    career_id: career_id
                },
                success: function(response) {
                    $('#career_position').val(response.data.position);
                    $('#career_factory').val(response.data.factory.id).trigger('change');
                    $('#career_location').val(response.data.location.id).trigger('change');
                    $('#career_job_level').val(response.data.job_level.id).trigger(
                        'change');
                    $('#career_range_salary').val(response.data.range_salary);
                    $('#career_education').val(response.data.education.id).trigger(
                        'change');
                    $('#career_experience').val(response.data.minimum_experience);
                    $('#career_description').summernote('code', response.data.description);
                },
                error: function(xhr) {
                    // Handle error
                    console.error(xhr);
                    alert('Failed to fetch career details.');
                }
            })
        });

    });
</script>
