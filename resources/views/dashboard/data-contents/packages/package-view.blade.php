@extends('dashboard.index')

@section('title', 'Package '.$package->title)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('packages.index') }}">Packages</a></li>
    <li class="breadcrumb-item active">Package {{ $package->title }}</li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Package <span class="text-primary">{{ $package->title }}</span></b>
                <a href="{{ route('packages.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span>Category:</span> <span class="pull-right">{{ slugToTitle($package->category) }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Price:</span> <span class="pull-right">{{ $package->price_currency }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Additional price per adult:</span> <span class="pull-right">{{ $package->extra_person_per_adult. ' ' . config('app.base_currency') }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Additional Price Per Child:</span> <span class="pull-right">{{ $package->extra_person_per_child. ' ' . config('app.base_currency') }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Serial No.:</span> <span class="pull-right">{{ $package->serial_no }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Status:</span> <span class="pull-right text-{{ $package->status ? 'primary' : 'danger' }}">{{ $package->status ? 'Active' : 'Inactive' }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-2">
                        <ul class="list-group text-center">
                            <li class="list-group-item">
                                Default Image
                            </li>
                            <li class="list-group-item">
                                <img src="{{ !empty($package->default_image) ? $package->default_image : asset('imgs/image-not-found.png') }}" alt="Image" class="img-fluid mx-height-200">
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                                Description
                            </li>
                            <li class="list-group-item">
                                {!! $package->description !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection