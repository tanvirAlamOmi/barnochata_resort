@extends('web.index')

@section('title', 'Contact Us')

@section('web_content')

	<section id="contact" class="section-bg">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Contact Us</h2>
                <p>Let us know how we can help.</p>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <h4>Find us here</h4>
                    <iframe src="{{$app_infos['map-location']}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                </div>
                <div class="col-sm-6">
                    <div class="row contact-info">
                        <div class="col-md-4">
                            <div class="contact-address">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Address</h3>
                                <address>{{$app_infos['address']}}</address>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-phone">
                                <i class="bi bi-phone"></i>
                                <h3>Phone Number</h3>
                                <p><a href="tel:{{$app_infos['mobile-number']}}">{{$app_infos['mobile-number']}}</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-email">
                                <i class="bi bi-envelope"></i>
                                <h3>Email</h3>
                                <p><a href="mailto:{{$app_infos['email']}}">{{$app_infos['email']}}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="form">
                        <form action="{{ route('submit-message') }}" method="post" role="form" class="php-email-form">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                </div>
                                <div class="form-group col-md-6 mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
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
            </div>

        </div>
    </section>

@endsection