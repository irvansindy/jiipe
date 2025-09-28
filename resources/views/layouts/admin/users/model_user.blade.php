<div class="modal fade" id="ModalUsers" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalUsersLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalUsersLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form_users">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_name">Name</label>
                        <input type="text" class="form-control" name="user_name" id="user_name">
                    </div>
                    <div class="mb-3" id="select_user_role">
                        <select name="user_role" id="user_role"></select>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_users">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
