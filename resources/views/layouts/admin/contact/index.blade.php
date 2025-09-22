@extends('layouts.admin.main', ['title' => 'Contact Management'])
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10 text-primary">Contact</h5>
                            </div>
                            <br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Contact</li>
                                <li class="breadcrumb-item" aria-current="page">Contact Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $locales = config('laravellocalization.supportedLocales');
            @endphp
            <div class="row">
            </div>
        </div>
    </div>
@endsection