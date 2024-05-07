@extends('web.index')

@section('title', 'FAQ')

@section('web_content')

	<section id="faq">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>FAQ </h2>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12">

                    @if(!empty($faqs) && count($faqs) > 0)

                        <ul class="faq-list">

                            @foreach($faqs as $f => $faq)

                            <li>
                                <div data-bs-toggle="collapse" class="collapsed question" href="#faq{{ $faq->id }}">{{ $faq->title }}<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq{{ $faq->id }}" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        {!! $faq->description !!}
                                    </p>
                                </div>
                            </li>

                            @endforeach

                        </ul>

                    @endif

                </div>
            </div>

        </div>

    </section>

@endsection