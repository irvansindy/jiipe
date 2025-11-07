@extends('layouts.client.main')

@section('title', 'Career')

@section('content')
<!-- Breadcrumb Section -->
<section class="block-breadcrumbs">
    <div class="prelative container">
        <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Career') }}</li>
            </ol>
        </nav>
        <div class="clear"></div>
    </div>
</section>

<!-- Cover Section -->
<section id="cover-karir">
    <div class="karir-images" style="background-image: url('{{ $careerHeader && $careerHeader->image ? asset('storage/' . $careerHeader->image) : asset('images/default-career-header.jpg') }}') !important;">
        <div class="prelative container">
        </div>
    </div>
</section>

<!-- Career Content Section -->
<section class="karir-sec-1">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="career icon">
                <p class="info">
                    {{ __('Job Vacancies') }}
                </p>
            </div>
            <div class="col-md-45">
                <div class="row karir">
                    <div class="col-md-50">
                        <div class="title pt-1 mt-2 pb-5 mb-4">
                            @if($careerSection && $careerSection->translations->isNotEmpty())
                                {!! $careerSection->translations->first()->title !!}
                            @else
                                <h2>{{ __('Join us and grow your career') }}</h2>
                                <h5>
                                    <p>{{ __('Find your suitable job vacancies and fill out the form.') }}</p>
                                </h5>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row lowongan">
                    <div class="col-md-30">
                        <div class="lowongan-title">
                            <p>{{ __('Available Jobs') }}</p>
                        </div>
                    </div>
                    <div class="col-md-30">
                        <div class="sortir float-md-right">
                            <form class="form-inline" method="GET">
                                <div class="form-group">
                                    <label for="inputState">{{ __('Sort by') }}</label>
                                    <select name="sort" id="inputState" class="form-control" onchange="this.form.submit()">
                                        <option value="date" {{ $sort == 'date' ? 'selected' : '' }}>{{ __('Date') }}</option>
                                        <option value="education" {{ $sort == 'education' ? 'selected' : '' }}>{{ __('Education') }}</option>
                                        <option value="experience" {{ $sort == 'experience' ? 'selected' : '' }}>{{ __('Experience') }}</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <hr class="karir">

                <div class="blocks_list_careers">
                    @forelse($careers as $career)
                    <div class="items">
                        <div class="title-loker">
                            <p>{{ $career->position }}</p>
                        </div>
                        <div class="row lowongan-content">
                            <div class="col-md-30">
                                <div class="job">
                                    <img src="{{ asset('asset/images/brief.png') }}" alt="company icon">
                                    <p>{{ $career->factory ? $career->factory->name : '-' }}</p>
                                </div>
                                <div class="location">
                                    <img src="{{ asset('asset/images/location.png') }}" alt="location icon">
                                    <p>{{ $career->location ? $career->location->name : '-' }}</p>
                                </div>
                                <div class="salary">
                                    <img src="{{ asset('asset/images/salary.png') }}" alt="job level icon">
                                    <p>{{ $career->jobLevel ? $career->jobLevel->name : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-30">
                                <div class="min-pend">
                                    <p class="title">{{ __('Minimum Education') }}</p>
                                    <p class="content">{{ $career->education ? $career->education->name : '-' }}</p>
                                </div>
                                <div class="min-peng">
                                    <p class="title">{{ __('Minimum Experience') }}</p>
                                    <p class="content">{{ $career->min_experience }}</p>
                                </div>
                                <div class="lebih">
                                    <a href="{{ route('client.career.detail', $career->id) }}" class="toscroll">
                                        <p>{{ __('Apply for this position') }} <span><img src="{{ asset('asset/images/arrow-red.png') }}" alt="arrow"></span></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="karir2">
                        <div class="clear clearfix"></div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <p>{{ __('No job vacancies available at the moment.') }}</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <nav aria-label="Career Pagination">
                    {{ $careers->links() }}
                </nav>

                <div class="lines-grey2 mb-5"></div>
                <div class="py-2"></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
        $('.pagination li.selected').addClass('active');
    });
</script>
@endpush
@endsection