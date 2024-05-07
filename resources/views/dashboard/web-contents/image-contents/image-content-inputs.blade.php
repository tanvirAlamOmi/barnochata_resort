@extends('dashboard.index')
@section('title', !empty($editRow) ? 'Edit Image' : 'Add Image')

@section('breadcrumbs')

    <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pages.show',$editRow->section->page_id) }}">Pages Details</a></li>
    <li class="breadcrumb-item active"><a href="#">{{ !empty($editRow) ? 'Edit Image' : 'Add Image' }}</a></li>

@endsection

@section('dashboard_content')

    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit Image' : 'Add Image' }}</b>
                <a href="{{ route('pages.show',$editRow->section->page_id) }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ !empty($editRow) ? route('image-contents.update',$editRow->id) : route('image-contents.store') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    @if(!empty($editRow))
                    {{ method_field('PATCH') }}
                    @endif

                    <input type="hidden" name="sectionId" value="{{ $section->id }}">
                    <input type="hidden" name="textContentId" value="{{ !empty($textContent) ? $textContent->id : '' }}">
                    <input type="hidden" name="pageId" value="{{ $section->page_id }}">

                    <div class="row">                        
                        @if(in_array('imageTitle', explode(',',$editRow->section->property)))
                            <div class="col-sm-4">
                                @include('dashboard.helpers.title')
                            </div>
                        @endif

                        <div class="col-sm-4">
                            @include('dashboard.helpers.serial-no')
                        </div>
                    </div>

                    @if(in_array('imageCaption', explode(',',$editRow->section->property)))
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                @include('dashboard.helpers.caption')
                            </div>
                        </div>
                    @endif

                    @if(in_array('imageLink', explode(',',$editRow->section->property)))
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                @include('dashboard.helpers.link')
                            </div>
                        </div>
                    @endif

                    @if(in_array('imageDescription', explode(',',$editRow->section->property)))
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                @include('dashboard.helpers.description')
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group mb-1">
                                <label for="image" class="col-form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="upload image" onchange="readImageURL(this, 'imageView');" accept="image/png, image/gif, image/jpeg, image/PNG, image/GIF, image/JPEG">
                                @if(!empty($editRow->image))
                                    <small class="text-danger">New image will delete the old image automatically.</small>
                                @endif
                                <span id="imageViewAlert" class="text-danger hide">
                                    Max Size: 5MB
                                </span>
                                <img id="imageView" src="{{ !empty($editRow) && !empty($editRow->image) ? asset('img-contents/content-images/'.$editRow->image) : '' }}"  alt="image" class="mt-2 mb-3 img-fluid img-thumbnail mx-y-200 {{ !empty($editRow) && !empty($editRow->image) ? '' : 'hide' }}">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            @include('dashboard.helpers.image-shape')
                        </div>
                    </div>

                    @if(in_array('textDescription', explode(',',$section->property)) || $section->type == 'msWord')
                        <div class="row">
                            <div class="col-8">
                                @include('dashboard.helpers.description')
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
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

<script type="text/javascript">
    $(document).ready(function(){
        //
    });
</script>

@endpush