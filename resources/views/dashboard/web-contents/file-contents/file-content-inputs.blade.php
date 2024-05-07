@extends('dashboard.index')
@section('title', (!empty($editRow) ? 'Edit ' . $editRow->name : 'Add ') . ($section->type == 'groupContent' ? getGroupContentType($section->property) : slugToTitle($section->type)) )

@php $urlArray = explode('/', getFullUrl()) @endphp

@section('breadcrumbs')

    <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pages.show',$section->page_id) }}">Pages Details</a></li>
    <li class="breadcrumb-item active"><a href="#">{{ !empty($editRow) ? 'Edit ' . $editRow->name : 'Add ' }} {{ $section->type == 'groupContent' ? getGroupContentType($section->property) : slugToTitle($section->type) }}</a></li>

@endsection

@section('dashboard_content')

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <h4 class="page-header">
                <i class="fa fa-file-pdf-o"></i> {{ !empty($editRow) ? 'Edit ' . $editRow->name : 'Add ' }} {{ $section->type == 'groupContent' ? getGroupContentType($section->property) : slugToTitle($section->type) }} <span class="text-secondary">- Section: {{ $section->name }}</span>
                <span class="pull-right"><a href="{{ route('pages.show',$section->page_id) }}" class="btn btn-sm btn-info">Page Details</a></span>
            </h4>                    
        </div>
    </div>

    <hr class="heading-devider">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ !empty($editRow) ? route('file-content.update',$editRow->id) : route('file-content.store') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                        @endif

                        <input type="hidden" name="sectionId" value="{{ $section->id }}">

                        <!-- row -->
                        <div class="row">
                            
                            @if(in_array('fileTitle', explode(',',$section->property)))
                            <div class="col-sm-4">
                                @include('dashboard.helpers.title')
                            </div>
                            @endif

                            <div class="col-sm-4">
                                @include('dashboard.helpers.serial-no')
                            </div>
                            <div class="col-sm-4">
                                @include('dashboard.helpers.status')
                            </div>
                        </div>
                        <!-- ./row -->
                        <!-- row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                    <div class="col-12">
                                        <small class="text-danger">NB: New file will delete existing file automatically.</small>
                                    </div>
                                    <label for="file" class="col-sm-8 control-label fw500">File <small class="text-danger">(pdf only)</small></label>
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" accept=".pdf" required="">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        </div>
                                        @if ($errors->has('file'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(!empty($editRow->file))
                                <div class="col-sm-6">
                                    <embed src="{{ asset('file_content/'.$editRow->file) }}" width="100%" height="auto" />
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