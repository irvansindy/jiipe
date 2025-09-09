<div class="modal fade" id="modalZone" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalZoneLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalZoneLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="form_zone" id="form_zone">
                @csrf
                <div class="modal-body">

                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp

                    {{-- Menu Name (multilingual) --}}
                    <div class="mb-3">
                        <label for="zone_class">Zone Class</label>
                        <select name="zone_class" id="zone_class" class="form-control zone_class">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="zone_image">Zone Image</label>
                        <input type="file" class="form-control" name="zone_image" id="zone_image" placeholder="Zone Image">
                        <span class="text-danger" id="message_zone_image"></span>
                    </div>
                    <div class="mb-3">
                        <ul class="nav nav-tabs" id="formZoneTab" role="tablist">
                            @foreach($locales as $locale => $properties)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if($loop->first) active @endif"
                                            id="tab-form-zone-{{ $locale }}"
                                            data-bs-toggle="tab"
                                            data-bs-target="#form-zone-{{ $locale }}"
                                            type="button" role="tab"
                                            aria-controls="form-zone-{{ $locale }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ strtoupper($properties['native'].' - '.$locale) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content border border-top-0 p-3">

                            @foreach($locales as $locale => $properties)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="form-zone-{{ $locale }}" role="tabpanel" aria-labelledby="tab-form-zone-{{ $locale }}">
                                    <div class="mb-3">
                                        <label for="zone_name[{{ $locale }}]">Zone Name ({{ strtoupper($locale) }})</label>
                                        <input type="text" class="form-control" name="zone_name[{{ $locale }}]" id="zone_name[{{ $locale }}]" placeholder="Zone Name ({{ strtoupper($locale) }})">
                                        <span class="text-danger" id="message_zone_name_{{ $locale }}"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="zone_subtitle[{{ $locale }}]">Zone Subtitle ({{ strtoupper($locale) }})</label>
                                        <input type="text" class="form-control" name="zone_subtitle[{{ $locale }}]" id="zone_subtitle[{{ $locale }}]" placeholder="Zone Subtitle ({{ strtoupper($locale) }})">
                                        <span class="text-danger" id="message_zone_subtitle_{{ $locale }}"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="zone_description[{{ $locale }}]">Zone Description ({{ strtoupper($locale) }})</label>
                                        <textarea class="form-control zone_summernote" name="zone_description[{{ $locale }}]" id="zone_description[{{ $locale }}]" cols="30" rows="10"></textarea>
                                        <span class="text-danger" id="message_zone_description_{{ $locale }}"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="zone_note[{{ $locale }}]">Zone Note ({{ strtoupper($locale) }})</label>
                                        <input type="text" class="form-control" name="zone_note[{{ $locale }}]" id="zone_note[{{ $locale }}]" placeholder="Zone Note ({{ strtoupper($locale) }})">
                                        <span class="text-danger" id="message_zone_note_{{ $locale }}"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_menu">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
