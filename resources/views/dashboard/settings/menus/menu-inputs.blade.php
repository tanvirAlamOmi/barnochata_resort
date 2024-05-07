@extends('dashboard.index')

@section('title', !empty($editRow) ? 'Edit '.$editRow->name : 'Add Menu')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('menus.index') }}">Menus</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">{{ !empty($editRow) ? 'Edit '.$editRow->name : 'Add Menu' }}</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">{{ !empty($editRow) ? 'Edit '.$editRow->name : 'Add Menu' }}</b>
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ !empty($editRow) ? route('menus.update',$editRow) : route('menus.store') }}">
                    
                    @csrf
                    @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                    @endif

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            @include('dashboard.helpers.name')
                        </div>
                        <div class="col-lg-4 col-md-6">
                            @include('dashboard.helpers.position')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="type" class="col-form-label">Type</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type-input" type="radio" name="type" id="navigation" value="navigation" {{ old('type') || (!empty($editRow) && $editRow->type == 'navigation') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="navigation">Navigation</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type-input" type="radio" name="type" id="page" value="page" {{ old('type') || (!empty($editRow) && $editRow->type == 'page') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="page">Page</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type-input" type="radio" name="type" id="external_link" value="external_link" {{ old('type') || (!empty($editRow) && $editRow->type == 'external_link') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="external_link">External Link</label>
                                    </div>
                                </div>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group mb-3">
                                <label for="display_options" class="col-form-label">Display Options</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input option-input" type="checkbox" name="display_options[]" id="header" value="header" {{ old('display_options') && in_array('header', old('display_options')) || (!empty($editRow) && in_array('header',explode(',',$editRow->display_options))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="header">Header</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input option-input" type="checkbox" name="display_options[]" id="footer" value="footer" {{ old('display_options') && in_array('footer', old('display_options')) || (!empty($editRow) && in_array('footer',explode(',',$editRow->display_options))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="footer">Footer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input option-input" type="checkbox" name="display_options[]" id="sidebar" value="sidebar" {{ old('display_options') && in_array('sidebar', old('display_options')) || (!empty($editRow) && in_array('sidebar',explode(',',$editRow->display_options))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sidebar">Sidebar</label>
                                    </div>
                                </div>
                                @error('display_options')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row @error('link_url') show @else hide @enderror" id="linkUrlDiv">
                        <div class="col-lg-8 col-md-12">
                            <div class="form-group mb-3">
                                <label for="link_url" class="col-form-label">Link URL</label>
                                <input id="link_url" type="url" class="form-control @error('link_url') is-invalid @enderror" name="link_url" placeholder="http://your-link.com" value="{{ !empty($editRow) ? $editRow->link_url : old('link_url') }}">
                                @error('link_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if(!empty($menus) && count($menus) > 0)
                        <div id="parentDiv" class="row hide">
                            <div class="col-lg-8 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="parent_id" class="col-form-label">Parent <small class="text-success">(If Required)</small></label>
                                    <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                        <option value="">Select Parent Menu</option>
                                        @foreach($menus as $m => $menu)
                                            <option value="{{ $menu->id }}" {{ !empty($editRow) && $editRow->parent_id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

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

    <script type="text/javascript">
        $(document).ready(function(){
            var menus = {!! json_encode($menus) !!};
            var editRow = {!! json_encode($editRow) !!};

            if(!editRow){
                $('.type-input').prop('checked',false);
                $('.option-input').prop('checked',false);
            }else{
                if(editRow['type'] == 'external_link'){
                    $('#linkUrlDiv').show();
                }
            }

            $('.type-input').change(function(){
                if($(this).prop('checked',true) && $(this).val() == 'external_link'){
                    $('#linkUrlDiv').show();
                    $('#parentDiv').hide()
                }else if($(this).prop('checked',true) && $(this).val() == 'page'){
                    $('#linkUrlDiv').hide();
                    $('#parentDiv').show();
                }else{
                    $('#linkUrlDiv').hide();
                    $('#parentDiv').hide();
                }
            });
        })
    </script>

@endpush