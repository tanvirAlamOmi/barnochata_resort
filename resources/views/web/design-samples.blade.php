@extends('web.index')

@section('title', 'FAQ')

@section('web_content')

    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" class="carousel slide carousel-fade pointer-event" data-bs-ride="carousel" data-bs-interval="5000">

                <ol id="hero-carousel-indicators" class="carousel-indicators"><li data-bs-target="#heroCarousel" data-bs-slide-to="0" class=""></li><li data-bs-target="#heroCarousel" data-bs-slide-to="1" class="active" aria-current="true"></li><li data-bs-target="#heroCarousel" data-bs-slide-to="2" class=""></li></ol>

                <div class="carousel-inner" role="listbox">

                  <div class="carousel-item active carousel-item-start" style="background-image: url({{ asset('web/assets/img/hero-carousel/slider-5.png')  }})">
                    <div class="carousel-container">
                      <div class="container">
                        <h2 class="animate__animated animate__fadeInDown">The Best Business Information </h2>
                        <p class="animate__animated animate__fadeInUp">We're In The Business Of Helping You Start Your Business</p>
                        <a href="#about" class="btn-get-started scrollto animate__animated animate__fadeInUp">Get Started</a>
                      </div>
                    </div>
                  </div>

                  <div class="carousel-item carousel-item-next carousel-item-start" style="background-image: url({{ asset('web/assets/img/hero-carousel/slider-4.png')  }})">
                    <div class="carousel-container">
                      <div class="container">
                        <h2 class="animate__animated animate__fadeInDown">At vero eos et accusamus</h2>
                        <p class="animate__animated animate__fadeInUp">Helping Business Security &amp; Peace of Mind for Your Family</p>
                        <a href="#about" class="btn-get-started scrollto animate__animated animate__fadeInUp">Get Started</a>
                      </div>
                    </div>
                  </div>

                  <div class="carousel-item" style="background-image: url({{ asset('web/assets/img/hero-carousel/slider-3.png')  }})">
                    <div class="carousel-container">
                      <div class="container">
                        <h2 class="animate__animated animate__fadeInDown">Temporibus autem quibusdam</h2>
                        <p class="animate__animated animate__fadeInUp">Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem</p>
                        <a href="#about" class="btn-get-started scrollto animate__animated animate__fadeInUp">Get Started</a>
                      </div>
                    </div>
                  </div>

                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

            </div>
        </div>
    </section>

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about">
            <div class="container position-relative" data-aos="fade-up">
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
        </section><!-- End About Section -->

        <!-- ======= Speakers Section ======= -->
        <section id="speakers">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Event Speakers</h2>
                    <p>Here are some of our speakers</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ asset('web/assets/img/speakers/1.jpg') }}" alt="Speaker 1" class="img-fluid">
                            <div class="details">
                                <h3><a href="speaker-details.html">Brenden Legros</a></h3>
                                <p>Quas alias incidunt</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="speaker" data-aos="fade-up" data-aos-delay="200">
                            <img src="{{ asset('web/assets/img/speakers/2.jpg') }}" alt="Speaker 2" class="img-fluid">
                            <div class="details">
                                <h3><a href="speaker-details.html">Hubert Hirthe</a></h3>
                                <p>Consequuntur odio aut</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="speaker" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ asset('web/assets/img/speakers/3.jpg') }}" alt="Speaker 3" class="img-fluid">
                            <div class="details">
                                <h3><a href="speaker-details.html">Cole Emmerich</a></h3>
                                <p>Fugiat laborum et</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ asset('web/assets/img/speakers/4.jpg') }}" alt="Speaker 4" class="img-fluid">
                            <div class="details">
                                <h3><a href="speaker-details.html">Jack Christiansen</a></h3>
                                <p>Debitis iure vero</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="speaker" data-aos="fade-up" data-aos-delay="200">
                            <img src="{{ asset('web/assets/img/speakers/5.jpg') }}" alt="Speaker 5" class="img-fluid">
                            <div class="details">
                                <h3><a href="speaker-details.html">Alejandrin Littel</a></h3>
                                <p>Qui molestiae natus</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="speaker" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ asset('web/assets/img/speakers/6.jpg') }}" alt="Speaker 6" class="img-fluid">
                            <div class="details">
                                <h3><a href="speaker-details.html">Willow Trantow</a></h3>
                                <p>Non autem dicta</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- End Speakers Section -->

        <!-- ======= Schedule Section ======= -->
        <section id="schedule" class="section-with-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Event Schedule</h2>
                    <p>Here is our event schedule</p>
                </div>

                <ul class="nav nav-tabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
                    <li class="nav-item">
                        <a class="nav-link active" href="#day-1" role="tab" data-bs-toggle="tab">Day 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#day-2" role="tab" data-bs-toggle="tab">Day 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#day-3" role="tab" data-bs-toggle="tab">Day 3</a>
                    </li>
                </ul>

                <h3 class="sub-heading">Voluptatem nulla veniam soluta et corrupti consequatur neque eveniet officia. Eius
                necessitatibus voluptatem quis labore perspiciatis quia.</h3>

                <div class="tab-content row justify-content-center" data-aos="fade-up" data-aos-delay="200">

                    <!-- Schdule Day 1 -->
                    <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>09:30 AM</time></div>
                            <div class="col-md-10">
                                <h4>Registration</h4>
                                <p>Fugit voluptas iusto maiores temporibus autem numquam magnam.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>10:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/1.jpg') }}" alt="Brenden Legros">
                                </div>
                                <h4>Keynote <span>Brenden Legros</span></h4>
                                <p>Facere provident incidunt quos voluptas.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>11:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/2.jpg') }}" alt="Hubert Hirthe">
                                </div>
                                <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                                <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>12:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/3.jpg') }}" alt="Cole Emmerich">
                                </div>
                                <h4>Explicabo et rerum quis et ut ea. <span>Cole Emmerich</span></h4>
                                <p>Veniam accusantium laborum nihil eos eaque accusantium aspernatur.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>02:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/4.jpg') }}" alt="Jack Christiansen">
                                </div>
                                <h4>Qui non qui vel amet culpa sequi. <span>Jack Christiansen</span></h4>
                                <p>Nam ex distinctio voluptatem doloremque suscipit iusto.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>03:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/5.jpg') }}" alt="Alejandrin Littel">
                                </div>
                                <h4>Quos ratione neque expedita asperiores. <span>Alejandrin Littel</span></h4>
                                <p>Eligendi quo eveniet est nobis et ad temporibus odio quo.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>04:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/6.jpg') }}" alt="Willow Trantow">
                                </div>
                                <h4>Quo qui praesentium nesciunt <span>Willow Trantow</span></h4>
                                <p>Voluptatem et alias dolorum est aut sit enim neque veritatis.</p>
                            </div>
                        </div>

                    </div>
                    <!-- End Schdule Day 1 -->

                    <!-- Schdule Day 2 -->
                    <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-2">

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>10:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/1.jpg') }}" alt="Brenden Legros">
                                </div>
                                <h4>Libero corrupti explicabo itaque. <span>Brenden Legros</span></h4>
                                <p>Facere provident incidunt quos voluptas.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>11:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/2.jpg') }}" alt="Hubert Hirthe">
                                </div>
                                <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                                <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>12:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/3.jpg') }}" alt="Cole Emmerich">
                                </div>
                                <h4>Explicabo et rerum quis et ut ea. <span>Cole Emmerich</span></h4>
                                <p>Veniam accusantium laborum nihil eos eaque accusantium aspernatur.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>02:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/4.jpg') }}" alt="Jack Christiansen">
                                </div>
                                <h4>Qui non qui vel amet culpa sequi. <span>Jack Christiansen</span></h4>
                                <p>Nam ex distinctio voluptatem doloremque suscipit iusto.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>03:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/5.jpg') }}" alt="Alejandrin Littel">
                                </div>
                                <h4>Quos ratione neque expedita asperiores. <span>Alejandrin Littel</span></h4>
                                <p>Eligendi quo eveniet est nobis et ad temporibus odio quo.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>04:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/6.jpg') }}" alt="Willow Trantow">
                                </div>
                                <h4>Quo qui praesentium nesciunt <span>Willow Trantow</span></h4>
                                <p>Voluptatem et alias dolorum est aut sit enim neque veritatis.</p>
                            </div>
                        </div>

                    </div>
                    <!-- End Schdule Day 2 -->

                    <!-- Schdule Day 3 -->
                    <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-3">

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>10:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/2.jpg') }}" alt="Hubert Hirthe">
                                </div>
                                <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                                <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>11:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/3.jpg') }}" alt="Cole Emmerich">
                                </div>
                                <h4>Explicabo et rerum quis et ut ea. <span>Cole Emmerich</span></h4>
                                <p>Veniam accusantium laborum nihil eos eaque accusantium aspernatur.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>12:00 AM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/1.jpg') }}" alt="Brenden Legros">
                                </div>
                                <h4>Libero corrupti explicabo itaque. <span>Brenden Legros</span></h4>
                                <p>Facere provident incidunt quos voluptas.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>02:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/4.jpg') }}" alt="Jack Christiansen">
                                </div>
                                <h4>Qui non qui vel amet culpa sequi. <span>Jack Christiansen</span></h4>
                                <p>Nam ex distinctio voluptatem doloremque suscipit iusto.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>03:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/5.jpg') }}" alt="Alejandrin Littel">
                                </div>
                                <h4>Quos ratione neque expedita asperiores. <span>Alejandrin Littel</span></h4>
                                <p>Eligendi quo eveniet est nobis et ad temporibus odio quo.</p>
                            </div>
                        </div>

                        <div class="row schedule-item">
                            <div class="col-md-2"><time>04:00 PM</time></div>
                            <div class="col-md-10">
                                <div class="speaker">
                                    <img src="{{ asset('web/assets/img/speakers/6.jpg') }}" alt="Willow Trantow">
                                </div>
                                <h4>Quo qui praesentium nesciunt <span>Willow Trantow</span></h4>
                                <p>Voluptatem et alias dolorum est aut sit enim neque veritatis.</p>
                            </div>
                        </div>

                    </div>
                    <!-- End Schdule Day 2 -->

                </div>

            </div>

        </section><!-- End Schedule Section -->

        <!-- ======= Venue Section ======= -->
        <section id="venue">

            <div class="container-fluid" data-aos="fade-up">

                <div class="section-header">
                    <h2>Event Venue</h2>
                    <p>Event venue location info and gallery</p>
                </div>

                <div class="row g-0">
                    <div class="col-lg-6 venue-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>

                    <div class="col-lg-6 venue-info">
                        <div class="row justify-content-center">
                            <div class="col-11 col-lg-8 position-relative">
                                <h3>Downtown Conference Center, New York</h3>
                                <p>Iste nobis eum sapiente sunt enim dolores labore accusantium autem. Cumque beatae ipsam. Est quae sit qui voluptatem corporis velit. Qui maxime accusamus possimus. Consequatur sequi et ea suscipit enim nesciunt quia velit.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container-fluid venue-gallery-container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-0">

                    <div class="col-lg-3 col-md-4">
                        <div class="venue-gallery">
                            <a href="{{ asset('web/assets/img/venue-gallery/1.jpg') }}" class="glightbox" data-gall="venue-gallery">
                                <img src="{{ asset('web/assets/img/venue-gallery/1.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="venue-gallery">
                            <a href="{{ asset('web/assets/img/venue-gallery/2.jpg') }}" class="glightbox" data-gall="venue-gallery">
                                <img src="{{ asset('web/assets/img/venue-gallery/2.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="venue-gallery">
                            <a href="{{ asset('web/assets/img/venue-gallery/3.jpg') }}" class="glightbox" data-gall="venue-gallery">
                                <img src="{{ asset('web/assets/img/venue-gallery/3.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="venue-gallery">
                            <a href="{{ asset('web/assets/img/venue-gallery/4.jpg') }}" class="glightbox" data-gall="venue-gallery">
                                <img src="{{ asset('web/assets/img/venue-gallery/4.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="venue-gallery">
                            <a href="{{ asset('web/assets/img/venue-gallery/5.jpg') }}" class="glightbox" data-gall="venue-gallery">
                                <img src="{{ asset('web/assets/img/venue-gallery/5.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="venue-gallery">
                            <a href="{{ asset('web/assets/img/venue-gallery/6.jpg') }}" class="glightbox" data-gall="venue-gallery">
                                <img src="{{ asset('web/assets/img/venue-gallery/6.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="venue-gallery">
                            <a href="{{ asset('web/assets/img/venue-gallery/7.jpg') }}" class="glightbox" data-gall="venue-gallery">
                                <img src="{{ asset('web/assets/img/venue-gallery/7.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="venue-gallery">
                            <a href="{{ asset('web/assets/img/venue-gallery/8.jpg') }}" class="glightbox" data-gall="venue-gallery">
                                <img src="{{ asset('web/assets/img/venue-gallery/8.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </section><!-- End Venue Section -->

        <!-- ======= Hotels Section ======= -->
        <section id="hotels" class="section-with-bg">

            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Hotels</h2>
                    <p>Her are some nearby hotels</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-4 col-md-6">
                        <div class="hotel">
                            <div class="hotel-img">
                                <img src="{{ asset('web/assets/img/hotels/1.jpg') }}" alt="Hotel 1" class="img-fluid">
                            </div>
                            <h3><a href="#">Hotel 1</a></h3>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p>0.4 Mile from the Venue</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="hotel">
                            <div class="hotel-img">
                                <img src="{{ asset('web/assets/img/hotels/2.jpg') }}" alt="Hotel 2" class="img-fluid">
                            </div>
                            <h3><a href="#">Hotel 2</a></h3>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill-half-full"></i>
                            </div>
                            <p>0.5 Mile from the Venue</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="hotel">
                            <div class="hotel-img">
                                <img src="{{ asset('web/assets/img/hotels/3.jpg') }}" alt="Hotel 3" class="img-fluid">
                            </div>
                            <h3><a href="#">Hotel 3</a></h3>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p>0.6 Mile from the Venue</p>
                        </div>
                    </div>

                </div>
            </div>

        </section><!-- End Hotels Section -->

        <!-- ======= Gallery Section ======= -->
        <section id="gallery">

            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Gallery</h2>
                    <p>Check our gallery from the recent events</p>
                </div>
            </div>

            <div class="gallery-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><a href="{{ asset('web/assets/img/gallery/1.jpg') }}" class="gallery-lightbox"><img src="{{ asset('web/assets/img/gallery/1.jpg') }}" class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a href="{{ asset('web/assets/img/gallery/2.jpg') }}" class="gallery-lightbox"><img src="{{ asset('web/assets/img/gallery/2.jpg') }}" class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a href="{{ asset('web/assets/img/gallery/3.jpg') }}" class="gallery-lightbox"><img src="{{ asset('web/assets/img/gallery/3.jpg') }}" class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a href="{{ asset('web/assets/img/gallery/4.jpg') }}" class="gallery-lightbox"><img src="{{ asset('web/assets/img/gallery/4.jpg') }}" class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a href="{{ asset('web/assets/img/gallery/5.jpg') }}" class="gallery-lightbox"><img src="{{ asset('web/assets/img/gallery/5.jpg') }}" class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a href="{{ asset('web/assets/img/gallery/6.jpg') }}" class="gallery-lightbox"><img src="{{ asset('web/assets/img/gallery/6.jpg') }}" class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a href="{{ asset('web/assets/img/gallery/7.jpg') }}" class="gallery-lightbox"><img src="{{ asset('web/assets/img/gallery/7.jpg') }}" class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a href="{{ asset('web/assets/img/gallery/8.jpg') }}" class="gallery-lightbox"><img src="{{ asset('web/assets/img/gallery/8.jpg') }}" class="img-fluid" alt=""></a></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </section><!-- End Gallery Section -->

        <!-- ======= Supporters Section ======= -->
        <section id="supporters" class="section-with-bg">

            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Sponsors</h2>
                </div>

                <div class="row no-gutters supporters-wrap clearfix" data-aos="zoom-in" data-aos-delay="100">

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="{{ asset('web/assets/img/supporters/1.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="{{ asset('web/assets/img/supporters/2.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="{{ asset('web/assets/img/supporters/3.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="{{ asset('web/assets/img/supporters/4.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="{{ asset('web/assets/img/supporters/5.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="{{ asset('web/assets/img/supporters/6.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="{{ asset('web/assets/img/supporters/7.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="{{ asset('web/assets/img/supporters/8.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Sponsors Section -->

        <!-- =======  F.A.Q Section ======= -->
        <section id="faq">

            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>F.A.Q </h2>
                </div>

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-9">

                        <ul class="faq-list">

                            <li>
                                <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                                    </p>
                                </div>
                            </li>

                        </ul>

                    </div>
                </div>

            </div>

        </section><!-- End  F.A.Q Section -->

        <!-- ======= Subscribe Section ======= -->
        <section id="subscribe">
            <div class="container" data-aos="zoom-in">
                <div class="section-header">
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
        </section><!-- End Subscribe Section -->

        <!-- ======= Buy Ticket Section ======= -->
        <section id="buy-tickets" class="section-with-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Buy Tickets</h2>
                    <p>Velit consequatur consequatur inventore iste fugit unde omnis eum aut.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Standard Access</h5>
                                <h6 class="card-price text-center">$150</h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Community Access</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Workshop Access</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>After Party</li>
                                </ul>
                                <hr>
                                <div class="text-center">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" data-ticket-type="standard-access">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Pro Access</h5>
                                <h6 class="card-price text-center">$250</h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Workshop Access</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>After Party</li>
                                </ul>
                                <hr>
                                <div class="text-center">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" data-ticket-type="pro-access">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pro Tier -->
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Premium Access</h5>
                                <h6 class="card-price text-center">$350</h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Workshop Access</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>After Party</li>
                                </ul>
                                <hr>
                                <div class="text-center">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" data-ticket-type="premium-access">Buy Now</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal Order Form -->
            <div id="buy-ticket-modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Buy Tickets</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="your-name" placeholder="Your Name">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="your-email" placeholder="Your Email">
                                </div>
                                <div class="form-group mt-3">
                                    <select id="ticket-type" name="ticket-type" class="form-select">
                                        <option value="">-- Select Your Ticket Type --</option>
                                        <option value="standard-access">Standard Access</option>
                                        <option value="pro-access">Pro Access</option>
                                        <option value="premium-access">Premium Access</option>
                                    </select>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn">Buy Now</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </section><!-- End Buy Ticket Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="section-bg">

            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Contact Us</h2>
                    <p>Nihil officia ut sint molestiae tenetur.</p>
                </div>

                <div class="row contact-info">

                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <address>A108 Adam Street, NY 535022, USA</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="bi bi-phone"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:info@example.com">info@example.com</a></p>
                        </div>
                    </div>

                </div>

                <div class="form">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>
        </section><!-- End Contact Section -->

    </main>

@endsection