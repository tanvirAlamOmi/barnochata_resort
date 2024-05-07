@extends('dashboard.index')

@section('title', 'Bookings')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Bookings</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Booking List</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Booking No</th>
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Total Guest</th>
                                <th>Booking Date</th>
                                <th>Check In Date</th>
                                <th>Check Out Date</th>
                                <th>Gross Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl.</th>
                                <th>Booking No</th>
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th align="center" class="text-center">Total Guest</th>
                                <th>Booking Date</th>
                                <th>Check In Date</th>
                                <th>Check Out Date</th>
                                <th>Gross Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($bookings as $b => $booking)
                            <tr>
                                <td>{{$b+1}}</td>
                                <td>{{ $booking->booking_no }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->contact_no }}</td>
                                <td>{{ $booking->email }}</td>
                                <td align="center" class="text-center">
                                    {{ $booking->total_adult + $booking->total_child }}
                                </td>
                                <td>{{ date('d-m-Y', strtotime($booking->booking_date)) }}</td>
                                <td>{{ date('d-m-Y',strtotime($booking->check_in_date)) }}</td>
                                <td>{{ !empty($booking->check_out_date) ? date('d-m-Y',strtotime($booking->check_out_date)) : 'N/A' }}</td>
                                <td>{{ $booking->gross_total }}</td>
                                @if($booking->status == 'ACCEPTED')
                                    <td><b class="text-primary">{{ $booking->status }}</b></td>
                                @elseif($booking->status == 'CANCELLED')
                                    <td><b class="text-danger">{{ $booking->status }}</b></td>
                                @elseif($booking->status == 'ALTER')
                                    <td><b class="text-secondary">{{ $booking->status }}</b></td>
                                @elseif($booking->status == 'ACTIVE')
                                    <td><b class="text-success">{{ $booking->status }}</b></td>
                                @else
                                    <td><b class="text-secondary">{{ $booking->status }}</b></td>
                                @endif
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('bookings.show',['booking_no' => $booking->booking_no]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if($booking->status == 'ACCEPTED')
                                            <button type="button" class="btn btn-sm btn-warning update-btn" data-id="{{ $booking->id }}" data-name="ACTIVE" data-bs-toggle="tooltip" data-placement="top" title="ACTIVE">
                                                <i class="fa fa-square"></i>
                                            </button>
                                        @elseif($booking->status == 'ACTIVE')
                                            <button type="button" class="btn btn-sm btn-success update-btn" data-id="{{ $booking->id }}" data-name="COMPLETED" data-bs-toggle="tooltip" data-placement="top" title="COMPLETED">
                                                <i class="fa fa-square-check"></i>
                                            </button>
                                        @elseif($booking->status == 'COMPLETED')
                                            <button type="button" class="btn btn-sm btn-primary update-btn" data-id="{{ $booking->id }}" data-name="COMPLETED" data-bs-toggle="tooltip" data-placement="top" title="COMPLETED">
                                                <i class="fa fa-square-check"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $bookings->links() !!}

                <form id="update-booking-form" action="{{ route('bookings.update-status') }}" method="post">
                    @csrf
                    <input id="booking_id" type="hidden" name="booking_id" value="">
                    <input id="status" type="hidden" name="status" value="">
                </form>

            </div>
        </div>
    </div> 

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#booking_id').val('');
            $('#status').val('');

            $('.update-btn').click(function(e){
                // e.preventDefault();
                console.log('u')
                let id = $(this).data('id');
                let status = $(this).data('name');
                $('#booking_id').val(id);
                $('#status').val(status);
                $('#update-booking-form').submit();
            });
        })
    </script>
@endpush