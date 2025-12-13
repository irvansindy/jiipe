{{-- Modal List Zone Clusters --}}
<div class="modal fade" id="modalListZoneCluster" tabindex="-1" aria-labelledby="modalListZoneClusterLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalListZoneClusterLabel">Zone Clusters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Zone: <span id="selected_zone_name" class="text-primary fw-bold"></span></h6>
                    <button type="button" class="btn btn-sm btn-primary" id="btnAddCluster">
                        <i class="ti ti-plus me-1"></i> Add Cluster
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="tableZoneCluster" width="100%">
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

{{-- Modal Zone Cluster Form (Add/Edit) --}}
<div class="modal fade" id="modalZoneCluster" tabindex="-1" aria-labelledby="modalZoneClusterLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalZoneClusterLabel">Add Zone Cluster</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formZoneCluster">
                <input type="hidden" id="cluster_id" name="cluster_id">
                <input type="hidden" id="cluster_zone_id" name="zone_id">
                <div class="modal-body">
                    <ul class="nav nav-tabs mb-3" id="clusterTransTab" role="tablist">
                        @foreach (config('laravellocalization.supportedLocales') as $locale => $properties)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="cluster-tab-{{ $locale }}" data-bs-toggle="tab"
                                    data-bs-target="#cluster-content-{{ $locale }}" type="button" role="tab"
                                    aria-controls="cluster-content-{{ $locale }}">
                                    {{ $properties['native'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach (config('laravellocalization.supportedLocales') as $locale => $properties)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="cluster-content-{{ $locale }}" role="tabpanel"
                                aria-labelledby="cluster-tab-{{ $locale }}">

                                <div class="mb-3">
                                    <label for="cluster_name_{{ $locale }}" class="form-label">
                                        Name ({{ $properties['native'] }}) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="cluster_name_{{ $locale }}"
                                        name="name[{{ $locale }}]" placeholder="Enter cluster name" required>
                                    <small class="text-danger" id="error_cluster_name_{{ $locale }}"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="cluster_description_{{ $locale }}" class="form-label">
                                        Description ({{ $properties['native'] }})
                                    </label>
                                    <textarea class="form-control summernote-cluster"
                                        id="cluster_description_{{ $locale }}" name="description[{{ $locale }}]"
                                        rows="4" placeholder="Enter cluster description"></textarea>
                                    <small class="text-danger" id="error_cluster_description_{{ $locale }}"></small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveCluster">
                        <i class="ti ti-device-floppy me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>