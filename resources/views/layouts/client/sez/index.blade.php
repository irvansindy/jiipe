@extends('layouts.client.main', ['title' => 'Special Economic Zone (SEZ)'])
@section('content')
    @include('layouts.client.sez.sections.breadcrumbs')
    @include('layouts.client.sez.sections.cover')
    @include('layouts.client.sez.sections.content')
    @include('components.appointment-form')
@endsection