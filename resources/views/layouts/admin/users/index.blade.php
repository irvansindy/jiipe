@extends('layouts.admin.main', ['title' => 'Users Management'])
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
                                <li class="breadcrumb-item">General Settings</li>
                                <li class="breadcrumb-item" aria-current="page">Users Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">List User</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-dark me-1" id="refresh_table_users" type="button" title="Refresh Table">
                                    <i class="ti ti-refresh"></i>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-primary" id="create_users" type="button" data-bs-toggle="modal" data-bs-target="#ModalUsers" title="Create User">
                                    <i class="ti ti-pencil"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_users" width="100%">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th>ROLE</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>NAME</th>
                                            <th>ROLE</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">List Role</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-dark me-1" id="refresh_table_roles" type="button" title="Refresh Table">
                                    <i class="ti ti-refresh"></i>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-primary" id="create_roles" type="button" data-bs-toggle="modal" data-bs-target="#ModalRoles" title="Create Menu">
                                    <i class="ti ti-pencil"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_roles" width="100%">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>NAME</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin.users.model_user')
        </div>
    </div>
@endsection()
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @include('layouts.admin.users.users_js')
@endpush
