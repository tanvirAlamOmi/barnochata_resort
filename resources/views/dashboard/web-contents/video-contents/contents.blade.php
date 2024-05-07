@if($section->video_contents && count($section->video_contents) > 0)

    @foreach($section->video_contents as $s => $videoContent)

        <div class="col-sm-6 text-secondary">
            @if($videoContent->embed_code)
            {!! $videoContent->embed_code !!}
            @endif

            @if($videoContent->vdo_link)
            {!! $videoContent->vdo_link !!}
            @endif
            <div class="content-box">
                {!! $videoContent->description !!}
                <div class="btn-group-vertical pull-right">
                    <a type="button" href="{{ route('video-content.edit',$videoContent->id) }}" class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
                    <a type="button" href="{{ route('video-content.status',$videoContent->id) }}" class="btn btn-sm btn-{{ $videoContent->status ? 'success' : 'warning' }}" title="Make {{ $videoContent->status ? 'Disable' : 'Activate' }}" data-toggle="tooltip" data-placement="top"><i class="fa fa-check-square"></i></a>
                    <a type="button" href="{{ route('video-content.delete',$videoContent->id) }}" class="btn btn-sm btn-danger" title="Delate" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
                </div>
            </div>

            @if($videoContent->title)
            <div class="fw500">
                <span class="text-primary">Title</span>: {{ $videoContent->title }}
            </div>
            @endif
            <div class="fw500">
                <span class="text-primary">Serial No</span>: {{ $videoContent->serial_no }}
            </div>
        </div>

    @endforeach

@endif