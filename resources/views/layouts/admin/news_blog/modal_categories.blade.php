<div class="modal fade" id="modalNewsCategories" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalNewsCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalNewsCategoriesLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_news_category" id="form_news_category">
                @csrf
                <div class="modal-body">
                    @php
                        $locales = config('laravellocalization.supportedLocales');
                    @endphp
                    <div class="mb-3">
                        <ul class="nav nav-tabs" id="FormNewsCategoryTab" role="tablist">
                            @foreach($locales as $locale => $properties)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if($loop->first) active @endif"
                                            id="tab-form-news-category-{{ $locale }}"
                                            data-bs-toggle="tab"
                                            data-bs-target="#form-news-category-{{ $locale }}"
                                            type="button" role="tab"
                                            aria-controls="form-news-category-{{ $locale }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ strtoupper($properties['native'].' - '.$locale) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content border border-top-0 p-3">

                            @foreach($locales as $locale => $properties)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="form-news-category-{{ $locale }}" role="tabpanel" aria-labelledby="tab-form-news-category-{{ $locale }}">
                                    <div class="mb-3">
                                        <label for="news_category_name[{{ $locale }}]">News Category ({{ strtoupper($locale) }})</label>
                                        <input type="text" class="form-control" name="news_category_name[{{ $locale }}]" id="news_category_name_{{ $locale }}" placeholder="News Category ({{ strtoupper($locale) }})">
                                        <span class="text-danger" id="message_news_category_name_{{ $locale }}"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_news_category">
                    
                </div>
            </form>
        </div>
    </div>
</div>
