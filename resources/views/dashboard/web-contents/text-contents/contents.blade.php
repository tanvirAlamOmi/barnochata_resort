@if($section->text_contents && count($section->text_contents) > 0)

    @foreach($section->text_contents as $s => $textContent)

        <div class="{{ $section->type == 'groupContent' ? 'col-lg-4 col-md-4 col-sm-6' : 'col-12' }} text-secondary mb-3">

            <div class="input-group">
                <span class="input-group-text form-control"><span class="text-secondary">Serial No</span>: {{ $textContent->serial_no }}</span>
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

            <div class="content-box mb-2">
                {!! $textContent->description !!}
            </div>

            @if($textContent->title)
            <div class="fw500">
                <span class="text-primary">Title</span>: {{ $textContent->title }}
            </div>
            @endif

            @if($textContent->title_icon)
            <div class="fw500">
                <span class="text-primary">Title Icon</span>: {{ $textContent->title_icon }}
            </div>
            @endif

            @if($textContent->link)
            <div class="fw500">
                <span class="text-primary">Link</span>: {{ $textContent->link }}
            </div>
            @endif

            @if($textContent->image)
                <img src="{{ asset('img-contents/content-images/'.$textContent->image) }}" alt="$textContent->image" class="img-fluid img-text-content">
            @endif
            <hr>
        </div>

    @endforeach

@endif