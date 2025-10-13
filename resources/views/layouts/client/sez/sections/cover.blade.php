{{-- <section class="cover-industri_jippe1 no_background">
    <img src="{{ asset($data['sezPages'][0]['thumbnail']) }}" alt="{{ $page['title'] ?? '' }}" class="img img-fluid w-100"
        loading="lazy" decoding="async">

</section>

@push('css')
    <style>
        .cover-industri_jippe1.no_background {
            background: none;
            height: auto;
        }
    </style>
@endpush --}}

<section class="cover-industri_jippe1 no_background">
    <img id="dynamic-cover-image"
        src="{{ asset($data['sezPages'][0]['thumbnail'] ?? 'asset/images/default-cover.jpg') }}"
        alt="{{ $data['sezPages'][0]['title'] ?? 'SEZ Gresik JIIPE' }}"
        class="img img-fluid w-100"
        loading="lazy"
        decoding="async">
</section>

@push('css')
    <style>
        .cover-industri_jippe1.no_background {
            background: none;
            height: auto;
        }

        #dynamic-cover-image {
            transition: opacity 0.3s ease-in-out;
        }

        #dynamic-cover-image.fade-out {
            opacity: 0.3;
        }
    </style>
@endpush