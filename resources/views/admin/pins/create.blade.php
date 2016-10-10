<section class="content">
    {!! Form::open(array('route' => 'admin::pin.store', 'id' => 'formImage', 'class' => 'form', 'files' => true)) !!}
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Add A Pin</h4>
                <a href="javascript:void(0)" onclick="getLocation()"><button type="button" class="btn btn-info btn-flat" ><i class="fa fa-map-marker"></i> Geolocate</button></a>
            </div>

            <div class="box-body">
                <div id="formErrors">
                    @include('errors.list')
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {!! Form::label('Name') !!}
                            {!! Form::text('name', null,
                                array(
                                    'required',
                                    'class' => 'form-control',
                                    'placeholder' => 'Name'
                                ))
                            !!}
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::label('Latitude') !!}
                            {!! Form::text('latitude', null,
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
                            {!! Form::text('longitude', null,
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
                        <label>{!! Form::radio('crit', '1', true) !!} Yes</label>
                        <label>{!! Form::radio('crit', '0') !!} No</label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Notes') !!}
                    {!! Form::textarea('notes', null,
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
                            'required',
                            'class' => 'form-control'
                        ))
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Routes') !!}
                    {!! Form::select('routes[]', $routes, null,
                        array(
                            'class' => 'form-control multiple-select-box',
                            'multiple' => 'multiple'
                        ));
                    !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Disability Type') !!}
                    {!! Form::select('disability_type_id', $disabilities, 1,
                        array(
                            'class' => 'form-control'
                        ));
                    !!}
                </div>
            </div>

            <div class="box-footer">
                <div class="form-group pull-right">
                    {!! Form::submit('Add Pin', array('class' => 'btn btn-primary ajaxSaveFileAndList')) !!}
                    {!! Form::reset('Reset', array('class' => 'btn btn-danger')) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</section>



<script>
    $(document).ready(function(){
        $(".multiple-select-box").select2();
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