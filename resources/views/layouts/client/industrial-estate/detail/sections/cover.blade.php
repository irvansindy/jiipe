<section class="cover-industri_jippe1">
    <img src="{{ asset('uploads/zones/cover/'.$zone['image_cover'] ?? '') }}" decoding="async" loading="lazy" alt="Cover Industri" class="cover-image" />

    <div class="prelative container">
        <div class="row"></div>
    </div>
</section>
<style>
    .cover-industri_jippe1 {
        position: relative;
        overflow: hidden;
        min-height: 400px;
        /* sesuaikan */
        background-color: #f0f0f0;
        /* warna placeholder biar nggak blank */
    }

    .cover-industri_jippe1 .cover-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* agar seperti background cover */
        z-index: 0;
    }

    .cover-industri_jippe1 .prelative.container {
        position: relative;
        z-index: 1;
        /* isi tetap di atas gambar */
    }
</style>
