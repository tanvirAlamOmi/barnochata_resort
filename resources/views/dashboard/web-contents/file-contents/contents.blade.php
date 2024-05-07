@if($section->file_contents && count($section->file_contents) > 0)

    @foreach($section->file_contents as $s => $fileContent)

        <div class="col-sm-6 text-secondary">
            @if($fileContent->title)
            <div class="fw500">
                <span class="text-primary">Title</span>: {{ $fileContent->title }}
            </div>
            @endif
            <div class="content-box">
                <embed src="{{ asset('file_content/'.$fileContent->file) }}" width="100%" height="auto" />

                <div class="btn-group-vertical pull-right">
                    <a type="button" href="{{ route('file-content.edit',$fileContent->id) }}" class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
                    <a type="button" href="{{ asset('file_content/'.$fileContent->file) }}" class="btn btn-sm btn-info" title="Open" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-eye"></i></a>
                    <a type="button" href="{{ route('file-content.status',$fileContent->id) }}" class="btn btn-sm btn-{{ $fileContent->status ? 'success' : 'warning' }}" title="Make {{ $fileContent->status ? 'Disable' : 'Activate' }}" data-toggle="tooltip" data-placement="top"><i class="fa fa-check-square"></i></a>
                    <a type="button" href="{{ route('file-content.delete',$fileContent->id) }}" class="btn btn-sm btn-danger" title="Delate" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
                </div>
            </div>

            <div class="fw500">
                <span class="text-primary">Serial No</span>: {{ $fileContent->serial_no }}
            </div>
        </div>

    @endforeach

@endif