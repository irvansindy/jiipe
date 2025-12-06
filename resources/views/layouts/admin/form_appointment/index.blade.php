@extends('layouts.admin.main', ['title' => 'List Appointment', 'page' => 'list_appointment'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Form Appointment</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Form Appointment</li>
                                <li class="breadcrumb-item" aria-current="page">List Appointment</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-32 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <form id="filterAppointmentForm">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Reason for
                                                    considering
                                                    JIIPE</label>
                                                <select class="form-control" id="filter_reason" name="reason">
                                                    <option value="">-- Select One --</option>
                                                    <option value="To Approach Market">To Approach Market</option>
                                                    <option value="Require a seaport">Require a seaport</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Industry</label>
                                                <select class="form-control" id="filter_industry" name="classification">
                                                    <option value="">-- Select One --</option>
                                                    <option value="Chemical">Chemical</option>
                                                    <option value="Energy">Energy</option>
                                                    <option value="Electronic">Electronic</option>
                                                    <option value="Metal">Metal</option>
                                                    <option value="Supporting & Logistic">Supporting & Logistic</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Land Plot</label>
                                                <select class="form-control" id="filter_land_plot" name="land_plot">
                                                    <option value="">-- Select One --</option>
                                                    <option value="2 - 10 Ha">2 - 10 Ha</option>
                                                    <option value="11 - 20 Ha">11 - 20 Ha</option>
                                                    <option value="21 - 30 Ha">21 - 30 Ha</option>
                                                    <option value="&gt;30 Ha">&gt;30 Ha</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Timeline</label>
                                                <select class="form-control" id="filter_timeline" name="timeline">
                                                    <option value="">-- Select One --</option>
                                                    <option value="1-2 Years">1-2 Years</option>
                                                    <option value="More than 2 years">More than 2 years</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Total Required
                                                    Power</label>
                                                <select class="form-control" id="filter_power" name="power">
                                                    <option value="">-- Select One --</option>
                                                    <option value="Below 10 MW">Below 10 MW</option>
                                                    <option value="Above 10 MW">Above 10 MW</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Total Industrial
                                                    Water</label>
                                                <select class="form-control" id="filter_industrial_water"
                                                    name="industrial_water">
                                                    <option value="">-- Select One --</option>
                                                    <option value="Below 100 m3 / day">Below 100 m3 / day</option>
                                                    <option value="Above 100 m3 / day">Above 100 m3 / day</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Total Required
                                                    Natural
                                                    Gas
                                                </label>
                                                <select class="form-control" id="filter_natural_gas" name="natural_gas">
                                                    <option value="">-- Select One --</option>
                                                    <option value="Below 100  MMBTU / annum">Below 100 MMBTU / annum
                                                    </option>
                                                    <option value="Above 100  MMBTU / annum">Above 100 MMBTU / annum
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Est. Vol.
                                                    Throughput
                                                    Via Seaport</label>
                                                <select class="form-control" id="filter_throughput"
                                                    name="throughput_via_seaport">
                                                    <option value="">-- Select One --</option>
                                                    <option value="Below 50000 tons/year">Below 50000 tons/year</option>
                                                    <option value="Above 50000 tons/year">Above 50000 tons/year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <button type="submit" class="btn btn-primary" id="applyFilters">Apply
                                                Filters</button>
                                            <button type="button" class="btn btn-secondary"
                                                id="resetFilters">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12 col-sm-6">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">List Appointment</h5>

                    </div>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0" id="table_list_appointment"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>FULL NAME</th>
                                            <th>COMPANY NAME</th>
                                            <th>COMPANY ORIGIN COUNTRY</th>
                                            <th>REASON</th>
                                            <th>INDUSTRY</th>
                                            <th>LAND PLOT</th>
                                            <th>TIMELINE</th>
                                            <th>DATE</th>
                                            <th class="text-end">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>FULL NAME</th>
                                            <th>COMPANY NAME</th>
                                            <th>COMPANY ORIGIN COUNTRY</th>
                                            <th>REASON</th>
                                            <th>INDUSTRY</th>
                                            <th>LAND PLOT</th>
                                            <th>TIMELINE</th>
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
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.min.js"></script>
    @include('layouts.admin.form_appointment.appointment_js')
    <script>
        (function() {
            const fetchUrl = "{{ route('fetch-appointment') }}";

            function buildParams() {
                const form = document.getElementById('filterAppointmentForm');
                const fd = new FormData(form);
                const params = {};
                for (const [k, v] of fd.entries()) {
                    if (v !== null && v !== '') params[k] = v;
                }
                return params;
            }

            function renderTable(items) {
                const tbody = document.querySelector('#table_list_appointment tbody');
                tbody.innerHTML = '';
                if (!Array.isArray(items)) return;
                items.forEach(item => {
                    const tr = document.createElement('tr');
                    const fullName = (item.first_name || '') + ' ' + (item.last_name || '');
                    const date = item.created_at ? new Date(item.created_at).toLocaleString() : '';
                    tr.innerHTML = `
                        <td>${fullName}</td>
                        <td>${item.company_name || ''}</td>
                        <td>${item.country_origin || ''}</td>
                        <td>${item.reason || ''}</td>
                        <td>${item.classification || ''}</td>
                        <td>${item.land_plot || ''}</td>
                        <td>${item.timeline || ''}</td>
                        <td>${date}</td>
                        <td class="text-end">-</td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            async function fetchAppointments() {
                try {
                    const params = buildParams();
                    const url = Object.keys(params).length ? fetchUrl + '?' + new URLSearchParams(params)
                    .toString() : fetchUrl;
                    const res = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    if (!res.ok) throw new Error('Network response was not ok');
                    const json = await res.json();
                    if (json && json.data) {
                        renderTable(json.data);
                    }
                } catch (err) {
                    console.error('Failed to fetch appointments', err);
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // initial load
                fetchAppointments();

                const form = document.getElementById('filterAppointmentForm');
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    fetchAppointments();
                });

                document.getElementById('resetFilters').addEventListener('click', function() {
                    form.reset();
                    fetchAppointments();
                });
            });
        })();
    </script>
@endpush
