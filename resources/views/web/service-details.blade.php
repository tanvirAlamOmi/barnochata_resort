@extends('web.index')

@section('title', slugToTitle($slug))

@section('web_content')

	<section id="faq">

        <div class="container" data-aos="fade-up">

            <div class="section-header mb-5">
                <h2>{{ slugToTitle($slug) }}</h2>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                @if(!empty($articles) && count($articles) > 0)
                    @foreach($articles as $a => $article)
                        <div class="col-12 {{ $a % 2 == 0  ? 'bg-light' : 'bg-white' }} mb-3">
                            <h4 class="mt-3"><b>{{ $article->title }}</b></h4>
                            <p>
                                @if(!empty($article->images) && count($article->images) > 0)
                                    <div class="col-lg-6 col-md-6 col-sm-12 pull-left slider-box">
                                        <div id="imageSlider" class="carousel slide">
                                            <div class="carousel-inner">
                                                @foreach($article->images as $i => $image)
                                                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                    <img src="{{ $image->image_path }}" class="img-fluid d-block w-100" alt="image" />
                                                </div>
                                                @endforeach
                                            </div>
                                            @if(count($article->images) > 1)
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
                                @if(!empty($article->description))
                                    
                                        {!! $article->description !!}
                                    
                                @endif
                            </p>
                            @if(!empty($article->videos) && count($article->videos) > 0)
                            <div class="row">
                                @foreach($article->videos as $v => $video)
                                    <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                                        @if(!empty($video->embed_code))
                                        <div class="embed-div">
                                            {!! $video->embed_code !!}
                                        </div>
                                        @endif
                                        @if(!empty($video->vdo_link))
                                        <div class="">
                                            @if(!empty($video->vdo_link_thumbnail))
                                                <a href="{!! $video->vdo_link !!}" target="_blank"><img src="{{ $video->thumbnail_path }}" alt="" class="img-fluid img-thumbnail">{!! $video->vdo_link !!}</a>
                                            @else
                                                <a href="{!! $video->vdo_link !!}" target="_blank">{!! $video->vdo_link !!}</a>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

        </div>

    </section>

@endsection