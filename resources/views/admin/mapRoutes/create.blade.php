<section class="content">
    {!! Form::open(array('route' => 'admin::route.store', 'class' => 'form')) !!}
    <div class="col-xs-6">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Add A Route</h4>
            </div>

            <div class="box-body">
                <div id="formErrors">
                    @include('errors.list')
                </div>

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
                <div class="form-group">
                    {!! Form::label('Description') !!}
                    {!! Form::textarea('description', null,
                        array(
                            'required',
                            'class' => 'form-control',
                            'placeholder' => 'Description'
                        ))
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Places') !!}
                    {!! Form::select('places[]', $places, null,
                        array(
                            'class' => 'form-control multiple-select-box',
                            'multiple' => 'multiple'
                        ));
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Active') !!}
                    <select name="active" class="form-control">
                        <option value="0" selected>Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>
            </div>

            <div class="box-footer">
                <div class="form-group pull-right">
                    {!! Form::submit('Add Route', array('class' => 'btn btn-primary ajaxSaveAndList')) !!}
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
</script>