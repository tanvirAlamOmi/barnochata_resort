@extends('dashboard.index')

@section('title', 'contact us')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Contact Us </a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> 
                            
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="flex-grow-1 mb-0">Message Details</h4>
                                <a href="{{ route('messages.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h5 class="flex-grow-1 mb-0">{{ $contact->name }}</h5>
                                <p> {{ dateTimeAsReadable($contact->created_at) }}</p> 
                             </div>
                            <div class="row">
                                
                                <div class="col-md-6 container">
                                     {{$contact->message}}
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <strong>Email:</strong> {{ $contact->email }}
                                    </div>

                                    <div class="mb-4">
                                        <strong>Email:</strong> {{ $contact->phone }}
                                    </div>

                                    <div class="mb-4">
                                        <strong>Status:</strong> {{ $contact->status ? 'Active' : 'Inactive' }}
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
 