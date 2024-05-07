@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit '.$editRow->title : 'Add Facility')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('facilities.index') }}">Facilities</a></li>
    <li class="breadcrumb-item active">{{ !empty($editRow) ? 'Edit '.$editRow->title : 'Add Facility' }}</li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit '.$editRow->title : 'Add Facility' }}</b>
                <a href="{{ route('facilities.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('facilities.update',$editRow) : route('facilities.store') }}" enctype="multipart/form-data">
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
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group mb-3">
                                <label for="type" class="col-form-label">Type</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="indoor" value="indoor" required {{ !empty($editRow) && $editRow->type == 'indoor' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="indoor">Indoor</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="outdoor" value="outdoor" {{ !empty($editRow) && $editRow->type == 'outdoor' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="outdoor">Outdoor</label>
                                    </div>
                                </div>
                                @error('type')
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

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            @include('dashboard.helpers.default-image')
                        </div>
                        <div class="col-lg-4 col-md-4">
                            @include('dashboard.helpers.serial-no')
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
            var editRow = {!! json_encode($editRow) !!};
        })
    </script>

@endpush