@extends('layouts.client.main')

@section('content')
    @include('layouts.client.industrial-estate.sections.breadcrumbs')
    @include('layouts.client.industrial-estate.sections.cover')
    @include('layouts.client.industrial-estate.sections.introduction')
    @include('components.appointment-form')
@endsection
