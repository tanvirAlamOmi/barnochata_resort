<div class="container-fluid pl-0 pr-0">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <label for="name" class="col-form-label">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="name" value="{{ !empty($editRow) ? $editRow->name : old('name') }}" required autofocus {{ !empty($editRow) ? 'disabled' : '' }}>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            @include('dashboard.helpers.serial-no')
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="form-group mb-3">
                <label for="heading" class="col-form-label">Section Heading</label>
                <input id="heading" type="text" class="form-control @error('heading') is-invalid @enderror" name="heading" placeholder="heading" value="{{ !empty($editRow) ? $editRow->heading : old('heading') }}">
                @error('heading')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <!-- row -->
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
                <img id="imageView" src="{{ !empty($editRow) && !empty($editRow->image) ? asset('img-contents/section-images/'.$editRow->image) : '' }}"  alt="image" class="mt-2 mb-3 img-fluid img-thumbnail mx-y-200 {{ !empty($editRow) && !empty($editRow->image) ? '' : 'hide' }}">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if(!empty($editRow->image))
                <div class="form-group mb-3">
                    <div class="form-check form-switch">
                        <input name="delete_old_image" class="form-check-input" type="checkbox" id="deleteOldImage" value="yes">
                        <label class="form-check-label" for="deleteOldImage">Delete Old Image</label>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-sm-4">
            @include('dashboard.helpers.image-shape')
        </div>

    </div>

    <div class="row">
        <div class="col-sm-2">
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <div class="col-12">
                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input name="type" class="form-check-input" type="checkbox" id="type" value="yes" {{ !empty($editRow) ? 'checked disabled' : '' }}>
                            <label class="form-check-label" for="type">Type</label>
                        </div>
                    </div>
                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            @include('dashboard.helpers.status-boolean')
        </div>
        <div class="col-12"></div>
    </div>
    <!-- ./row -->
</div>

@if(!$editRow)

