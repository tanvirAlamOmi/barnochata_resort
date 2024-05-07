@extends('web.index')

@section('title', 'Payment')

@section('web_content')

	<section id="faq">

        <div class="container">

            <div class="section-header">
                <h2>Payment</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <form action="{{ route('search-booking') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Booking No" id="booking_no" name="booking_no" value="{{ !empty($booking) ? $booking->booking_no : old('booking_no') }}" required>
                          <button type="submit" class="btn btn-primary" id="search-btn">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            @if(!empty($booking))
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="card mb-4">
                        <div class="card-body text-comfort">
                            <h4><b class="fs-120 text-comfort">Booking Details</b></h4>
                            <div class="row fw-500">
                                <div class="col-sm-6 mb-2">
                                    <div class="mb-3"><b>Booking No: {{ $booking->booking_no }}</b></div>
                                    <div class="mb-1"><b>Name</b>: {{ $booking->name }}</div>
                                    <div class="mb-1"><b>Email</b>: {{ $booking->email }}</div>
                                    <div class="mb-1"><b>Contact No</b>: {{ $booking->contact_no }}</div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <div class="mb-3"><div class="mb-3"><b>Request Date Time: {{ date('d-m-Y h:i', strtotime($booking->created_at)) }}</b></div></div>
                                    <div class="mb-1"><b>Arrival Date</b>: {{ date('d-m-Y', strtotime($booking->check_in_date)) }}</div>
                                    <div class="mb-1"><b>Departure Date</b>: {{ date('d-m-Y', strtotime($booking->check_out_date)) }}</div>
                                    <div class="mb-1"><b>Adult</b>: {{ $booking->total_adult }}, <b>Child</b>: {{ $booking->total_child }}</div>
                                </div>
                                @if(!empty($booking->booking_note))
                                <div class="col-sm-12 mb-2">
                                    Note: {{ $booking->booking_note }}
                                </div>
                                @endif
                            </div>
                            <div class="row fw-500">
                                <div class="table-responsive">
                                    <b>Requested for</b>
                                    <table class="table table-bordered table-hover table-stripe">
                                        <thead>
                                            <tr>
                                                <th align="center" class="text-center">SL</th>
                                                <th>Item</th>
                                                <th align="center" class="text-center">Type</th>
                                                <th align="center" class="text-center">Price</th>
                                                <th align="center" class="text-center">QTY</th>
                                                <th align="center" class="text-center" style="width:150px;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($booking->booking_rooms_only) > 0)
                                                @php
                                                    $counter = 1;
                                                    $subtotal = 0;
                                                    $allowed_adult = 0;
                                                    $extra_adult_count = 0;
                                                    $extra_adult_price = 0;
                                                    $extra_child_count = 0;
                                                    $extra_child_price = 0;
                                                    $arrival_date = new DateTime($booking->check_in_date);
                                                    $departure_date = new DateTime($booking->check_out_date);
                                                    $day_count = $arrival_date->diff($departure_date)->days;
                                                @endphp

                                                @foreach($booking->booking_rooms_only as $br => $booking_room)
                                                    @php
                                                        $allowed_adult += $booking_room->default_guest;
                                                        $extra_adult_price = $booking_room->extra_person_per_adult;
                                                        $extra_child_price = $booking_room->extra_person_per_child;
                                                    @endphp

                                                    <tr>
                                                        <td align="center" class="text-center">{{ $counter++ }}</td>
                                                        <td>
                                                            {{ $booking_room->room->title }}
                                                            @if(!empty($booking_room->package))
                                                                , <small>(Pkg: {{ $booking_room->package->title }})</small>
                                                            @endif
                                                        </td>
                                                        <td align="center" class="text-center">Accommodations</td>
                                                        <td align="center" class="text-center">{{ $booking_room->price }}</td>
                                                        <td align="center" class="text-center">1 * {{ $day_count }}</td>
                                                        <td align="right" class="text-right" style="width:150px;">{{ $booking_room->price * $day_count }} {{ config('app.base_currency') }}</td>
                                                    </tr>
                                                    @php $subtotal += ($booking_room->price * $day_count) @endphp
                                                @endforeach

                                                @if($booking->total_adult > $allowed_adult)
                                                    @php
                                                        $extra_adult_count = $booking->total_adult - $allowed_adult;
                                                    @endphp
                                                    <tr>
                                                        <td align="center" class="text-center">{{ $counter++ }}</td>
                                                        <td>Adult</td>
                                                        <td align="center" class="text-center">Extra Person</td>
                                                        <td align="center" class="text-center">{{ $extra_adult_price }}</td>
                                                        <td align="center" class="text-center">{{ $extra_adult_count }} * {{ $day_count }}</td>
                                                        <td align="right" class="text-right" style="width:150px;">{{ $extra_adult_price * $extra_adult_count * $day_count }} {{ config('app.base_currency') }}</td>
                                                    </tr>
                                                    @php $subtotal += ($extra_adult_price * $extra_adult_count * $day_count) @endphp
                                                @endif

                                                @if($booking->total_child > 0)
                                                    @php
                                                        $extra_child_count = $booking->total_child;
                                                    @endphp
                                                    <tr>
                                                        <td align="center" class="text-center">{{ $counter++ }}</td>
                                                        <td>Child</td>
                                                        <td align="center" class="text-center">Extra Person</td>
                                                        <td align="center" class="text-center">{{ $extra_child_price }}</td>
                                                        <td align="center" class="text-center">{{ $extra_child_count }} * {{ $day_count }}</td>
                                                        <td align="right" class="text-right" style="width:150px;">{{ $extra_child_price * $extra_child_count * $day_count }} {{ config('app.base_currency') }}</td>
                                                    </tr>
                                                    @php $subtotal += ($extra_child_price * $extra_child_count * $day_count) @endphp
                                                @endif

                                                @if(!empty($booking->booking_addons) && count($booking->booking_addons) > 0)
                                                    @foreach($booking->booking_addons as $ba => $booking_addons)
                                                    <tr>
                                                        <td align="center" class="text-center">{{ $counter++ }}</td>
                                                        <td>{{ $booking_addons->addons->title }}</td>
                                                        <td align="center" class="text-center">Addons</td>
                                                        <td align="center" class="text-center">{{ $booking_addons->addons->charge }}</td>
                                                        <td align="center" class="text-center">{{ $booking_addons->addons_counter }}</td>
                                                        <td align="right" class="text-right" style="width:150px;">{{ $booking_addons->addons->charge * $booking_addons->addons_counter }} {{ config('app.base_currency') }}</td>
                                                    </tr>
                                                    @php $subtotal += ($booking_addons->addons->charge * $booking_addons->addons_counter) @endphp
                                                    @endforeach
                                                @endif

                                                <tr>
                                                    <td colspan="5" align="right" class="text-right"><b>Gross Total</b></td>
                                                    <td align="right" class="text-right" style="width:150px;"><b id="subtotal">{{ $subtotal }} {{ config('app.base_currency') }}</b></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row fw-500">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#responseModal"><b>Coupon / Referral Code</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4><b class="fs-120 text-comfort">Process Payment</b></h4>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

    </section>

@endsection