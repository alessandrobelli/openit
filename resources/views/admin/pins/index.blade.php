@extends('admin.layouts.master')

@section('content')

<section class="content-header">
    <h1>
        Pins
        <small>Management panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Pins</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin::pin.create') }}" class="ajaxShow" data-target="newFormBody">
                        <button class="btn bg-olive btn-flat pull-right"><i class="fa fa-plus"></i> New Pin</button>
                    </a>
                </div>
                <div class="box-body" id="newFormBody"></div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pins List</h3>
                    <div class="box-tools">
                        <a href="{{ route('admin::pin.export', ['csv']) }}" class="btn btn-sm btn-info"><i class="fa fa-download"></i> CSV</a>
                        <a href="{{ route('admin::pin.export', ['xlsx']) }}" class="btn btn-sm btn-info"><i class="fa fa-download"></i> Excel</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover" id="indexTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Crit</th>
                                <th>Notes</th>
                                <th>Image</th>
                                <th>Routes</th>
                                <th>Disability Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($pins as $pin)
                            @include('admin.pins.showRow')
                        @empty
                            <tr>
                                <td colspan="4">
                                    No Pins
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