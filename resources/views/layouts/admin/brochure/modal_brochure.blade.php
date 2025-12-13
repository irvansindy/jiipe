{{-- Loading Overlay --}}
<div id="loadingOverlayBrochure"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
     background: rgba(0,0,0,0.7); z-index: 9999; align-items: center; justify-content: center;">
    <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

{{-- Modal Brochure --}}
<div class="modal fade" id="modalBrochure" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalBrochureLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBrochureLabel">Add Brochure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formBrochure" enctype="multipart/form-data">
                <input type="hidden" id="brochure_id" name="brochure_id">
                <div class="modal-body">
                    {{-- Cover Image --}}
                    <div class="mb-3">
                        <label for="brochure_image" class="form-label">
                            Cover Image <span class="text-danger">*</span>
                            <small class="text-muted">(Max 2MB, PNG/WebP)</small>
                        </label>
                        <input type="file" class="form-control" id="brochure_image" name="image"
                            accept="image/png,image/webp">

                        <small class="text-danger" id="error_brochure_image"></small>

                        {{-- Image Preview --}}
                        <div id="preview_brochure_image" class="mt-2"></div>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="status_active"
                                value="1" checked>
                            <label class="form-check-label" for="status_active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="status_inactive"
                                value="0">
                            <label class="form-check-label" for="status_inactive">Inactive</label>
                        </div>
                        <br><small class="text-danger" id="error_brochure_is_active"></small>
                    </div>

                    <hr>

                    {{-- Translation Tabs --}}
                    <ul class="nav nav-tabs mb-3" id="brochureTransTab" role="tablist">
                        @foreach (config('laravellocalization.supportedLocales') as $locale => $properties)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="brochure-tab-{{ $locale }}" data-bs-toggle="tab"
                                    data-bs-target="#brochure-content-{{ $locale }}" type="button" role="tab"
                                    aria-controls="brochure-content-{{ $locale }}">
                                    {{ $properties['native'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach (config('laravellocalization.supportedLocales') as $locale => $properties)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="brochure-content-{{ $locale }}" role="tabpanel"
                                aria-labelledby="brochure-tab-{{ $locale }}">

                                <div class="mb-3">
                                    <label for="brochure_title_{{ $locale }}" class="form-label">
                                        Title ({{ $properties['native'] }}) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="brochure_title_{{ $locale }}"
                                        name="title[{{ $locale }}]" placeholder="Enter brochure title" required>
                                    <small class="text-danger" id="error_brochure_title_{{ $locale }}"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="brochure_subtitle_{{ $locale }}" class="form-label">
                                        Subtitle ({{ $properties['native'] }})
                                    </label>
                                    <input type="text" class="form-control"
                                        id="brochure_subtitle_{{ $locale }}"
                                        name="subtitle[{{ $locale }}]" placeholder="Enter brochure subtitle">
                                    <small class="text-danger"
                                        id="error_brochure_subtitle_{{ $locale }}"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="brochure_file_{{ $locale }}" class="form-label">
                                        PDF File ({{ $properties['native'] }})
                                        <small class="text-muted">(Max 5MB)</small>
                                    </label>
                                    <input type="file" class="form-control brochure-pdf-input"
                                        id="brochure_file_{{ $locale }}" name="file[{{ $locale }}]"
                                        accept="application/pdf" data-locale="{{ $locale }}">
                                    <small class="text-danger" id="error_brochure_file_{{ $locale }}"></small>

                                    {{-- PDF Preview --}}
                                    <div id="preview_brochure_file_{{ $locale }}" class="mt-2"></div>

                                    {{-- Current file indicator --}}
                                    <div id="current_file_{{ $locale }}" class="mt-2"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveBrochure">
                        <i class="ti ti-device-floppy me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>