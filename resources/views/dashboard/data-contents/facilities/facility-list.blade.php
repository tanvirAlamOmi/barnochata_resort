@extends('dashboard.index')

@section('title', 'Facilities')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Facilities</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Facility List</b>
                <a href="{{ route('facilities.create') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Add Facility
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Description</th> 
                            <th>Status</th>
                            <th>Default Image</th>
                            <th>Serial No.</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Description</th> 
                            <th>Status</th>
                            <th>Default Image</th>
                            <th>Serial No.</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($facilities as $u => $facility)
                        <tr>
                            <td>{{$u += 1}}</td>
                            <td>{{ $facility->title }}</td>      
                            <td>{{ slugToTitle($facility->type) }}</td>      
                            <td>{!!  Str::limit( $facility->description, 15)  !!}</td> 
                            <td><b class="text-{{ $facility->status ? 'success' : 'danger' }}">{{ $facility->status ? 'ACTIVE' : 'INACTIVE' }}</b></td>
                            <td>
                                <img src="{{ !empty($facility->default_image) ? $facility->default_image : asset('imgs/image-not-found.png') }}" alt="" class="img-fluid img-cell">
                            </td>
                            <td>{{ $facility->serial_no }}</td>
                            <td>{{ dateTimeAsReadable($facility->created_at) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('facilities.edit', $facility) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('facilities.show', $facility) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-primary change-confirmation" title="{{ $facility->status ? 'Inactivate' : 'Activate' }}"  data-id={{$facility->id}} 
                                        data-request-url="{{ route('facilities.status') }}"  
                                        data-redirect-url="{{ route('facilities.index') }}"
                                        data-title = "{{ $facility->status ? 'Inactivate' : 'Activate' }}"
                                        data-description = "Do you want to {{ $facility->status ? 'Inactivate' : 'Activate' }} this facility?"
                                        >
                                        <i class="fa fa-{{ $facility->status ? 'trash' : 'trash-restore' }}"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- <div class="pagination">
                    {!! $facilities->links() !!}
                </div> -->

                <!-- a Tag for previous page -->
                <!-- <a href="{{$facilities->previousPageUrl()}}"> -->
                    <!-- You can insert logo or text here -->
                <!-- </a> -->
                <!-- @for($i=0;$i<=$facilities->lastPage();$i++) -->
                    <!-- a Tag for another page -->
                    <!-- <a href="{{$facilities->url($i)}}">{{$i}}</a> -->
                <!-- @endfor -->
                <!-- a Tag for next page -->
                <!-- <a href="{{$facilities->nextPageUrl()}}"> -->
                    <!-- You can insert logo or text here -->
                <!-- </a> -->

                {!! $facilities->links('pagination::bootstrap-5') !!}

            </div>
        </div>
    </div> 

@endsection
 