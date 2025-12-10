@extends('layouts.admin.main', ['title' => 'Language Management', 'page' => 'language'])

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10 text-primary">General Settings</h5>
                        </div>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">General Settings</li>
                            <li class="breadcrumb-item" aria-current="page">Language Management</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Language Table Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                        <h4 class="text-white m-0">Languages</h4>
                        <div>
                            <button class="btn btn-light btn-sm me-2" id="sync_config_btn" title="Sync from Config">
                                <i class="ti ti-refresh"></i> Sync Config
                            </button>
                            <button class="btn btn-light btn-sm me-2" id="refresh_table_language" title="Refresh Table">
                                <i class="ti ti-refresh"></i>
                            </button>
                            <button class="btn btn-light btn-sm" id="create_language" data-bs-toggle="modal" data-bs-target="#ModalLanguage">
                                <i class="ti ti-plus"></i> Add Language
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.admin.language.table_language')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.admin.language.modal_language')
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('asset/css/cdn/datatable-bootstrap5.css') }}">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    #loadingOverlayLanguage {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loadingOverlayLanguage .spinner {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>
@endpush

@push('js')
<script src="{{ asset('asset/js/cdn/jquery-v3-7-1.js') }}"></script>
<script src="{{ asset('asset/js/cdn/datatable.js') }}"></script>
<script src="{{ asset('asset/js/cdn/datatable-bootstrap5.js') }}"></script>
<script src="{{ asset('asset/js/cdn/moment.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('layouts.admin.language.language_js')
@endpush