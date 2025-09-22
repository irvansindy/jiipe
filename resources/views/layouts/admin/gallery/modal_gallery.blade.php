<div class="modal fade" id="modalGallery" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalGalleryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalGalleryLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @php
                $locale = app()->getLocale();
            @endphp
            <form action="" class="form_gallery" id="form_gallery">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="gallery_topic">Topic</label>
                        <select name="gallery_topic" id="gallery_topic" class="form-control">
                            @foreach (\App\Models\Topic::with([
                                'translations' => function ($query) use ($locale) {
                                    $query->where('locale', $locale);
                                },
                            ])->get() as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->translations->first()->name ?? 'No Translation' }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="message_gallery_topic"></span>
                    </div>
                    <div class="mb-3">
                        <label for="gallery_video_url">Url Video</label>
                        <input type="text" class="form-control" name="gallery_video_url" id="gallery_video_url"
                            required>
                        <span class="text-danger" id="message_gallery_video_url"></span>
                    </div>
                    <div class="mb-3">
                        <label for="gallery_main_image">Main Image</label>
                        <input type="file" class="form-control" name="gallery_main_image" id="gallery_main_image"
                            required>
                        <span class="text-danger" id="message_gallery_main_image"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gallery_status" id="status_1"
                                value="1">
                            <label class="form-check-label" for="status_1">Ditampilkan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gallery_status" id="status_0"
                                value="0">
                            <label class="form-check-label" for="status_0">Sembunyikan</label>
                        </div>
                        <br>
                        <span class="text-danger" id="message_gallery_status"></span>
                    </div>
                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp
                    <div class="mb-3">
                        <ul class="nav nav-tabs" id="formGalleryTab" role="tablist">
                            @foreach ($locales as $locale => $properties)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($loop->first) active @endif"
                                        id="tab-gallery-{{ $locale }}" data-bs-toggle="tab"
                                        data-bs-target="#gallery-{{ $locale }}" type="button" role="tab"
                                        aria-controls="gallery-{{ $locale }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ strtoupper($properties['native'] . ' - ' . $locale) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content border border-top-0 p-3">
                            @foreach ($locales as $locale => $properties)
                                <div class="tab-pane fade @if ($loop->first) show active @endif"
                                    id="gallery-{{ $locale }}" role="tabpanel"
                                    aria-labelledby="tab-gallery-{{ $locale }}">

                                    <div class="mb-3">
                                        <label for="news_title_{{ $locale }}">Title
                                            ({{ strtoupper($locale) }})
                                        </label>
                                        <input type="text" class="form-control"
                                            name="news_title[{{ $locale }}]"
                                            id="news_title_{{ $locale }}"
                                            placeholder="News Name ({{ strtoupper($locale) }})">
                                        <span class="text-danger"
                                            id="message_news_title_{{ $locale }}"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                                <span>Gambar Tambahan</span>
                                <button type="button" id="addImage" class="btn btn-light btn-sm">
                                    <i class="bi bi-plus"></i> Tambah Gambar
                                </button>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted mb-3">
                                    <strong>Note:</strong> Ukuran gambar 450 x 450 px. Gambar lebih besar akan ter-crop otomatis.
                                </p>

                                <!-- container form upload -->
                                <div id="imageFields" class="row g-3">
                                    <!-- 1 field awal -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_gallery">
                    
                </div>
            </form>
        </div>
    </div>
</div>
