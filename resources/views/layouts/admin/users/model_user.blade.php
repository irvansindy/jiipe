<div class="modal fade" id="ModalUsers" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalUsersLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalUsersLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form_users">
                @csrf
                <input type="hidden" name="id" id="user_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter user name">
                        <div class="invalid-feedback" id="error_user_name"></div>
                    </div>

                    <div class="mb-3">
                        <label for="user_email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter email address">
                        <div class="invalid-feedback" id="error_user_email"></div>
                    </div>

                    <div class="mb-3">
                        <label for="user_role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select" name="user_role" id="user_role">
                            <option value="">Select Role</option>
                        </select>
                        <div class="invalid-feedback" id="error_user_role"></div>
                    </div>

                    <div class="mb-3" id="password_field">
                        <label for="user_password" class="form-label">
                            Password <span class="text-danger" id="password_required">*</span>
                        </label>
                        <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter password">
                        <small class="text-muted">Minimum 8 characters</small>
                        <div class="invalid-feedback" id="error_user_password"></div>
                    </div>

                    <div class="mb-3" id="password_confirmation_field">
                        <label for="user_password_confirmation" class="form-label">
                            Confirm Password <span class="text-danger" id="password_confirmation_required">*</span>
                        </label>
                        <input type="password" class="form-control" name="user_password_confirmation" id="user_password_confirmation" placeholder="Confirm password">
                        <div class="invalid-feedback" id="error_user_password_confirmation"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit_user">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>