<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input name="status" class="form-check-input" type="checkbox" id="status" value="yes" checked="{{ !empty($editRow) && $editRow->status ? true : false }}">
        <label class="form-check-label" for="status">Status</label>
    </div>
</div>