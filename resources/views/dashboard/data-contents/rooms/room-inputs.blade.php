@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit '.$editRow->title : 'Add Room')

@push('styles')
    <link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('rooms.index') }}">Rooms</a></li>
    <li class="breadcrumb-item active">{{ !empty($editRow) ? 'Edit '.$editRow->title : 'Add Room' }}</li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <!-- <h1>Add room</h1> -->
        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit '.$editRow->title : 'Add Room' }}</b>
                <a href="{{ route('rooms.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('rooms.update',$editRow) : route('rooms.store') }}" enctype="multipart/form-data">
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
                                <label for="category" class="col-form-label">Category</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">-- select --</option>
                                    <option value="room" {{ !empty($editRow) && $editRow->category == 'room' ? 'selected' : '' }}>Room</option>
                                    <option value="suite" {{ !empty($editRow) && $editRow->category == 'suite' ? 'selected' : '' }}>Suite</option>
                                    <option value="cottage" {{ !empty($editRow) && $editRow->category == 'cottage' ? 'selected' : '' }}>Cottage</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group mb-3">
                                <label for="price" class="col-form-label">Price</label>
                                <div class="input-group">
                                    <input type="text" class="form-control quantity_class" id="price" name="price" placeholder="00" value="{{ !empty($editRow) && $editRow->price > 0 ? $editRow->price : '' }}">
                                    <span class="input-group-text">{{ config('app.base_currency') }}</span>
                                </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group mb-3">
                                <label for="extra_person_per_adult" class="col-form-label">Additional Price Per Adult</label>
                                <div class="input-group">
                                    <input type="text" class="form-control quantity_class text-right" id="extra_person_per_adult" name="extra_person_per_adult" placeholder="00" value="{{ !empty($editRow) && $editRow->extra_person_per_adult > 0 ? $editRow->extra_person_per_adult : '' }}">
                                    <span class="input-group-text">{{ config('app.base_currency') }}</span>
                                </div>
                                @error('extra_person_per_adult')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group mb-3">
                                <label for="extra_person_per_child" class="col-form-label">Additional Price Per Child</label>
                                <div class="input-group">
                                    <input type="text" class="form-control quantity_class text-right" id="extra_person_per_child" name="extra_person_per_child" placeholder="00" value="{{ !empty($editRow) && $editRow->extra_person_per_child > 0 ? $editRow->extra_person_per_child : '' }}">
                                    <span class="input-group-text">{{ config('app.base_currency') }}</span>
                                </div>
                                @error('extra_person_per_child')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            @include('dashboard.helpers.description')
                        </div>
                    </div>

                    @if(count($facilities) > 0)
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group mb-3">
                                <label for="facilities" class="col-form-label">Facilities</label>
                                <select id="facilities" name="facilities[]" class="form-control" multiple>
                                    @foreach($facilities as $f => $facility)
                                    <option value="{{ $facility->slug }}" {{ !empty($editRow) && in_array($facility->slug, explode(',', $editRow->facilities)) ? 'selected' : '' }}>{{ $facility->title }}</option>
                                    @endforeach
                                </select>

                                @error('facilities')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            @include('dashboard.helpers.default-image')
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group mb-3">
                                <label for="guest_capacity" class="col-form-label">Guest Capacity</label>
                                <div class="input-group">
                                    <input type="text" class="form-control quantity_class text-right" id="guest_capacity" name="guest_capacity" placeholder="00" value="{{ !empty($editRow) && $editRow->guest_capacity > 0 ? $editRow->guest_capacity : 2 }}">
                                    <span class="input-group-text">Persons</span>
                                </div>
                                @error('guest_capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            @include('dashboard.helpers.serial-no')
                        </div>
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
<script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var editRow = {!! json_encode($editRow) !!};
            $("#facilities").select2({
                placeholder: "Select Facilities",
                allowClear: true
            });

            if(editRow){
                $('#facilities').val(editRow.facilities.split(','));
                $('#facilities').trigger('change');
            }
        })
    </script>

@endpush