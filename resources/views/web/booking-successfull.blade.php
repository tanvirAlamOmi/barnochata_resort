@extends('web.index')

@section('title', 'Booking Successfull')

@section('web_content')

    <section id="booking" class="section-bg">
        <div class="container" data-aos="fade-up">
            <div class="container white-shadow-conteiner">
                <div class="section-header mb-5">
                    <h2 class="mb-0">Booking Successfull</h2>
                </div>
                <div class="row">
                    <div class="container text-center">
                        <h3 class="text-theme-g bold">Congratulations!</h3>
                        <p class="fs-md-2">
                            Your booking request has been submitted successfully. <br><br>
                            Your booking request number is <strong class="text-theme-r">{{ !empty(request()->input('booking_no')) ? request()->input('booking_no') : '' }}</strong> <br><br>
                            Please, check your email <span class="text-primary">{{ !empty(request()->input('email')) ? request()->input('email') : '' }}</span> for details response. <br>
                            Thank you very much to be with us. 
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-theme">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection