@extends('web.index')

@section('title', 'Privacy Policy')

@section('web_content')

    <section id="faq">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Privacy Policy</h2>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12">

                    @if(!empty($privacy_policies) && count($privacy_policies))
                        @foreach($privacy_policies as $p => $privacy_policy)
                            {!! $privacy_policy->description !!}
                            <hr>
                        @endforeach
                    @endif

                </div>
            </div>

        </div>

    </section>

@endsection