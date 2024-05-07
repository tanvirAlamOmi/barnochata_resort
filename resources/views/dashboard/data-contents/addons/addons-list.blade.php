@extends('dashboard.index')

@section('title', 'Addons')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Addons</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Addons List</b>
                <a href="{{ route('addons.create') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Add Addons
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th> 
                            <th>Description</th>
                            <th>Charge</th>
                            <th>Default Image</th>
                            <th>Serial No.</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th> 
                            <th>Description</th>
                            <th>Charge</th>
                            <th>Default Image</th>
                            <th>Serial No.</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($addons as $u => $addon)
                        <tr>
                            <td>{{$u += 1}}</td>
                            <td>{{ $addon->title }}</td>                          
                            <td>{!!  Str::limit( $addon->description, 15)  !!}</td>
                            <td>{{ $addon->charge }}</td>
                            <td>
                                <img src="{{ !empty($addon->default_image) ? $addon->default_image : asset('imgs/image-not-found.png') }}" alt="" class="img-fluid img-cell">
                            </td>
                            <td>{{ $addon->serial_no }}</td>
                            <td><b class="text-{{ $addon->status ? 'success' : 'danger' }}">{{ $addon->status ? 'ACTIVE' : 'INACTIVE' }}</b></td>
                            <td>{{ dateTimeAsReadable($addon->created_at) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('addons.edit', $addon) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('addons.show', $addon) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-primary change-confirmation" title="{{ $addon->status ? 'Inactivate' : 'Activate' }}"  data-id={{$addon->id}} 
                                        data-request-url="{{ route('addons.status') }}"  
                                        data-redirect-url="{{ route('addons.index') }}"
                                        data-title = "{{ $addon->status ? 'Inactivate' : 'Activate' }}"
                                        data-description = "Do you want to {{ $addon->status ? 'Inactivate' : 'Activate' }} this messages?"
                                        >
                                        <i class="fa fa-{{ $addon->status ? 'trash' : 'trash-restore' }}"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $addons->links() !!}

            </div>
        </div>
    </div> 

@endsection
 