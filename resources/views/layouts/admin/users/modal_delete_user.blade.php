<!-- Modal Delete Confirmation -->
<div class="modal fade" id="ModalDeleteUser" tabindex="-1" aria-labelledby="ModalDeleteUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="ModalDeleteUserLabel">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
                <p class="text-danger"><strong>This action cannot be undone!</strong></p>
                <input type="hidden" id="delete_user_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm_delete_user">Delete</button>
            </div>
        </div>
    </div>
</div>