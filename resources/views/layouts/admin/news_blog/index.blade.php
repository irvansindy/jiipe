@extends('layouts.admin.main', ['title' => 'News & Articles Management'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-danger">News & Articles</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">News</li>
                                <li class="breadcrumb-item" aria-current="page">News Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">List News & Articles</h5>
                    </div>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="zoneTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="news-articles" data-bs-toggle="tab"
                                        data-bs-target="#tab-news-articles" type="button" role="tab"
                                        aria-controls="tab-news-articles" aria-selected="true">
                                        News & Articles
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="news-categories" data-bs-toggle="tab"
                                        data-bs-target="#tab-news-categories" type="button" role="tab"
                                        aria-controls="tab-news-categories" aria-selected="false">
                                        Categories
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content border border-top-0 p-3">
                                <div class="tab-pane fade show active" id="tab-news-articles" role="tabpanel"
                                    aria-labelledby="news-articles">
                                    <ul class="nav nav-pills justify-content-end mb-2" id="chart-tab-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="btn btn-outline-dark me-1" id="refresh_table_news" type="button"
                                                title="Refresh Table">
                                                <i class="ti ti-refresh"></i>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="btn btn-outline-danger" id="create_news" type="button"
                                                data-bs-toggle="modal" data-bs-target="#modalNews" title="Create Menu">
                                                <i class="ti ti-pencil"></i>
                                            </button>
                                        </li>
                                    </ul>
                                    @include('layouts.admin.news_blog.news_table')
                                </div>
                                <div class="tab-pane fade" id="tab-news-categories" role="tabpanel"
                                    aria-labelledby="news-categories">
                                    <ul class="nav nav-pills justify-content-end mb-2" id="chart-tab-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="btn btn-outline-dark me-1" id="refresh_table_news_categories"
                                                type="button" title="Refresh Table">
                                                <i class="ti ti-refresh"></i>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="btn btn-outline-danger" id="create_news_categories"
                                                type="button" data-bs-toggle="modal" data-bs-target="#modalNewsCategories"
                                                title="Create Menu">
                                                <i class="ti ti-pencil"></i>
                                            </button>
                                        </li>
                                    </ul>
                                    @include('layouts.admin.news_blog.categories_table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin.news_blog.modal_news')
            @include('layouts.admin.news_blog.modal_categories')
        </div>
    </div>
@endsection
@push('css')
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    @include('layouts.admin.news_blog.news_js')
@endpush
