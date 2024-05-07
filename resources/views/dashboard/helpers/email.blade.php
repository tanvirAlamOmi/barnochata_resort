<div class="form-group mb-3">
    <label for="email" class="col-form-label">Email Address</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="your@email.com" value="{{ !empty($editRow) ? $editRow->email : old('email') }}" required>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>