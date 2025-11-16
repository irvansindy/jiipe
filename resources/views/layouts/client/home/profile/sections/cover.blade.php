<section class="cover-profil">
    @php
        // dd($aboutUsHeader);
    @endphp
    <img src="{{ asset('storage/about_us/cover/' . $aboutUsHeader->image ?? '') }}" decoding="async" loading="lazy"
        alt="Cover Industri" class="cover-image" />

    <div class="prelative container">
        <div class="row"></div>
    </div>
</section>
