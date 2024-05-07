@extends('dashboard.index')

@section('title', 'Notices')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Notice </a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="flex-grow-1 mb-0">Notice Details</h4>
                                <a href="{{ route('notices.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h5 class="flex-grow-1 mb-0">{{ $notice->title }}</h5>
                                <p>{{ dateTimeAsReadable($notice->created_at) }}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ !empty($notice->image) ? asset('img-contents/notice-images/'.$notice->image) : '' }}" alt="{{ !empty($notice->image) ? 'Image' : 'No Image Found' }}" class="img-fluid ">
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <strong>Serial No:</strong> {{ $notice->serial_no }}
                                    </div>
                                    <div class="mb-4">
                                        <strong>Status:</strong> {{ $notice->status ? 'Active' : 'Inactive' }}
                                    </div> 
                                    <div class="mb-4">
                                        <strong>Description:</strong>
                                        <p>{!! $notice->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

@endsection
 