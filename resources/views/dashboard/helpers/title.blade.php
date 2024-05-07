<div class="form-group mb-3">
    <label for="title" class="col-form-label">Title</label>
    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="title" value="{{ !empty($editRow) ? $editRow->title : old('title') }}" required autofocus>
    @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>