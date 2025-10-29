<div class="modal fade" id="modalContentDetail" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalContentDetailLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalContentDetailLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_content_detail" id="form_content_detail">
                @csrf
                <div class="modal-body">
                    <div class="for-id">
                        <input type="hidden" id="content_id" name="content_id">
                    </div>
                    <div class="row">
                        @php
                            $locales = config('laravellocalization.supportedLocales');
                        @endphp
                        <div class="mb-3">
                            <ul class="nav nav-tabs mb-3" id="contentDetailTab" role="tablist">
                                @foreach ($locales as $locale => $properties)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="content_detail-{{ $locale }}-tab" data-bs-toggle="tab"
                                            data-bs-target="#content_detail-{{ $locale }}" type="button" role="tab"
                                            aria-controls="content_detail-{{ $locale }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            {{ $properties['name'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($locales as $locale => $properties)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                        id="content_detail-{{ $locale }}" role="tabpanel"
                                        aria-labelledby="content_detail-{{ $locale }}-tab">
                                        <div class="mb-3">
                                            <label for="content_detail_title_{{ $locale }}" class="form-label">Content Title
                                                ({{ $properties['native'] }})</label>
                                            <input type="text" class="form-control"
                                                id="content_detail_title_{{ $locale }}"
                                                name="content_detail_title[{{ $locale }}]"
                                                value="{{ old('content_detail_title_' . $locale) }}">
                                                <div class="text-danger small" id="message_content_detail_title_{{ $locale }}"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content_detail_sub_content_{{ $locale }}" class="form-label">Content Title
                                                ({{ $properties['native'] }})</label>
                                                <textarea class="summernote" name="content_detail_sub_content[{{ $locale }}]" id="content_detail_sub_content_{{ $locale }}" cols="30" rows="10"></textarea>
                                                <div class="text-danger small" id="message_content_detail_sub_content_{{ $locale }}"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="content_detail_image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="content_detail_image" name="content_detail_image">
                            <span class="text-info" style="font-size: 12px;">Direkomendasikan menggunakan format webp</span>
                            <div class="text-danger small" id="message_content_detail_image"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" id="button_action_content_detail">
                    <button >Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
