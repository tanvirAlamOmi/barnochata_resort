@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit Page' : 'Add Page')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">{{ !empty($editRow) ? 'Edit Page' : 'Add Page' }}</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit Page' : 'Add Page' }}</b>
                <a href="{{ route('pages.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('pages.update',$editRow) : route('pages.store') }}" enctype="multipart/form-data">
                    
                    @csrf
                    @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                    @endif

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <label for="menu_id" class="col-form-label">Menu</label>
                            <select name="menu_id" id="menu_id" class="form-control @error('menu_id') is-invalid @enderror">
                                <option value="">Select Menu</option>
                                @foreach($menus as $m => $menu)
                                    <option value="{{ $menu->id }}" {{ !empty($editRow) && $editRow->menu_id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                                @endforeach
                            </select>
                            @error('menu_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            @include('dashboard.helpers.title')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="type" class="col-form-label">Type</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type-input" type="radio" name="type" id="dynamic" value="dynamic" {{ old('type') || (!empty($editRow) && $editRow->type == 'dynamic') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dynamic">Dynamic</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type-input" type="radio" name="type" id="static" value="static" {{ old('type') || (!empty($editRow) && $editRow->type == 'static') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="static">Static</label>
                                    </div>
                                </div>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="form-group mb-3">
                                <label for="subtitle" class="col-form-label">Subtitle <small class="text-success">(optional)</small></label>
                                <input id="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" placeholder="subtitle" value="{{ !empty($editRow) ? $editRow->subtitle : old('subtitle') }}">
                                @error('subtitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div> -->

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
                                    <input class="form-check-input" type="checkbox" name="delete_old_image" id="delete_old_image" value="yes">
                                    <label class="form-check-label text-danger" for="delete_old_image">Delete</label>
                                </div>
                            @endif
                            <div>
                                <img id="imageView" src="{{ !empty($editRow->image) ? asset('img-contents/page-images/'.$editRow->image) : '' }}"  alt="photo" class="mb-3 img-fluid img-thumbnail mx-y-200 {{ !empty($editRow->image) ? '' : 'hide' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            @include('dashboard.helpers.status-boolean')
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12">
                            <a href="{{ route('pages.index') }}" class="btn btn-danger">
                                Cancel
                            </a>
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
            var editRow = {!! json_encode($editRow) !!};

            if(!editRow){
                $('.type-input').prop('checked',false);
                $('.option-input').prop('checked',false);
            }else{
                if(editRow['type'] == 'external_link'){
                    $('#linkUrlDiv').show();
                }
            }

            $('#menu_id').change(function(){
                var title = $(this).find('option:selected').text();
                $('#title').val(title);
            });

            $('.type-input').change(function(){
                if($(this).prop('checked',true) && $(this).val() == 'external_link'){
                    $('#linkUrlDiv').show();
                }else{
                    $('#linkUrlDiv').hide();
                }
            });
        })
    </script>

@endpush