<div class="form-group{{ $errors->has('shape') ? ' has-error' : '' }}">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 mb-2">
                <strong class="control-label fw500">Select a Shape <small>(if required)</small></strong>
            </div>
            <div class="col-sm-12 fw500">
                <div class="mr15">
                    <label class="input-container">None
                        <input id="none" class="shape" type="radio" name="shape" value="none">
                        <span class="radio-checkmark"></span>
                    </label>
                </div>
                <div class="mr15">
                    <label class="input-container">Square (will resize to 900px * 900px)
                        <input id="square" class="shape" type="radio" name="shape" value="square">
                        <span class="radio-checkmark"></span>
                    </label>
                </div>
                <div class="mr15">
                    <label class="input-container">Potrait (will resize to 600px * 900px)
                        <input id="potrait" class="shape" type="radio" name="shape" value="potrait">
                        <span class="radio-checkmark"></span>
                    </label>
                </div>
                <div class="mr15">
                    <label class="input-container">Landscape (will resize to 900px * 600px)
                        <input id="landscape" class="shape" type="radio" name="shape" value="landscape">
                        <span class="radio-checkmark"></span>
                    </label>
                </div>
                <div class="mr15">
                    <label class="input-container">Custom (Set Width * Height)
                        <input id="custom" class="shape" type="radio" name="shape" value="custom">
                        <span class="radio-checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="col-sm-12 mt-3" id="customShape">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('width') ? ' has-error' : '' }}">
                            <label for="width" class="col-sm-12 control-label fw500">Width (px)</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input id="width" type="text" class="form-control quantity_class" name="width" value="{{ !empty($editRow->width) ? $editRow->width : old('width') }}" placeholder="0" disabled="true">
                                </div>
                                @if ($errors->has('width'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('width') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                            <label for="height" class="col-sm-12 control-label fw500">height (px)</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input id="height" type="text" class="form-control quantity_class" name="height" value="{{ !empty($editRow->height) ? $editRow->height : old('height') }}" placeholder="0" disabled="true">
                                </div>
                                @if ($errors->has('height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->has('shape'))
            <div class="col-sm-12">
                <span class="help-block">
                    <strong>{{ $errors->first('shape') }}</strong>
                </span>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $('#customShape').hide();

        $('.shape').change(function(){
            if($(this).val() == 'custom'){
                $('#customShape').show();
                $('#width').prop('disabled',false);
                $('#height').prop('disabled',false);
            }else{
                $('#customShape').hide();
                $('#width').prop('disabled',true);
                $('#height').prop('disabled',true);
            }
        });
    });
</script>

@endpush