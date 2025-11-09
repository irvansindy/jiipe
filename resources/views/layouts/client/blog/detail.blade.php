@extends('layouts.client.main', ['title' => $data['title']])

@section('content')
    @include('layouts.client.blog.sections.breadcrumbs-detail')
    @include('layouts.client.blog.sections.content-detail')
    @include('components.appointment-form')
@endsection