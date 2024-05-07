@extends('dashboard.index')

@section('title', 'Edit Section')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('pages.show',$editRow->page->id) }}">Page Details</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Edit Section</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Edit Section</b>
                <a href="{{ route('pages.show',$editRow->page->id) }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('sections.update',$editRow->id) }}" enctype="multipart/form-data">
                    
                    @csrf
                    @if(!empty($editRow))
                        {{ method_field('PATCH') }}
                    @endif

                    <input type="hidden" name="page_id" value="{{ $editRow->page->id }}">

                    <div class="row">
                        @include('dashboard.helpers.section-inputs-helper')
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                                {{ !empty($editRow) ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            var editRow = {!! json_encode($editRow) !!};

            if(!editRow){
                $('.type-input').prop('checked',false);
                $('.option-input').prop('checked',false);
            }else{
                if(editRow['type'] == 'external_link'){
                    $('#linkUrlDiv').show();
                }
            }

            $('#menu_id').change(function(){
                var title = $(this).find('option:selected').text();
                $('#title').val(title);
            });

            $('.type-input').change(function(){
                if($(this).prop('checked',true) && $(this).val() == 'external_link'){
                    $('#linkUrlDiv').show();
                }else{
                    $('#linkUrlDiv').hide();
                }
            });
        })
    </script>

@endpush