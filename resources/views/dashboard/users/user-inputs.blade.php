@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit '.$editRow->name : 'Add User')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('users.index') }}">Users</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">{{ !empty($editRow) ? 'Edit '.$editRow->name : 'Add User' }}</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <!-- <h1>Add User</h1> -->
        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit '.$editRow->name : 'Add User' }}</b>
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('users.update',$editRow) : route('users.store') }}">
                    @csrf
                    @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                    @endif

                    <div class="row">

                        <div class="col-lg-4 col-md-6">

                            @include('dashboard.helpers.name')

                            @include('dashboard.helpers.email')

                            @include('dashboard.helpers.mobile-no')

                            @if(!empty($editRow))
                                <div class="form-group mb-3">
                                    <div class="form-check form-switch">
                                        <input name="update_password" class="form-check-input" type="checkbox" id="updatePassword" name="darkmode" value="yes" checked="@error('password') true @else false @enderror">
                                        <label class="form-check-label" for="updatePassword">Update Password</label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div id="passwordBox" class="@if(!empty($editRow)) hide @else '' @endif @error('password') show @enderror">
                                <div class="form-group mb-3">
                                    <label for="password" class="col-form-label">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password-confirm" class="col-form-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
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
            if(editRow)
            {
                $('#updatePassword').prop('checked',false);
            }

            $('#updatePassword').change(function(){
                if($(this).prop('checked'))
                {
                    $('#passwordBox').show();
                    $('#passwordBox :input').prop('required',true);
                }else{
                    $('#passwordBox').hide();
                    $('#passwordBox :input').prop('required',false);
                }
            })
        })
    </script>

@endpush