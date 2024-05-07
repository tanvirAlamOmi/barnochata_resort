@extends('dashboard.index')

@section('title', 'contact us')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">App Inforamtion</a></li>
@endsection

@section('dashboard_content')
<div class="container-fluid">        
    <div class="card mb-4">
        <div class="card-header bg-white">
            <b class="fs-120"> App Information </b>
            <a href="{{ route('/') }}" class="btn btn-sm btn-primary pull-right fw-500">
                Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('app-info.update') }}" method="post">
                @csrf
                <div class="row">
                    @foreach($app_infos as $key => $app_info)
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group mb-3">
                            <label for="{{ $key }}" class="col-form-label">{{ ucfirst($key) }}:</label>
                            <input id="{{ $key }}" type="text" class="form-control" name="{{ $key }}" placeholder="{{ $key }}" value="{{ $app_info }}" autofocus>
                        </div>
                    </div>
                    @endforeach
                </div>

                <hr>

                <div class="card-header bg-white">
                    <b class="fs-120"> Add New Information </b>
                </div>
        
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group mb-3">
                            <label for="newKey" class="col-form-label">Title:</label>
                            <input id="newKey" type="text" class="form-control" name="newKey" placeholder="Title">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="form-group mb-3">
                            <label for="newValue" class="col-form-label">Value:</label>
                            <input id="newValue" type="text" class="form-control" name="newValue" placeholder="Value">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <button type="submit" class="btn btn-primary mt-4">Update Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection