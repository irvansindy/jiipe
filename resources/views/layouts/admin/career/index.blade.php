@extends('layouts.admin.main', ['title' => 'Career Management'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-danger">Career</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Career</li>
                                <li class="breadcrumb-item" aria-current="page">Career Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="filterCareerForm">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 col-lg-3 mb-2">
                                <select class="form-control" name="master_career_location"
                                    id="master_career_location"></select>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 mb-2">
                                <select class="form-control" name="master_career_education"
                                    id="master_career_education"></select>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 mb-2">
                                <select class="form-control" name="master_career_job_level"
                                    id="master_career_job_level"></select>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 mb-2">
                                <select class="form-control" name="master_career_company"
                                    id="master_career_company"></select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-2" id="applyCareerFilters">Apply
                                    Filters</button>
                                <button type="button" class="btn btn-secondary" id="resetCareerFilters">Reset</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Career List</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-dark me-1" id="refresh_table_career_list" type="button"
                                    title="Refresh Table">
                                    <i class="ti ti-refresh"></i>
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-primary me-1" id="create_career_list" type="button"
                                    data-bs-toggle="modal" data-bs-target="#modalCareer" title="">
                                    <i class="ti ti-pencil"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_career_list"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>POSITION</th>
                                            <th>PT</th>
                                            <th>LOCATION</th>
                                            <th>JOB LEVEL</th>
                                            <th>MIN EDUCATION</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>POSITION</th>
                                            <th>PT</th>
                                            <th>LOCATION</th>
                                            <th>JOB LEVEL</th>
                                            <th>MIN EDUCATION</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.career.modal_career')
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @include('layouts.admin.career.js.index_js')
@endpush
