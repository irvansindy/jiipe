@extends('layouts.admin.main', ['title' => 'Jiipe - Dashboard'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Dashboard</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Total Appointments Card -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Contact (Appointment)</h6>
                            <h4 class="mb-3">{{ number_format($stats['appointments']['total']) }}</h4>
                            <p class="mb-0 text-muted text-sm">
                                {{ $stats['appointments']['formatted']['text'] }}
                                <span class="{{ $stats['appointments']['formatted']['class'] }}">
                                    {{ $stats['appointments']['formatted']['value'] }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Brochure Downloads Card -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Contact (Brochure)</h6>
                            <h4 class="mb-3">{{ number_format($stats['brochure']['total']) }}</h4>
                            <p class="mb-0 text-muted text-sm">
                                {{ $stats['brochure']['formatted']['text'] }}
                                <span class="{{ $stats['brochure']['formatted']['class'] }}">
                                    {{ $stats['brochure']['formatted']['value'] }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Job Vacancies Card -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Job Vacancies</h6>
                            <h4 class="mb-3">{{ number_format($stats['job_vacancies']['total']) }}</h4>
                            <p class="mb-0 text-muted text-sm">
                                Published positions
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Applicants Card -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Applicants</h6>
                            <h4 class="mb-3">{{ number_format($stats['applicants']['total']) }}</h4>
                            <p class="mb-0 text-muted text-sm">
                                {{ $stats['applicants']['formatted']['text'] }}
                                <span class="{{ $stats['applicants']['formatted']['class'] }}">
                                    {{ $stats['applicants']['formatted']['value'] }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Unique Visitor Chart -->
                <div class="col-md-12 col-xl-8">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Website Visitors</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="chart-tab-month-tab" data-bs-toggle="pill"
                                    data-bs-target="#chart-tab-month" type="button" role="tab"
                                    aria-controls="chart-tab-month" aria-selected="false">Month</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="chart-tab-week-tab" data-bs-toggle="pill"
                                    data-bs-target="#chart-tab-week" type="button" role="tab"
                                    aria-controls="chart-tab-week" aria-selected="true">Week</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="chart-tab-tabContent">
                                <!-- Monthly Chart -->
                                <div class="tab-pane" id="chart-tab-month" role="tabpanel"
                                    aria-labelledby="chart-tab-month-tab" tabindex="0">
                                    <div id="visitor-chart-month"></div>
                                </div>
                                <!-- Weekly Chart -->
                                <div class="tab-pane show active" id="chart-tab-week" role="tabpanel"
                                    aria-labelledby="chart-tab-week-tab" tabindex="0">
                                    <div id="visitor-chart-week"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Pages Card -->
                <div class="col-md-12 col-xl-4">
                    <h5 class="mb-3">Top Visited Pages</h5>
                    <div class="card">
                        <div class="list-group list-group-flush">
                            @forelse($stats['top_pages'] as $page)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-grow-1" style="min-width: 0;">
                                            <h6 class="mb-1 text-truncate" title="{{ $page['url'] }}">
                                                {{ Str::limit($page['url'], 30) }}
                                            </h6>
                                            <p class="mb-0 text-muted text-sm">{{ number_format($page['visits']) }} visits</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-center text-muted">
                                    No visitor data available
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Weekly Visitors Chart Data
        const weeklyData = @json($stats['visitors']['weekly']);

        // Monthly Visitors Chart Data
        const monthlyData = @json($stats['visitors']['monthly']);

        // Initialize Weekly Chart
        if (document.querySelector("#visitor-chart-week")) {
            var weekOptions = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Total Visits',
                    data: weeklyData.totals
                }, {
                    name: 'Unique Visitors',
                    data: weeklyData.uniques
                }],
                xaxis: {
                    categories: weeklyData.labels
                },
                colors: ['#4680FF', '#2CA87F'],
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'top'
                }
            };

            var weekChart = new ApexCharts(document.querySelector("#visitor-chart-week"), weekOptions);
            weekChart.render();
        }

        // Initialize Monthly Chart
        if (document.querySelector("#visitor-chart-month")) {
            var monthOptions = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Total Visits',
                    data: monthlyData.totals
                }, {
                    name: 'Unique Visitors',
                    data: monthlyData.uniques
                }],
                xaxis: {
                    categories: monthlyData.labels
                },
                colors: ['#4680FF', '#2CA87F'],
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'top'
                }
            };

            var monthChart = new ApexCharts(document.querySelector("#visitor-chart-month"), monthOptions);
            monthChart.render();
        }
    });
</script>
@endpush