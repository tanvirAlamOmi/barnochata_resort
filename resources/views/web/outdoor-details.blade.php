@extends('web.index')

@section('title', slugToTitle($slug))

@section('web_content')

	<section id="faq">

        <div class="container" data-aos="fade-up">

            <div class="section-header mb-5">
                <h2>{{ slugToTitle($slug) }}</h2>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-12">
                    <p>
                        @if(!empty($images) && count($images) > 0)
                            <div class="col-lg-6 col-md-6 col-sm-12 pull-left slider-box">
                                <div id="imageSlider" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach($images as $i => $image)
                                        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                            <img src="{{ $image->image_path }}" class="img-fluid d-block w-100" alt="image" />
                                        </div>
                                        @endforeach
                                    </div>
                                    @if(count($images) > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if(!empty($description))
                            
                                {!! $description !!}
                            
                        @endif
                    </p>
                </div>
            </div>

        </div>

    </section>

@endsection