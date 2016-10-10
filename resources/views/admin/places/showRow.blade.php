<tr>
    <td>{{ $place->name }}</td>
    <td>{{ $place->description }}</td>
    <td>{{ $place->active ? 'Yes' : 'No' }}</td>
    <td>
        <a href="{{ route('admin::place.edit', ['id' => $place->id]) }}" class="ajaxShowRow">
            <button class="btn btn-success btn-sm btn-flat"><i class="fa fa-pencil-square-o"></i> </button>
        </a>
        <a href="{{ route('admin::place.toggleActive', ['id' => $place->id]) }}" class="ajaxShowRow">
            @if($place->active)
                <button class="btn btn-danger btn-sm btn-flat">Inactive</button>
            @else
                <button class="btn btn-success btn-sm btn-flat">Active</button>
            @endif
        </a>
        <!--<a href="{{ route('admin::place.show', ['id' => $place->id]) }}" class="">
            <button class="btn btn-info btn-sm btn-flat"><i class="fa fa-info-circle"></i> </button>
        </a>-->
        <a href="{{ route('admin::place.destroy', ['id' => $place->id]) }}" class="ajaxDelete">
            {!! csrf_field() !!}
            <button class="btn btn-danger btn-sm btn-flat"><i class="fa fa-times-circle"></i> </button>
        </a>
    </td>
</tr>