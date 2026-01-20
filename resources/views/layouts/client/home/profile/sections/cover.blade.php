<section class="cover-profil">
    <img src="{{ asset('uploads/about-us/header/' . $aboutUsHeader->image ?? '') }}" decoding="async" loading="lazy"
        alt="Cover Industri" class="cover-image" />

    <div class="prelative container">
        <div class="row"></div>
    </div>
</section>
<style>
    .cover-profil {
        position: relative;
        width: 100%;
        height: 100vh; /* full tinggi layar */
        overflow: hidden;
    }

    .cover-profil .cover-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* biar nggak gepeng */
        object-position: center;
        display: block;
    }

</style>