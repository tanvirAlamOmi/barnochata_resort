@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit '.$editRow->name : 'Add Addons')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('addons.index') }}">Addons</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">{{ !empty($editRow) ? 'Edit '.$editRow->name : 'Add Addons' }}</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit '.$editRow->name : 'Add Addons' }}</b>
                <a href="{{ route('addons.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('addons.update',$editRow) : route('addons.store') }}" enctype="multipart/form-data">
                    
                    @csrf
                    @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                    @endif

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            @include('dashboard.helpers.title')
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="charge" class="col-form-label">Chrage</label>
                                <div class="input-group">
                                    <input id="charge" type="text" class="form-control @error('charge') is-invalid @enderror" name="charge" placeholder="0" value="{{ !empty($editRow) && $editRow->charge > 0 ? $editRow->charge : old('charge') }}">
                                    <span class="input-group-text">{{ config('app.base_currency') }}</span>
                                </div>
                                @error('charge')
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
    <script type="module">
        $(document).ready(function(){
            //
        })
    </script>
@endpush