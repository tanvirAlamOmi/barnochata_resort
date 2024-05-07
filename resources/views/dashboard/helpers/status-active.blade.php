<div class="form-group mb-3">
    <label for="status" class="col-form-label">Status</label>
    <div class="form-check form-switch">
        <input name="status" class="form-check-input" type="checkbox" id="status" value="yes" checked="{{ !empty($editRow) && $editRow->status ? true : false }}">
        <label class="form-check-label" for="status">Inctive</label>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            var checkbox = $("#status");
            var label = $(".form-check-label[for='status']");
            checkbox.change(function () {
                updateStatus();
            });

            function updateStatus(){
                if (checkbox.is(":checked")) {
                    label.text("Active");
                } else {
                    label.text("Inactive");
                }
            }

            updateStatus();
        });
    </script>
@endpush