<div class="container-fluid collapse" id="sectionType">
    <div class="row">
        <div class="col-12">
            <h5>Select Section Type</h5>
        </div>
    </div>
    <div class="row mb-3">

        <div class="col-md-4 col-sm-2 mb-3">
            <ul class="list-group section-entry-list" id="article">
                <li class="list-group-item pt-2">
                    <label class="input-container mb-0 fw500">Article / Text Content
                        <input class="contentType" type="radio" name="type" value="article">
                        <span class="box-checkmark"></span>
                    </label>
                </li>
                <li class="list-group-item text-center">
                    <div class="slide-box">
                        <i class="fa fa-file-text text-secondary"></i>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="textTitle" id="articleTitle" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="articleTitle"><span class="text-primary">Title</span></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="textDescription" id="articleDescription" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="articleDescription"><span class="text-primary">Text Editor Description</span></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="textImage" id="articleCoverImage" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="articleCoverImage"><span class="text-primary">Related Images</span></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="textVideo" id="articleVideo" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="articleVideo"><span class="text-primary">Related Videos</span></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="textFile" id="articleFile" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="articleFile"><span class="text-primary">Related Files</span></label>
                    </div>
                    <!-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="textLink" id="articleLink" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="articleLink"><span class="text-primary">Link</span></label>
                    </div> -->
                </li>
            </ul>
        </div>

        <div class="col-md-4 col-sm-2 mb-3">
            <ul class="list-group section-entry-list" id="msWord">
                <li class="list-group-item pt-2">
                    <label class="input-container mb-0 fw500">MS Word Copy & Paste
                        <input class="contentType" type="radio" name="type" value="msWord">
                        <span class="box-checkmark"></span>
                    </label>
                </li>
                <li class="list-group-item text-center">
                    <div class="slide-box">
                        <i class="fa fa-file-word text-secondary"></i>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li class="list-group-item">
                    Compatible with <span class="text-danger">Microsoft Word</span> or copyable custom text type contents to copy and then paste here<small class="text-danger">(Text Only)</small>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="msWordDescription" id="msWordDescription" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="msWordDescription"><span class="text-primary">Text Editor Description</span></label>
                    </div>
                </li>
            </ul>
        </div>

        <div class="col-md-4 col-sm-2 mb-3">
            <ul class="list-group section-entry-list" id="imageSlider">
                <li class="list-group-item pt-2">
                    <label class="input-container mb-0 fw500">Image Slider
                        <input class="contentType" type="radio" name="type" value="imageSlider">
                        <span class="box-checkmark"></span>
                    </label>
                </li>
                <li class="list-group-item text-center">
                    <span class="pull-left"><i class="fa fa-angle-left fa-3x text-secondary"></i></span>
                    <span class="pull-right"><i class="fa fa-angle-right fa-3x text-secondary"></i></span>
                    <div class="slide-box">
                        <i class="fa fa-image text-secondary"></i>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="imageTitle" id="slideImageTitle" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="slideImageTitle"><span class="text-primary">Title</span></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="imageCaption" id="slideImageCaption" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="slideImageCaption"><span class="text-primary">Caption</span></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="imageLink" id="slideImageLink" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="slideImageLink"><span class="text-primary">Link</span></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input property" value="imageDescription" id="slideImageDescription" name="property[]">
                        <label class="custom-control-label fw500 text-dark" for="slideImageDescription"><span class="text-primary">Text Editor Description</span></label>
                    </div>
                </li>
            </ul>
        </div>

    </div>

    <div class="row mb-3">

        <div class="col-sm-12 mb-3">
            <ul class="list-group section-entry-list" id="groupContent">
                <li class="list-group-item pt-2">
                    <span class="d-inline mr-3">
                        <label class="input-container mb-0 fw500">Group Content
                            <input class="contentType" type="radio" name="type" value="groupContent">
                            <span class="box-checkmark"></span>
                        </label>
                    </span>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul class="list-group group-content-entry-list" id="imageContent">
                                <li class="list-group-item">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input groupContentType" name="groupContentType" id="groupImage" value="imageContent">
                                        <label class="custom-control-label fw500 text-dark" for="groupImage"><span class="text-primary">Image</span></label>
                                    </div>
                                </li>
                                <li class="list-group-item text-center text-secondary">
                                    <span class="col">
                                        <i class="fa fa-image fa-5x"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="imageTitle" id="contentImageTitle" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentImageTitle"><span class="text-primary">Title</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="imageCaption" id="contentImageCaption" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentImageCaption"><span class="text-primary">Caption</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="imageLink" id="contentImageLink" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentImageLink"><span class="text-primary">Link</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="imageDescription" id="contentImageDescription" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentImageDescription"><span class="text-primary">Text Editor Description</span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <ul class="list-group group-content-entry-list" id="textContent">
                                <li class="list-group-item">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input groupContentType" name="groupContentType" id="groupText" value="textContent">
                                        <label class="custom-control-label fw500 text-dark" for="groupText"><span class="text-primary">Text</span></label>
                                    </div>
                                </li>
                                <li class="list-group-item text-center text-secondary">
                                    <span class="col">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="textTitle" id="textContentTitle" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="textContentTitle"><span class="text-primary">Title</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="textTitleIcon" id="textContentIcon" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="textContentTitleIcon"><span class="text-primary">Title Icon</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="textDescription" id="textContentDescription" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="textContentDescription"><span class="text-primary">Text Editor Description</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="textImage" id="textContentCoverImage" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="textContentCoverImage"><span class="text-primary">Image</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="textLink" id="textContentLink" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="textContentLink"><span class="text-primary">Details Link</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="textVideo" id="textContentVideo" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="textContentVideo"><span class="text-primary">Video</span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <ul class="list-group group-content-entry-list" id="videoContent">
                                <li class="list-group-item">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input groupContentType" name="groupContentType" id="groupVideo" value="videoContent">
                                        <label class="custom-control-label fw500 text-dark" for="groupVideo"><span class="text-primary">Video</span></label>
                                    </div>
                                </li>
                                <li class="list-group-item text-center text-secondary">
                                    <span class="col">
                                        <i class="fa fa-file-video fa-5x"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="videoTitle" id="contentVideoTitle" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentVideoTitle"><span class="text-primary">Title</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="videoDescription" id="contentVideoDescription" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentVideoDescription"><span class="text-primary">Text Editor Description</span></label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input property groupContentProperty" id="contentVideoEmbedCode" value="videoEmbed" checked="" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentVideoEmbedCode"><span class="text-primary">Youtube Embed Code</span></label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input property groupContentProperty" id="contentVideoLink" value="videoLink" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentVideoLink"><span class="text-primary">Youtube Share Link</span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <ul class="list-group group-content-entry-list" id="fileContent">
                                <li class="list-group-item">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input groupContentType" name="groupContentType" id="groupFile" value="fileContent">
                                        <label class="custom-control-label fw500 text-dark" for="groupFile"><span class="text-primary">File (PDF)</span></label>
                                    </div>
                                </li>
                                <li class="list-group-item text-center text-secondary">
                                    <span class="col">
                                        <i class="fa fa-file-pdf fa-5x"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input property groupContentProperty" value="fileTitle" id="contentFileTitle" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="contentFileTitle">File <span class="text-primary">Title</span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </div>

    <div class="row mb-3">

        <div class="col-sm-6 mb-3">
            <ul class="list-group section-entry-list" id="dataContent">
                <li class="list-group-item pt-2">
                    <span class="d-inline mr-3">
                        <label class="input-container mb-0 fw500">Data Content
                            <input class="contentType" type="radio" name="type" value="dataContent">
                            <span class="box-checkmark"></span>
                        </label>
                    </span>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-group section-entry-list">
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox d-block">
                                        <input type="checkbox" class="custom-control-input property" value="displayTitle" id="displayTitle" name="property[]">
                                        <label class="custom-control-label fw500 text-dark" for="displayTitle"><span class="text-primary">Display Title</span></label>
                                    </div>
                                </li>
                                <li class="list-group-item text-center text-secondary">
                                    <span class="col">
                                        <i class="fa fa-cubes fa-5x"></i>
                                    </span>
                                    <span class="col">
                                        <i class="fa fa-cubes fa-5x"></i>
                                    </span>
                                    <span class="col">
                                        <i class="fa fa-cubes fa-5x"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div>

