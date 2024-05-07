<div class="form-group mb-3">
    <label for="mobile_no" class="col-form-label">Mobile Number</label>
    <input id="mobile_no" type="tel" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" placeholder="01xxxxxxxxx" value="{{ !empty($editRow) ? $editRow->mobile_no : old('mobile_no') }}" required>
    @error('mobile_no')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>