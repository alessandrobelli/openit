@extends('admin.layouts.master')

@section('content')

<section class="content-header">
    <h1>
        Routes
        <small>Management panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Routes</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin::route.create') }}" class="ajaxShow" data-target="newFormBody">
                        <button class="btn bg-olive btn-flat pull-right"><i class="fa fa-plus"></i> New Route</button>
                    </a>
                </div>
                <div class="box-body" id="newFormBody"></div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Routes List</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover" id="indexTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Places</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($routes as $route)
                            @include('admin.mapRoutes.showRow')
                        @empty
                            <tr>
                                <td colspan="4">
                                    No Routes
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection