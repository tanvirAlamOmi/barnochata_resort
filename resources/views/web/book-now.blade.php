@extends('web.index')

@section('title', 'Entry Booking')

@section('web_content')
    
    <div class="loader" style="display: none;">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
	<section id="booking">
        <div class="container" data-aos="fade-up">
            <div class="container white-shadow-conteiner">
                <div class="section-header mb-5">
                    <h2 class="mb-0">Entry Booking</h2>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="card bg-transparent no-border">
                            <div class="card-body">
                                <form id="entry-booking-form" action="{{ route('confirm-booking') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label for="from_date" class="control-label text-secondary">Arrival Date</label>
                                                        <input type="date" class="form-control box-shadow-1 {{ !empty($booking_request->from_date) ? 'is-valid' : '' }}" id="from_date" name="from_date" value="{{ !empty($booking_request->from_date) ? $booking_request->from_date : old('from_date') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label for="to_date" class="control-label text-secondary">Departure Date</label>
                                                        <input type="date" class="form-control box-shadow-1 {{ !empty($booking_request->to_date) ? 'is-valid' : '' }}" id="to_date" name="to_date" value="{{ !empty($booking_request->to_date) ? $booking_request->to_date : old('to_date') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <label for="total_adult" class="control-label text-secondary">Adult</label>
                                                        <input type="number" class="form-control box-shadow-1 {{ !empty($booking_request->total_adult) && $booking_request->total_adult >= 1 ? 'is-valid' : '' }}" min="1" id="total_adult" name="total_adult" value="{{ !empty($booking_request->total_adult) ? $booking_request->total_adult : (old('total_adult') ? old('total_adult') : 1) }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <label for="total_child" class="control-label text-secondary">Child</label>
                                                        <input type="number" class="form-control box-shadow-1" min="0" id="total_child" name="total_child" value="{{ !empty($booking_request->total_child) ? $booking_request->total_child : (old('total_child') ? old('total_child') : 0) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="warning" class="alert alert-danger alert-dismissible bg-white text-danger " style="display: none;font-weight: 600;">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>

                                    @if(count($rooms) > 0)
                                    <div class="row mb-3">
                                        <div class="col-12 mb-2">
                                            <label class="control-label text-secondary">Select Room / Cottage / Suite</label>
                                        </div>
                                        @foreach($rooms as $r => $room)
                                        <div class="col-12 mb-3">
                                            <div class="card box-shadow-1">
                                                <div class="card-body">
                                                    <div class="">
                                                        <div class="row text-secondary">
                                                            <div class="col-12">
                                                                <b class="text-theme-g">{{ $room->title }}</b> <small>({{ $room->category }})</small>
                                                                <small class="pull-right">On Selected Date: 
                                                                    <b class="text-theme-g">Available</b>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-1 mb-2">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <img src="{{ $room->default_image }}" alt="{{ $room->title }}" class="img-fluid">
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="mb-1">
                                                                        Default Guest <span class="pull-right bold text-secondary">{{ $room->guest_capacity }} PERSON</span>
                                                                    </div>
                                                                    <div class="mb-1">
                                                                        Price <span class="pull-right bold text-secondary">{{ number_format($room->price, 0, '.', '') }} {{ config('app.base_currency') }}</span>
                                                                    </div>
                                                                    <div class="mb-1">
                                                                        Additional price per adult <span class="pull-right bold text-secondary">{{ number_format($room->extra_person_per_adult, 0, '.', '') }} {{ config('app.base_currency') }}</span>
                                                                    </div>
                                                                    <div class="mb-1">
                                                                        Additional price per child <span class="pull-right bold text-secondary">{{ number_format($room->extra_person_per_child, 0, '.', '') }} {{ config('app.base_currency') }}</span>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="mt-2">
                                                                        <button type="button" class="btn btn-sm btn-secondary btn-details" data-id="{{ $room->id }}">
                                                                            Details
                                                                        </button>
                                                                        <span class="pull-right">
                                                                            <div class="form-check mt-1">
                                                                                <input class="form-check-input form-check-input-md room-input select_room_{{ $room->id }}" type="checkbox" value="{{ $room->id }}" id="select_room_{{ $room->id }}" name="rooms[]">
                                                                                <label class="form-check-label room-input-label-{{ $room->id }} bold text-theme-g" for="select_room_{{ $room->id }}">
                                                                                    Select
                                                                                </label>
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(!empty($room->facilities) && count($room->room_packages) > 0)
                                                            <div class="row mt-3">
                                                                <div class="col-12 text-secondary">
                                                                    <small class="bold">Facilities: </small>
                                                                    @foreach(explode(',', $room->facilities) as $f => $facility)
                                                                        <small class="badge bg-light text-secondary border p-1 mb-1">{{ $facility}}</small>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12">
                                                                    @if(count($room->room_packages) > 0)
                                                                    <div class="row text-secondary">
                                                                        <div class="col-12 bold">
                                                                            Available Packages
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <ul class="list-group">
                                                                                @foreach($room->room_packages as $rp => $room_package)
                                                                                <li class="list-group-item">
                                                                                    <div class="row mb-1">
                                                                                        <div class="col-12">
                                                                                            <b class="">{{ $room_package->package->title }}</b>
                                                                                            <small class="pull-right">
                                                                                                <b class="text-secondary">Duration</b> {{ $room_package->package->duration }}
                                                                                            </small>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            @if(count($room_package->package->package_addons) > 0)
                                                                                            <div class="row">
                                                                                                <div class="col-12 text-secondary">
                                                                                                    <small class="bold">Service Included: </small>
                                                                                                    @foreach($room_package->package->package_addons as $ps => $package_addons)
                                                                                                        <small class="badge bg-light text-secondary border p-1 mb-1">{{ $package_addons->addons->title }} ({{ $package_addons->counter }})</small>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <span>
                                                                                                Default Guest: 
                                                                                                <small>
                                                                                                    <b class="text-secondary">{{ $room_package->default_guest }} Person</b>
                                                                                                </small>
                                                                                            </span>
                                                                                            <span class="pull-right">
                                                                                                Price: 
                                                                                                <small>
                                                                                                    <b class="text-secondary">{{ number_format($room_package->price, 0, '.', '') }} {{ config('app.base_currency') }}</b>
                                                                                                </small>
                                                                                            </span>
                                                                                        </div>
                                                                                        <div class="col-12">
                                                                                            <small>
                                                                                                Extra Person: <b class="text-secondary">{{ number_format($room_package->extra_person_per_adult, 0, '.', '') }} {{ config('app.base_currency') }}</b> (Adult) and <b class="text-secondary">{{ number_format($room_package->extra_person_per_child, 0, '.', '') }} {{ config('app.base_currency') }}</b> (Child)
                                                                                            </small>
                                                                                            <span class="pull-right">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input form-check-input-md room-package-input room-package-{{ $room_package->room_id }} select_room_package_{{ $room_package->room_id.'-'.$room_package->package_id }}" type="checkbox" value="{{ $room_package->package_id }}" id="select_room_package_{{ $room_package->room_id.'-'.$room_package->package_id }}" name="packages[{{ $room_package->room_id }}]" data-id="{{ $room_package->room_id }}" disabled="true">
                                                                                                    <label class="form-check-label room-package-label-{{ $room_package->room_id }} room-package-input-label-{{ $room_package->room_id.'-'.$room_package->package_id }} bold text-theme-g" for="select_room_package_{{ $room_package->room_id.'-'.$room_package->package_id }}">
                                                                                                        Select
                                                                                                    </label>
                                                                                                </div>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <div class="row">
                                                                        <div class="col-12 text-secondary">
                                                                            <small class="bold">Facilities: </small>
                                                                            @foreach(explode(',', $room->facilities) as $f => $facility)
                                                                                <small class="badge bg-light text-secondary border p-1 mb-1">{{ $facility}}</small>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    @if(count($addons) > 0)
                                    <div class="row mb-3">
                                        <div class="col-12 mb-2">
                                            <label class="control-label text-secondary">Available Addons</label>
                                        </div>
                                        @foreach($addons as $s => $addon)
                                        <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                                            <div class="card box-shadow-1">
                                                <div class="card-body">
                                                    <div class="col-12 mb-1">
                                                        <div class="row">
                                                            <div class="col-12 pl-1">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input form-check-input-md addon-input" type="checkbox" value="{{ $addon->slug }}" id="select_addons_{{ $addon->slug }}" name="selected_addons[]">
                                                                    <label class="form-check-label" for="select_addons_{{ $addon->slug }}">
                                                                    {{ $addon->title }}
                                                                    </label>
                                                                </div>
                                                                <span class="text-right pull-right">
                                                                    {{ $addon->charge ? number_format($addon->charge, 0, '.', '') : 0 }} {{ config('app.base_currency') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <small class="text-theme-r" id="selected-addon-text-{{ $addon->slug }}">Not Selected</small>
                                                        <small class="pull-right">
                                                            <input type="text" class="form-control input-sm quanityt_class addons-counter" id="selected-addons-counter-{{ $addon->slug }}" name="selected_addons_counter[]" data-name="{{ $addon->slug }}" value="0" disabled="true">
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-theme" type="submit">Confirm Booking</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="detailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageSliderModalLabel"><b></b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div id="imageSlider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12" id="room-description">
                        </div>
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
            const rooms = {!! json_encode($rooms) !!};
            const bookingRequest = {!! json_encode($booking_request) !!};
            let roomSelected = [];
            let addonsSelected = [];

            $('#from_date').attr('min', today);
            $('#to_date').attr('min', today);
            $('#from_date').change(function(){
                $('#to_date').attr('min', $(this).val());
            });

            $('.btn-details').click(function(){
                let roomId = $(this).data('id');
                let getRoom = rooms.filter(function(room){
                    return room.id == roomId;
                })[0];
                $('.modal-title b').text(getRoom.title);
                $('#room-description').html(getRoom.description);

                let slideImages = '';

                if(getRoom.default_image)
                {
                    slideImages += `<div class="carousel-item active"><img src="`+getRoom.default_image+`" class="d-block w-100" alt="..." /></div>`
                }

                if(getRoom.room_images.length > 0)
                {
                    $.each(getRoom.room_images, function(index, room_image) {
                         slideImages += `<div class="carousel-item"><img src="`+room_image.image+`" class="d-block w-100" alt="..." /></div>`
                    });
                }

                $('.carousel-inner').html(slideImages);
                $('#detailsModal').modal('show')
            });

            $('#entry-booking-form .form-check-input').prop('checked',false);
            $('#entry-booking-form .room-package-input').prop('disabled',true);
            $('#entry-booking-form .room-package-input').prop('checked',false);
            $('#entry-booking-form .addons-counter').val(0);
            $('#entry-booking-form .addons-counter').prop('disabled',true);

            // if(bookingRequest.roomId)
            // {
            //     $('#select_room_'+bookingRequest.roomId).prop('checked',true);
            //     updateRoomCheckboxLabel(bookingRequest.roomId, true);
            // }

            $('.room-input').click(function(){
                updateRoomCheckboxLabel($(this).val(), $(this).prop('checked'));
            });

            $('.room-package-input').click(function(){
                updatePackageCheckboxLabel($(this).data('id'), $(this).val(), $(this).prop('checked'));
            });

            $('.addon-input').change(function(){
                updateAddons($(this).val(), 'input');
            });

            $('.addons-counter').change(function(){
                let action = 'update';
                let addonSlug = $(this).data('name');
                const data = {
                    name: 'addons',
                    addonSlug: addonSlug,
                    addonCounter: $('#selected-addons-counter-'+addonSlug).val()
                };
                // updateCart(action, data);
            });

            $('#entry-booking-form').submit(function(e) {
                $('.loader').hide();
                if (!roomSelected.length && !addonsSelected.length) {
                    e.preventDefault();
                    $('#warning').text('Please fill at least one Room or one Addons!').show();

                    $('html, body').animate({
                        scrollTop: $('#booking').offset().top
                    }, 1000);
                }
            });

            function updateAddons(addonSlug, entryType)
            {
                const checked = $('#select_addons_'+addonSlug).prop('checked');
                const action = checked ? 'add' : 'remove';
                if(checked)
                {
                    addonsSelected.push(addonSlug);
                    let addonText = entryType == 'input' ? 'Selected' : 'Selected by Package';
                    $('#selected-addon-text-'+addonSlug).text(addonText);
                    $('#selected-addon-text-'+addonSlug).removeClass('text-theme-r');
                    $('#selected-addon-text-'+addonSlug).addClass('text-theme-g');
                    $('#selected-addons-counter-'+addonSlug).prop('disabled',false);
                    $('#selected-addons-counter-'+addonSlug).val(1);
                }else{
                    $.each(addonsSelected, function(index, val) {
                        if(val == addonSlug){
                            addonsSelected.splice(index, 1);
                        }
                    });
                    $('#selected-addon-text-'+addonSlug).text('Not Selected');
                    $('#selected-addon-text-'+addonSlug).removeClass('text-theme-g');
                    $('#selected-addon-text-'+addonSlug).addClass('text-theme-r');
                    $('#selected-addons-counter-'+addonSlug).prop('disabled',true);
                    $('#selected-addons-counter-'+addonSlug).val(0);
                }
                const data = {
                    name: 'addons',
                    addonSlug: addonSlug,
                    addonCounter: $('#selected-addons-counter-'+addonSlug).val()
                };
                // updateCart(action, data);
            }

            function updateRoomCheckboxLabel(roomId, checked)
            {
                const action = checked ? 'add' : 'remove';
                if(checked){
                    roomSelected.push(roomId);
                    $('.room-input-label-'+roomId).removeClass('text-theme-g');
                    $('.room-input-label-'+roomId).addClass('text-theme-r');
                    $('.room-input-label-'+roomId).text('Remove');
                    $('.room-package-'+roomId).prop('disabled', false);
                }else{
                    $.each(roomSelected, function(index, val) {
                        if(val == roomId){
                            roomSelected.splice(index, 1);
                        }
                    });
                    $('.room-input-label-'+roomId).removeClass('text-theme-r');
                    $('.room-input-label-'+roomId).addClass('text-theme-g');
                    $('.room-input-label-'+roomId).text('Select');
                    $('.room-package-'+roomId).prop('checked', false);
                    $('.room-package-'+roomId).prop('disabled', true);
                    $('.room-package-label-'+roomId).removeClass('text-theme-r');
                    $('.room-package-label-'+roomId).addClass('text-theme-g');
                    $('.room-package-label-'+roomId).text('Select');
                }
                const data = {
                    name: 'room',
                    roomId: roomId,
                };
                // updateCart(action, data);
            }

            function updatePackageCheckboxLabel(roomId, packageId, checked)
            {
                const action = checked ? 'add' : 'remove';
                const room_packages = rooms.filter(function(room){return room.id == roomId;})[0].room_packages;
                let checkedValue = roomId+'-'+packageId;
                if(checked){
                    $('.room-package-'+roomId).prop('checked',false);
                    $('.room-package-label-'+roomId).removeClass('text-theme-r');
                    $('.room-package-label-'+roomId).addClass('text-theme-g');
                    $('.room-package-label-'+roomId).text('Select');
                    // set 
                    $('#select_room_package_'+checkedValue).prop('checked', true);
                    $('.room-package-input-label-'+checkedValue).removeClass('text-theme-g');
                    $('.room-package-input-label-'+checkedValue).addClass('text-theme-r');
                    $('.room-package-input-label-'+checkedValue).text('Remove');
                }else{
                    $('.room-package-input-label-'+checkedValue).removeClass('text-theme-r');
                    $('.room-package-input-label-'+checkedValue).addClass('text-theme-g');
                    $('.room-package-input-label-'+checkedValue).text('Select');
                }
                const data = {
                    name: 'package',
                    roomId: roomId,
                    packageId: packageId
                };
                // updateCart(action, data);
            }

            function updateCart(action, data)
            {
                $('.loader').show();
                const formData = {...data};
                var token = $('meta[name="csrf-token"]').attr('content');
                let routeName = '';
                if(action == 'add'){
                    routeName = "{{ route('add-to-cart') }}";
                }
                if(action == 'update'){
                    routeName = "{{ route('update-cart-addons') }}";
                }
                if(action == 'remove'){
                    routeName = "{{ route('remove-from-cart') }}";
                }
                $.ajax({
                    url: routeName,
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        $('.loader').hide();
                        console.log(response);
                        // $('.response-message').text('');
                        // if(response['status']){
                        //     $('.response-message').removeClass('text-danger');
                        //     $('.response-message').addClass('text-primary');
                        // }
                        // if(!response['status']){
                        //     $('.response-message').removeClass('text-primary');
                        //     $('.response-message').addClass('text-danger');
                        // }
                        // $('.response-message').text(response['message']);
                        // $('.response-message').show();
                        // if(response['status'] == true){
                        //     $('#password-update-form .form-control').val('');
                        //     setTimeout( function(){ 
                        //         hideModal();
                        //     }, 3000 );
                        // }
                    },
                    error: function(xhr, status, error) {
                        $('.loader').hide();
                        console.log(error)
                    }
                });
            }
        });
    </script>
@endpush