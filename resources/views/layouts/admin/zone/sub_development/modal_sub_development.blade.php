{{-- Modal List Sub Developments --}}
<div class="modal fade" id="modalListSubDevelopment" tabindex="-1" aria-labelledby="modalListSubDevelopmentLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalListSubDevelopmentLabel">Sub Developments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Zone: <span id="selected_zone_name_dev" class="text-primary fw-bold"></span></h6>
                    <button type="button" class="btn btn-sm btn-primary" id="btnAddDevelopment">
                        <i class="ti ti-plus me-1"></i> Add Development
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="tableSubDevelopment" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="30%">NAME</th>
                                <th width="45%">DESCRIPTION</th>
                                <th width="20%" class="text-end">ACTION</th>
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

{{-- Modal Sub Development Form (Add/Edit) --}}
<div class="modal fade" id="modalSubDevelopment" tabindex="-1" aria-labelledby="modalSubDevelopmentLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSubDevelopmentLabel">Add Sub Development</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formSubDevelopment">
                <input type="hidden" id="development_id" name="development_id">
                <input type="hidden" id="development_zone_id" name="zone_id">
                <div class="modal-body">
                    <ul class="nav nav-tabs mb-3" id="developmentTransTab" role="tablist">
                        @foreach (config('laravellocalization.supportedLocales') as $locale => $properties)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="development-tab-{{ $locale }}" data-bs-toggle="tab"
                                    data-bs-target="#development-content-{{ $locale }}" type="button" role="tab"
                                    aria-controls="development-content-{{ $locale }}">
                                    {{ $properties['native'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach (config('laravellocalization.supportedLocales') as $locale => $properties)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="development-content-{{ $locale }}" role="tabpanel"
                                aria-labelledby="development-tab-{{ $locale }}">

                                <div class="mb-3">
                                    <label for="development_name_{{ $locale }}" class="form-label">
                                        Name ({{ $properties['native'] }}) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="development_name_{{ $locale }}"
                                        name="name[{{ $locale }}]" placeholder="Enter development name" required>
                                    <small class="text-danger" id="error_development_name_{{ $locale }}"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="development_description_{{ $locale }}" class="form-label">
                                        Description ({{ $properties['native'] }})
                                    </label>
                                    <textarea class="form-control summernote-development"
                                        id="development_description_{{ $locale }}" name="description[{{ $locale }}]"
                                        rows="4" placeholder="Enter development description"></textarea>
                                    <small class="text-danger" id="error_development_description_{{ $locale }}"></small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveDevelopment">
                        <i class="ti ti-device-floppy me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>