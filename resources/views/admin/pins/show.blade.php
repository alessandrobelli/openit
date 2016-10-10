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
                    <a href="{{ route('admin::pin.index') }}">
                        <button class="btn bg-olive btn-flat pull-right"><i class="fa fa-plus"></i> Go Back</button>
                    </a>
                </div>
                <div class="box-body" id="newFormBody"></div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pin Details</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-2"><b>Name</b></div>
                        <div class="col-sm-10">{{ $pin->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><b>Latitude</b></div>
                        <div class="col-sm-10">{{ $pin->latitude }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><b>Longitude</b></div>
                        <div class="col-sm-10">{{ $pin->longitude }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><b>Crit</b></div>
                        <div class="col-sm-10">{{ $pin->crit ? 'Yes' : 'No' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><b>Notes</b></div>
                        <div class="col-sm-10">{{ $pin->notes }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><b>Image</b></div>
                        <div class="col-sm-10"><img src="{{ asset('storage/' . $pin->image) }}" alt="Image" height="100px"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><b>Disability Type</b></div>
                        <div class="col-sm-10">{{ $pin->disabilityType->name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection