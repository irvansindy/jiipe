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



        var tableCareerList = $('#table_career_list').DataTable({
            processing: true,
            // serverSide: true,
            ajax: "{{ route('fetch-career-list') }}",
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
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-career_id="'+item.id+'" class="btn btn-outline-info btn-sm mt-2 detail_career" data-toggle="modal" data-target="#">View</button>'
                    }
                },
            ]
        });

        $('#refresh_table_career_list').click(function() {
            tableCareerList.ajax.reload();
        });

        $('#create_career_list').click(function() {
            // Clear form fields
            $('#modalCareer form')[0].reset();
            $('#modalCareer').modal('show');
        });
    });
</script>
