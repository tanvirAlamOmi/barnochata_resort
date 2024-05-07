@extends('dashboard.index')
@section('title', !empty($editRow) ? 'Edit ' . $editRow->name : 'Add Image')

@php $urlArray = explode('/', getFullUrl()) @endphp

@section('breadcrumbs')

    <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pages.show',$section->page_id) }}">Pages Details</a></li>
    <li class="breadcrumb-item active"><a href="#">{{ !empty($editRow) ? 'Edit ' . $editRow->name : 'Add Image' }}</a></li>

@endsection

@section('dashboard_content')

<style>
    .btnDeleteImg {position: absolute;}
</style>

    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit ' . $editRow->name : 'Add Image' }}</b>
                <span class="text-secondary">- Section: {{ $section->name }}</span>
                @if(!empty($textContent))
                    <span class="text-secondary">, Content: {{ $textContent->title }}</span>
                @endif
                <a class="btn btn-sm btn-primary pull-right fw-500" href="{{ route('pages.show',$section->page_id) }}">
                    Page Details
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

                    <!-- row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-sm-12 control-label fw500">Image(s)</label>

                                <div class="col-sm-12">
                                    <small class="fw500">Accept: <span class="text-danger">jpg, jpeg, png, gif</span></small>
                                </div>

                                <div class="col-sm-8">
                                    
                                    <div class="custom-file">
                                        <input id="image" type="file" name="images[]" class="custom-file-input" accept=".jpg, .jpeg, .png, .gif" multiple="">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose files...</label>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            @include('dashboard.helpers.image-shape')
                        </div>
                    </div>
                    <!-- ./row -->
                    <!-- row -->
                    <div class="row">
                        <hr>
                        <div class="col-sm-12">
                            <div class="row" id="imageTray">
                            </div>
                        </div>
                    </div>
                    <!-- ./row -->
                    <!-- row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">{{ !empty($editRow->id) ? 'Update' : 'Save' }}</button>
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
    var properties = {!! json_encode(explode(',',$section->property)) !!};
    var title = caption = link = description = '';
    for (var i = properties.length - 1; i >= 0; i--) {
        if(properties[i] == 'imageTitle'){
            title = "<input type='text' class='form-control' name='title[]' value='' placeholder='Title'>";
        }
        if(properties[i] == 'imageCaption'){
            caption = "<textarea class='form-control' name='caption[]' cols='1' rows='2' placeholder='caption'></textarea>";
        }
        if(properties[i] == 'imageLink'){
            link = "<input type='text' class='form-control' name='link[]' value='' placeholder='link'>";
        }
        if(properties[i] == 'imageDescription'){
            description = "<textarea cols='1' rows='3' class='form-control' name='description[]' placeholder='description'></textarea>";
        }
    }

    window.onload = function(){
        //Check File API support
        if(window.File && window.FileList && window.FileReader)
        {
            var filesInput = document.getElementById("image");
            filesInput.addEventListener("change", function(event){
                var files = event.target.files; //FileList object
                var output = document.getElementById("imageTray");
                for(var i = 0; i< files.length; i++)
                {
                    var file = files[i];
                    //Only pics
                    if(!file.type.match('image'))
                        continue;
                    var picReader = new FileReader();
                    picReader.addEventListener("load",function(event){
                        var picFile = event.target;
                        var div = document.createElement("div");
                        div.classList.add("col-sm-4");
                        div.classList.add("mb-4");
                        div.innerHTML = "<button type='button' class='btn btn-sm btn-danger btnDeleteImg' onclick='this.parentElement.remove();'>X</button><img class='img-fluid' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>"+title+caption+link+description+"<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>Serial No</span></div><input type='number' class='form-control' placeholder='0' name='serialNo[]'></div><input type='hidden' name='uploadedImages[]' value='"+picFile.result+"'>";
                        output.insertBefore(div,null);
                    });
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            });
        }
        else
        {
            console.log("Your browser does not support File API");
        }
    }

    $(document).ready(function(){
        //
    });
</script>

@endpush