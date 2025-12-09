<div class="modal fade" id="modalContentDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalContentDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalContentDetailLabel">Content Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_content_detail" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    {{-- Hidden ID Field --}}
                    <input type="hidden" id="content_id" name="id">

                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp

                    {{-- Tabs for Locales --}}
                    <div class="mb-3">
                        <ul class="nav nav-tabs mb-3" id="contentDetailTab" role="tablist">
                            @foreach ($locales as $locale => $properties)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="content-detail-{{ $locale }}-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#content-detail-{{ $locale }}"
                                        type="button"
                                        role="tab"
                                        aria-controls="content-detail-{{ $locale }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $properties['native'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Tab Content --}}
                        <div class="tab-content">
                            @foreach ($locales as $locale => $properties)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="content-detail-{{ $locale }}"
                                    role="tabpanel"
                                    aria-labelledby="content-detail-{{ $locale }}-tab">

                                    {{-- Title --}}
                                    <div class="mb-3">
                                        <label for="content_detail_title_{{ $locale }}" class="form-label">
                                            Title ({{ $properties['native'] }})
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control"
                                            id="content_detail_title_{{ $locale }}"
                                            name="content_detail_title[{{ $locale }}]"
                                            placeholder="Enter title in {{ $properties['native'] }}">
                                        <div class="text-danger small" id="message_content_detail_title_{{ $locale }}"></div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="mb-3">
                                        <label for="content_detail_sub_content_{{ $locale }}" class="form-label">
                                            Description ({{ $properties['native'] }})
                                        </label>
                                        <textarea class="form-control summernote"
                                            name="content_detail_sub_content[{{ $locale }}]"
                                            id="content_detail_sub_content_{{ $locale }}"></textarea>
                                        <div class="text-danger small" id="message_content_detail_sub_content_{{ $locale }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Image Upload --}}
                    <div class="mb-3">
                        <label for="content_detail_image" class="form-label">
                            Icon/Image
                        </label>
                        <input type="file"
                            class="form-control"
                            id="content_detail_image"
                            name="content_detail_image"
                            accept="image/*">
                        <small class="text-muted">
                            Recommended format: WebP, PNG, JPG. Max size: 2MB
                        </small>
                        <div class="text-danger small" id="message_content_detail_image"></div>

                        {{-- Preview current image --}}
                        <div id="current_image_preview" class="mt-2" style="display: none;">
                            <img id="current_image" src="" alt="Current Icon" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                    </div>

                    {{-- Category (Optional) --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category (Optional)</label>
                        <input type="number"
                            class="form-control"
                            id="category_id"
                            name="category_id"
                            placeholder="Enter category ID (leave empty for none)">
                        <div class="text-danger small" id="message_category_id"></div>
                    </div>
                </div>

                <div class="modal-footer" id="button_action_content_detail">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit_content_detail">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>