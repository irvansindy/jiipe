@extends('layouts.client.main')
@section('content')
<div class="container">
    <div class="text-center my-4">
    <img src="{{ asset('asset/images/thanks.png') }}"
         alt="Success"
         class="img-fluid d-block mx-auto"
         style="max-width: 250px;">

    <h1 class="thank_title mt-1">Thank You For Contacting Us !</h1>
    <p class="thank_subtitle mt-0 mb-5">We Will Get In Touch With You Shortly.</p>
    <a href="{{ route('home') }}" class="thank_btn" style="cursor: pointer;">Back to Home</a>
</div>
</div>
@endsection