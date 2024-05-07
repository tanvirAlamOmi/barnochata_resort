@extends('web.index')

@section('title', 'Terms & Conditions')

@section('web_content')

	<section id="faq">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Terms & Conditions</h2>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12">

                    @if(!empty($conditions) && count($conditions))
                        @foreach($conditions as $c => $condition)
                            {!! $condition->description !!}
                            <hr>
                        @endforeach
                    @endif

                </div>
            </div>

        </div>

    </section>

@endsection