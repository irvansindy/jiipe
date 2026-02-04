@extends('layouts.client.main', ['title' => 'News - JIIPE - Java Integrated Industrial and Ports Estate. Gresik, Indonesia.'])

@section('content')
    @include('layouts.client.blog.sections.breadcrumbs')
    @include('layouts.client.blog.sections.content')
    @include('components.appointment-form')
@endsection