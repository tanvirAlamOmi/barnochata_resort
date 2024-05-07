@extends('dashboard.index')

@section('title', 'Menus')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Menus</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Menu List</b>
                <a href="{{ route('menus.create') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Add Menu
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Position</th>
                            <th>Parent</th>
                            <th>Display Options</th>
                            <th>Type</th>
                            <th>Link URL</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl.</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Position</th>
                            <th>Parent</th>
                            <th>Display Options</th>
                            <th>Type</th>
                            <th>Link URL</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($menus as $u => $menu)
                        <tr>
                            <td>{{$u = 1}}</td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->slug }}</td>
                            <td>{{ $menu->position }}</td>
                            <td>{{ $menu->parent ? $menu->parent->name : '' }}</td>
                            <td>{{ $menu->display_options }}</td>
                            <td>{{ $menu->type }}</td>
                            <td>
                                <a href="{{ $menu->link_url }}" target="_blank">{{ $menu->link_url }}</a>
                            </td>
                            <td><b class="text-{{ $menu->status ? 'success' : 'danger' }}">{{ $menu->status ? 'ACTIVE' : 'INACTIVE' }}</b></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('menus.edit',$menu->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
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