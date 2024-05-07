@extends('web.index')

@section('title', 'Directors')

@section('web_content')

    <section id="faq">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Directors</h2>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                @if(!empty($directors) && count($directors) > 0)
                    <div class="col-lg-12">
                        @foreach($directors as $d => $director)
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <img src="{{ $director->image_path }}" alt="" class="img-fluid img-thumbnail img-round">
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12">
                                <h5><b>{{ $director->title }}</b></h5>
                                <p>
                                    {!! $director->description !!}
                                </p>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>           
                @endif
            </div>

        </div>

    </section>

@endsection