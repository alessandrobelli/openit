@extends('admin.layouts.master')

@section('content')

<section class="content-header">
    <h1>
        Edit Pin
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Pin</h3>
                    <a href="javascript:void(0)" onclick="getLocation()"><button type="button" class="btn btn-info btn-flat" ><i class="fa fa-map-marker"></i> Geolocate</button></a>
                </div>
                <div class="box-body">
                    <div id="formErrors">
                        @include('errors.list')
                    </div>

                    {!! Form::open(array('route' => array('admin::pin.update', $pin->id), 'method' => 'PATCH', 'id' => 'formImage', 'class' => 'form', 'files' => true)) !!}
                    {!! csrf_field() !!}

                    <div class="form-group">
                        {!! Form::label('Name') !!}
                        {!! Form::text('name', $pin->name,
                            array(
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Name'
                            ))
                        !!}
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                {!! Form::label('Latitude') !!}
                                {!! Form::text('latitude', $pin->latitude,
                                    array(
                                        'required',
                                        'class' => 'form-control',
                                        'placeholder' => 'Latitude',
                                        'id' => 'latitude'
                                    ))
                                !!}
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                {!! Form::label('Longitude') !!}
                                {!! Form::text('longitude', $pin->longitude,
                                    array(
                                        'required',
                                        'class' => 'form-control',
                                        'placeholder' => 'Longitude',
                                        'id' => 'longitude'
                                    ))
                                !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Crit') !!}
                        <div class="radio">
                            <label>{!! Form::radio('crit', '1', $pin->crit ? true : false) !!} Yes</label>
                            <label>{!! Form::radio('crit', '0', !$pin->crit ? true : false) !!} No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Notes') !!}
                        {!! Form::textarea('notes', $pin->notes,
                            array(
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Notes'
                            ))
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Image') !!}
                        {!! Form::file('image',
                            array(
                                'class' => 'form-control'
                            ))
                        !!}
                    </div>

                    @if($pin->image)
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6 col-md-3">
                                <button type="button" class="close remove-image" data-target="removed_image">&times;</button>
                                <a href="#" class="thumbnail">
                                    <img src="{{ asset('storage/' . $pin->image) }}" alt="Image">
                                </a>
                            </div>
                        </div>
                    </div>

                    {!! Form::hidden('removed_image', null,
                        array(
                            'required',
                            'class' => 'form-control',
                            'id' => 'removed_image'
                        ))
                    !!}
                    @endif

                    <div class="form-group">
                        <label for="routes">Routes</label>
                        <select class="form-control multiple-select-box" id="routes" name="routes[]" multiple="multiple">
                        @foreach($routes as $key => $value)
                            <option value="{{ $key }}" @if(in_array($key, $selectedRoutes))selected="selected"@endif >{{ $value }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Disability Type') !!}
                        {!! Form::select('disability_type_id', $disabilities, $pin->disability_type_id,
                            array(
                                'class' => 'form-control'
                            ));
                        !!}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(".multiple-select-box").select2();

        $('body').on('click', '.remove-image', function(){
            $('#' + $(this).data('target')).val(1);
            $(this).parents('.form-group').remove();
        });
    });

    var lat = document.getElementById("latitude");
    var lon = document.getElementById("longitude");
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            lon.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    function showPosition(position) {
        lat.value= position.coords.latitude;
        lon.value= position.coords.longitude;
    }
</script>
@endsection