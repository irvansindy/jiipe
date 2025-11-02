@extends('layouts.admin.main', ['title' => 'Zone Management'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Zones</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Zones</li>
                                <li class="breadcrumb-item" aria-current="page">Zone Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">List Zone</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-dark me-1" id="refresh_table_zone" type="button"
                                    title="Refresh Table">
                                    <i class="ti ti-refresh"></i>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-primary" id="create_zone" type="button"
                                    data-bs-toggle="modal" data-bs-target="#modalZone" title="Create Zone">
                                    <i class="ti ti-pencil"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="zoneTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="special-zone" data-bs-toggle="tab"
                                        data-bs-target="#tab-special-zone" type="button" role="tab"
                                        aria-controls="tab-special-zone" aria-selected="true">
                                        Special Economic Zone
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="zone" data-bs-toggle="tab" data-bs-target="#tab-zone"
                                        type="button" role="tab" aria-controls="tab-zone" aria-selected="false">
                                        Zone
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content border border-top-0 p-3">
                                <div class="tab-pane fade show active" id="tab-special-zone" role="tabpanel"
                                    aria-labelledby="special-zone">
                                    @include('layouts.admin.zone.special_zone')
                                </div>
                                <div class="tab-pane fade" id="tab-zone" role="tabpanel" aria-labelledby="zone">
                                    @include('layouts.admin.zone.zone')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.admin.zone.modal_zone')
            </div>
        </div>
    </div>
@endsection
@push('css')
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
    @include('layouts.admin.zone.zone_js')
@endpush
