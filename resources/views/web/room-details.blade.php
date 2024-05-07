@extends('web.index')

@section('title', $room->title)

@section('web_content')

	<section id="hotels">

        <div class="container">
            <div class="section-header">
                <h2 class="mb-5">{{ $room->title }}</h2>
            </div>

            <div class="row justify-content-center mb-3">
                <div class="col-lg-8 col-md-7">
                    <div id="imageSlider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ $room->default_image }}" class="d-block w-100" alt="..." />
                            </div>
                            @if(count($room->room_images) > 0)
                                @foreach($room->room_images as $i => $room_image)
                                <div class="carousel-item">
                                    <img src="{{ $room_image->image }}" class="d-block w-100" alt="..." />
                                </div>
                                @endforeach
                            @endif
                        </div>
                        @if(count($room->room_images) > 0)
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
                <div class="col-lg-4 col-md-5">
                    <div class="d-block">
                        <strong>Price:</strong> <span class="">{{ $room->price_currency }}</span>
                    </div>
                    <div class="d-block">
                        <strong>Capacity:</strong> <span class="">{{ $room->guest_capacity }} Person</span>
                    </div>
                    <div class="d-block">
                        <strong>Additional Price Per Adult:</strong> <span class="">{{ $room->extra_person_per_adult. ' ' . config('app.base_currency') }}</span>
                    </div>
                    <div class="d-block">
                        <strong>Additional Price Per Child:</strong> <span class="">{{ $room->extra_person_per_child. ' ' . config('app.base_currency') }}</span>
                    </div>
                    <div class="d-block">
                        <strong>Facilities:</strong> <span class="">{{ $room->facilities }}</span>
                    </div>
                    <div class="d-block mt-2">
                        {!! $room->description !!}
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection