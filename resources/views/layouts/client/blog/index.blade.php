@extends('layouts.client.main', ['title' => 'News - JIIPE - Java Integrated Industrial and Ports Estate. Gresik, Indonesia.'])

@section('content')
    @include('layouts.client.blog.sections.breadcrumbs')
    @include('layouts.client.blog.sections.content')
    @include('components.appointment-form')
@endsection
@push('css')
<style>
.lebih p {
    display: inline-flex !important;
    align-items: center !important;
    margin: 0 !important;
    vertical-align: middle !important;
}

.lebih p span {
    display: inline-flex !important;
    align-items: center !important;
    margin-left: 8px;
    line-height: 1 !important;
    vertical-align: middle !important;
}

.lebih p span img {
    display: block !important;
    margin: 0 !important;
    padding: 0 !important;
    vertical-align: middle !important;
    max-height: 1em;
}
</style>
@endpush