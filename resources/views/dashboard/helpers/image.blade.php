<div class="form-group mb-3">
    <label for="image" class="col-form-label">Image</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="upload image" onchange="readImageURL(this, 'imageView');" accept="image/png, image/gif, image/jpeg, image/PNG, image/GIF, image/JPEG">
    <span id="imageViewAlert" class="text-danger hide">
        Max Size: 5MB
    </span>
    <img id="imageView" src=""  alt="image" class="mt-2 mb-3 img-fluid img-thumbnail mx-y-200 hide">
    @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>