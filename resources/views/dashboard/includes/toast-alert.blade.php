@if(Session::has('message_success'))
<div class="alert alert-success alert-dismissible fade show lv-alert" role="alert">
    <strong>Success!!!</strong>
    <strong>{{ Session::get('message_success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('message_warning'))
<div class="alert alert-warning alert-dismissible fade show lv-alert" role="alert">
    <strong>Warning!!!</strong>
    <strong>{{ Session::get('message_warning') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('message_danger'))
<div class="alert alert-danger alert-dismissible fade show lv-alert" role="alert">
    <strong>Error!!!</strong>
    <strong>{{ Session::get('message_danger') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('message_info'))
<div class="alert alert-info alert-dismissible fade show lv-alert" role="alert">
    <strong>Info!!!</strong>
    <strong>{{ Session::get('message_info') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif