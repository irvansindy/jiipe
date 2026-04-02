<div class="modal fade" id="modalGallery" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalGalleryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="modalGalleryLabel"></h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            @php
                $locale = app()->getLocale();
            @endphp
            <form action="" class="form_gallery" id="form_gallery">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="gallery_topic" class="form-label">Topic <span class="text-danger">*</span></label>
                        <select name="gallery_topic" id="gallery_topic" class="form-select" required>
                            <option value="">-- Select Topic --</option>
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
                        <span class="text-danger small" id="message_gallery_topic"></span>
                    </div>

                    <div class="mb-3">
                        <label for="gallery_video_url" class="form-label">Video URL</label>
                        <input type="url" class="form-control" name="gallery_video_url" id="gallery_video_url"
                            placeholder="https://youtube.com/watch?v=...">
                        <span class="text-danger small" id="message_gallery_video_url"></span>
                    </div>

                    <div class="mb-3">
                        <label for="gallery_main_image" class="form-label">Main Image <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="gallery_main_image" id="gallery_main_image"
                            accept="image/*" required>
                        <small class="text-muted">Recommended size: 1024 x 618 px. Max 2MB</small>
                        <span class="text-danger small d-block" id="message_gallery_main_image"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gallery_status" id="status_1"
                                value="1" checked>
                            <label class="form-check-label" for="status_1">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gallery_status" id="status_0"
                                value="0">
                            <label class="form-check-label" for="status_0">Inactive</label>
                        </div>
                        <br>
                        <span class="text-danger small" id="message_gallery_status"></span>
                    </div>

                    @php
                        $supportedLocales = array_keys(config('laravellocalization.supportedLocales'));

                        $locales = \App\Models\Language::whereIn('locale', $supportedLocales)->get()->keyBy('locale');
                    @endphp
                    <div class="mb-3">
                        <label class="form-label">Translations <span class="text-danger">*</span></label>
                        <ul class="nav nav-tabs" id="formGalleryTab" role="tablist">
                            @foreach ($locales as $locale => $properties)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($loop->first) active @endif"
                                        id="tab-gallery-{{ $locale }}" data-bs-toggle="tab"
                                        data-bs-target="#gallery-{{ $locale }}" type="button" role="tab"
                                        aria-controls="gallery-{{ $locale }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <img src="{{ asset('uploads/flags/' . $properties['flag']) }}"
                                            alt="{{ $locale }}"
                                            style="width: 24px; height: 24px; border: 1px solid #ddd; border-radius: 4px;">
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
                                        <label for="news_title_{{ $locale }}" class="form-label">
                                            Title ({{ strtoupper($locale) }})
                                        </label>
                                        <input type="text" class="form-control"
                                            name="news_title[{{ $locale }}]"
                                            id="news_title_{{ $locale }}"
                                            placeholder="Gallery title in {{ strtoupper($locale) }}">
                                        <span class="text-danger small"
                                            id="message_news_title_{{ $locale }}"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="card border-primary">
                            <div
                                class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                                <span><i class="ti ti-photo"></i> Additional Images</span>
                                <button type="button" id="addImage" class="btn btn-light btn-sm">
                                    <i class="ti ti-plus"></i> Add Image
                                </button>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted mb-3">
                                    <strong>Note:</strong> Images will be resized to 450 x 450 px. Max 2MB per image.
                                </p>

                                <!-- Container for file upload inputs -->
                                <div id="imageFields" class="row g-3">
                                    <div class="col-12 col-md-6 image-item">
                                        <div class="input-group">
                                            <input type="file" name="gallery_image_detail[]" class="form-control"
                                                accept="image/*">
                                            <button class="btn btn-outline-danger remove-field" type="button">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_gallery">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit_gallery">
                        <i class="ti ti-device-floppy"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="modalLoader"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; display: none;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
        <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="text-white mt-3">Processing...</p>
    </div>
</div>

<style>
    .image-item {
        transition: all 0.3s ease;
    }

    .image-item:hover {
        transform: translateY(-2px);
    }
</style>
