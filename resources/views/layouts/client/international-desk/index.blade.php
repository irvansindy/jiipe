@extends('layouts.client.main', ['title' => 'International Desk'])

@section('content')
    @include('layouts.client.international-desk.sections.breadcrumbs')
    @include('layouts.client.international-desk.sections.content')
    @include('components.appointment-form')
@endsection