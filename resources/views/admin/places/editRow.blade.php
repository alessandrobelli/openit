<tr>
    <td>
        {!! csrf_field() !!}
        {!! Form::text('name', $place->name,
            array(
                'required',
                'class' => 'form-control',
                'placeholder' => 'Name'
            ))
        !!}
    </td>
    <td>
        {!! Form::textarea('description', $place->description,
            array(
                'required',
                'class' => 'form-control',
                'placeholder' => 'Description'
            ))
        !!}
    </td>
    <td></td>
    <td>
        <button type="button" class="btn btn-sm btn-primary ajaxUpdateAndList" data-href="{{ route('admin::place.update', ['id' => $place->id]) }}">Update</button>
        <button class="btn btn-sm btn-danger ajaxShowRow" data-href="{{ route('admin::place.edit', ['id' => $place->id]) }}"><i class="fa fa-rotate-left"></i></button>
        <button type="button" class="btn btn-sm btn-danger ajaxShowRow" data-href="{{ route('admin::place.showRow', ['id' => $place->id]) }}"><i class="fa fa-times"></i></button>
    </td>
</tr>