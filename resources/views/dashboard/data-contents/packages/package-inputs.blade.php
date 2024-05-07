@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit '.$editRow->title : 'Add Package')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('packages.index') }}">Packages</a></li>
    <li class="breadcrumb-item active">{{ !empty($editRow) ? 'Edit '.$editRow->title : 'Add Package' }}</li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <!-- <h1>Add room</h1> -->
        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit '.$editRow->title : 'Add Package' }}</b>
                <a href="{{ route('packages.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('packages.update',$editRow) : route('packages.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                    @endif

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            @include('dashboard.helpers.title')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group mb-3">
                                <label for="type" class="col-form-label">Type</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="day-long" value="day-long" {{ !empty($editRow) && $editRow->type == 'day-long' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="day-long">Day Long</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="night-stay" value="night-stay" {{ !empty($editRow) && $editRow->type == 'night-stay' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="night-stay">Night Stay</label>
                                    </div>
                                </div>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group mb-3">
                                <label for="duration" class="col-form-label">Duration</label>
                                <input type="text" class="form-control" id="duration" name="duration" placeholder="Ex: from 12 pm to next day 12 pm" value="{{ !empty($editRow) ? $editRow->duration : '' }}">
                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group mb-3">
                                <label for="rooms" class="col-form-label">Select Rooms / Cottage / Suits</label>
                                <div>
                                    @if(count($rooms) > 0)
                                        @foreach($rooms as $s => $room)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input room-input" type="checkbox" name="rooms[]" id="{{ $room->slug }}" value="{{ $room->id }}" />
                                                <label class="form-check-label" for="{{ $room->slug }}">{{ $room->title }} @if($room->price > 0) ({{ $room->price_currency }}) @endif</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @error('rooms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="row hide" id="room-table">
                        <div class="col-8">
                            <label for="" class="col-form-label">Package Applicable  Rooms</label>
                        </div>
                        <div class="col-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-condensed font-90">
                                    <thead>
                                        <tr>
                                            <th align="center" class="text-center">Title</th>
                                            <th align="center" class="text-center">Guest Allowed</th>
                                            <th align="center" class="text-center">Price</th>
                                            <th align="center" class="text-center">Extra Adult</th>
                                            <th align="center" class="text-center">Extra Child</th>
                                            <th align="center" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="room-table-body"></tbody>
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group mb-3">
                                <label for="addons" class="col-form-label">Addons Included</label>
                                <div class="row">
                                    @if(count($addons) > 0)
                                        @foreach($addons as $s => $addon)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="d-flex justify-content-between border mb-2 pl-10">
                                                    <div class="form-check form-check-inline mt-2">
                                                        <input class="form-check-input addons-input" type="checkbox" name="addons[]" id="{{ $addon->slug }}" value="{{ $addon->id }}" />
                                                        <label class="form-check-label" for="{{ $addon->slug }}">{{ $addon->title }} @if($addon->charge > 0) ({{ $addon->charge_currency }}) @endif</label>
                                                    </div>
                                                    <input id="{{ $addon->slug }}-counter" type="text" class="form-control quantity_class counter-input text-right" name="addons_counter[]" placeholder="0" value="0" disabled="">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @error('addons')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            @include('dashboard.helpers.description')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group mb-3">
                                <label for="start_date" class="col-form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Ex: from 12 pm to next day 12 pm" value="{{ !empty($editRow) ? $editRow->start_date : old('start_date') }}">
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group mb-3">
                                <label for="end_date" class="col-form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Ex: from 12 pm to next day 12 pm" value="{{ !empty($editRow) ? $editRow->end_date : old('end_date') }}">
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            @include('dashboard.helpers.status-active')
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                                {{ !empty($editRow) ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            const editRow = {!! json_encode($editRow) !!};
            const rooms = {!! json_encode($rooms) !!};
            const addons = {!! json_encode($addons) !!};

            console.log(editRow)
            let selectedRooms = [];

            if(!editRow){
                $('.room-input, .addons-input').prop('checked',false);
            }else{
                if(editRow.package_rooms.length > 0){
                    $.each(editRow.package_rooms, function(index, package_room) {
                         $('#'+package_room.room.slug).prop('checked',true);
                         addRoom(package_room.room_id, package_room);
                    });
                }

                if(editRow.package_addons.length > 0){
                    $.each(editRow.package_addons, function(index, package_addons) {
                         $('#'+package_addons.addons.slug).prop('checked',true);
                         updateAddons(package_addons.addons.slug, package_addons);
                    });
                }
            }

            $('.room-input').change(function(){
                let roomId = parseInt($(this).val());
                if($(this).prop('checked')){
                    addRoom(roomId);
                }else{
                    removeRoom(roomId);
                }
            });

            function addRoom(roomId, roomInfo = null)
            {
                let room = rooms.filter(function(room){return room.id == roomId;})[0];
                let setRow = `<tr id="row_${room.id}">
                        <td align="center">${room.title}</td>
                        <td><div class="input-group">
                                <input type="text" class="form-control text-right quantity_class" name="default_guest[]" placeholder="00" value="`+(roomInfo ? roomInfo.default_guest : '')+`">
                                <span class="input-group-text">Person</span>
                            </div>
                        </td>
                        <td><div class="input-group">
                                <input type="text" class="form-control text-right quantity_class" name="price[]" placeholder="00" value="`+(roomInfo ? roomInfo.price : '')+`">
                                <span class="input-group-text">{{ config('app.base_currency') }}</span>
                            </div>
                        </td>
                        <td><div class="input-group">
                                <input type="text" class="form-control text-right quantity_class" name="extra_person_per_adult[]" placeholder="00" value="`+(roomInfo ? roomInfo.extra_person_per_adult : '')+`">
                                <span class="input-group-text">{{ config('app.base_currency') }}</span>
                            </div>
                        </td>
                        <td><div class="input-group">
                                <input type="text" class="form-control text-right quantity_class" name="extra_person_per_child[]" placeholder="00" value="`+(roomInfo ? roomInfo.extra_person_per_child : '')+`">
                                <span class="input-group-text">{{ config('app.base_currency') }}</span>
                            </div>
                        </td>
                        <td class="text-center"><button type="button" class="btn btn-danger delete-room" data-id="${room.id}" data-name="${room.slug}">Delete</button>
                        </td>
                    </tr>`;
                    $('#room-table-body').append(setRow);
                    $('#room-table').removeClass('hide');
                    selectedRooms.push(room);
            }

            function removeRoom(roomId)
            {
                $('#row_'+roomId).remove();
                const roomIndex = selectedRooms.findIndex(room => room.id === roomId);
                if (roomIndex !== -1) {
                    selectedRooms.splice(roomIndex, 1);
                }
                if(selectedRooms.length <= 0){
                    $('#room-table').addClass('hide');
                }
            }

            $(document).on('click', '.delete-room', function (e) {
                e.preventDefault();
                const roomId = $(this).data('id');
                const roomSlug = $(this).data('name');
                removeRoom(roomId);
                $('#'+roomSlug).prop('checked',false);
            });

            $(document).on('keyup', '.quantity_class', function (e) {
                this.value=this.value.replace(/[^0-9:]/g,'');
            })

            $('.addons-input').change(function(){
                let addonSlug = $(this).prop('id');
                updateAddons(addonSlug);
            });

            function updateAddons(addonSlug, serviceInfo = null)
            {
                console.log(serviceInfo)
                let counter = serviceInfo ? serviceInfo.counter : 1 ;
                if($('#'+addonSlug).prop('checked')){
                    $('#'+addonSlug+'-counter').prop('disabled', false);
                    $('#'+addonSlug+'-counter').val(counter);
                }else{
                    $('#'+addonSlug+'-counter').prop('disabled', true);
                    $('#'+addonSlug+'-counter').val(0);
                }
            }
        })
    </script>

@endpush