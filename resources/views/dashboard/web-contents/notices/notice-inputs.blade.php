@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit '.$editRow->name : 'Add Notice')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('notices.index') }}">Notices</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">{{ !empty($editRow) ? 'Edit '.$editRow->name : 'Add Notice' }}</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit '.$editRow->name : 'Add Notice' }}</b>
                <a href="{{ route('notices.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('notices.update',$editRow) : route('notices.store') }}" enctype="multipart/form-data">
                    
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
                                <label for="serial_no" class="col-form-label">Serial No</label>
                                <input id="serial_no" type="text" class="form-control @error('serial_no') is-invalid @enderror" name="serial_no" placeholder="serial no" value="{{ !empty($editRow) ? $editRow->serial_no : old('serial_no') }}" required autofocus>
                                @error('serial_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="image" class="col-form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="upload image" onchange="readImageURL(this, 'imageView');" accept="image/png, image/gif, image/jpeg, image/PNG, image/GIF, image/JPEG">
                                @if(!empty($editRow) && $editRow->image)
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
                        <div class="col-lg-4 col-md-6">
                            @if(!empty($editRow) && $editRow->image)
                                <label class="col-form-label">
                                    Existing Image
                                </label>
                                <div class="form-check form-check-inline pull-right mt-2">
                                    <input class="form-check-input" type="checkbox" name="delete_image" id="delete_image" value="yes">
                                    <label class="form-check-label text-danger" for="delete_image">Delete</label>
                                </div>
                            @endif
                            <div>
                                <img id="imageView" src="{{ !empty($editRow->image) ? asset('img-contents/notice-images/'.$editRow->image) : '' }}"  alt="photo" class="mb-3 img-fluid img-thumbnail mx-y-200 {{ !empty($editRow->image) ? '' : 'hide' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            @include('dashboard.helpers.description')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            @include('dashboard.helpers.status-boolean')
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