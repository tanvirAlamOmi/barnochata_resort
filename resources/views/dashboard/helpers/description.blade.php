<div class="form-group mb-3">
    <label for="description" class="col-form-label">Description</label>
    <textarea id="description" name="description" rows="5" class="form-control">{{ !empty($editRow) ? $editRow->description : old('description') }}</textarea>

    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        });
    </script>
@endpush