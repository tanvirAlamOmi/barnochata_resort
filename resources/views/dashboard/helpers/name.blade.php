<div class="form-group mb-3">
    <label for="name" class="col-form-label">Name</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="name" value="{{ !empty($editRow) ? $editRow->name : old('name') }}" required autofocus>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>