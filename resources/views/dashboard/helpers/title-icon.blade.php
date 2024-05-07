<div class="form-group mb-3">
    <label for="title_icon" class="col-form-label">Title Icon</label>
    <input id="title_icon" type="text" class="form-control @error('title_icon') is-invalid @enderror" name="title_icon" placeholder="Title Icon ex:<i class='fa fa-user'></i>" value="{{ !empty($editRow) ? $editRow->title_icon : old('title_icon') }}">
    @error('title_icon')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>