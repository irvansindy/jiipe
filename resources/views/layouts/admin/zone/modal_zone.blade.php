<!-- Modal: Create / Edit Zone -->
<div class="modal fade" id="modalZone" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalZoneLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalZoneLabel">Zone</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form method="post" id="zone_form" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp

                    <input type="hidden" name="id" id="zone_id" value="">

                    {{-- Zone Class & Image Section --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Basic Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- Zone Class --}}
                                <div class="col-md-6 mb-3">
                                    <label for="zone_class" class="form-label">
                                        Zone Class <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="zone_class" name="zone_class" required>
                                        <option value="">-- Select Zone Class --</option>
                                    </select>
                                    <span class="text-danger" id="message_zone_class"></span>
                                </div>

                                {{-- Zone Image --}}
                                <div class="col-md-6 mb-3">
                                    <label for="zone_image" class="form-label">
                                        Zone Image
                                    </label>
                                    <input type="file" class="form-control" id="zone_image" name="zone_image"
                                        accept="image/jpeg,image/png,image/jpg,image/webp">
                                    <div class="form-text">
                                        Supported formats: JPG, PNG, WEBP (Max: 5MB)
                                    </div>
                                    <span class="text-danger" id="message_zone_image"></span>
                                </div>

                                {{-- Image Preview --}}
                                <div class="col-md-12">
                                    <div id="current_zone_image"></div>
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
                            <ul class="nav nav-tabs mb-3" id="zoneFormTab" role="tablist">
                                @foreach ($locales as $locale => $properties)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="zone-form-{{ $locale }}-tab" data-bs-toggle="tab"
                                            data-bs-target="#zone-form-{{ $locale }}" type="button"
                                            role="tab" aria-controls="zone-form-{{ $locale }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <img src="{{ asset('flags/' . $locale . '.png') }}"
                                                alt="{{ $locale }}" style="width: 20px; margin-right: 5px;"
                                                onerror="this.style.display='none'">
                                            {{ $properties['native'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach ($locales as $locale => $properties)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                        id="zone-form-{{ $locale }}" role="tabpanel"
                                        aria-labelledby="zone-form-{{ $locale }}-tab">

                                        {{-- Zone Name --}}
                                        <div class="mb-3">
                                            <label for="zone_name_{{ $locale }}" class="form-label">
                                                Zone Name ({{ $properties['native'] }}) <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control"
                                                id="zone_name_{{ $locale }}"
                                                name="zone_name[{{ $locale }}]"
                                                placeholder="Enter zone name in {{ $properties['native'] }}" required>
                                            <span class="text-danger"
                                                id="message_zone_name_{{ $locale }}"></span>
                                        </div>

                                        {{-- Zone Subtitle --}}
                                        <div class="mb-3">
                                            <label for="zone_subtitle_{{ $locale }}" class="form-label">
                                                Subtitle ({{ $properties['native'] }})
                                            </label>
                                            <input type="text" class="form-control"
                                                id="zone_subtitle_{{ $locale }}"
                                                name="zone_subtitle[{{ $locale }}]"
                                                placeholder="Enter subtitle in {{ $properties['native'] }}">
                                            <span class="text-danger"
                                                id="message_zone_subtitle_{{ $locale }}"></span>
                                        </div>

                                        {{-- Zone Description --}}
                                        <div class="mb-3">
                                            <label for="zone_description_{{ $locale }}" class="form-label">
                                                Description ({{ $properties['native'] }}) <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control zone_description" id="zone_description_{{ $locale }}"
                                                name="zone_description[{{ $locale }}]" rows="5"
                                                placeholder="Enter description in {{ $properties['native'] }}"></textarea>
                                            <span class="text-danger"
                                                id="message_zone_description_{{ $locale }}"></span>
                                        </div>

                                        {{-- Zone Note --}}
                                        <div class="mb-3">
                                            <label for="zone_note_{{ $locale }}" class="form-label">
                                                Note ({{ $properties['native'] }})
                                            </label>
                                            <textarea class="form-control" id="zone_note_{{ $locale }}" name="zone_note[{{ $locale }}]"
                                                rows="3" placeholder="Enter additional notes in {{ $properties['native'] }}"></textarea>
                                            <span class="text-danger"
                                                id="message_zone_note_{{ $locale }}"></span>
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
                    <button type="submit" id="action_zone" class="btn btn-primary">
                        <span class="btn-text"><i class="ti ti-device-floppy me-1"></i> Save</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Loading Overlay --}}
<div id="loadingOverlayZone" style="display: none;">
    <div class="spinner"></div>
</div>

<style>
#loadingOverlayZone {
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

#loadingOverlayZone .spinner {
    border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-top: 5px solid #3498db;
    width: 60px;
    height: 60px;
    animation: spinZone 1s linear infinite;
}

@keyframes spinZone {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>