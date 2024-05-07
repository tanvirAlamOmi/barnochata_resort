@extends('dashboard.index')

@section('title', 'Add Popup')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="#">Settings</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">{{ 'Add Popup' }}</a></li>
@endsection

@push('styles')
    <style>
        .vl {
            border-left: 6px solid #192a89;
            height: 350px;
            position: relative;
            left: 50%;
            margin-left: -3px;
            top: 0;
        }
    </style>
@endpush

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ 'Add Popup' }}</b>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('popup.update',$editRow) }}" enctype="multipart/form-data">
                    
                    @csrf
                    @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                    @endif

                    <div class="row">
                        <div class="col-5">
                            <div class="form-group mb-3">
                                <label for="title" class="col-form-label">Title</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="title" value="{{$popup['title'] ?? '' }}" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="col-form-label">Description</label>
                                <textarea id="description" name="description" class="form-control">{{ $popup['description'] ?? ''}}</textarea>
                            
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="external_link" class="col-form-label">Exernal Link</label>
                                <input id="external_link" type="text" class="form-control @error('external_link') is-invalid @enderror" name="external_link" placeholder="https://example.com" value="{{$popup['external_link'] ?? ''}}" autofocus>
                                @error('external_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="vl"></div>
                        </div>

                        <div class="col-5">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="image" class="col-form-label">Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="upload image" onchange="readImageURL(this, 'imageView');" accept="image/png, image/gif, image/jpeg, image/PNG, image/GIF, image/JPEG"
                                        @if(!empty($popup['image'])) value="{{  asset('img-contents/popup-images/'.$popup['image']) }}" @endif>
                                        @if( isset($popup['image']))
                                                <small class="text-danger">New Image will delete the existing image </small>
                                        @endif
                                        <span id="imageViewAlert" class="text-danger hide">
                                            Max Size: 5MB
                                        </span>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    @if(isset($popup['image']))
                                        <label class="col-form-label">
                                            Existing Image
                                        </label>
                                        <div class="form-check form-check-inline pull-right mt-2">
                                            <input class="form-check-input" type="checkbox" name="delete_image" id="delete_image" value="yes">
                                            <label class="form-check-label text-danger" for="delete_image">Delete</label>
                                        </div>
                                    @endif
                                    <div>
                                        <img id="imageView" src="{{ !empty($popup['image']) ? asset('img-contents/popup-images/'.$popup['image']) : '' }}"  alt="photo" class="mb-3 img-fluid img-thumbnail mx-y-200 {{ !empty($popup['image']) ? '' : 'hide' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="expire_date" class="col-form-label">Expire Date</label>
                                    <input id="expire_date" type="date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date" placeholder="expire_date" value="{{$popup['expire_date'] ?? '' }}" autofocus>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary"> Update </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3"></div>
                    </div>
                    
                   
                </form>
            </div>
        </div>
    </div>

@endsection
