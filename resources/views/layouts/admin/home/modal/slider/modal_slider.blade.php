<!-- Modal: Create / Edit Home Slider -->
<div class="modal fade" id="ModalSlider" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalSliderLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalSliderLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" id="slider_form" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp

                    <input type="hidden" name="id" id="slider_id" value="">

                    {{-- Main files (image & video) --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="slider_file" class="form-label">File</label>
                            <input type="file" class="form-control" id="slider_file" name="slider_file">
                            <span class="text-muted" id="">image/video</span>
                            <span class="text-danger" id="message_image"></span>
                            <div id="current_image" class="mt-2"></div>
                        </div>
                    </div>

                    {{-- Translation tabs --}}
                    <ul class="nav nav-tabs mb-3" id="sliderTab" role="tablist">
                        @foreach ($locales as $locale => $properties)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="slider-{{ $locale }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#slider-{{ $locale }}" type="button" role="tab">
                                    {{ $properties['native'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach ($locales as $locale => $properties)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="slider-{{ $locale }}" role="tabpanel">
                                <div class="mb-3">
                                    <label for="slider_title_{{ $locale }}" class="form-label">Title
                                        ({{ $properties['native'] }})
                                    </label>
                                    <input type="text" class="form-control" id="slider_title_{{ $locale }}"
                                        name="title[{{ $locale }}]" value="">
                                    <span class="text-danger" id="message_title_{{ $locale }}"></span>
                                </div>

                                <div class="mb-3">
                                    <label for="slider_description_{{ $locale }}" class="form-label">Description
                                        ({{ $properties['native'] }})</label>
                                    <textarea class="form-control slider_description" id="slider_description_{{ $locale }}"
                                        name="description[{{ $locale }}]" rows="3">{{ old('description.' . $locale, '') }}</textarea>
                                    <span class="text-danger" id="message_description_{{ $locale }}"></span>
                                </div>

                            </div>
                        @endforeach
                        <div class="mb-3 form-check form-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                value="1" checked>
                            <label class="form-check-label" for="is_active">Published</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer" id="button_action_slider">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="action_slider" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
