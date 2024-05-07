@extends('dashboard.index')

@section('title', 'Pages')

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a class="btn-link" href="#">Pages</a></li>
@endsection

@section('dashboard_content')

	<div class="container-fluid">        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <b class="fs-120">Page List</b>
                @if(Auth::user()->weight > 75)
                <a href="{{ route('pages.create') }}" class="btn btn-sm btn-primary pull-right fw-500">
                    Add Page
                </a>
                @endif
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Menu</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Menu</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($pages as $u => $page)
                        <tr>
                            <td>{{$u + 1}}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->type }}</td>
                            <td>{{ $page->menu ? $page->menu->name : '' }}</td>
                            <td>
                                <img src="{{ !empty($page->image) ? asset('img-contents/page-images/'.$page->image) : '' }}" alt="{{ !empty($page->image) ? 'Image' : 'No Image Found' }}" class="img-fluid td-img">
                            </td>
                            <td><b class="text-{{ $page->status ? 'success' : 'danger' }}">{{ $page->status ? 'ACTIVE' : 'INACTIVE' }}</b></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('pages.show',$page->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if(Auth::user()->weight > 75)
                                    <a href="{{ route('pages.edit',$page->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
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