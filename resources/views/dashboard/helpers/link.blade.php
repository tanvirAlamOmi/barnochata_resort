<div class="form-group mb-3">
    <label for="link" class="col-form-label">Link</label>
    <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" placeholder="link" value="{{ !empty($editRow) ? $editRow->link : old('link') }}">
    @error('link')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>