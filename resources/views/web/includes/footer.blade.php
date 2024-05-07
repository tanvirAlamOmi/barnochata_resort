@php
    $app_info = appInfo();
@endphp
<footer id="footer">
                <div class="footer-top">
                    <div class="container-fluid container-xxl">
                        <div class="row">

                            <div class="col-lg-4 col-md-4 footer-info">
                                <img src="{{ asset('imgs/brncht-logo.jpg') }}" alt="TheEvenet">
                                <span class="footer-title font-prompt text-uppercase">{{ $app_info['name']}}</span>
                                
                                @if(!empty($app_info['footer-description']))
                                    <p>{{ $app_info['footer-description']}}</p>
                                @endif

                                @if(!empty($app_info['mobile-number']))
                                    <p>{{ $app_info['address']}} <br>
                                @endif

                                @if(!empty($app_info['mobile-number']))
                                    <strong>Phone:</strong> {{ $app_info['mobile-number']}}<br>
                                @endif

                                @if(!empty($app_info['email']))
                                    <strong>Email:</strong> {{ $app_info['email']}}<br>
                                @endif
                                </p>

                                <div class="social-links mt-4">
                                    @if(!empty($app_info['facebook-link']))
                                        <a href="https://facebook.com/{{$app_info['facebook-link']}}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                                    @endif

                                    @if(!empty($app_info['youtube-link']))
                                        <a href="https://youtube.com/{{$app_info['youtube-link']}}" class="instagram" target="_blank"><i class="bi bi-youtube"></i></a>
                                    @endif

                                    @if(!empty($app_info['instagram-link']))
                                        <a href="https://instagram.com/{{$app_info['instagram-link']}}" class="google-plus" target="_blank"><i class="bi bi-instagram"></i></a>
                                    @endif

                                    @if(!empty($app_info['twitter-link']))
                                        <a href="https://twitter.com/{{$app_info['twitter-link']}}" class="twitter" target="_blank"><i class="bi bi-twitter"></i></a>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8 footer-links">
                                <h4>Useful Links</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul>
                                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('rooms-&-suits') }}">Rooms & Suits</a></li>
                                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('contact') }}">Contact</a></li>
                                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('directors') }}">Directors</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('gallery') }}">Gallery</a></li>
                                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('faq') }}">FAQ</a></li>
                                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('terms-&-conditions') }}">Terms of service</a></li>
                                            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('privacy-policy') }}">Privacy policy</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="copyright">
                        &copy; Copyright <strong>{{ config('app.name') }}</strong>. All Rights Reserved
                    </div>
                </div>
            </footer>