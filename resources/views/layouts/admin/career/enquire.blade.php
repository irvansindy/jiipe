@extends('layouts.admin.main', ['title' => 'Career Enquire Management'])
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
                                <li class="breadcrumb-item" aria-current="page">Career Enquire</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <form id="filterEnquireForm" class="mb-3">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-3">
                                <input type="text" class="form-control" id="filter_email" name="email"
                                    placeholder="Search email">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <input type="text" class="form-control" id="filter_position" name="position_id"
                                    placeholder="Position ID">
                            </div>
                            <div class="col-sm-12 col-md-6 d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <button type="button" id="resetEnquireFilters" class="btn btn-secondary">Reset</button>
                                <button type="button" id="refresh_table_enquire_list"
                                    class="btn btn-outline-dark">Refresh</button>
                            </div>
                        </div>
                    </form>

                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_enquire_list"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>POSITION ID</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>PHONE</th>
                                            <th>DATE</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for enquire detail -->
                    <div class="modal fade" id="modalEnquire" tabindex="-1" aria-labelledby="modalEnquireLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEnquireLabel">Enquire Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="enquireDetailBody">
                                        <!-- populated by JS -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" id="delete_enquire_btn">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    @include('layouts.admin.career.js.enquire_js')
@endpush
