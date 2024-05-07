@extends('dashboard.index')

@section('title', 'Packages')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Packages</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Package List</b>
                <a href="{{ route('packages.create') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Add Package
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Duration</th>
                            <th>Applicable Rooms</th>
                            <th>Applicable Services</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Duration</th>
                            <th>Applicable Rooms</th>
                            <th>Applicable Services</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($packages as $r => $package)
                        <tr>
                            <td>{{$r = 1}}</td>
                            <td>{{ $package->title }}</td>
                            <td>{{ slugToTitle($package->type) }}</td>
                            <td>{{ $package->duration }}</td>
                            <td>
                                @if(count($package->package_rooms) > 0)
                                    @foreach($package->package_rooms as $pr => $package_room)
                                        <span class="badge bg-secondary text-light fs-100 mb-1">{{ $package_room->room->title }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if(count($package->package_addons) > 0)
                                    @foreach($package->package_addons as $pr => $package_addons)
                                        <span class="badge bg-secondary text-light fs-100 mb-1">{{ $package_addons->addons->title }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td><b class="text-{{ $package->status ? 'success' : 'danger' }}">{{ $package->status ? 'ACTIVE' : 'INACTIVE' }}</b></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('packages.edit',$package) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('packages.show',$package) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-primary change-confirmation" title="{{ $package->status ? 'Inactivate' : 'Activate' }}"  data-id={{$package->id}} 
                                        data-request-url="{{ route('packages.status') }}"  
                                        data-redirect-url="{{ route('packages.index') }}"
                                        data-title = "{{ $package->status ? 'Inactivate' : 'Activate' }}"
                                        data-description = "Do you want to {{ $package->status ? 'Inactivate' : 'Activate' }} this package?"
                                        >
                                        <i class="fa fa-{{ $package->status ? 'trash' : 'trash-restore' }}"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection