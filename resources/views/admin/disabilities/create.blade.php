<section class="content">
    {!! Form::open(array('route' => 'admin::disability.store', 'class' => 'form')) !!}
    <div class="col-xs-6">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Add A Disability Type</h4>
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
            </div>

            <div class="box-footer">
                <div class="form-group pull-right">
                    {!! Form::submit('Add Disability Type', array('class' => 'btn btn-primary ajaxSaveAndList')) !!}
                    {!! Form::reset('Reset', array('class' => 'btn btn-danger')) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</section>