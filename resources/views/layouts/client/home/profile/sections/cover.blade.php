<section class="cover-profil">
    @php
        // dd($aboutUsHeader);
    @endphp
    <img src="{{ asset('uploads/about-us/header/' . $aboutUsHeader->image ?? '') }}" decoding="async" loading="lazy"
        alt="Cover Industri" class="cover-image" />

    <div class="prelative container">
        <div class="row"></div>
    </div>
</section>
