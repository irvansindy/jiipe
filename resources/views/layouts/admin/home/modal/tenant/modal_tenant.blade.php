{{-- <div class="modal fade" id="ModalTenant" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalTenantLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTenantLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" id="tenant_form" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp

                    <input type="hidden" name="id" id="tenant_id" value="">
                    <ul class="nav nav-tabs mb-3" id="tenantTab" role="tablist">
                        @foreach ($locales as $locale => $properties)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="tenant-{{ $locale }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#tenant-{{ $locale }}" type="button" role="tab">
                                    {{ $properties['native'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach ($locales as $locale => $properties)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="tenant-{{ $locale }}" role="tabpanel">
                                <div class="mb-3">
                                    <label for="tenant_name_{{ $locale }}" class="form-label">Name
                                        ({{ $properties['native'] }})
                                    </label>
                                    <input type="text" class="form-control" id="tenant_name_{{ $locale }}"
                                        name="name[{{ $locale }}]" value="">
                                    <span class="text-danger" id="message_name_{{ $locale }}"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<!-- Modal Tenant -->
<div class="modal fade" id="ModalTenant" data-bs-backdrop="static" tabindex="-1" aria-labelledby="tenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="tenantModalLabel">Add New Tenant</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tenantForm" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp

                    <input type="hidden" id="tenant_id" name="tenant_id">
                    <input type="hidden" id="formMethod" name="_method" value="POST">

                    <div class="row">
                        <!-- Logo -->
                        <div class="col-md-12 mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            <small class="text-muted">Max size: 2MB. Format: JPG, PNG, GIF</small>
                            <span class="text-danger" id="message_logo"></span>
                            <div id="current_logo" class="mt-2"></div>
                        </div>

                        <!-- Logo Preview -->
                        <div class="col-md-12 mb-3" id="logoPreview" style="display: none;">
                            <label class="form-label">Logo Preview</label>
                            <div class="border rounded p-2 text-center">
                                <img id="logoImage" src="" alt="Logo Preview" style="max-width: 200px; max-height: 200px; object-fit: contain;">
                            </div>
                        </div>
                    </div>

                    {{-- Translation tabs --}}
                    <ul class="nav nav-tabs mb-3" id="tenantTab" role="tablist">
                        @foreach ($locales as $locale => $properties)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="tenant-{{ $locale }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#tenant-{{ $locale }}" type="button" role="tab">
                                    {{ $properties['native'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach ($locales as $locale => $properties)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="tenant-{{ $locale }}" role="tabpanel">

                                <div class="mb-3">
                                    <label for="tenant_name_{{ $locale }}" class="form-label">
                                        Name ({{ $properties['native'] }}) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="tenant_name_{{ $locale }}"
                                        name="name[{{ $locale }}]" value="" required>
                                    <span class="text-danger" id="message_name_{{ $locale }}"></span>
                                </div>

                                <div class="mb-3">
                                    <label for="tenant_description_{{ $locale }}" class="form-label">
                                        Description ({{ $properties['native'] }})
                                    </label>
                                    <textarea class="form-control tenant_description" id="tenant_description_{{ $locale }}"
                                        name="description[{{ $locale }}]" rows="3">{{ old('description.' . $locale, '') }}</textarea>
                                    <span class="text-danger" id="message_description_{{ $locale }}"></span>
                                </div>

                            </div>
                        @endforeach

                        <!-- Status -->
                        <div class="mb-3 form-check form-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" id="button_action_tenant">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x"></i> Close
                    </button>
                    <button type="submit" id="action_tenant" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none"></span>
                        <i class="ti ti-device-floppy"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModalTenant" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center py-3">
                    <i class="ti ti-alert-circle text-danger" style="font-size: 64px;"></i>
                    <h5 class="mt-3">Are you sure?</h5>
                    <p class="text-muted">You won't be able to revert this!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="ti ti-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>