<div class="row">
    <div class="col-12">
        <div class="form-group mb-3">
            <label for="serial_no" class="col-form-label">Video Type</label>
            <div class="d-block">
                <label for="type-input-check-vdo_link" class="input-container mb-0 fw500">Video Shared Link
                    <input class="type-input-check" type="radio" name="video_type" value="vdo_link" id="type-input-check-vdo_link">
                    <span class="box-checkmark"></span>
                </label>
                <label for="type-input-check-embed_code" class="input-container mb-0 fw500 ml-20">Embed Code
                    <input class="type-input-check" type="radio" name="video_type" value="embed_code" id="type-input-check-embed_code">
                    <span class="box-checkmark"></span>
                </label>
                <!-- <label class="input-container mb-0 fw500 ml-20">File
                    <input class="type-input-check" type="radio" name="video_type" value="file">
                    <span class="box-checkmark"></span>
                </label> -->
            </div>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- <div class="col-12 hide-div" id="file-input-div">
        <div class="form-group mb-3">
            <label for="file" class="col-form-label">Upload Video File</label>
            <input type="file" class="form-control type-input @error('file') is-invalid @enderror" id="file" name="file" placeholder="upload video" accept="video/*">
            <span id="videoSizeAlert" class="text-danger hide">
                Max Size: 20MB
            </span>
            @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div> -->
    <div class="row hide-div" id="vdo_link-input-div">
        <div class="col-lg-6 col-md-6">
            <div class="form-group mb-3">
                <label for="vdo_link" class="col-form-label">Video Link</label>
                <input type="url" class="form-control type-input @error('vdo_link') is-invalid @enderror" id="vdo_link" name="vdo_link" placeholder="upload video">
                @error('vdo_link')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group mb-3">
                <label for="vdo_link_thumbnail" class="col-form-label">Video Thumbnail</label>
                <input type="file" class="form-control @error('vdo_link_thumbnail') is-invalid @enderror" id="vdo_link_thumbnail" name="vdo_link_thumbnail" placeholder="upload vdo link thumbnail" onchange="readImageURL(this, 'thumbnailView');" accept="image/png, image/gif, image/jpeg, image/PNG, image/GIF, image/JPEG">
                <span id="thumbnailViewAlert" class="text-danger hide">
                    Max Size: 2MB
                </span>
                <img id="thumbnailView" src=""  alt="image" class="mt-2 mb-3 img-fluid img-thumbnail mx-y-200 hide">
                @if(!empty($editRow) && $editRow->vdo_link_thumbnail)
                    <label class="col-form-label">
                        Existing Image
                    </label>
                    <div class="form-check form-check-inline pull-right mt-2">
                        <input class="form-check-input" type="checkbox" name="delete_old_image" id="delete_old_image" value="yes">
                        <label class="form-check-label text-danger" for="delete_old_image">Delete</label>
                    </div>
                @endif
                @error('vdo_link_thumbnail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 hide-div" id="embed_code-input-div">
        <div class="form-group mb-3">
            <label for="embed_code" class="col-form-label">Embed Code</label>
            <textarea name="embed_code" id="embed_code" cols="1" rows="5" class="form-control type-input" placeholder="paste embed code here"></textarea>
            @error('embed_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {

            var editRow = {!! json_encode($editRow) !!};

            $('.type-input-check').prop('checked',false);

            if(editRow)
            {
                console.log(editRow)
                $('#type-input-check-'+editRow['type']).prop('checked',true);
                updateTypeInput(editRow['type']);
                if(editRow['embed_code'])
                {
                    $('#embed_code').val(editRow['embed_code']);
                }
                if(editRow['vdo_link'])
                {
                    $('#vdo_link').val(editRow['vdo_link']);
                }
                if(editRow['vdo_link_thumbnail'])
                {
                    $('#thumbnailView').prop('src', editRow['thumbnail_path']);
                    $('#thumbnailView').show()
                }

            }else{
                presetInputs();
            }

            function presetInputs()
            {
                $('.hide-div').hide();
                $('.type-input').prop('required',false);
                $('.type-input').val('');
            }

            $('.type-input-check').change(function(){
                if($(this).prop('checked'))
                {
                    updateTypeInput($(this).val());
                }
            });

            function updateTypeInput(type)
            {
                presetInputs();
                $('#'+type+'-input-div').show();
                $('#'+type+'-input-div .type-input').prop('required',true);
            }
        });
    </script>
@endpush