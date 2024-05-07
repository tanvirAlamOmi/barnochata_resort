@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit '.$editRow->title : 'Add Guest')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('guests.index') }}">Guests</a></li>
    <li class="breadcrumb-item active">{{ !empty($editRow) ? 'Edit '.$editRow->title : 'Add Guest' }}</li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit '.$editRow->title : 'Add Guest' }}</b>
                <a href="{{ route('guests.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('guests.update',$editRow) : route('guests.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                    @endif

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group mb-3">
                                <label for="booking_no" class="col-form-label">Booking No</label>
                                <div>
                                    <select name="booking_no" id="booking_no" class="form-control" required>
                                        <option value="">Select Booking No</option>
                                        @if(!empty($bookings) && count($bookings) > 0)
                                            @foreach($bookings as $b => $booking)
                                                <option value="{{ $booking->id }}">{{ $booking->booking_no }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @error('booking_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" id="booking_id" name="booking_id" value="" required>
                            <input type="hidden" id="booking_id_no" name="booking_no" value="">
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label">Name</label>
                                <div>
                                    <input id="booking_name" type="text" class="form-control" readonly="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label">Email</label>
                                <div>
                                    <input id="booking_email" type="text" class="form-control" readonly="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label">Contact No</label>
                                <div>
                                    <input id="booking_contact_no" type="text" class="form-control" readonly="" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="type" class="col-form-label">Type <small class="text-danger">*</small></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type-input" type="radio" name="type" id="local" value="local" required {{ !empty($editRow) && $editRow->type == 'local' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="local">Local</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type-input" type="radio" name="type" id="foreign" value="foreign" {{ !empty($editRow) && $editRow->type == 'foreign' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="foreign">Foreign</label>
                                    </div>
                                </div>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="title" class="col-form-label">Title <small class="text-danger">*</small></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="title" id="Mr" value="Mr" required {{ !empty($editRow) && $editRow->title == 'Mr' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Mr">Mr</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="title" id="Mrs/Miss" value="Mrs/Miss" {{ !empty($editRow) && $editRow->title == 'Mrs/Miss' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Mrs/Miss">Mrs/Miss</label>
                                    </div>
                                </div>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="form-group mb-3">
                                <label for="full_name" class="col-form-label">Full Name <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Full Name" required>
                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="profession" class="col-form-label">Profession <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="profession" name="profession" value="{{ old('profession') }}" placeholder="Profession" required>
                                @error('profession')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="dob" class="col-form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-12">
                            <div class="form-group mb-3">
                                <label for="address" class="col-form-label">Address <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="nationality" class="col-form-label">Nationality <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value="Bangladeshi" placeholder="Nationality" required>
                                @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="nid" class="col-form-label">National ID</label>
                                <input type="text" class="form-control" id="nid" name="nid" value="{{ old('nid') }}" placeholder="National ID" >
                                @error('nid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="email" class="col-form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="mobile_no" class="col-form-label">Mobile No</label>
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Mobile No">
                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="company_name" class="col-form-label">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Company Name">
                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="company_mobile_no" class="col-form-label">Company Mobile No</label>
                                <input type="text" class="form-control" id="company_mobile_no" name="company_mobile_no" value="{{ old('company_mobile_no') }}" placeholder="Company Mobiel No">
                                @error('company_mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-12">
                            <div class="form-group mb-3">
                                <label for="company_address" class="col-form-label">Company Address</label>
                                <input type="text" class="form-control" id="company_address" name="company_address" value="{{ old('company_address') }}" placeholder="Company Address">
                                @error('company_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="vehicle_no" class="col-form-label">Vehicle No</label>
                                <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" value="{{ old('vehicle_no') }}" placeholder="Vehicle No">
                                @error('vehicle_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div id="foreign-input-div" class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="passport_no" class="col-form-label">Passport No <small class="text-danger">*</small></label>
                                <input type="text" class="form-control foreign-input" id="passport_no" name="passport_no" value="{{ old('passport_no') }}" placeholder="Passport No">
                                @error('passport_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="passport_issue_place" class="col-form-label">Passport Issue Place <small class="text-danger">*</small></label>
                                <input type="text" class="form-control foreign-input" id="passport_issue_place" name="passport_issue_place" value="{{ old('passport_issue_place') }}" placeholder="Passport Issue Place">
                                @error('passport_issue_place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="passport_issue_date" class="col-form-label">Passport Issue Date <small class="text-danger">*</small></label>
                                <input type="date" class="form-control foreign-input" id="passport_issue_date" name="passport_issue_date" value="{{ old('passport_issue_date') }}">
                                @error('passport_issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="visa_imm_no" class="col-form-label">Visa / Immigration / Reg: No <small class="text-danger">*</small></label>
                                <input type="text" class="form-control foreign-input" id="visa_imm_no" name="visa_imm_no" value="{{ old('visa_imm_no') }}" placeholder="Visa / Immigration / Reg: No">
                                @error('visa_imm_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="coming_from" class="col-form-label">Coming From <small class="text-danger">*</small></label>
                                <input type="text" class="form-control foreign-input" id="coming_from" name="coming_from" value="{{ old('coming_from') }}" placeholder="Coming From">
                                @error('coming_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="going_to" class="col-form-label">Going To <small class="text-danger">*</small></label>
                                <input type="text" class="form-control foreign-input" id="going_to" name="going_to" value="{{ old('going_to') }}" placeholder="Going To">
                                @error('going_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="expected_langth_of_staying" class="col-form-label">Expected Length of Staying <small class="text-danger">*</small></label>
                                <input type="text" class="form-control foreign-input" id="expected_langth_of_staying" name="expected_langth_of_staying" value="{{ old('expected_langth_of_staying') }}" placeholder="Expected length of staying">
                                @error('expected_langth_of_staying')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="date_of_entry_in_bd" class="col-form-label">Date of entry in Bangladesh <small class="text-danger">*</small></label>
                                <input type="date" class="form-control foreign-input" id="date_of_entry_in_bd" name="date_of_entry_in_bd" value="{{ old('date_of_entry_in_bd') }}">
                                @error('date_of_entry_in_bd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="purpose_of_visit" class="col-form-label">Purpose of Visit <small class="text-danger">*</small></label>
                                <input type="text" class="form-control foreign-input" id="purpose_of_visit" name="purpose_of_visit" value="{{ old('purpose_of_visit') }}" placeholder="purpose of Visit">
                                @error('purpose_of_visit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
            var editRow = {!! json_encode($editRow) !!};
            var bookings = {!! json_encode($bookings) !!};
            var bookingId = {!! json_encode($booking_id) !!};

            if(bookingId){
                updateBookingInfo(bookingId);
                $('#booking_no').prop('disabled',true);
            }

            $('#booking_no').change(function(){
                let bookingId = $(this).val();
                updateBookingInfo(bookingId);
            });

            $('.type-input').change(function(){
                checkType();
            })

            checkType();

            function checkType()
            {
                let type = $('.type-input:checked').val();
                if(type == 'foreign')
                {
                    $('#foreign-input-div').show();
                    $('.foreign-input').prop('required', true);
                }else{
                    $('#foreign-input-div').hide();
                    $('.foreign-input').prop('required', false);
                }
            }

            function updateBookingInfo(bookingId)
            {
                let bookingInfo = bookings.filter(function(booking){return booking.id == bookingId;})[0];
                $('#booking_no').val(bookingInfo.id);
                $('#booking_id').val(bookingInfo.id);
                $('#booking_id_no').val(bookingInfo.booking_no);
                $('#booking_name').val(bookingInfo.name);
                $('#booking_email').val(bookingInfo.email);
                $('#booking_contact_no').val(bookingInfo.contact_no);
                $('#email').val(bookingInfo.email);
                $('#mobile_no').val(bookingInfo.contact_no);
            }
        })
    </script>

@endpush