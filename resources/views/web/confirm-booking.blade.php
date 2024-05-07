@extends('web.index')

@section('title', 'Confirm Booking')

@section('web_content')

	<section id="contact" class="section-bg">

        <div class="container" data-aos="fade-up">

            <div class="section-header mb-5">
                <h2>Confirm Booking</h2>
            </div>

            <form action="{{ route('submit-confirmation') }}" method="post" id="confirmation-form">
                @csrf
                <div class="row php-email-form">
                    <div class="col-lg-8 col-md-8">
                        <h5>Booking Information</h5>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="from_date" class="control-label text-secondary bold">Arrival Data</label>
                                            <input type="date" class="form-control box-shadow-1 {{ !empty($booking_request->from_date) ? 'is-valid' : '' }}" id="from_date" name="from_date" value="{{ !empty($booking_request->from_date) ? $booking_request->from_date : old('from_date') }}" required readonly="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="to_date" class="control-label text-secondary bold">Departure Date</label>
                                            <input type="date" class="form-control box-shadow-1 {{ !empty($booking_request->to_date) ? 'is-valid' : '' }}" id="to_date" name="to_date" value="{{ !empty($booking_request->to_date) ? $booking_request->to_date : old('to_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="total_adult" class="control-label text-secondary bold">Adult</label>
                                            <input type="text" class="form-control quantity_class box-shadow-1 {{ !empty($booking_request->total_adult) && $booking_request->total_adult >= 1 ? 'is-valid' : '' }}" min="1" id="total_adult" name="total_adult" value="{{ !empty($booking_request->total_adult) ? $booking_request->total_adult : (old('total_adult') ? old('total_adult') : 1) }}" required readonly="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="total_child" class="control-label text-secondary bold">Child</label>
                                            <input type="text" class="form-control quantity_class box-shadow-1" min="0" id="total_child" name="total_child" value="{{ !empty($booking_request->total_child) ? $booking_request->total_child : (old('total_child') ? old('total_child') : 0) }}" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <label class="control-label text-secondary bold">Booking Details</label>
                            <table class="table table-bordered table-hover table-stripe" id="cart-table">
                                <thead>
                                    <tr>
                                        <th align="center" class="text-center">SL</th>
                                        <th>Item</th>
                                        <th align="center" class="text-center">Type</th>
                                        <th align="center" class="text-center">Price</th>
                                        <th align="center" class="text-center">QTY</th>
                                        <th align="right" class="text-right" style="width:150px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($cart_items) > 0)
                                    
                                    @php
                                        $counter = 1;
                                        $subtotal = 0;
                                        $allowed_adult = 0;
                                        $allowed_child = 0;
                                        $extra_adult_price = 0;
                                        $extra_child_price = 0;
                                        $arrival_date = new DateTime($booking_request->from_date);
                                        $departure_date = new DateTime($booking_request->to_date);
                                        $day_count = $arrival_date->diff($departure_date)->days;
                                    @endphp

                                        @foreach($cart_items as $c => $cart_item)

                                        @php
                                            $item_price = $cart_item->price;
                                            if($cart_item->options->type == 'room'){
                                                $type = 'Accommodations';
                                                $extra_adult_price = $cart_item->options->extra_person_per_adult;
                                                $extra_child_price = $cart_item->options->extra_person_per_child;
                                                if($cart_item->options->package)
                                                {
                                                    $item_price = $cart_item->options->package['price'];
                                                    $allowed_adult += $cart_item->options->package['default_guest'];
                                                    $extra_adult_price = $cart_item->options->package['extra_person_per_adult'];
                                                    $extra_child_price = $cart_item->options->package['extra_person_per_child'];
                                                }
                                            }else{
                                                $type = 'Addons';
                                            }
                                        @endphp

                                        <tr>
                                            <td align="center" class="text-center">{{ $counter++ }}</td>
                                            <td>
                                                {{ $cart_item->name }} 
                                                @if($cart_item->options->package != null)
                                                <small>(Package: {{$cart_item->options->package['title']. ', ' .$cart_item->options->package['default_guest']. ' person'}})</small>
                                                @endif
                                            </td>
                                            <td align="center" class="text-center">{{ $type }}</td>
                                            <td align="center" class="text-center">{{ $item_price }}</td>
                                            <td align="center" class="text-center">
                                                {{ $cart_item->qty }}
                                                @if($cart_item->options->type == 'room')
                                                 * {{ $day_count }}
                                                @endif
                                            </td>
                                            <td align="right" class="text-right" style="width:150px;">
                                                @if($cart_item->options->type == 'room')
                                                    {{ $item_price * $cart_item->qty * $day_count }}
                                                @else
                                                    {{ $item_price * $cart_item->qty }}
                                                @endif
                                                
                                                 {{ config('app.base_currency') }}
                                            </td>
                                        </tr>
                                        @php
                                            if($cart_item->options->type == 'room')
                                            {
                                                $subtotal += ($item_price * $cart_item->qty * $day_count);
                                            }else{

                                                $subtotal += ($item_price * $cart_item->qty);
                                            }
                                        @endphp
                                        @endforeach
                                        @if($booking_request->total_adult > $allowed_adult)
                                        @php
                                            $extra_adult_count = $booking_request->total_adult - $allowed_adult;
                                        @endphp
                                        <tr>
                                            <td align="center" class="text-center">{{ $counter }}</td>
                                            <td>Extra Person</td>
                                            <td align="center" class="text-center">Adult</td>
                                            <td align="center" class="text-center">{{ $extra_adult_price }}</td>
                                            <td align="center" class="text-center">
                                                {{ $extra_adult_count }} * {{ $day_count }}
                                            </td>
                                            <td align="right" class="text-right" style="width:150px;">{{ $extra_adult_price * $extra_adult_count * $day_count}} {{ config('app.base_currency') }}</td>
                                        </tr>
                                        @php $subtotal += ($extra_adult_price * $extra_adult_count * $day_count) @endphp
                                        @endif
                                        @if($booking_request->total_child > $allowed_child)
                                        @php
                                            $extra_child_count = $booking_request->total_child - $allowed_child;
                                        @endphp
                                        <tr>
                                            <td align="center" class="text-center">{{ $counter+1 }}</td>
                                            <td>Extra Person</td>
                                            <td align="center" class="text-center">Child</td>
                                            <td align="center" class="text-center">{{ $extra_child_price }}</td>
                                            <td align="center" class="text-center">
                                                {{ $extra_child_count }} * {{ $day_count }}
                                            </td>
                                            <td align="right" class="text-right" style="width:150px;">{{ $extra_child_price * $extra_child_count * $day_count }} {{ config('app.base_currency') }}</td>
                                        </tr>
                                        @php $subtotal += ($extra_child_price * $extra_child_count * $day_count) @endphp
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
                    <div class="col-lg-4 col-md-4">
                        <h5>Contact Information</h5>
                        <hr>
                        <div class="row">
                            <div class="form-group mb-2">
                                <label for="name" class="control-label text-secondary bold">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-2">
                                <label for="email" class="control-label text-secondary bold">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="your@email.com" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-2">
                                <label for="contact_no" class="control-label text-secondary bold">Contact Number</label>
                                <input type="text" name="contact_no" class="form-control quantity_class" id="contact_no" placeholder="01XXXXXXXXX" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-2">
                                <label for="booking_note" class="control-label text-secondary bold">Booking Note</label>
                                <textarea class="form-control" name="booking_note" rows="3" placeholder="write your booking note here"></textarea>
                            </div>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button class="btn btn-theme" type="submit">Submit Confirmation</button></div>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <!-- Modal -->
    <div class="modal" id="loaderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loaderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content" style="background: transparent;border: none;">
                <div class="modal-body text-center">
                    <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const today = {!! json_encode(date('Y-m-d')) !!};
            let fromDate = {!! json_encode(date('Y-m-d', strtotime($booking_request->from_date))) !!};
            $('#to_date').attr('min', fromDate);
            $('#confirmation-form').on('submit', function(){
                $('#loaderModal').modal('show');
            });
        });
    </script>
@endpush