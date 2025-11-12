{{-- <section class="industri_jippe1-sec-5">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="{{ asset('asset/images/beijing-red.png') }}" alt="{{ __('JIIPE Industrial Estate Gresik') }}">
                <p class="info">
                    {{ __('Efficiency of Business Opening in JIIPE Gresik Industrial Area') }}
                </p>
            </div>

            <div class="col-md-45">
                <div class="row">
                    @foreach ($area['business_efficiency'] ?? [] as $efficiency)
                        <div class="col-md-20">
                            <img src="{{ $efficiency['icon'] ?? '' }}" alt="{{ $efficiency['title'] ?? '' }}"
                                style="margin-top:40px">
                            <div class="judul">
                                <p>{{ $efficiency['title'] ?? '' }}</p>
                            </div>
                            <div class="content">
                                {!! $efficiency['description'] ?? '' !!}
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr class="artikel-berita">
            </div>
        </div>
    </div>
</section> --}}
<section class="industri_jiipe1-sec-5">
    <div class="prelative container">
        <div class="row">
            <div class="col-md-15">
                <img src="/asset/images/beijing-red.png" alt="kawasan industri gresik jiipe">
                <p class="info">
                    Kemudahan Berbisnis di Kawasan Industri JIIPE Gresik </p>
            </div>
            <div class="col-md-45">
                <div class="row">
                    <div class="col-md-20">
                        <img src="/images/kawasan/.tmb/thumb_28cad-timer_adaptiveResize_59_59.png"
                            alt="Layanan Perijinan Terpadu" style="margin-top:40px">
                        <div class="judul">
                            <p>Layanan Perijinan Terpadu</p>
                        </div>
                        <div class="content">
                            <p>
                                Pelayanan terpadu disediakan oleh Badan Koordinasi Penanaman Modal Pusat dan Daerah
                                untuk pengurusan dokumen yang dibutuhkan dalam proses investasi. JIIPE menjembatani
                                investor dengan pemerintah setempat untuk kebutuhan perijinannya.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-20">
                        <img src="/images/kawasan/.tmb/thumb_cf65c-repeat_adaptiveResize_59_59.png"
                            alt="Ijin Konstruksi Langsung" style="margin-top:40px">
                        <div class="judul">
                            <p>Ijin Konstruksi Langsung</p>
                        </div>
                        <div class="content">
                            <p>
                                Perusahaan industri dapat langsung membangun setelah rancang gambar disetujui oleh
                                Kawasan, sembari mengurus Ijin Mendirikan Bangunan dengan adanya fasilitas KLIK
                                (Kemudahan Langsung Ijin Konstruksi) dari Badan Koordinasi Penanaman Modal.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-20">
                        <img src="/images/kawasan/.tmb/thumb_ae33b-icn-3_adaptiveResize_59_59.png" alt="Zona Industri"
                            style="margin-top:40px">
                        <div class="judul">
                            <p>Zona Industri</p>
                        </div>
                        <div class="content">
                            <ul>
                                <li>Zona Manufaktur</li>
                                <li>Zona Pergudangan</li>
                                <li>Pusat Logistik</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="artikel-berita">
            </div>
        </div>
    </div>
</section>
