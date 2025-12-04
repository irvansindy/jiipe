<!-- Modal: Create / Edit Home Slider -->
<div class="modal fade" id="ModalSlider" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalSliderLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ModalSliderLabel">Slider</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form method="post" id="slider_form" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp

                    <input type="hidden" name="id" id="slider_id" value="">

                    {{-- File Upload Section --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Media File</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="slider_file" class="form-label">
                                        Upload Image or Video <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="slider_file" name="slider_file"
                                        accept="image/jpeg,image/png,image/jpg,image/webp,video/mp4,video/ogg,video/webm">
                                    <div class="form-text">
                                        Supported formats: JPG, PNG, WEBP, MP4, OGG, WEBM (Max: 20MB)
                                    </div>
                                    <span class="text-danger" id="message_slider_file"></span>

                                    {{-- Current Image Preview --}}
                                    <div id="current_image" class="mt-3"></div>

                                    {{-- Current Video Preview --}}
                                    <div id="current_video" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Translation Tabs --}}
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Content (Multi-language)</h6>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="sliderTab" role="tablist">
                                @foreach ($locales as $locale => $properties)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="slider-{{ $locale }}-tab" data-bs-toggle="tab"
                                            data-bs-target="#slider-{{ $locale }}" type="button" role="tab"
                                            aria-controls="slider-{{ $locale }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            
                                            {{ $properties['native'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach ($locales as $locale => $properties)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                        id="slider-{{ $locale }}" role="tabpanel"
                                        aria-labelledby="slider-{{ $locale }}-tab">

                                        {{-- Title --}}
                                        <div class="mb-3">
                                            <label for="slider_title_{{ $locale }}" class="form-label">
                                                Title ({{ $properties['native'] }}) <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control"
                                                id="slider_title_{{ $locale }}"
                                                name="title[{{ $locale }}]"
                                                placeholder="Enter title in {{ $properties['native'] }}">
                                            <span class="text-danger" id="message_title_{{ $locale }}"></span>
                                        </div>

                                        {{-- Description --}}
                                        <div class="mb-3">
                                            <label for="slider_description_{{ $locale }}" class="form-label">
                                                Description ({{ $properties['native'] }}) <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control slider_description" id="slider_description_{{ $locale }}"
                                                name="description[{{ $locale }}]" rows="5"
                                                placeholder="Enter description in {{ $properties['native'] }}"></textarea>
                                            <span class="text-danger"
                                                id="message_description_{{ $locale }}"></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Status Toggle --}}
                            <div class="mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" checked>
                                    <label class="form-check-label" for="is_active">
                                        <strong>Published</strong>
                                        <small class="text-muted d-block">Enable this slider to show on
                                            homepage</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x me-1"></i> Cancel
                    </button>
                    <button type="submit" id="action_slider" class="btn btn-primary">
                        <span class="btn-text"><i class="ti ti-device-floppy me-1"></i> Save</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Loading Overlay --}}
<div id="loadingOverlaySlider" style="display: none;">
    <div class="spinner"></div>
</div>

<style>
    #loadingOverlaySlider {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loadingOverlaySlider .spinner {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
