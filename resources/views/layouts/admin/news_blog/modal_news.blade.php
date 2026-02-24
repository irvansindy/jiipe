<div class="modal fade" id="modalNews" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalNewsLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalNewsLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="form_news" id="form_news">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="news_category">Category</label>
                        <select name="news_category" id="news_category" class="form-control news_category">
                        </select>
                        <span class="text-danger" id="message_news_category"></span>
                    </div>

                    <div class="mb-3">
                        <label for="news_thumbnail">Thumbnail</label>
                        <input type="file" name="news_thumbnail" id="news_thumbnail"
                            class="form-control news_thumbnail" />
                        <span class="text-danger" id="message_news_thumbnail"></span>
                    </div>

                    <div class="mb-3">
                        <label for="news_published">Status</label>
                        <select name="news_published" id="news_published" class="form-control">
                            <option value="0">Unpublished</option>
                            <option value="1">Published</option>
                        </select>
                        <span class="text-danger" id="message_news_published"></span>
                    </div>

                    @php
                        $supportedLocales = array_keys(config('laravellocalization.supportedLocales'));

                        $locales = \App\Models\Language::whereIn('locale', $supportedLocales)->get()->keyBy('locale');
                    @endphp
                    <div class="mb-3">
                        <ul class="nav nav-tabs" id="formNewsTab" role="tablist">
                            @foreach ($locales as $locale => $properties)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($loop->first) active @endif"
                                        id="tab-form-news-{{ $locale }}" data-bs-toggle="tab"
                                        data-bs-target="#form-news-{{ $locale }}" type="button" role="tab"
                                        aria-controls="form-news-{{ $locale }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <img src="{{ asset('uploads/flags/' . $properties['flag']) }}" alt="{{ $locale }}" style="width: 24px; height: 24px; border: 1px solid #ddd; border-radius: 4px;">
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content border border-top-0 p-3">
                            @foreach ($locales as $locale => $properties)
                                <div class="tab-pane fade @if ($loop->first) show active @endif"
                                    id="form-news-{{ $locale }}" role="tabpanel"
                                    aria-labelledby="tab-form-news-{{ $locale }}">

                                    <div class="mb-3">
                                        <label for="news_title_{{ $locale }}">News Name
                                            ({{ strtoupper($locale) }})
                                        </label>
                                        <input type="text" class="form-control"
                                            name="news_title[{{ $locale }}]" id="news_title_{{ $locale }}"
                                            placeholder="News Name ({{ strtoupper($locale) }})">
                                        <span class="text-danger" id="message_news_title_{{ $locale }}"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="news_content_{{ $locale }}">News Description
                                            ({{ strtoupper($locale) }})</label>
                                        <textarea class="form-control news_summernote" name="news_content[{{ $locale }}]"
                                            id="news_content_{{ $locale }}" cols="30" rows="10"></textarea>
                                        <span class="text-danger" id="message_news_content_{{ $locale }}"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="news_quote_{{ $locale }}">News Note
                                            ({{ strtoupper($locale) }})</label>
                                        <input type="text" class="form-control"
                                            name="news_quote[{{ $locale }}]" id="news_quote_{{ $locale }}"
                                            placeholder="News Note ({{ strtoupper($locale) }})">
                                        <span class="text-danger" id="message_news_quote_{{ $locale }}"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="modal-footer" id="button_action_news">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_changes">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
