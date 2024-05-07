@extends('dashboard.index')

@section('title', 'Rooms')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Rooms</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Room List</b>
                <a href="{{ route('rooms.create') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Add Room
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Capacity</th>
                            <th>Price</th>
                            <th>Default Image</th>
                            <th>Serial No.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th align="center" class="text-center">Capacity</th>
                            <th>Price</th>
                            <th>Default Image</th>
                            <th>Serial No.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($rooms as $r => $room)
                        <tr>
                            <td>{{$r = 1}}</td>
                            <td>{{ $room->title }}</td>
                            <td>{{ slugToTitle($room->category) }}</td>
                            <td align="center" class="text-center">{{ $room->guest_capacity }}</td>
                            <td>{{ $room->price_currency }}</td>
                            <td>
                                <img src="{{ !empty($room->default_image) ? $room->default_image : asset('imgs/image-not-found.png') }}" alt="" class="img-fluid img-cell">
                            </td>
                            <td>{{ $room->serial_no }}</td>
                            <td><b class="text-{{ $room->status ? 'success' : 'danger' }}">{{ $room->status ? 'ACTIVE' : 'INACTIVE' }}</b></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('rooms.edit',$room) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('rooms.show',$room) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="fa fa-trash"></i>
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