@php
    $faqs = app()->make('App\Http\Controllers\Client\HomeController')->getFaqs();

    // Convert collection → array
    $faqs = is_array($faqs) ? $faqs : $faqs->toArray();

    $totalFaqs = count($faqs);
    $halfCount = ceil($totalFaqs / 2);

    $firstColumnFaqs = array_slice($faqs, 0, $halfCount);
    $secondColumnFaqs = array_slice($faqs, $halfCount);
@endphp

<section class="faq-jippe faq-jippe-red" id="faq">
    <div class="prelative container">
        <div class="row">
            <div class="col-60 text-center py-lg-4 py-sm-2">
                <h2 class="jiipe-main-header jiipe-main-putih">Frequently Asked Questions</h2>
            </div>
        </div>

        <div class="row">

            {{-- ==================== COLUMN 1 ==================== --}}
            <div class="col-lg-30 col-sm-60">
                <div class="faq-accordian">
                    <div class="accordion" id="accordian_page_0">

                        @foreach ($firstColumnFaqs as $index => $faq)
                            <div class="card">
                                <div class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_{{ $index }}"
                                        aria-expanded="false" class="collapsed">

                                        {!! $faq['question'] !!}

                                    </a>
                                </div>

                                <div id="collapse_{{ $index }}" class="collapse" data-parent="#accordian_page_0">
                                    <div class="card-body text-justify">
                                        {!! $faq['answer'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            {{-- ==================== COLUMN 2 ==================== --}}
            <div class="col-lg-30 col-sm-60">
                <div class="faq-accordian">
                    <div class="accordion" id="accordian_page_1">

                        @foreach ($secondColumnFaqs as $index2 => $faq)
                            @php $realIndex = $index2 + $halfCount; @endphp

                            <div class="card">
                                <div class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_{{ $realIndex }}"
                                        aria-expanded="false" class="collapsed">

                                        {!! $faq['question'] !!}

                                    </a>
                                </div>

                                <div id="collapse_{{ $realIndex }}" class="collapse" data-parent="#accordian_page_1">
                                    <div class="card-body text-justify">
                                        {!! $faq['answer'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
