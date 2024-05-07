<div class="form-group mb-3">
    <label for="default_image" class="col-form-label">Deafult Image</label>
    <input type="file" class="form-control @error('default_image') is-invalid @enderror" id="default_image" name="default_image" placeholder="upload image" onchange="readImageURL(this, 'imageView');" accept="image/png, image/gif, image/jpeg, image/PNG, image/GIF, image/JPEG">
    <span id="imageViewAlert" class="text-danger hide">
        Max Size: 5MB
    </span>
    <img id="imageView" src="{{ !empty($editRow->default_image) ? $editRow->default_image : '' }}"  alt="image" class="mt-2 mb-3 img-fluid img-thumbnail mx-y-200 {{ !empty($editRow->default_image) ? '' : 'hide' }}">
    @if(!empty($editRow->default_image))
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="delete_existing_image" id="delete_existing_image" value="yes">
        <label class="form-check-label text-danger" for="delete_existing_image">Delete Existing Image</label>
    </div>
    @endif
    @error('default_image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>