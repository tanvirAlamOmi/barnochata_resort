@extends('web.index')

@section('title', 'Home')

@section('web_content')

    @if(!empty($slides) && count($slides) > 0)
        <section class="container-fluid pl-0 pr-0">
            <div id="introCarousel" class="carousel slide carousel-fade">
                <div class="carousel-inner">

                    @foreach($slides as $s => $slide)
                        <div class="carousel-item {{ $s == 0 ? 'active' : '' }}">
                            <img src="{{ $slide->image_path  }}" class="d-block" alt="...">
                            @if(!empty($slide->caption))
                            <div class="carousel-caption">
                                <div class="caption-container">
                                    <h2 class="text-light">{{ $slide->caption }}</h2>
                                </div>
                            </div>
                            @endif
                        </div>
                    @endforeach

                    <button class="carousel-control-prev" type="button" data-bs-target="#introCarousel" data-bs-slide="prev">
                        <span class="controller-icon" aria-hidden="true">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#introCarousel" data-bs-slide="next">
                        <span class="controller-icon" aria-hidden="true">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
    @endif

    <main id="main">

    <section id="book-now" class="book-now justify-content-center pt-5 pb-5">
            <div class="container">
                <div class="card book-card">
                    <div class="card-body">
                        <!-- <h3 class="text-center book-title"><b>BOOK NOW</b></h3> -->
                        <form action="{{ route('book-now') }}" method="GET">
                            <div class="container">
                                <div class="row  book-form">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <label for="from_date" class="control-label">Arrival Date</label>
                                            <input type="date" class="form-control" id="from_date" name="from_date" value="" min="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <label for="to_date" class="control-label">Departure Date</label>
                                            <input type="date" class="form-control" id="to_date" name="to_date" value="" min="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <label for="total_adult" class="control-label">Adult</label>
                                            <input type="text" class="form-control quantity_class text-right" id="total_adult" name="total_adult" value="1" min="1" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <label for="total_child" class="control-label">Child</label>
                                            <input type="text" class="form-control quantity_class text-right" id="total_child" name="total_child" value="0" min="0" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <button class="btn">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="hotels" class="section-with-bg">

            <div class="container">
                <div class="section-header mb-3">
                    <h2>Rooms & Suites</h2>
                    <p class="mb-0">Our Creations to make you feel RELAXED!</p>
                </div>

                <div class="row justify-content-center">

                    @if(count($rooms) > 0)
                        @foreach($rooms as $r => $room)
                            <div class="col-lg-4 col-md-4 d-flex align-items-stretch">
                                <div class="hotel box-shadow-1">
                                    <div class="hotel-img">
                                        <img src="{{ $room->default_image }}" alt="Hotel 2" class="img-fluid">
                                    </div>
                                    <h3>
                                        <a class="room-title" href="{{ route('room-details',['slug' => $room->slug]) }}">{{ $room->title }}</a>
                                        <small class="pull-right"><b class="text-secondary">{{ $room->price_currency }}</b></small>
                                    </h3>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill-half-full"></i>
                                        </div>
                                        <a class="btn btn-sm btn-theme mb-3 mr-20 book-now-btn" href="{{ route('book-now') }}" data-id="{{ $room->id }}" href="#">Book Now</a>
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
                        <form action="{{ route('book-now') }}" id="book-now-form" method="GET" class="hidden-input">
                            <input type="hidden" id="roomId" name="roomId">
                        </form>
                    @endif

                </div>
            </div>

        </section>

        @if(count($packages) > 0)
        <section class="pt-5">
            <div class="container">
                <div class="section-header mb-3">
                    <h2>Packages</h2>
                    <p class="mb-0">Get the best within awesome packages</p>
                </div>

                @foreach($packages as $p => $package)
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card box-shadow-1">
                                <div class="card-body">
                                    <h4 class="mb-2">
                                        <b>{{ $package->title }}</b>
                                        <small class="pull-right">{{ $package->duration }}</small>
                                    </h4>
                                    <div>
                                        Service Included: 
                                        @foreach($package->package_addons as $pa => $package_addons)
                                            <small class="badge bg-light text-secondary border p-1 mb-1">{{ $package_addons->addons->title }} ({{ $package_addons->counter }})</small>
                                        @endforeach
                                    </div>

                                    <div class="row mt-2">
                                        @foreach($package->package_rooms as $pr => $package_room)
                                        <div class="col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="{{ $package_room->room->default_image }}" alt="{{ $package_room->room->title }}" class="img-fluid">

                                                    <div class="col-12 mt-2 mb-1">
                                                        Room/Suita/Cottage <strong class="pull-right">{{ $package_room->room->title }}</strong>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        Price <strong class="pull-right">{{ $package_room->price }} {{ config('app.base_currency') }}</strong>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        Default Guest <strong class="pull-right">{{ $package_room->default_guest }} Person</strong>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        Extra Adult <strong class="pull-right">{{ $package_room->extra_person_per_adult }} {{ config('app.base_currency') }}</strong>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        Extra Child <strong class="pull-right">{{ $package_room->extra_person_per_child }} {{ config('app.base_currency') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif

        <section id="hotels" class="section-with-bg bg-white">

            <div class="container">
                <div class="section-header mb-3">
                    <h2>Outdoors</h2>
                    <p class="mb-0">Our Creations to make you feel better</p>
                </div>

                <div class="row" data-aos-delay="100">

                    @if(count($outdoors) > 0)
                        @foreach($outdoors as $o => $outdoor)
                            <div class="col-lg-3 col-md-6">
                                <div class="hotel box-shadow-1">
                                    <div class="hotel-img">
                                        <img src="{{ $outdoor->default_image }}" alt="{{ $outdoor->title }}" class="img-fluid">
                                    </div>
                                    <h3 class="text-center mb-2"><a href="#">{{ $outdoor->title }}</a></h3>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

        </section>

        <!-- <section id="venue" class="">

            <div class="container" data-aos-delay="100">
                <div class="section-header mb-3">
                    <h2>Restaurants</h2>
                    <p>Event venue location info and gallery</p>
                </div>

                <section class="row">
                    <div class="container">
                        <div class="row">
                            
                            <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                <div class="card">
                                  <img src="{{ asset('web/assets/img/rooms1.png') }}" alt="Hotel 2" class="img-fluid card-img-top">
                                  <div class="card-body">
                                    <h4 class="card-title item-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                <div class="card">
                                  <img src="{{ asset('web/assets/img/rooms1.png') }}" alt="Hotel 2" class="img-fluid card-img-top">
                                  <div class="card-body">
                                    <h4 class="card-title item-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                <div class="card">
                                  <img src="{{ asset('web/assets/img/rooms1.png') }}" alt="Hotel 2" class="img-fluid card-img-top">
                                  <div class="card-body">
                                    <h4 class="card-title item-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                <div class="card">
                                  <img src="{{ asset('web/assets/img/rooms1.png') }}" alt="Hotel 2" class="img-fluid card-img-top">
                                  <div class="card-body">
                                    <h4 class="card-title item-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                <div class="card">
                                  <img src="{{ asset('web/assets/img/rooms1.png') }}" alt="Hotel 2" class="img-fluid card-img-top">
                                  <div class="card-body">
                                    <h4 class="card-title item-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                <div class="card">
                                  <img src="{{ asset('web/assets/img/rooms1.png') }}" alt="Hotel 2" class="img-fluid card-img-top">
                                  <div class="card-body">
                                    <h4 class="card-title item-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                <div class="card">
                                  <img src="{{ asset('web/assets/img/rooms1.png') }}" alt="Hotel 2" class="img-fluid card-img-top">
                                  <div class="card-body">
                                    <h4 class="card-title item-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2 mt-2">
                                <div class="card">
                                  <img src="{{ asset('web/assets/img/rooms1.png') }}" alt="Hotel 2" class="img-fluid card-img-top">
                                  <div class="card-body">
                                    <h4 class="card-title item-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </section> -->

        @if(!empty($recent_photos) && count($recent_photos) > 0)
        <section id="gallery" class="bg-light">

            <div class="container">
                <div class="section-header mb-5">
                    <h2>Recent Photos</h2>
                </div>
            </div>

            <div class="gallery-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    @foreach($recent_photos as $r => $photo)
                        <div class="swiper-slide"><a href="{{ $photo->image_path }}" class="gallery-lightbox"><img src="{{ $photo->image_path }}" class="img-fluid" alt=""></a></div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </section>
        @endif

        <!-- ======= Supporters Section ======= -->
        <section id="supporters" class="section-with-bg">

            <div class="container">
                <div class="section-header mb-3">
                    <h2>Addons</h2>
                    <p>We serve to get your happy smile!</p>
                </div>

                <div class="row clearfix justify-content-center">

                    @if(count($addons) > 0)
                        @foreach($addons as $s => $addon)
                            <div class="col-lg-3 col-md-4 col-xs-6 mb-3 ">
                                <div class="supporter-logo box-shadow-1">
                                    <div class="addons-name">{{ $addon->title }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

            </div>

        </section><!-- End Sponsors Section -->

        <!-- ======= About Section ======= -->
        <!-- <section id="about" class="">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>About The Event</h2>
                        <p>Sed nam ut dolor qui repellendus iusto odit. Possimus inventore eveniet accusamus error amet eius aut
                            accusantium et. Non odit consequatur repudiandae sequi ea odio molestiae. Enim possimus sunt inventore in
                        est ut optio sequi unde.</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>Where</h3>
                        <p>Downtown Conference Center, New York</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>When</h3>
                        <p>Monday to Wednesday<br>10-12 December</p>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- ======= Subscribe Section ======= -->
        <section id="subscribe">
            <div class="container" data-aos="zoom-in">
                <div class="section-header mb-3">
                    <h2>Newsletter</h2>
                    <p>Rerum numquam illum recusandae quia mollitia consequatur.</p>
                </div>

                <form method="POST" action="#">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-10 d-flex">
                            <input type="text" class="form-control" placeholder="Enter your Email">
                            <button type="submit" class="ms-2">Subscribe</button>
                        </div>
                    </div>
                </form>

            </div>
        </section>

    </main>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const today = {!! json_encode(date('Y-m-d')) !!};
            $('#roomId').val('');
            
            $('#from_date').attr('min', today);
            $('#to_date').attr('min', today);

            $('#from_date').change(function(){
                $('#to_date').attr('min', $(this).val());
            });

            // $('.book-now-btn').click(function(e){
            //     e.preventDefault();
            //     $('#roomId').val($(this).data('id'));
            //     $('#book-now-form').submit()
            // });
        });
    </script>
@endpush