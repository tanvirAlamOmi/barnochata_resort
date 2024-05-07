@extends('dashboard.index')

@section('title', 'Room '.$room->title)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a class="btn-link" href="{{ route('rooms.index') }}">Rooms</a></li>
    <li class="breadcrumb-item active">Room {{ $room->title }}</li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Room <span class="text-primary">{{ $room->title }}</span></b>
                <a href="{{ route('rooms.index') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Back
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span>Category:</span> <span class="pull-right">{{ slugToTitle($room->category) }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Capacity:</span> <span class="pull-right">{{ $room->guest_capacity }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Price:</span> <span class="pull-right">{{ $room->price_currency }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Additional Price Per Adult:</span> <span class="pull-right">{{ $room->extra_person_per_adult. ' ' . config('app.base_currency') }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Additional Price Per Child:</span> <span class="pull-right">{{ $room->extra_person_per_child. ' ' . config('app.base_currency') }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Serial No.:</span> <span class="pull-right">{{ $room->serial_no }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Status:</span> <span class="pull-right text-{{ $room->status ? 'primary' : 'danger' }}">{{ $room->status ? 'Active' : 'Inactive' }}</span>
                            </li>
                            <li class="list-group-item">
                                Facilities: {{ $room->facilities }}
                            </li>
                            <li class="list-group-item">
                                Description: 
                                {!! $room->description !!}
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                Images
                                <small class="btn-link pointer pull-right" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <b>Add Images</b>
                                </small>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    @if(!empty($room->default_image))
                                    <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                                        <img src="{{ $room->default_image }}" alt="Image" class="img-fluid mx-height-200 room-image" data-id="0">
                                        <div class="text-center"><small>Default Image</small></div>
                                    </div>
                                    @endif
                                    @if(count($room->room_images) > 0)
                                        @foreach($room->room_images as $i => $room_image)
                                        <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                                            <img src="{{ $room_image->image }}" alt="Image" class="img-fluid mx-height-200 room-image" data-id="{{$i+1}}">
                                            <div class="text-center">
                                                <small>
                                                    <a href="#" class="btn-link btn-danger change-confirmation" title="Delete" data-id={{$room_image->id}} 
                                                        data-request-url="{{ route('rooms.delete-image') }}"  
                                                        data-redirect-url="{{ route('rooms.show',$room->id) }}"
                                                        data-title = "delete"
                                                        data-description = "Do you want to delete this image?"
                                                        >
                                                        Delete
                                                    </a>
                                                </small>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Images to {{ $room->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('rooms.store-images') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <input type="hidden" name="roomId" value="{{ $room->id }}">
                        <input type="hidden" name="room_title" value="{{ $room->title }}">

                        <!-- row -->
                        <div class="row">
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input id="image" type="file" name="images[]" class="form-control" accept=".jpg, .jpeg, .png" multiple="">
                                        <small class="fw500">Accept: <span class="text-danger">jpg, jpeg, png</span></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row" id="imageTray">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageSliderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="imageSliderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageSliderModalLabel">Images of {{ $room->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="imageSlider" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if(!empty($room->default_image))
                            <div class="carousel-item carousel-item-0">
                                <img src="{{ $room->default_image }}" class="d-block w-100" alt="..." />
                            </div>
                            @endif
                            @if(count($room->room_images) > 0)
                                @foreach($room->room_images as $i => $room_image)
                                <div class="carousel-item carousel-item-{{ $i + 1 }}">
                                    <img src="{{ $room_image->image }}" class="d-block w-100" alt="..." />
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        window.onload = function(){
            //Check File API support
            if(window.File && window.FileList && window.FileReader)
            {
                var filesInput = document.getElementById("image");
                filesInput.addEventListener("change", function(event){
                    var files = event.target.files; //FileList object
                    var output = document.getElementById("imageTray");
                    for(var i = 0; i< files.length; i++)
                    {
                        var file = files[i];
                        //Only pics
                        if(!file.type.match('image'))
                            continue;
                        var picReader = new FileReader();
                        picReader.addEventListener("load",function(event){
                            var picFile = event.target;
                            var div = document.createElement("div");
                            div.classList.add("col-sm-4");
                            div.classList.add("mb-4");
                            div.innerHTML = "<img class='img-fluid' src='" + picFile.result + "'" + "title='" + picFile.name + "'/><input type='hidden' name='uploadedImages[]' value='"+picFile.result+"'><button type='button' class='btn btn-sm btn-outline-danger w-100' onclick='this.parentElement.remove();'>Delete</button>";
                            output.insertBefore(div,null);
                        });
                        //Read the image
                        picReader.readAsDataURL(file);
                    }
                });
            }
            else
            {
                console.log("Your browser does not support File API");
            }
        }

        $(document).ready(function(){
            $('.room-image').click(function(){
                let counter = $(this).data('id');
                $('.carousel-item-'+counter).addClass('active');
                $('#imageSliderModal').modal('show');
            });
            $('#imageSliderModal').on('hidden.bs.modal', function(){
                $('.carousel-item').removeClass('active');
            });
        })
    </script>
@endpush