<script>
    function showLoader() {
        $("#modalLoader").fadeIn(200);
    }

    function hideLoader() {
        $("#modalLoader").fadeOut(200);
    }
    $(document).ready(function() {
        var table_news = $('#table_news').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('fetch-article-and-news') }}",
                type: 'GET',
            },
            columns: [
                { data: 'category.translations[0].name', name: 'category' },
                { data: 'translations[0].title', name: 'title' },
                    { data: 'created_at', name: 'created_at', render: function(data) {
                        return moment(data).format('LL');
                    }},
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    searchable: false,
                    render: function(item) {
                        return `
                        <button type="button" data-id="${item.id}" class="btn btn-outline-info me-1 mt-2 detail_news" data-bs-toggle="modal" data-bs-target="#modalNews" title="Detail Zone"><i class="ti ti-edit"></i></button>
                    `;
                    }
                }
            ],
            order: [[2, 'desc']],
        });

        var table_news_categories = $('#table_news_categories').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('fetch-article-and-news-categories') }}",
                type: 'GET',
            },
            columns: [
                { data: 'translations[0].name', name: 'category' },
                { data: 'created_at', name: 'created_at', render: function(data) {
                        return moment(data).format('LL');
                    }},
                {
                    data: null,
                    title: 'Action',
                    orderable: false,
                    searchable: false,
                    render: function(item) {
                        return `
                        <button type="button" data-id="${item.id}" class="btn btn-outline-info me-1 mt-2 detail_news_category" data-bs-toggle="modal" data-bs-target="#modalNewsCategories" title="Detail Category"><i class="ti ti-edit"></i></button>
                    `;
                    }
                }
            ],
            order: [[1, 'desc']],
        });

        $('#refresh_table_news').on('click', function() {
            table_news.ajax.reload();
        });

        $('#refresh_table_news_categories').on('click', function() {
            table_news_categories.ajax.reload();
        });

        $('#create_news').on('click', function() {
            $('#form_news')[0].reset();
            $('#modalNewsLabel').text('Create News & Articles');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-article-and-news-categories') }}",
                type: 'GET',
                success: function(res) {
                    var categories = res.data;
                    var $newsCategorySelect = $('#news_category');
                    $newsCategorySelect.empty(); // Clear existing options
                    $.each(categories, function(index, category) {
                        var option = $('<option></option>')
                            .attr('value', category.id)
                            .text(category.translations[0].name);
                        $newsCategorySelect.append(option);
                    });
                }
            });
            $('.news_summernote').summernote('reset');
            $('.news_summernote').summernote();
            $('#button_action_news').empty().append(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_news">Submit</button>
            `);
        });

        $(document).on('click', '#submit_news', function() {
            var formData = new FormData($('#form_news')[0]);
            // $('.news_summernote').each(function() {
            //     var locale = $(this).attr('id').match(/\[(.*?)\]/)[1];
            //     formData.append('news_content[' + locale + ']', $(this).summernote('code'));
            // });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('store-article-and-news') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('#modalNews').modal('hide');
                    table_news.ajax.reload();
                    alert('News & Articles created successfully!');
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    $('.text-danger').text('');
                    $.each(errors, function(key, value) {
                        $('#message_' + key.replace(/\./g, '_')).text(value[0]);
                    });
                }
            });
        });

        $('#create_news_categories').on('click', function() {
            $('#form_news_category')[0].reset();
            $('#modalNewsCategoriesLabel').text('Create News & Articles Categories');
            $('#button_action_news_category').empty().append(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_news_category">Submit</button>
            `)
        });

        $(document).on('click', '#submit_news_category', function(e) {
            e.preventDefault()
            let formDataCategory = new FormData($('#form_news_category')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('store-article-and-news-category') }}',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formDataCategory,
                beforeSend: function() {
                    showLoader();
                },
                success: function(res) {
                    $('#modalNewsCategories').modal('hide');
                    table_news_categories.ajax.reload(null, false);
                    alert('Menu permission created successfully!');
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    $('.text-danger').text('');
                    console.log(xhr);

                    $.each(errors, function(key, value) {
                        $('#message_' + key.replace(/\./g, '_')).text(value[0]);
                    });
                    hideLoader();
                },
                complete: function() {
                    hideLoader();
                }
            })

        })

        $(document).on('click', '.detail_news', function() {
            let newsId = $(this).data('id')
            $.ajax({
                url: "{{ route('get-article-and-news-id') }}",
                data: {
                    id: newsId
                },
                type: 'GET',
                beforeSend: function() {
                    showLoader();
                },
                success: function(res) {
                    let news = res.data.news;
                    let categories = res.data.categories;
                    // Set form data-id untuk update
                    $('#form_news').attr('data-id', news.id);

                    // Set category
                    let loop_categories = $('#news_category');
                    loop_categories.empty(); // Clear existing options
                    $.each(categories, function(index, category) {
                        var option = $('<option></option>')
                            .attr('value', category.id)
                            .text(category.translations[0].name);
                        loop_categories.append(option);
                    });
                    news.category != null ? loop_categories.val(news.category.id).trigger('change') : loop_categories.val('').trigger('change');

                    // Set status published
                    $('#news_published').val(news.is_published).trigger('change');

                    // Kosongkan semua error message
                    $('.text-danger').text('');

                    // Prefill translations
                    $.each(news.translations, function(i, t) {
                        $('#news_title_' + t.locale).val(t.title);
                        $('#news_content_' + t.locale).val(t.content);
                        $('#news_quote_' + t.locale).val(t.quote);

                        // kalau textarea pakai Summernote
                        $('#news_content_' + t.locale).summernote('code', t.content);
                    });

                    // Tampilkan modal
                    $('#modalNewsLabel').text('Edit News');
                    $('#button_action_news').html(`
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="update_news">Update</button>
                    `);
                    $('#modalNews').modal('show');
                },
                complete: function() {
                    hideLoader();
                }
            });
        });

        $(document).on('click', '#update_news', function() {
            var formData = new FormData($('#form_news')[0]);
            formData.append('id', $('#form_news').data('id'));
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('update-article-and-news') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    showLoader();
                },
                success: function(res) {
                    $('#modalNews').modal('hide');
                    table_news.ajax.reload();
                    alert('News & Articles created successfully!');
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    $('.text-danger').text('');
                    $.each(errors, function(key, value) {
                        $('#message_' + key.replace(/\./g, '_')).text(value[0]);
                    });
                    hideLoader();
                },
                complete: function() {
                    hideLoader();
                }
            });
        });

        $(document).on('click', '.detail_news_category', function(e) {
            e.preventDefault()
            let category_id = $(this).data('id')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-article-and-news-category-id') }}",
                data: {
                    id: category_id
                },
                type: 'get',
                beforeSend: function() {
                    showLoader();
                },
                success: function(res) {
                    $('#form_news_category')[0].reset()
                    let data = res.data
                    $('#form_news_category').attr('data-id', data.id.id)
                    $.each(data, (i, category) => {
                        $('#news_category_name_'+category.locale).val(category.name)
                    })
                    $('#button_action_news_category').empty().append(`
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="update_news_category">Update</button>
                    `)
                },
                error: function(xhr) {
                    alert('Gagal memuat data')
                    hideLoader();
                },
                complete: function() {
                    hideLoader();
                }
            })

            $(document).on('click', '#update_news_category', function() {
                let formDataCategory = new FormData($('#form_news_category')[0])
                formDataCategory.append('id', $('#form_news_category').data('id'))
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('update-article-and-news-category') }}",
                    type: 'POST',
                    data: formDataCategory,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(res) {
                        $('#modalNewsCategories').modal('hide');
                        table_news_categories.ajax.reload();
                        alert('News category successfully!');
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');
                        $.each(errors, function(key, value) {
                            $('#message_' + key.replace(/\./g, '_')).text(value[0]);
                        });
                        hideLoader();
                    },
                    complete: function() {
                        hideLoader();
                    }
                });
            })
        })
    });
</script>