@extends('dashboard.index')

@section('title', 'Facility '.$facility->title)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('facilities.index') }}">Facilities</a></li>
    <li class="breadcrumb-item active">Facility {{ $facility->title }}</li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Facility <span class="text-primary">{{ $facility->title }}</span></b>
                <a href="{{ route('facilities.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span>Serial No.:</span> <span class="pull-right">{{ $facility->serial_no }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Status:</span> <span class="pull-right text-{{ $facility->status ? 'primary' : 'danger' }}">{{ $facility->status ? 'Active' : 'Inactive' }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Created At:</span> <span class="pull-right">{{ dateTimeAsReadable($facility->created_at) }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-2">
                        <ul class="list-group text-center">
                            <li class="list-group-item">
                                Default Image
                            </li>
                            <li class="list-group-item">
                                <img src="{{ !empty($facility->default_image) ? $facility->default_image : asset('imgs/image-not-found.png') }}" alt="Image" class="img-fluid mx-height-200">
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                                Description
                            </li>
                            <li class="list-group-item">
                                {!! $facility->description !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection