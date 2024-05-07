<div class="form-group mb-3">
    <label for="serial_no" class="col-form-label">Serial No</label>
    <input id="serial_no" type="number" class="form-control @error('serial_no') is-invalid @enderror" name="serial_no" placeholder="serial no(1,2,3...)" value="{{ !empty($editRow) ? $editRow->serial_no : old('serial_no') }}">
    @error('serial_no')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>