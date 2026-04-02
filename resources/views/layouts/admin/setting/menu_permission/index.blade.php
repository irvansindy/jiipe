@extends('layouts.admin.main', ['title' => 'Menu Permission'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-danger">General Settings</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">General Settings</li>
                                <li class="breadcrumb-item" aria-current="page">Menu Permission</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">List Menu Permission</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-dark me-1" id="refresh_table_menu_permission" type="button"
                                    title="Refresh Table">
                                    <i class="ti ti-refresh"></i>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-primary" id="create_menu_permission" type="button"
                                    data-bs-toggle="modal" data-bs-target="#modalMenuPermission" title="Create Menu">
                                    <i class="ti ti-pencil"></i> Create Menu
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- DataTable Card -->
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_menu_permission"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>MENU NAME</th>
                                            <th>URL</th>
                                            <th>ICON</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>NO</th>
                                            <th>MENU NAME</th>
                                            <th>URL</th>
                                            <th>ICON</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Modals -->
            @include('layouts.admin.setting.menu_permission.modal')
            @include('layouts.admin.setting.menu_permission.modal_child_menu')
            @include('layouts.admin.setting.menu_permission.modal_loader')
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Switch Toggle Styling */
        .form-switch .form-check-input {
            width: 2.5em;
            height: 1.25em;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
        }

        .form-switch .form-check-input:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Badge Styling */
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        /* Button Group Alignment */
        .d-flex.gap-1 {
            gap: 0.25rem !important;
        }

        /* DataTable Processing */
        .dataTables_processing {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 2rem;
        }

        /* Modal Content Position */
        .modal-content {
            position: relative;
        }

        /* Action Column Width */
        #table_menu_permission tbody td:last-child,
        #table_child_menu tbody td:last-child {
            min-width: 250px;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('layouts.admin.setting.menu_permission.menu_permission_js')
@endpush
