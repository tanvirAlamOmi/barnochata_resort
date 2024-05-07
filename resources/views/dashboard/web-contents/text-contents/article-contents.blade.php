@if($section->text_contents && count($section->text_contents) > 0)

    @foreach($section->text_contents as $s => $textContent)

        <div class="col-12 mb-3 text-secondary">
            <div class="card">
                <div class="card-header bg-white p-0">
                    <div class="input-group">
                        <span class="input-group-text form-control">Article No: {{ $s + 1 }}</span>
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="">
                                <a class="dropdown-item" href="{{ route('text-contents.edit',$textContent->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </li>
                            <li class="">
                                <form action="{{ route('text-contents.status',$textContent->id) }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item img-delete-btn" type="submit" data-toggle="tooltip" data-placement="top" title="{{ !$textContent->status ? 'Activate' : 'Deactivate' }}">
                                        @if(!$textContent->status)
                                            <i class="fa fa-check-square"></i> Activate
                                        @else
                                            <i class="fa fa-ban"></i> Diactivate
                                        @endif
                                    </button>
                                </form>
                            </li>
                            <li class="">
                                <form action="{{ route('text-contents.destroy',$textContent->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item img-delete-btn" type="submit" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="row p-2">
                        <div class="col-sm-10">
                            <div class="fw500">
                                <span class="text-primary">Title</span>: {{ $textContent->title }}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="fw500">
                                <span class="text-primary">Serial No</span>: {{ $textContent->serial_no }}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            @if($textContent->link)
                            <div class="fw500">
                                <span class="text-primary">Link</span>: {{ $textContent->link }}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            @if($textContent->title_icon)
                            <div class="fw500">
                                <span class="text-primary">Title Icon</span>: {{ $textContent->title_icon }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="content-box article-box mb-2">
                                {!! $textContent->description !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 p-3">
                            <div class="ml-5">
                                <b>Images</b> <a href="{{ route('image-contents.create',['sectionId' => $section->id, 'textContentId' => $textContent->id]) }}" class="btn btn-sm btn-secondary pull-right">Add Images</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-3">
                            <div class="row">
                                @if(!empty($textContent->image_contents) && count($textContent->image_contents) > 0)
                                    @foreach($textContent->image_contents as $ti => $image_content)
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-text form-control"><span class="text-secondary">Serial No</span>: {{ $image_content->serial_no }}</span>
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li class="">
                                                        <form action="{{ route('image-contents.status',$image_content->id) }}" method="POST">
                                                            @csrf
                                                            <button class="dropdown-item img-delete-btn" type="submit" data-toggle="tooltip" data-placement="top" title="{{ !$image_content->status ? 'Activate' : 'Deactivate' }}">
                                                                @if(!$image_content->status)
                                                                    <i class="fa fa-check-square"></i> Activate
                                                                @else
                                                                    <i class="fa fa-ban"></i> Diactivate
                                                                @endif
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li class="">
                                                        <form action="{{ route('image-contents.destroy',$image_content->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item img-delete-btn" type="submit" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                            <img src="{{ $image_content->image_path }}" alt="" class="img-fluid img-thumbnail">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 p-3">
                            <div class="ml-5">
                                <b>Videos</b> <a href="{{ route('video-contents.create',['sectionId' => $section->id, 'textContentId' => $textContent->id]) }}" class="btn btn-sm btn-secondary pull-right">Add Videos</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-3">
                            <div class="row">
                                @if(!empty($textContent->video_contents) && count($textContent->video_contents) > 0)
                                    @foreach($textContent->video_contents as $ti => $video_content)
                                        <div class="col-lg-4 col-md-4 col-sm-6 embed-div">
                                            <div class="input-group">
                                                <span class="input-group-text form-control"><span class="text-secondary">Serial No</span>: {{ $video_content->serial_no }}</span>
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li class="">
                                                        <a class="dropdown-item" href="{{ route('video-contents.edit',$video_content->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <form action="{{ route('video-contents.status',$video_content->id) }}" method="POST">
                                                            @csrf
                                                            <button class="dropdown-item img-delete-btn" type="submit" data-toggle="tooltip" data-placement="top" title="{{ !$video_content->status ? 'Activate' : 'Deactivate' }}">
                                                                @if(!$video_content->status)
                                                                    <i class="fa fa-check-square"></i> Activate
                                                                @else
                                                                    <i class="fa fa-ban"></i> Diactivate
                                                                @endif
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li class="">
                                                        <form action="{{ route('video-contents.destroy',$video_content->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item img-delete-btn" type="submit" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                            @if(!empty($video_content->embed_code))
                                            <div class="mb-2 img-thumbnail">
                                                {!! $video_content->embed_code !!}
                                            </div>
                                            @endif
                                            @if(!empty($video_content->vdo_link_thumbnail))
                                            <div class="mb-2 img-thumbnail">
                                                <div>Video Thumbnail</div>
                                                <img src="{{ $video_content->thumbnail_path }}" alt="" class="img-fluid">
                                            </div>
                                            @endif
                                            @if(!empty($video_content->vdo_link))
                                            <div class="mb-2">
                                                Link: <span class="text-primary">{!! $video_content->vdo_link !!}</span>
                                            </div>
                                            @endif
                                            <div class="mb-1 p-1">
                                                Title: {!! $video_content->title !!}
                                            </div>
                                            @if(!empty($video_content->description))
                                            <div class="content-box mb-2">
                                                {!! $video_content->description !!}
                                            </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

@endif