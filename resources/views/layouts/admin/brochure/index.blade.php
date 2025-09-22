@extends('layouts.admin.main', ['title' => 'Brochure Management'])

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10 text-primary">Brochures</h5>
                        </div>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">Brochure</li>
                            <li class="breadcrumb-item" aria-current="page">Brochure Management</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alert Sukses / Error --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->has('error'))
            <div class="alert alert-danger">{{ $errors->first('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-12 col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary d-flex align-items-center justify-content-between">
                        <h4 class="text-white m-0">Brochure</h4>
                        <button class="btn btn-outline-light" id="create_brochure" type="button" data-bs-toggle="modal" data-bs-target="#ModalBrochure" title="Create Brocure">
                            <i class="ti ti-pencil"></i>
                        </button>
                    </div>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_brochure" width="100%">
                                    <thead>
                                        <tr>
                                            <th>NUMBER</th>
                                            <th>TITLE</th>
                                            <th>DATE</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>NUMBER</th>
                                            <th>TITLE</th>
                                            <th>DATE</th>
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
        @include('layouts.admin.brochure.modal_brochure')
    </div>
</div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @include('layouts.admin.brochure.brochure_js')
@endpush
