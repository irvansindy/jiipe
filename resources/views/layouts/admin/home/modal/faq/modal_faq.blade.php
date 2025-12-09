<div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="faqModalLabel">Add FAQ</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="faqForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="faq_id" name="faq_id">
                <input type="hidden" id="method" name="_method" value="POST">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position">Position <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="position" name="position" min="1"
                                    value="1" required>
                                <small class="text-muted">Urutan tampilan FAQ (angka kecil muncul lebih dulu)</small>
                                <small class="text-danger" id="error-position"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <div class="mb-3 form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" checked>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h6 class="mb-3">FAQ Content</h6>

                    <ul class="nav nav-tabs mb-3" id="faqTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-id" data-bs-toggle="tab" data-bs-target="#faq-id"
                                type="button">
                                Indonesian
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-en" data-bs-toggle="tab" data-bs-target="#faq-en"
                                type="button">
                                English
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-zh" data-bs-toggle="tab" data-bs-target="#faq-zh"
                                type="button">
                                Chinese (Simplified)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-ja" data-bs-toggle="tab" data-bs-target="#faq-ja"
                                type="button">
                                Japanese
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-ko" data-bs-toggle="tab" data-bs-target="#faq-ko"
                                type="button">
                                Korean
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-tw" data-bs-toggle="tab" data-bs-target="#faq-tw"
                                type="button">
                                Chinese (Traditional)
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Indonesian -->
                        <div class="tab-pane fade show active" id="faq-id" role="tabpanel">
                            <div class="form-group">
                                <label for="question_id">Question (Indonesian) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="question_id" name="question_id"
                                    required>
                                <small class="text-danger" id="error-question_id"></small>
                            </div>
                            <div class="form-group">
                                <label for="answer_id">Answer (Indonesian) <span class="text-danger">*</span></label>
                                <textarea class="form-control summernote" id="answer_id" name="answer_id" rows="6" required></textarea>
                                <small class="text-danger" id="error-answer_id"></small>
                            </div>
                        </div>

                        <!-- English -->
                        <div class="tab-pane fade" id="faq-en" role="tabpanel">
                            <div class="form-group">
                                <label for="question_en">Question (English) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="question_en" name="question_en"
                                    required>
                                <small class="text-danger" id="error-question_en"></small>
                            </div>
                            <div class="form-group">
                                <label for="answer_en">Answer (English) <span class="text-danger">*</span></label>
                                <textarea class="form-control summernote" id="answer_en" name="answer_en" rows="6" required></textarea>
                                <small class="text-danger" id="error-answer_en"></small>
                            </div>
                        </div>

                        <!-- Chinese Simplified -->
                        <div class="tab-pane fade" id="faq-zh" role="tabpanel">
                            <div class="form-group">
                                <label for="question_zh">Question (Chinese - Simplified)</label>
                                <input type="text" class="form-control" id="question_zh" name="question_zh">
                                <small class="text-danger" id="error-question_zh"></small>
                            </div>
                            <div class="form-group">
                                <label for="answer_zh">Answer (Chinese - Simplified)</label>
                                <textarea class="form-control summernote" id="answer_zh" name="answer_zh" rows="6"></textarea>
                                <small class="text-danger" id="error-answer_zh"></small>
                            </div>
                        </div>

                        <!-- Japanese -->
                        <div class="tab-pane fade" id="faq-ja" role="tabpanel">
                            <div class="form-group">
                                <label for="question_ja">Question (Japanese)</label>
                                <input type="text" class="form-control" id="question_ja" name="question_ja">
                                <small class="text-danger" id="error-question_ja"></small>
                            </div>
                            <div class="form-group">
                                <label for="answer_ja">Answer (Japanese)</label>
                                <textarea class="form-control summernote" id="answer_ja" name="answer_ja" rows="6"></textarea>
                                <small class="text-danger" id="error-answer_ja"></small>
                            </div>
                        </div>

                        <!-- Korean -->
                        <div class="tab-pane fade" id="faq-ko" role="tabpanel">
                            <div class="form-group">
                                <label for="question_ko">Question (Korean)</label>
                                <input type="text" class="form-control" id="question_ko" name="question_ko">
                                <small class="text-danger" id="error-question_ko"></small>
                            </div>
                            <div class="form-group">
                                <label for="answer_ko">Answer (Korean)</label>
                                <textarea class="form-control summernote" id="answer_ko" name="answer_ko" rows="6"></textarea>
                                <small class="text-danger" id="error-answer_ko"></small>
                            </div>
                        </div>

                        <!-- Chinese Traditional -->
                        <div class="tab-pane fade" id="faq-tw" role="tabpanel">
                            <div class="form-group">
                                <label for="question_tw">Question (Chinese - Traditional)</label>
                                <input type="text" class="form-control" id="question_tw" name="question_tw">
                                <small class="text-danger" id="error-question_tw"></small>
                            </div>
                            <div class="form-group">
                                <label for="answer_tw">Answer (Chinese - Traditional)</label>
                                <textarea class="form-control summernote" id="answer_tw" name="answer_tw" rows="6"></textarea>
                                <small class="text-danger" id="error-answer_tw"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitFaq">
                        <span class="btn-text">Save</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="loadingOverlayFaq" style="display: none;">
    <div class="spinner"></div>
</div>

<style>
    #loadingOverlayFaq {
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

    #loadingOverlayFaq .spinner {
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
