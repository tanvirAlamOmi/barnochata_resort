@extends('dashboard.index')

@section('title', 'Booking Details')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('bookings') }}">Bookings</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Booking Details</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120 text-comfort">Booking Details</b>
            </div>
            <div class="card-body text-comfort">
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
                                    <th align="right" class="text-right" style="width:150px;">Total</th>
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
                        @if($booking->status == 'REQUESTED')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#responseModal">Response</button>
                        @elseif($booking->status == 'ACCEPTED')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#responseModal">Actiavate</button>
                        @elseif($booking->status == 'ACTIVE')
                            <a class="btn btn-primary" href="{{ route('guests.add-guest',$booking->id) }}">Add Guest</a>
                            <form id="update-booking-form" action="{{ route('bookings.update-status') }}" method="post" class="d-inline-block">
                                @csrf
                                <input id="booking_id" type="hidden" name="booking_id" value="{{ $booking->id }}">
                                <input id="status" type="hidden" name="status" value="COMPLETED">
                                <button type="submit" class="btn btn-success">Completed</button>
                            </form>
                        @elseif($booking->status == 'COMPLETED')
                            <b class="text-primary">{{ $booking->status }}</b>
                        @elseif($booking->status == 'ALTER')
                            <b class="text-secondary">{{ $booking->status }}</b>
                        @elseif($booking->status == 'CANCELLED')
                            <b class="text-danger">{{ $booking->status }}</b>
                        @endif
                    </div>
                </div>

                @if(!empty($booking->guests) && count($booking->guests) > 0)
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Booking No</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Nationality</th>
                                <th>Mobile No</th>
                                <th>Entry At</th>
                                <th align="center" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking->guests as $g => $guest)
                            <tr>
                                <td>{{ $g += 1 }}</td>
                                <td>{{ $guest->booking_no }}</td>
                                <td>{{ $guest->full_name }}</td>
                                <td>{{ slugToTitle($guest->type) }}</td> 
                                <td>{{ $guest->nationality }}</td>
                                <td>{{ $guest->mobile_no }}</td>
                                <td>{{ dateTimeAsReadable($guest->created_at) }}</td>
                                <td align="center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('guests.edit', $guest) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('guests.show', $guest) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="responseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="responseModalLabel">Response to the Booking Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('booking-response') }}" enctype="multipart/form-data" id="response-form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="booking_no" name="booking_no" value="{{ $booking->booking_no }}" required>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <div class="d-flex justify-content-start">
                                        <label for="" class="control-label">Set Request Status: </label>
                                        <label class="input-container mb-0 fw500 text-primary ml-20"><b>Accept</b>
                                            <input class="status-input" type="radio" name="status" value="ACCEPTED" required>
                                            <span class="box-checkmark"></span>
                                        </label>
                                        <label class="input-container mb-0 fw500 text-success ml-20"><b>Offer Alter</b>
                                            <input class="status-input" type="radio" name="status" value="ALTER">
                                            <span class="box-checkmark"></span>
                                        </label>
                                        <label class="input-container mb-0 fw500 text-danger ml-20"><b>Cancel</b>
                                            <input class="status-input" type="radio" name="status" value="CANCELLED">
                                            <span class="box-checkmark"></span>
                                        </label>
                                    </div>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="response_message" class="col-form-label">Email Context</label>
                                    <textarea id="response_message" name="response_message" rows="5" class="form-control">{{ !empty($editRow) ? $editRow->response_message : old('response_message') }}</textarea>

                                    @error('response_message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary">Send Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            $('.status-input').prop('checked',false);
            // ClassicEditor
            // .create(document.querySelector('#response_message'))
            // .catch(error => {
            //     console.error(error);
            // });

            const booking = {!! json_encode($booking) !!};

            const responseModal = document.getElementById('responseModal')
            responseModal.addEventListener('show.bs.modal', event => {
                $('#response_message').val('');
            })


            let accept_msg = "We are glad to inform you that your booking request has been accepted honourably. \nPlease, continue the payment process to execute the request. Use your booking number while processing payment.";

            let alter_msg = "We are very sorry to inform you that you requested accommodations are booked already.  \nPlease feel free to choose any alternative accommodation from our other available accommodations if it complies your desire.";

            let cancel_msg = "We are extreemly sorry to inform you that right now all of our accommodation are booked.  \nWe will notify you if we can manage any accommodation for you in short time.";

            $('.status-input').change(function(){
                let status = $(this).val();
                // $('#response_message').val('');
                if($(this).prop('checked',true))
                {
                    if(status == 'ACCEPTED'){
                        $('#response_message').val(accept_msg);
                    }else if(status == 'ALTER'){
                        $('#response_message').val(alter_msg);
                    }else if(status == 'CANCELLED'){
                        $('#response_message').val(cancel_msg);
                    }
                }
            });

            $('#response-form').on('submit', function(){
                $('#responseModal').modal('hide');
                $('#loaderModal').modal('show');
            });
        });
    </script>
@endpush