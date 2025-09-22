<div class="modal fade" id="ModalBrochure" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalBrochureLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalBrochureLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="brochure_form" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp
                    <div id="input_id">
                        <input type="hidden" name="id" id="id" value="">
                    </div>
                    <div class="mb-3">
                        <ul class="nav nav-tabs mb-3" id="brochureTab" role="tablist">
                            @foreach ($locales as $locale => $properties)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="brochure-{{ $locale }}-tab" data-bs-toggle="tab"
                                        data-bs-target="#brochure-{{ $locale }}" type="button" role="tab">
                                        {{ $properties['native'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach ($locales as $locale => $properties)

                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="brochure-{{ $locale }}" role="tabpanel">

                                    {{-- Title --}}
                                    <div class="mb-3">
                                        <label for="brochure_title_{{ $locale }}" class="form-label">
                                            Brochure Title ({{ $properties['native'] }})
                                        </label>
                                        <input type="text" class="form-control" id="brochure_title_{{ $locale }}" name="brochure_title[{{ $locale }}]" value="{{ old('brochure_title.' . $locale, $translation['title'] ?? '') }}">
                                        <span class="text-danger" id="message_brochure_title_{{ $locale }}"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="brochure_file_{{ $locale }}" class="form-label">
                                            Brochure File ({{ $properties['native'] }})
                                        </label>
                                        <input type="file" class="form-control" id="brochure_file_{{ $locale }}" name="brochure_file[{{ $locale }}]">
                                        <span class="text-danger" id="message_brochure_file_{{ $locale }}"></span>

                                        {{-- Container untuk link file yang akan diisi via Ajax --}}
                                        <div id="current_file_{{ $locale }}" class="mt-1"></div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="hidden" name="brochure_is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="brochure_is_active"
                                name="brochure_is_active" value="1">
                            <label class="form-check-label" for="brochure_is_active">Published</label>
                        </div>
                        @error('brochure_is_active')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer" id="button_action_brochure">
                    
                </div>
            </form>
        </div>
    </div>
</div>
