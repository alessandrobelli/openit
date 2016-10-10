<tr>
    <td>
        {!! csrf_field() !!}
        {!! Form::text('name', $disability->name,
            array(
                'required',
                'class' => 'form-control',
                'placeholder' => 'Name'
            ))
        !!}
    </td>
    <td>
        <button type="button" class="btn btn-sm btn-primary ajaxUpdateAndList" data-href="{{ route('admin::disability.update', ['id' => $disability->id]) }}">Update</button>
        <button class="btn btn-sm btn-danger ajaxShowRow" data-href="{{ route('admin::disability.edit', ['id' => $disability->id]) }}"><i class="fa fa-rotate-left"></i></button>
        <button type="button" class="btn btn-sm btn-danger ajaxShowRow" data-href="{{ route('admin::disability.showRow', ['id' => $disability->id]) }}"><i class="fa fa-times"></i></button>
    </td>
</tr>