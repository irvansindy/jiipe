<!-- Modal Role Permissions -->
<div class="modal fade" id="ModalRolePermissions" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalRolePermissionsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalRolePermissionsLabel">Role Permissions</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form_role_permissions">
                @csrf
                <input type="hidden" name="role_id" id="role_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <h6>Role: <span id="role_name_display" class="badge bg-primary"></span></h6>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0">Permissions</label>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="select_all_permissions">
                                    <i class="ti ti-check"></i> Select All
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="deselect_all_permissions">
                                    <i class="ti ti-x"></i> Deselect All
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover table-bordered" id="permissions_table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="50px" class="text-center">
                                            <input type="checkbox" class="form-check-input" id="check_all_permissions">
                                        </th>
                                        <th>Permission Name</th>
                                        <th>Guard</th>
                                    </tr>
                                </thead>
                                <tbody id="permissions_table_body">
                                    <!-- Will be populated by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i>
                        <small>Select permissions that this role should have access to.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit_role_permissions">
                        <i class="ti ti-device-floppy"></i> Save Permissions
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>