<div class="form-group mb-3">
    <label for="position" class="col-form-label">Position</label>
    <input id="position" type="number" class="form-control @error('position') is-invalid @enderror" name="position" placeholder="position(1,2,3...)" value="{{ !empty($editRow) ? $editRow->position : old('position') }}" required>
    @error('position')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>