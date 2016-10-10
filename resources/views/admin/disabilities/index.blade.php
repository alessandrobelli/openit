@extends('admin.layouts.master')

@section('content')

<section class="content-header">
    <h1>
        Disability Type
        <small>Management panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Disability Types</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin::disability.create') }}" class="ajaxShow" data-target="newFormBody">
                        <button class="btn bg-olive btn-flat pull-right"><i class="fa fa-plus"></i> New Disability Type</button>
                    </a>
                </div>
                <div class="box-body" id="newFormBody"></div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Disability Types List</h3>
                </div>
                <div class="box-body table-responsive">
                    <div id="indexErrors" class="col-sm-12 col-md-6"></div>
                    <table class="table table-bordered table-hover" id="indexTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($disabilities as $disability)
                            @include('admin.disabilities.showRow')
                        @empty
                            <tr>
                                <td colspan="4">
                                    No Disability Types
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