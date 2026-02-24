{{-- Modal List Regional Advantages --}}
<div class="modal fade" id="modalListRegionalAdvantages" tabindex="-1" aria-labelledby="modalListRegionalAdvantagesLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalListRegionalAdvantagesLabel">Regional Advantages</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Zone: <span id="selected_zone_name_adv" class="text-primary fw-bold"></span></h6>
                    <button type="button" class="btn btn-sm btn-primary" id="btnAddAdvantage">
                        <i class="ti ti-plus me-1"></i> Add Advantage
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="tableRegionalAdvantages" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="10%">IMAGE</th>
                                <th width="10%">ICON</th>
                                <th width="20%">NAME</th>
                                <th width="35%">DESCRIPTION</th>
                                <th width="5%">ORDER</th>
                                <th width="15%" class="text-end">ACTION</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@php
    $supportedLocales = array_keys(config('laravellocalization.supportedLocales'));

    $locales = \App\Models\Language::whereIn('locale', $supportedLocales)->get()->keyBy('locale');
@endphp
{{-- Modal Regional Advantage Form (Add/Edit) --}}
<div class="modal fade" id="modalRegionalAdvantage" tabindex="-1" aria-labelledby="modalRegionalAdvantageLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegionalAdvantageLabel">Add Regional Advantage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formRegionalAdvantage" enctype="multipart/form-data">
                <input type="hidden" id="advantage_id" name="advantage_id">
                <input type="hidden" id="advantage_zone_id" name="zone_id">
                <div class="modal-body">
                    {{-- Media Upload Section --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="advantage_image" class="form-label">
                                Image <span class="text-danger">*</span>
                                <small class="text-muted">(Max 2MB, JPG/PNG/WebP)</small>
                            </label>
                            <input type="file" class="form-control" id="advantage_image" name="image"
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp">
                            <small class="text-danger" id="error_advantage_image"></small>

                            {{-- Image Preview --}}
                            <div id="preview_advantage_image" class="mt-2"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="advantage_icon" class="form-label">
                                Icon
                                <small class="text-muted">(Max 1MB, JPG/PNG/WebP)</small>
                            </label>
                            <input type="file" class="form-control" id="advantage_icon" name="icon"
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp">
                            <small class="text-danger" id="error_advantage_icon"></small>

                            {{-- Icon Preview --}}
                            <div id="preview_advantage_icon" class="mt-2"></div>
                        </div>
                    </div>

                    {{-- Order Field --}}
                    <div class="mb-3">
                        <label for="advantage_order" class="form-label">
                            Display Order <small class="text-muted">(Lower numbers appear first)</small>
                        </label>
                        <input type="number" class="form-control" id="advantage_order" name="order"
                               placeholder="0" min="0" value="0">
                        <small class="text-danger" id="error_advantage_order"></small>
                    </div>

                    <hr>

                    {{-- Translation Tabs --}}
                    <ul class="nav nav-tabs mb-3" id="advantageTransTab" role="tablist">
                        @foreach ($locales as $locale => $properties)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="advantage-tab-{{ $locale }}" data-bs-toggle="tab"
                                    data-bs-target="#advantage-content-{{ $locale }}" type="button" role="tab"
                                    aria-controls="advantage-content-{{ $locale }}">
                                    <img src="{{ asset('uploads/flags/' . $properties['flag']) }}" alt="{{ $locale }}" style="width: 24px; height: 24px; border: 1px solid #ddd; border-radius: 4px;">
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach ($locales as $locale => $properties)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="advantage-content-{{ $locale }}" role="tabpanel"
                                aria-labelledby="advantage-tab-{{ $locale }}">

                                <div class="mb-3">
                                    <label for="advantage_name_{{ $locale }}" class="form-label">
                                        Name ({{ $properties['native'] }}) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="advantage_name_{{ $locale }}"
                                        name="name[{{ $locale }}]" placeholder="Enter advantage name" required>
                                    <small class="text-danger" id="error_advantage_name_{{ $locale }}"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="advantage_description_{{ $locale }}" class="form-label">
                                        Description ({{ $properties['native'] }})
                                    </label>
                                    <textarea class="form-control summernote-advantage"
                                        id="advantage_description_{{ $locale }}" name="description[{{ $locale }}]"
                                        rows="4" placeholder="Enter advantage description"></textarea>
                                    <small class="text-danger" id="error_advantage_description_{{ $locale }}"></small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveAdvantage">
                        <i class="ti ti-device-floppy me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>