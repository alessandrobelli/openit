<tr>
    <td>
        {!! csrf_field() !!}
        {!! Form::text('name', $route->name,
            array(
                'required',
                'class' => 'form-control',
                'placeholder' => 'Name'
            ))
        !!}
    </td>
    <td>
        {!! Form::textarea('description', $route->description,
            array(
                'required',
                'class' => 'form-control',
                'placeholder' => 'Description'
            ))
        !!}
    </td>
    <td>
        <select class="form-control multiple-select-box" name="places[]" multiple="multiple">
        @foreach($places as $key => $value)
            <option value="{{ $key }}" @if(in_array($key, $selectedPlaces))selected="selected"@endif >{{ $value }}</option>
        @endforeach
        </select>
    </td>
    <td></td>
    <td>
        <button type="button" class="btn btn-sm btn-primary ajaxUpdateAndList" data-href="{{ route('admin::route.update', ['id' => $route->id]) }}">Update</button>
        <button class="btn btn-sm btn-danger ajaxShowRow" data-href="{{ route('admin::route.edit', ['id' => $route->id]) }}"><i class="fa fa-rotate-left"></i></button>
        <button type="button" class="btn btn-sm btn-danger ajaxShowRow" data-href="{{ route('admin::route.showRow', ['id' => $route->id]) }}"><i class="fa fa-times"></i></button>
    </td>
</tr>

<script>
    $(document).ready(function(){
        $(".multiple-select-box").select2();
    });
</script>