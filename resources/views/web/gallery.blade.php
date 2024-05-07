@extends('web.index')

@section('title', 'Gallery')

@section('web_content')

	<section id="venue">

        <div class="container-fluid" data-aos="fade-up">
            <div class="section-header mb-5">
                <h2>Gallery</h2>
                <!-- <p>Event venue location info and gallery</p> -->
            </div>
        </div>

        @if(!empty($gallery_images) && count($gallery_images) > 0)
        <div class="container-fluid venue-gallery-container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-0">

                @foreach($gallery_images as $i => $image)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="venue-gallery">
                        <a href="{{ $image->image_path }}" class="glightbox" data-gall="venue-gallery">
                            <img src="{{ $image->image_path }}" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        @endif

    </section>

@endsection