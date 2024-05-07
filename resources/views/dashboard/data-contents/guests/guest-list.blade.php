@extends('dashboard.index')

@section('title', 'Guests')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Guests</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Guest List</b>
                <a href="{{ route('guests.create') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Add Guest
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Booking No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Nationality</th> 
                            <th>Entry At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl.</th>
                            <th>Booking No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Nationality</th> 
                            <th>Entry At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($guests as $g => $guest)
                        <tr>
                            <td>{{ $g += 1 }}</td>
                            <td>{{ $guest->booking_no }}</td>
                            <td>{{ $guest->full_name }}</td>
                            <td>{{ slugToTitle($guest->type) }}</td> 
                            <td>{{ $guest->nationality }}</td>
                            <td>{{ dateTimeAsReadable($guest->created_at) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('guests.edit', $guest) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('guests.show', $guest) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! $guests->links('pagination::bootstrap-5') !!}

            </div>
        </div>
    </div> 

@endsection
 