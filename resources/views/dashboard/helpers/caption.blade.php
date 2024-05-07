<div class="form-group mb-3">
    <label for="caption" class="col-form-label">Caption</label>
    <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" placeholder="caption" value="{{ !empty($editRow) ? $editRow->caption : old('caption') }}" required autofocus>
    @error('caption')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>