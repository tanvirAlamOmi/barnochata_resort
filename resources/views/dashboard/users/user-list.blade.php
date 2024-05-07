@extends('dashboard.index')

@section('title', 'Users')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Users</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">User List</b>
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Add User
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Registered At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Registered At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $u => $user)
                        <tr>
                            <td>{{$u = 1}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile_no }}</td>
                            <td>{{ $user->type }}</td>
                            <td><b class="text-{{ $user->status ? 'success' : 'danger' }}">{{ $user->status ? 'ACTIVE' : 'INACTIVE' }}</b></td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('users.edit',$user) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
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