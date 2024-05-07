@extends('web.index')

@section('title', 'Home')

@section('web_content')

    <!-- page-title -->
    <section class="page-title centred" style="background-image: url({{ asset('Panola/images/background/page-title.jpg')  }});">
        <div class="container">
            <div class="content-box">
                <div class="title">About Us</div>
                <ul class="bread-crumb">
                    <li><a href="index.html">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->


    <!-- about-section -->
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="about-content">
                        <div class="sec-title left">Panola Hotel</div>
                        <div class="text">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde omnis natus error.</div>
                        <div class="text">Inventore veritatis et quasi architebeatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem.</div>
                        <div class="link"><a href="#" class="theme-btn-two">About Us</a></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 clearfix">
                    <div class="img-box">
                        <figure class="img-three wow zoomIn animated"><img src="{{ asset('Panola/images/resource/3.jpg') }}" alt=""></figure>
                        <figure class="img-two wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="{{ asset('Panola/images/resource/2.jpg') }}" alt=""></figure>
                        <figure class="img-one wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="{{ asset('Panola/images/resource/1.jpg') }}" alt=""></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->


    <!-- video-section -->
    <section class="video-section" style="background-image: url({{ asset('Panola/images/background/1.jpg')  }});">
        <div class="title centred">Enjoy your holiday</div>
        <div class="video-gallery">
            <div class="overlay-gallery">
                <div class="icon-holder">
                    <div class="icon">
                        <a class="html5lightbox" title="Video" href="https://youtu.be/yVb0mfmMV9w"><i class="flaticon-play"></i></a> 
                    </div>
                </div>    
            </div>
        </div>
    </section>
    <!-- video-section end -->


    <!-- service-section -->
    <section class="service-section sec-pad">
        <div class="container">
            <div class="top-title">
                <div class="sec-title">Our Services</div>
                <div class="title-text">Excepteur sint occaecat cupidatat</div>
            </div>
            <div class="custom-tab-title">
                <ul class="tab-title clearfix">
                    <li data-tab-name="details" class="active">
                        <div class="single-btn">
                            <div class="icon-box"><i class="flaticon-coffee-cup"></i></div>
                            <div class="text">Restaurent</div>
                        </div>
                    </li>
                    <li data-tab-name="review">
                        <div class="single-btn">
                            <div class="icon-box"><i class="flaticon-mortar"></i></div>
                            <div class="text">Health & Beauty</div>
                        </div>
                    </li>
                    <li data-tab-name="review1">
                        <div class="single-btn">
                            <div class="icon-box"><i class="flaticon-swimming-pool"></i></div>
                            <div class="text">Swimming Pool</div>
                        </div>
                    </li>
                    <li data-tab-name="review2">
                        <div class="single-btn">
                            <div class="icon-box"><i class="flaticon-lecture"></i></div>
                            <div class="text">Conference Room</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-details-content">
                <div class="tab-content" id="details">
                    <div class="single-tab-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="img-box"><img src="images/resource/7.jpg" alt=""></div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="content">
                                    <div class="title">Restaurent</div>
                                    <div class="text">
                                        <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde omnis natus error.Inventore veritatis et quasi architebeatae vitae dicta sunt explicabonemo enim ipsam voluptatem quia voluptassit.aspernatur aut odit aut fugit, sed quia consequuntur</p>
                                        <p>Magni dolores eos qui ratione voluptatem sequi nesciunt.neque porro quisquam est qui dolore ipsum quia dolor sit amet, consectetur adipisci velit sed quia.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="review">
                    <div class="single-tab-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="img-box"><img src="{{ asset('Panola/images/resource/service-2.jpg') }}" alt=""></div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="content">
                                    <div class="title">Health & Beauty</div>
                                    <div class="text">
                                        <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde omnis natus error.Inventore veritatis et quasi architebeatae vitae dicta sunt explicabonemo enim ipsam voluptatem quia voluptassit.aspernatur aut odit aut fugit, sed quia consequuntur</p>
                                        <p>Magni dolores eos qui ratione voluptatem sequi nesciunt.neque porro quisquam est qui dolore ipsum quia dolor sit amet, consectetur adipisci velit sed quia.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="review1">
                    <div class="single-tab-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="img-box"><img src="{{ asset('Panola/images/resource/service-3.jpg') }}" alt=""></div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="content">
                                    <div class="title">Swimming Pool</div>
                                    <div class="text">
                                        <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde omnis natus error.Inventore veritatis et quasi architebeatae vitae dicta sunt explicabonemo enim ipsam voluptatem quia voluptassit.aspernatur aut odit aut fugit, sed quia consequuntur</p>
                                        <p>Magni dolores eos qui ratione voluptatem sequi nesciunt.neque porro quisquam est qui dolore ipsum quia dolor sit amet, consectetur adipisci velit sed quia.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="review2">
                    <div class="single-tab-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="img-box"><img src="{{ asset('Panola/images/resource/service-4.jpg') }}" alt=""></div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="content">
                                    <div class="title">Conference Room</div>
                                    <div class="text">
                                        <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde omnis natus error.Inventore veritatis et quasi architebeatae vitae dicta sunt explicabonemo enim ipsam voluptatem quia voluptassit.aspernatur aut odit aut fugit, sed quia consequuntur</p>
                                        <p>Magni dolores eos qui ratione voluptatem sequi nesciunt.neque porro quisquam est qui dolore ipsum quia dolor sit amet, consectetur adipisci velit sed quia.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-section end -->


    <!-- fact-counter -->
    <section class="fact-counter gray-bg sec-pad centred">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="single-item">
                        <div class="content-box">
                            <div class="icon-box"><i class="flaticon-bed"></i></div>
                            <article class="column wow fadeIn" data-wow-duration="0ms">
                                <div class="count-outer"><span class="count-text" data-speed="1500" data-stop="50">0</span></div>
                            </article>
                            <div class="text">Rooms</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="single-item">
                        <div class="content-box">
                            <div class="icon-box"><i class="flaticon-bell-boy"></i></div>
                            <article class="column wow fadeIn" data-wow-duration="0ms">
                                <div class="count-outer"><span class="count-text" data-speed="1500" data-stop="25">0</span></div>
                            </article>
                            <div class="text">Staffs</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="single-item">
                        <div class="content-box">
                            <div class="icon-box"><i class="flaticon-swimming-pool"></i></div>
                            <article class="column wow fadeIn" data-wow-duration="0ms">
                                <div class="count-outer"><span>0</span><span class="count-text" data-speed="1500" data-stop="3">0</span></div>
                            </article>
                            <div class="text">Swimming Pool</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 column">
                    <div class="single-item">
                        <div class="content-box">
                            <div class="icon-box"><i class="flaticon-medal"></i></div>
                            <article class="column wow fadeIn" data-wow-duration="0ms">
                                <div class="count-outer"><span class="count-text" data-speed="1500" data-stop="79">0</span></div>
                            </article>
                            <div class="text">Awards Win</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- fact-counter end -->


    <!-- testimonial-section -->
    <section class="testimonial-section sec-pad centred">
        <div class="container">
            <div class="top-title">
                <div class="sec-title">What Other Say?</div>
                <div class="title-text">Excepteur sint occaecat cupidatat</div>
            </div>
            <div class="three-column-carousel">
                <div class="testimonial-content">
                    <figure class="thumb-box"><img src="{{ asset('Panola/images/resource/t1.png') }}" alt=""></figure>
                    <div class="author">Erica Romaguera</div>
                    <div class="title">Designer</div>
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor inciduntut labore.</p>
                    </div>
                </div>
                <div class="testimonial-content">
                    <figure class="thumb-box"><img src="{{ asset('Panola/images/resource/t2.png') }}" alt=""></figure>
                    <div class="author">Kole Bednar</div>
                    <div class="title">Designer</div>
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor inciduntut labore.</p>
                    </div>
                </div>
                <div class="testimonial-content">
                    <figure class="thumb-box"><img src="{{ asset('Panola/images/resource/t3.png') }}" alt=""></figure>
                    <div class="author">Camila Hintz</div>
                    <div class="title">Designer</div>
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor inciduntut labore.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-section end -->

@endsection