@extends('layouts.admin.main', ['title' => 'Home Page'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">General Settings</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item" aria-current="page">Home Page</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Header</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store-home-header') }}" method="post" id="home_header" enctype="multipart/form-data">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white m-0">Slider</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="sliderTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active"
                                        id="slider-video-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#slider-video"
                                        type="button" role="tab"
                                        aria-controls="slider-video"
                                        aria-selected="true">
                                        Video
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link"
                                        id="slider-image-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#slider-image"
                                        type="button" role="tab"
                                        aria-controls="slider-image"
                                        aria-selected="true">
                                        Image
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="slider-video" role="tabpanel" aria-labelledby="slider-video-tab">
                                    <ul class="nav nav-pills justify-content-end mb-2" id="chart-tab-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="btn btn-outline-dark me-1" id="refresh_table_video" type="button"
                                                title="Refresh Table">
                                                <i class="ti ti-refresh"></i>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="btn btn-outline-primary" id="create_video" type="button"
                                                data-bs-toggle="modal" data-bs-target="#modalVideo" title="Create Video">
                                                <i class="ti ti-pencil"></i>
                                            </button>
                                        </li>
                                    </ul>
                                    @include('layouts.admin.home.table_slider_video')
                                </div>
                                <div class="tab-pane fade show" id="slider-image" role="tabpanel" aria-labelledby="slider-image-tab">
                                    <ul class="nav nav-pills justify-content-end mb-2" id="chart-tab-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="btn btn-outline-dark me-1" id="refresh_table_image" type="button"
                                                title="Refresh Table">
                                                <i class="ti ti-refresh"></i>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="btn btn-outline-primary" id="create_image" type="button"
                                                data-bs-toggle="modal" data-bs-target="#modalImage" title="Create image">
                                                <i class="ti ti-pencil"></i>
                                            </button>
                                        </li>
                                    </ul>
                                    @include('layouts.admin.home.table_slider_image')
                                </div>
                            </div>
                            <form action="{{ route('store-home-slider') }}" method="post" id="home_slider" enctype="multipart/form-data">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection