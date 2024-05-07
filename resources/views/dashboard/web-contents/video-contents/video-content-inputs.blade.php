@extends('dashboard.index')
@section('title', (!empty($editRow) ? 'Edit ' . $editRow->name : 'Add ') . 'Video' )

@php $urlArray = explode('/', getFullUrl()) @endphp

@section('breadcrumbs')

    <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pages.show',$section->page_id) }}">Pages Details</a></li>
    <li class="breadcrumb-item active"><a href="#">{{ !empty($editRow) ? 'Edit ' . $editRow->name : 'Add ' }} Video</a></li>

@endsection

@section('dashboard_content')

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header bg-white">
            <b class="fs-120">{{ !empty($editRow) ? 'Edit Video' : 'Add Video' }}</b>
            <a href="{{ route('pages.show',$section->page_id) }}" class="btn btn-sm btn-primary pull-right fw-500">
                Back
            </a>
        </div>
        <div class="card-body">

            <form class="form-horizontal" role="form" method="POST" action="{{ !empty($editRow) ? route('video-contents.update',$editRow->id) : route('video-contents.store') }}" enctype="multipart/form-data">

                {{ csrf_field() }}
                @if(!empty($editRow))
                {{ method_field('PATCH') }}
                @endif

                <input type="hidden" name="sectionId" value="{{ $section->id }}">
                <input type="hidden" name="textContentId" value="{{ !empty($textContent) ? $textContent->id : '' }}">
                <input type="hidden" name="pageId" value="{{ $section->page_id }}">

                <div class="row">
                    <div class="col-sm-8">
                        @include('dashboard.helpers.title')
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        @include('dashboard.helpers.video-inputs-helper')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        @include('dashboard.helpers.description')
                    </div>
                </div>

                <!-- row -->
                <div class="row">
                    <div class="col-sm-4">
                        @include('dashboard.helpers.serial-no')
                    </div>
                    <div class="col-sm-4">
                        @include('dashboard.helpers.status-active')
                    </div>
                </div>
                <!-- ./row -->
                <!-- row -->
                <div class="row">

                    @if(in_array('videoLink', explode(',',$section->property)))
                        <div class="col-sm-8">
                            <div class="form-group{{ $errors->has('vdo_link') ? ' has-error' : '' }}">
                                <label for="vdo_link" class="col-sm-8 control-label fw500">Video Link</label>
                                <div class="col-sm-12">
                                    <textarea name="vdo_link" id="vdo_link" cols="1" rows="3" class="form-control">{{ !empty($editRow->vdo_link) ? $editRow->vdo_link : old('vdo_link') }}</textarea>
                                    @if ($errors->has('vdo_link'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('vdo_link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(in_array('videoEmbed', explode(',',$section->property)))
                        <div class="col-sm-8">
                            <div class="form-group{{ $errors->has('embed_code') ? ' has-error' : '' }}">
                                <label for="embed_code" class="col-sm-8 control-label fw500">Embed Code</label>
                                <div class="col-sm-12">
                                    <textarea name="embed_code" id="embed_code" cols="1" rows="5" class="form-control">{{ !empty($editRow->embed_code) ? $editRow->embed_code : old('embed_code') }}</textarea>
                                    @if ($errors->has('embed_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('embed_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- ./row -->
                <!-- row -->
                <div class="row">
                    
                    @if(in_array('videoDescription', explode(',',$section->property)))
                    <div class="col-sm-8">
                        @include('dashboard.helpers.description')
                    </div>
                    @endif

                </div>
                <!-- ./row -->
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-md btn-success">{{ !empty($editRow->id) ? 'Update' : 'Save' }}</button>
                    </div>
                </div>
                <!-- ./row -->
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