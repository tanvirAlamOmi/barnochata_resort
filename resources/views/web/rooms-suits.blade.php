@extends('web.index')

@section('title', 'Rooms & Suits')

@section('web_content')

	<section id="hotels" class="section-with-bg">

        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Rooms & Suits</h2>
                <!-- <p>Her are some nearby hotels</p> -->
            </div>

            @if(!empty($rooms) && count($rooms) > 0)
                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    @foreach($rooms as $r => $room)

                        <div class="col-lg-4 col-md-6 d-lg-flex">
                            <div class="hotel">
                                <div class="hotel-img">
                                    <img src="{{ $room->default_image }}" alt="{{ $room->title }}" class="img-fluid">
                                </div>
                                <h3>
                                    {{ $room->title }}
                                    <small class="pull-right"><b class="text-secondary">{{ $room->price_currency }}</b></small>
                                </h3>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                @if(!empty($room->facilities))
                                <p class="mb-2">
                                    @foreach(explode(',', $room->facilities) as $f => $facility)
                                        <small class="badge bg-light text-secondary border p-1 mb-1">{{ $facility}})</small>
                                    @endforeach
                                </p>
                                @endif
                            </div>
                        </div>

                    @endforeach

                </div>
            @endif
        </div>

    </section>

@endsection