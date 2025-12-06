@extends('layouts.client.main')

@section('title', 'Career - ' . $career->position)

@section('content')
    <!-- Breadcrumb Section -->
    <section class="block-breadcrumbs">
        <div class="prelative container">
            <nav class="t-breadcrumb wow fadeInUp" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('career', app()->getLocale()) }}">{{ __('Career') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Detail') }}</li>
                </ol>
            </nav>
            <div class="clear"></div>
        </div>
    </section>

    <!-- Cover Section -->
    <section id="cover-karir">
        <div class="karir-images"
            style="background-image: url('{{ asset('uploads/career/header/header_career.jpg') }}') !important;">
            <div class="prelative container">
            </div>
        </div>
    </section>

    <!-- Career Detail Section -->
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
                    <div class="blocks_list_careers">
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
                                </div>
                            </div>
                            <hr style="margin-top: 2px; margin-bottom: 0; color: #ccc; padding-bottom: 2px">

                            @if ($career->description)
                                <div class="row lowongan-content">
                                    <div class="col-md-60">
                                        <div class="deskripsi">
                                            <p class="title">{{ __('Job description') }}</p>
                                            <p class="content">{!! nl2br(e($career->description)) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top: 2px; margin-bottom: 0; color: #ccc; padding-bottom: 2px">
                            @endif

                            <div class="clear clearfix"></div>
                        </div>
                    </div>

                    <!-- Career Application Form -->
                    <section id="FormKarir" class="mb-5">
                        <div class="outers_block_form_career my-5">
                            <div class="inners_form" id="block_form_career">
                                <p><strong>{{ __('CAREER FORM') }}</strong></p>
                                <p class="py-1 mb-0">&nbsp;</p>

                                <div class="box-form tl-contact-form careerForm" id="contact-form-ku">
                                    <div class="mw700">
                                        <div class="text-left">
                                            <div class="clear"></div>

                                            @if (session('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <ul class="mb-0">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            <form enctype="multipart/form-data" id="CareerNewForm" class="form-"
                                                action="{{ route('client.career.apply', ['locale' => app()->getLocale(), 'id' => $career->id]) }}"
                                                method="post">
                                                @csrf

                                                <div class="row default">
                                                    <div class="col-md-60 col-sm-60 col-lg-60">
                                                        <div class="form-group form-line">
                                                            <label for="CareerForm_posisi">{{ __('POSITION') }}</label>
                                                            <input class="form-control" required readonly
                                                                value="{{ $career->position }}" name="position"
                                                                id="CareerForm_posisi" type="text">
                                                            <input class="form-control" value="{{ $career->id }}"
                                                                name="career_id" id="CareerForm_posisiID" type="hidden">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-30 col-sm-30">
                                                        <div class="form-group form-line">
                                                            <label
                                                                for="CareerForm_pendidikan">{{ __('Min. Graduates') }}</label>
                                                            <input class="form-control" required readonly
                                                                value="{{ $career->education ? $career->education->name : '-' }}"
                                                                name="education" id="CareerForm_pendidikan"
                                                                type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-30 col-sm-30">
                                                        <div class="form-group form-line">
                                                            <label for="CareerForm_joblevel">{{ __('Job Level') }}</label>
                                                            <input class="form-control" required readonly
                                                                value="{{ $career->jobLevel ? $career->jobLevel->name : '-' }}"
                                                                name="job_level" id="CareerForm_joblevel" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-30 col-sm-30 col-lg-30">
                                                        <div class="form-group form-line">
                                                            <label for="CareerForm_name">{{ __('Name') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control @error('name') is-invalid @enderror"
                                                                required name="name" id="CareerForm_name"
                                                                type="text" value="{{ old('name') }}">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-30 col-sm-30 col-lg-30">
                                                        <div class="form-group form-line">
                                                            <label for="CareerForm_email">{{ __('Email') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                required type="email" name="email"
                                                                id="CareerForm_email" value="{{ old('email') }}">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row default">
                                                    <div class="col-md-30 col-sm-30">
                                                        <div class="form-group form-line">
                                                            <label for="CareerForm_phone">{{ __('No HP') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                required name="phone" id="CareerForm_phone"
                                                                type="text" value="{{ old('phone') }}">
                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-30 col-sm-30">
                                                        <div class="form-group form-line">
                                                            <label for="CareerForm_pengalaman">{{ __('Experience') }}
                                                                <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control @error('experience') is-invalid @enderror"
                                                                required name="experience" id="CareerForm_pengalaman">
                                                                <option value="">-- {{ __('Choose Experience') }} --
                                                                </option>
                                                                <option value="0 Tahun"
                                                                    {{ old('experience') == '0 Tahun' ? 'selected' : '' }}>
                                                                    0 {{ __('Years') }}</option>
                                                                <option value="1-2 Tahun"
                                                                    {{ old('experience') == '1-2 Tahun' ? 'selected' : '' }}>
                                                                    1-2 {{ __('Years') }}</option>
                                                                <option value="3-5 Tahun"
                                                                    {{ old('experience') == '3-5 Tahun' ? 'selected' : '' }}>
                                                                    3-5 {{ __('Years') }}</option>
                                                                <option value="5-10 Tahun"
                                                                    {{ old('experience') == '5-10 Tahun' ? 'selected' : '' }}>
                                                                    5-10 {{ __('Years') }}</option>
                                                                <option value="> 10 Tahun"
                                                                    {{ old('experience') == '> 10 Tahun' ? 'selected' : '' }}>
                                                                    &gt; 10 {{ __('Years') }}</option>
                                                            </select>
                                                            @error('experience')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row default">
                                                    <div class="col-md-30 col-sm-30 col-lg-30">
                                                        <div class="form-group form-line">
                                                            <label
                                                                for="CareerForm_files">{{ __('Upload Curriculum Vitae') }}
                                                                <span class="text-danger">*</span></label>
                                                            <div class="clear height-5"></div>
                                                            <div class="height-2"></div>
                                                            <input
                                                                class="form-control @error('cv_file') is-invalid @enderror"
                                                                required name="cv_file" id="CareerForm_files"
                                                                type="file" accept=".pdf,.jpeg,.jpg,.png">
                                                            <p class="help-block" style="font-size: 11px; color:red;">
                                                                <b>{{ __('Note') }}:</b> {{ __('File Format') }}
                                                                <b>*.pdf, *.jpeg, *.jpg, *.png</b><br>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                {{ __('Max File Size') }} : 2MB
                                                            </p>
                                                            @error('cv_file')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-30 col-sm-30 col-lg-30">
                                                        <div class="form-group form-line">
                                                            <label
                                                                for="CareerForm_files2">{{ __('Upload Supporting Documents') }}</label>
                                                            <div class="clear height-5"></div>
                                                            <div class="height-2"></div>
                                                            <input
                                                                class="form-control @error('support_file') is-invalid @enderror"
                                                                name="support_file" id="CareerForm_files2" type="file"
                                                                accept=".pdf,.jpeg,.jpg,.png">
                                                            <p class="help-block" style="font-size: 11px; color:red;">
                                                                <b>{{ __('Note') }}:</b> {{ __('File Format') }}
                                                                <b>*.pdf, *.jpeg, *.jpg, *.png</b><br>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                {{ __('Max File Size') }} : 2MB
                                                            </p>
                                                            @error('support_file')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-60 col-sm-60 col-lg-60">
                                                        <div class="form-group form-line">
                                                            <label for="CareerForm_body">{{ __('Messages') }}</label>
                                                            <div class="clear"></div>
                                                            <textarea class="form-control @error('message') is-invalid @enderror" rows="3" name="message"
                                                                id="CareerForm_body">{{ old('message') }}</textarea>
                                                            @error('message')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>

                                                    <div class="col-md-60 col-sm-60 col-lg-60">
                                                        <div class="row default">
                                                            <div class="col-md-30 col-sm-30">
                                                                <div class="fright-inpd">
                                                                    <div class="form-group mb-0">
                                                                        <div class="fleft">
                                                                            <div class="g-recaptcha"
                                                                                data-sitekey="{{ config('services.recaptcha.site_key') }}">
                                                                            </div>
                                                                            @error('g-recaptcha-response')
                                                                                <span class="text-danger" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-30 col-sm-30">
                                                                <div class="float-right">
                                                                    <button type="submit"
                                                                        class="btn btn-default btns-submit-bt">{{ __('SUBMIT') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="clear height-20"></div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="py-3"></div>
                    <div class="lines-grey2 mb-5"></div>
                    <div class="py-2"></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="{{ asset('asset/js/jquery-validation/jquery.validate.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // Validate form
                $("#CareerNewForm").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        phone: {
                            required: true,
                            minlength: 10
                        },
                        experience: {
                            required: true
                        },
                        cv_file: {
                            required: true,
                            extension: "pdf|jpeg|jpg|png"
                        },
                        support_file: {
                            extension: "pdf|jpeg|jpg|png"
                        }
                    },
                    messages: {
                        name: {
                            required: "{{ __('Name is required') }}",
                            minlength: "{{ __('Name must be at least 3 characters') }}"
                        },
                        email: {
                            required: "{{ __('Email is required') }}",
                            email: "{{ __('Please enter a valid email') }}"
                        },
                        phone: {
                            required: "{{ __('Phone number is required') }}",
                            minlength: "{{ __('Phone number must be at least 10 digits') }}"
                        },
                        experience: {
                            required: "{{ __('Experience is required') }}"
                        },
                        cv_file: {
                            required: "{{ __('CV file is required') }}",
                            extension: "{{ __('File must be PDF, JPEG, JPG, or PNG') }}"
                        },
                        support_file: {
                            extension: "{{ __('File must be PDF, JPEG, JPG, or PNG') }}"
                        }
                    }
                });

                // Scroll to form if there are errors
                @if ($errors->any())
                    $('html, body').animate({
                        scrollTop: $("#FormKarir").offset().top - 100
                    }, 1000);
                @endif

                // Scroll to form if success
                @if (session('success'))
                    $('html, body').animate({
                        scrollTop: $("#FormKarir").offset().top - 100
                    }, 1000);
                @endif
            });
            // Add loading overlay and submit via AJAX (plain JS)
            (function() {
                var overlayHtml =
                    '<div id="career-loading-overlay" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:99999;align-items:center;justify-content:center;">' +
                    '<div class="spinner-border text-light" role="status" aria-hidden="true" style="width:3rem;height:3rem;"></div></div>';
                // append overlay using plain JS to avoid relying on jQuery
                var body = document.getElementsByTagName('body')[0];
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = overlayHtml;
                body.appendChild(tempDiv.firstChild);

                var form = document.getElementById('CareerNewForm');
                // ensure there is a container for alerts
                var alertContainer = document.getElementById('career-alerts');
                if (!alertContainer) {
                    alertContainer = document.createElement('div');
                    alertContainer.id = 'career-alerts';
                    form.parentNode.insertBefore(alertContainer, form);
                }

                // capturing listener to ensure it runs before any other submit handlers
                form.addEventListener('submit', function(e) {
                    // noop: capture phase binding ensures our handler runs first
                }, true);

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // validate using jQuery validate if available
                    var valid = true;
                    if (window.jQuery && typeof jQuery(form).valid === 'function') {
                        valid = jQuery(form).valid();
                    }
                    if (!valid) {
                        return;
                    }

                    // show overlay and disable submit
                    var overlay = document.getElementById('career-loading-overlay');
                    overlay.style.display = 'flex';
                    var submitButtons = form.querySelectorAll('button[type=submit]');
                    submitButtons.forEach(function(btn) {
                        btn.disabled = true;
                    });
                    alertContainer.innerHTML = '';

                    var formData = new FormData(form);

                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                        }
                    }).then(function(resp) {
                        if (!resp.ok) throw resp;
                        return resp.json();
                    }).then(function(json) {
                        // on success, reload the page so flash message appears
                        window.location.reload();
                    }).catch(function(err) {
                        // hide overlay and re-enable submit
                        var overlay = document.getElementById('career-loading-overlay');
                        overlay.style.display = 'none';
                        submitButtons.forEach(function(btn) {
                            btn.disabled = false;
                        });

                        if (err && err.status === 422) {
                            err.json().then(function(res) {
                                var errors = res.errors || (res.meta && res.meta.message ? {
                                    error: [res.meta.message]
                                } : null);
                                if (errors) {
                                    var div = document.createElement('div');
                                    div.className =
                                    'alert alert-danger alert-dismissible fade show';
                                    var ul = document.createElement('ul');
                                    ul.className = 'mb-0';
                                    Object.keys(errors).forEach(function(k) {
                                        (errors[k] || []).forEach(function(m) {
                                            var li = document.createElement('li');
                                            li.textContent = m;
                                            ul.appendChild(li);
                                        });
                                    });
                                    div.appendChild(ul);
                                    var btn = document.createElement('button');
                                    btn.type = 'button';
                                    btn.className = 'btn-close';
                                    btn.setAttribute('data-bs-dismiss', 'alert');
                                    btn.setAttribute('aria-label', 'Close');
                                    div.appendChild(btn);
                                    alertContainer.appendChild(div);
                                    window.scrollTo({
                                        top: form.getBoundingClientRect().top + window
                                            .scrollY - 100,
                                        behavior: 'smooth'
                                    });
                                    return;
                                }
                            }).catch(function() {});
                        }

                        // generic error
                        var div = document.createElement('div');
                        div.className = 'alert alert-danger alert-dismissible fade show';
                        div.textContent = 'Failed to submit application. Please try again later.';
                        var btnClose = document.createElement('button');
                        btnClose.type = 'button';
                        btnClose.className = 'btn-close';
                        btnClose.setAttribute('data-bs-dismiss', 'alert');
                        btnClose.setAttribute('aria-label', 'Close');
                        div.appendChild(btnClose);
                        alertContainer.appendChild(div);
                    });
                });

                // ensure overlay hidden on load
                window.addEventListener('load', function() {
                    var ov = document.getElementById('career-loading-overlay');
                    if (ov) ov.style.display = 'none';
                });
            })();
        </script>
    @endpush
@endsection
