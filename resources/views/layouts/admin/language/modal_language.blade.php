<!-- Modal: Create / Edit Language -->
<div class="modal fade" id="ModalLanguage" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalLanguageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ModalLanguageLabel">Language</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" id="language_form">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="language_id" value="">

                    <div class="row">
                        <!-- Locale Code -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="locale" class="form-label">
                                    Locale Code <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="locale" name="locale"
                                    placeholder="e.g., en, id, zh" maxlength="10" required>
                                <small class="text-muted">ISO 639-1 code (2-3 characters)</small>
                                <span class="text-danger" id="message_locale"></span>
                            </div>
                        </div>

                        <!-- English Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    English Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="e.g., English, Indonesian" required>
                                <small class="text-muted">Language name in English</small>
                                <span class="text-danger" id="message_name"></span>
                            </div>
                        </div>

                        <!-- Native Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="native" class="form-label">
                                    Native Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="native" name="native"
                                    placeholder="e.g., English, Bahasa Indonesia" required>
                                <small class="text-muted">Language name in native script</small>
                                <span class="text-danger" id="message_native"></span>
                            </div>
                        </div>

                        <!-- Regional Code -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="regional" class="form-label">
                                    Regional Code
                                </label>
                                <input type="text" class="form-control" id="regional" name="regional"
                                    placeholder="e.g., en_US, id_ID" maxlength="10">
                                <small class="text-muted">Locale with region (optional)</small>
                                <span class="text-danger" id="message_regional"></span>
                            </div>
                        </div>

                        <!-- Script -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="script" class="form-label">
                                    Script
                                </label>
                                <select class="form-select" id="script" name="script">
                                    <option value="Latn">Latin (Latn)</option>
                                    <option value="Hans">Simplified Chinese (Hans)</option>
                                    <option value="Hant">Traditional Chinese (Hant)</option>
                                    <option value="Jpan">Japanese (Jpan)</option>
                                    <option value="Hang">Korean (Hang)</option>
                                    <option value="Cyrl">Cyrillic (Cyrl)</option>
                                    <option value="Arab">Arabic (Arab)</option>
                                    <option value="Deva">Devanagari (Deva)</option>
                                    <option value="Thai">Thai (Thai)</option>
                                    <option value="Hebr">Hebrew (Hebr)</option>
                                    <option value="Grek">Greek (Grek)</option>
                                    <option value="Armn">Armenian (Armn)</option>
                                    <option value="Geor">Georgian (Geor)</option>
                                    <option value="Ethi">Ethiopic (Ethi)</option>
                                </select>
                                <small class="text-muted">ISO 15924 script code</small>
                                <span class="text-danger" id="message_script"></span>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i>
                        <strong>Note:</strong> After adding/updating a language, the system will automatically update the
                        <code>config/laravellocalization.php</code> file and clear the config cache.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x me-1"></i> Cancel
                    </button>
                    <button type="submit" id="action_language" class="btn btn-primary">
                        <span class="btn-text"><i class="ti ti-device-floppy me-1"></i> Save</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Loading Overlay --}}
<div id="loadingOverlayLanguage" style="display: none;">
    <div class="spinner"></div>
</div>