@endif

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var status = typeSelected = false;
        $('.section-entry-list').find('.custom-control-input').prop('disabled',true);
        $('.section-entry-list').find('.custom-control-input').prop('checked',false);
        // open typ selection modal
        $('#addSectionBtn').click(function(){
           $("#sectionEntryModal").modal({backdrop: "static"}); 
        });
        $('#type').change(function(){
            if($('#type:checked').val())
            {
                $("#sectionType").collapse('show');
            }else{
                $("#sectionType").collapse('hide');
            }
            enableEntry();
        });
        $('.contentType').change(function(){
            var contentName = $(this).val();
            $('.section-entry-list').removeClass('active');
            $('.section-entry-list').find('.property').prop('disabled',true);
            $('.section-entry-list').find('.property').prop('checked',false);
            $('#'+contentName).addClass('active');
            $('#'+contentName).find('.property').prop('disabled',false);

            if(contentName == 'groupContent')
            {
                $('.groupContentType').prop('disabled',false);
            }else{
                $('.groupContentType').prop('disabled',true);
                $('.groupContentType').removeClass('active');
                $('.group-content-entry-list').removeClass('active');
                $('.group-content-entry-list').find('.groupContentProperty').prop('disabled',true);
                $('.group-content-entry-list').find('.groupContentProperty').prop('checked',false);
            }
            status = true;
            enableEntry();
        });
        $('.groupContentType').change(function(){
            var groupContentName = $('.groupContentType:checked').val();
            console.log(groupContentName);
            $('.group-content-entry-list').removeClass('active');
            $('.group-content-entry-list').find('.groupContentProperty').prop('disabled',true);
            $('.group-content-entry-list').find('.groupContentProperty').prop('checked',false);
            $('#'+groupContentName).addClass('active');
            $('#'+groupContentName).find('.groupContentProperty').prop('disabled',false);

            enableEntry();
        });
        $('.property').change(function() {
            enableEntry(); 
        });
        function enableEntry()
        {
            if($('.contentType:checked').val() == 'msWord' || $('.contentType:checked').val() == 'dataContent'){
                typeSelected = $('.contentType:checked').val();
            }else{
                typeSelected = $('.property:checked').val();
            }
            if(status && typeSelected){
                $('#submitBtn').prop('disabled', false);
            }else{
                $('#submitBtn').prop('disabled', true);
            }
        }
    });
</script>

@endpush
