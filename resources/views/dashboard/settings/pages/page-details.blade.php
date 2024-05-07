@extends('dashboard.index')

@section('title', 'Page Details - '.$page->title)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item active"><a class="btn-link" href="#">{{ $page->title }}</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Page Details - {{ $page->title }}</b>
                @if(Auth::user()->weight > 75)
                <button class="btn btn-sm btn-primary pull-right fw-500" data-bs-toggle="modal" data-bs-target="#sectionInputModal" data-bs-backdrop="static">
                    Add Section
                </button>
                @endif
            </div>
            <div class="card-body">
                @if(count($page->sections) > 0)

                    @foreach($page->sections as $s => $section)

                    <div class="row pb-2 pt-2 bg-section-header">
                        <div class="col-lg-8 col-md-8 mt-1">
                            <h5 class="mb-0">
                                <b class="text-primary">{{ $section->name }}</b> 
                                <small>({{ $section->type == 'groupContent' ? $section->type.'-'.getGroupContentType($section->property) : $section->type }})</small>
                                @if(!empty($section->image))
                                    <img src="{{ asset('img-contents/section-images/'.$section->image) }}" alt="" class="img-fluid img-xs">
                                @endif
                            </h5>
                        </div>

                        <div class="col-lg-4 col-md-4 text-right">
                            @if(Auth::user()->weight > 75)
                            <a href="{{ route('sections.edit',$section->id) }}" class="btn btn-sm btn-success mt-1">Edit</a>
                            <form class="d-inline" action="{{ route('sections.destroy',$section->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger mt-1" type="submit">
                                    Delete
                                </button>
                            </form>
                            @endif

                            <span class="pull-right mt-1 action-btn-box">
                                @if($section->type == 'imageSlider')
                                    <a href="{{ route('image-contents.create',['sectionId' => $section->id]) }}" class="btn btn-sm btn-primary">Add Slide Image</a>
                                @elseif($section->type == 'article')
                                    <a href="{{ route('text-contents.create',['sectionId' => $section->id]) }}" class="btn btn-sm btn-primary">Add Article</a>
                                @elseif($section->type == 'msWord')
                                    <a href="{{ route('text-contents.create',['sectionId' => $section->id]) }}" class="btn btn-sm btn-primary">Add MS Text</a>
                                @elseif($section->type == 'groupContent')
                                    <a href="{{ route(''.strtolower(getGroupContentType($section->property)).'-contents.create',['sectionId' => $section->id]) }}" class="btn btn-sm btn-primary">Add {{ getGroupContentType($section->property) }}</a>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row mt-2 mb-5">
                        @if(in_array('sectionHeading', explode(',',$section->property)))
                        <form action="{{ route('sections.update-heading') }}" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="sectionId" value="{{ $section->id }}">
                                <div class="col-12">
                                    <small class="text-danger">(Section Heading Max: 190 Character)</small>
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text">Section Heading</span>
                                        </div>
                                        <input type="text" class="form-control" name="heading" value="{{ $section->heading ? $section->heading : '' }}" placeholder="Add Section Heading here ...">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="submit">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif

                        <div class="col-12">
                            <div class="row">
                                
                                @if($section->type == 'imageSlider')

                                    @include('dashboard.web-contents.image-contents.contents')

                                    <!-- <hr class="heading-devider mt-2"> -->

                                @elseif($section->type == 'article')

                                    @include('dashboard.web-contents.text-contents.article-contents')

                                    <!-- <hr class="heading-devider mt-2"> -->

                                @elseif($section->type == 'msWord')

                                    @include('dashboard.web-contents.text-contents.contents')

                                    <!-- <hr class="heading-devider mt-2"> -->

                                @elseif($section->type == 'groupContent')

                                    @if(strtolower(getGroupContentType($section->property)) == 'image')

                                        @include('dashboard.web-contents.image-contents.contents')

                                        <!-- <hr class="heading-devider mt-2"> -->

                                    @endif

                                    @if(strtolower(getGroupContentType($section->property)) == 'text')

                                        @include('dashboard.web-contents.text-contents.contents')

                                        <!-- <hr class="heading-devider mt-2"> -->

                                    @endif

                                    @if(strtolower(getGroupContentType($section->property)) == 'video')

                                        @include('dashboard.web-contents.video-contents.contents')

                                        <!-- <hr class="heading-devider mt-2"> -->

                                    @endif

                                    @if(strtolower(getGroupContentType($section->property)) == 'file')

                                        @include('dashboard.web-contents.file-contents.contents')

                                        <!-- <hr class="heading-devider mt-2"> -->

                                    @endif

                                @elseif($section->type == 'dataContent')

                                    @include('dashboard.web-contents.data-contents.contents')

                                @endif
                                
                            </div>
                        </div>
                    </div>

                    @endforeach

                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="sectionInputModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('sections.store') }}" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Create Section with Content Type & Properties
                    </h4>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-12 text-center mb-2 fw500">
                            <span class="text-danger">Section Type can not be changed once it is created</span>
                        </div>
                    </div>

                    @csrf

                    <input type="hidden" name="page_id" value="{{ $page->id }}">

                    @include('dashboard.helpers.section-inputs-helper')

                    
                </div>
                <div class="modal-footer">
                    <button id="submitBtn" type="submit" class="btn btn-md btn-success pull-right" disabled="">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            const page = {!! json_encode($page) !!};
            console.log(page);
        })
    </script>
@endpush