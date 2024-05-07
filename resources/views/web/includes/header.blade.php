@php
    $outdoors = getMenubySlug('outdoors');
    $services = getMenubySlug('services-&-facilities');
    $app_info = appInfo();
@endphp
<!-- ======= Header ======= -->
        <div class="top-bar">
            <div class="container-fluid container-xxl">
                <div class="row">
                    <div class="col-lg-10 col-md-9 col-sm-8 col-6 top-bar-link-box">
                        @if(!empty($app_info['email']))
                            <small class="top-bar-link email-link"><i class="bi bi-envelope"></i> {{$app_info['email']}}</small>
                        @endif
                        @if(!empty($app_info['mobile-number']))
                            <small class="top-bar-link"><i class="bi bi-phone"></i> {{$app_info['mobile-number']}}</small>
                        @endif
                        <span class="ml-5 follow-us-label"><small>Follow Us: </small></span>
                        
                        @if(!empty($app_info['facebook-link']))
                            <small class="top-bar-link ml-3 d-xs-none">
                                <a class="social-media-icon" href="https://facebook.com/{{$app_info['facebook-link']}}" target="_blank"><i class="bi bi-facebook"></i></a>
                            </small>
                        @endif
                        
                        @if(!empty($app_info['youtube-link']))
                            <small class="top-bar-link d-xs-none">
                                <a class="social-media-icon" href="https://youtube.com/{{$app_info['youtube-link']}}" target="_blank"><i class="bi bi-youtube"></i></a>
                            </small>
                        @endif

                        @if(!empty($app_info['instagram-link']))
                            <small class="top-bar-link d-xs-none">
                                <a class="social-media-icon" href="https://instagram.com/{{$app_info['instagram-link']}}" target="_blank"><i class="bi bi-instagram"></i></a>
                            </small>
                        @endif

                        @if(!empty($app_info['twitter-link']))
                            <small class="top-bar-link d-xs-none">
                                <a class="social-media-icon" href="https://twitter.com/{{$app_info['twitter-link']}}" target="_blank"><i class="bi bi-twitter"></i></a>
                            </small>
                        @endif
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 top-bar-link-box text-right">
                        @auth
                        <!-- <small class="top-bar-link">
                            <a class="social-media-icon" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> <span>Sign Up</span></a>
                        </small>
                        <small class="top-bar-link">
                            <a class="social-media-icon" href="{{ route('login') }}"><i class="fa fa-sign-in"></i> <span>Sign In</span></a>
                        </small> -->
                        <small class="top-bar-link btn-group">
                            <a class="social-media-icon" data-bs-toggle="dropdown" href="#account-menu"><i class="fa fa-user"></i> <span>{{ Auth::user()->name }}</span></a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                @if(Auth::user()->weight >= 50)
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                @endif
                                <li><a class="dropdown-item" href=""><i class="fa fa-address-book"></i> <span>Account</span></a></li>
                                <li><a class="dropdown-item" href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </small>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <header id="header" class="d-flex align-items-center header-scrolled">
            <div class="container-fluid container-xxl d-flex align-items-center">

                <div id="logo" class="me-auto">
                    <a href="{{ route('/') }}" class=""><img src="{{ asset('imgs/brncht-logo.jpg') }}" alt="" title="" class="">
                        <div class="title font-prompt">
                            BARN<img src="{{ asset('imgs/brncht-logo.jpg') }}" alt="" class="title-o"><span class="text-o">O</span>CHATA
                        </div>
                    </a>
                </div>

                <nav id="navbar" class="navbar order-last order-lg-0">
                    <ul>
                        <li><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                        <li><a class="nav-link" href="{{ route('rooms-&-suits') }}">Rooms & Suits</a></li>
                        <li class="dropdown"><a href="#"><span>Outdoors</span></a>
                          <ul class="mb-0">
                            @if(!empty($outdoors) && count($outdoors->submenus) > 0)
                                @foreach($outdoors->submenus as $o => $outdoor)
                                    <li><a href="{{ route('outdoors',['slug' => $outdoor->slug]) }}">{{ $outdoor->name }}</a></li>
                                @endforeach
                            @endif
                          </ul>
                        </li>
                        <li class="dropdown"><a href="#"><span>Services & Facilities</span></a>
                          <ul class="mb-0">
                            @if(!empty($services) && count($services->submenus) > 0)
                                @foreach($services->submenus as $o => $service)
                                    <li><a href="{{ route('service-&-facilities',['slug' => $service->slug]) }}">{{ $service->name }}</a></li>
                                @endforeach
                            @endif
                          </ul>
                        </li>
                        <li><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
                        <li><a class="nav-link" href="{{ route('payment') }}">Payment</a></li>
                        <li class="dropdown"><a href="#"><span>About</span></a>
                          <ul>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                            <li><a href="{{ route('terms-&-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('directors') }}">Directors</a></li>
                          </ul>
                        </li>
                        <!-- <li><a class="nav-link" href="{{ route('contact') }}">Contact</a></li> -->
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
            <a class="buy-tickets " href="{{ route('book-now') }}">Book Now</a>

        </div>
    </header>