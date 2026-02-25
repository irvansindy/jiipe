<!-- Modal: Create / Edit Area ShowCase -->
<div class="modal fade" id="ModalAreaShowCase" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="ModalAreaShowCaseLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ModalAreaShowCaseLabel">Area ShowCase</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form method="post" id="area_show_case_form" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    @php
                        $supportedLocales = array_keys(config('laravellocalization.supportedLocales'));
                        $locales = \App\Models\Language::whereIn('locale', $supportedLocales)->get()->keyBy('locale');
                    @endphp

                    <input type="hidden" name="id" id="area_show_case_id" value="">

                    {{-- Image Upload --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Image</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">

                                {{-- Desktop Image --}}
                                <div class="col-md-6">
                                    <label for="area_show_case_image" class="form-label">
                                        Image (Desktop) <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="area_show_case_image" name="image"
                                        accept="image/jpg,image/jpeg,image/png,image/webp">
                                    <div class="form-text">JPG, JPEG, PNG, WEBP &mdash; Max: 2MB</div>
                                    <span class="text-danger" id="message_image"></span>
                                    <div id="current_area_show_case_image" class="mt-3"></div>
                                </div>

                                {{-- Mobile Image --}}
                                <div class="col-md-6">
                                    <label for="area_show_case_image_mobile" class="form-label">
                                        Image (Mobile / Small Screen)
                                        <span class="text-muted small">&mdash; optional, falls back to desktop image</span>
                                    </label>
                                    <input type="file" class="form-control" id="area_show_case_image_mobile"
                                        name="image_mobile"
                                        accept="image/jpg,image/jpeg,image/png,image/webp">
                                    <div class="form-text">JPG, JPEG, PNG, WEBP &mdash; Max: 2MB</div>
                                    <span class="text-danger" id="message_image_mobile"></span>
                                    <div id="current_area_show_case_image_mobile" class="mt-3"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Settings --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Settings</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="area_show_case_position" class="form-label">Display Position</label>
                                    <input type="number" class="form-control" id="area_show_case_position"
                                        name="position" min="0" value="0"
                                        placeholder="e.g. 1 (lower = displayed first)">
                                    <span class="text-danger" id="message_position"></span>
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="area_show_case_is_active"
                                            name="is_active" value="1" checked>
                                        <label class="form-check-label" for="area_show_case_is_active">
                                            <strong>Published</strong>
                                            <small class="text-muted d-block">Enable this item to show on the page</small>
                                        </label>
                                    </div>
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
                            <ul class="nav nav-tabs mb-3" id="areaShowCaseTab" role="tablist">
                                @foreach ($locales as $locale => $properties)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="area-show-case-{{ $locale }}-tab" data-bs-toggle="tab"
                                            data-bs-target="#area-show-case-{{ $locale }}" type="button" role="tab"
                                            aria-controls="area-show-case-{{ $locale }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <img src="{{ asset('uploads/flags/' . $properties['flag']) }}"
                                                alt="{{ $locale }}"
                                                style="width: 24px; height: 24px; border: 1px solid #ddd; border-radius: 4px;">
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach ($locales as $locale => $properties)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                        id="area-show-case-{{ $locale }}" role="tabpanel"
                                        aria-labelledby="area-show-case-{{ $locale }}-tab">

                                        {{-- Title --}}
                                        <div class="mb-3">
                                            <label for="area_show_case_title_{{ $locale }}" class="form-label">
                                                Title ({{ $properties['native'] }}) <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control"
                                                id="area_show_case_title_{{ $locale }}"
                                                name="title[{{ $locale }}]"
                                                placeholder="Enter title in {{ $properties['native'] }}">
                                            <span class="text-danger" id="message_title_{{ $locale }}"></span>
                                        </div>

                                        {{-- Description --}}
                                        <div class="mb-3">
                                            <label for="area_show_case_description_{{ $locale }}" class="form-label">
                                                Description ({{ $properties['native'] }}) <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control area_show_case_description"
                                                id="area_show_case_description_{{ $locale }}"
                                                name="description[{{ $locale }}]" rows="5"
                                                placeholder="Enter description in {{ $properties['native'] }}"></textarea>
                                            <span class="text-danger" id="message_description_{{ $locale }}"></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x me-1"></i> Cancel
                    </button>
                    <button type="submit" id="action_area_show_case" class="btn btn-primary">
                        <span class="btn-text"><i class="ti ti-device-floppy me-1"></i> Save</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Loading Overlay --}}
<div id="loadingOverlayAreaShowCase" style="display: none;">
    <div class="spinner"></div>
</div>

<style>
    #loadingOverlayAreaShowCase {
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

    #loadingOverlayAreaShowCase .spinner {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>