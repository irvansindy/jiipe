<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="reviewModalLabel">Add Review</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="reviewForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="review_id" name="review_id">
                <input type="hidden" id="method" name="_method" value="POST">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" >
                                <small class="text-danger" id="error-name"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="position" name="position" >
                                <small class="text-danger" id="error-position"></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo" name="photo"
                                accept="image/*">
                            <label class="custom-file-label" for="photo">Choose file</label>
                        </div>
                        <small class="text-danger" id="error-photo"></small>
                        <div id="photo-preview" class="mt-2" style="display: none;">
                            <img src="" alt="Preview" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                    </div>

                    <hr>
                    <h6 class="mb-3">Review Descriptions</h6>

                    <ul class="nav nav-tabs mb-3" id="reviewDescTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-id" data-bs-toggle="tab"
                                data-bs-target="#desc-id" type="button">
                                Indonesian
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-en" data-bs-toggle="tab" data-bs-target="#desc-en"
                                type="button">
                                English
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-zh" data-bs-toggle="tab" data-bs-target="#desc-zh"
                                type="button">
                                Chinese (Simplified)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-ja" data-bs-toggle="tab" data-bs-target="#desc-ja"
                                type="button">
                                Japanese
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-ko" data-bs-toggle="tab" data-bs-target="#desc-ko"
                                type="button">
                                Korean
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-tw" data-bs-toggle="tab" data-bs-target="#desc-tw"
                                type="button">
                                Chinese (Traditional)
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="desc-id" role="tabpanel">
                            <div class="form-group">
                                <label for="description_id">Review (Indonesian) <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="description_id" name="description_id" rows="4" ></textarea>
                                <small class="text-danger" id="error-description_id"></small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="desc-en" role="tabpanel">
                            <div class="form-group">
                                <label for="description_en">Review (English) <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="description_en" name="description_en" rows="4" ></textarea>
                                <small class="text-danger" id="error-description_en"></small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="desc-zh" role="tabpanel">
                            <div class="form-group">
                                <label for="description_zh">Review (Chinese - Simplified)</label>
                                <textarea class="form-control" id="description_zh" name="description_zh" rows="4"></textarea>
                                <small class="text-danger" id="error-description_zh"></small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="desc-ja" role="tabpanel">
                            <div class="form-group">
                                <label for="description_ja">Review (Japanese)</label>
                                <textarea class="form-control" id="description_ja" name="description_ja" rows="4"></textarea>
                                <small class="text-danger" id="error-description_ja"></small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="desc-ko" role="tabpanel">
                            <div class="form-group">
                                <label for="description_ko">Review (Korean)</label>
                                <textarea class="form-control" id="description_ko" name="description_ko" rows="4"></textarea>
                                <small class="text-danger" id="error-description_ko"></small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="desc-tw" role="tabpanel">
                            <div class="form-group">
                                <label for="description_tw">Review (Chinese - Traditional)</label>
                                <textarea class="form-control" id="description_tw" name="description_tw" rows="4"></textarea>
                                <small class="text-danger" id="error-description_tw"></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="mb-3 form-check form-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <span class="btn-text">Save</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="loadingOverlay" style="display: none;">
    <div class="spinner"></div>
</div>

<style>
    #loadingOverlay {
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

    .spinner {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
