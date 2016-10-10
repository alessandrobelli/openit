<tr>
    <td>{{ $route->name }}</td>
    <td>{{ $route->description }}</td>
    <td>
        @foreach($route->places as $place)
            {{ $place->name . ',' }}
        @endforeach
    </td>
    <td>{{ $route->active ? 'Yes' : 'No' }}</td>
    <td>
        <a href="{{ route('admin::route.edit', ['id' => $route->id]) }}" class="ajaxShowRow">
            <button class="btn btn-success btn-sm btn-flat"><i class="fa fa-pencil-square-o"></i> </button>
        </a>
        <a href="{{ route('admin::route.toggleActive', ['id' => $route->id]) }}" class="ajaxShowRow">
            @if($route->active)
                <button class="btn btn-danger btn-sm btn-flat">Inactive</button>
            @else
                <button class="btn btn-success btn-sm btn-flat">Active</button>
            @endif
        </a>
        <!--<a href="{{ route('admin::route.show', ['id' => $route->id]) }}" class="">
            <button class="btn btn-info btn-sm btn-flat"><i class="fa fa-info-circle"></i> </button>
        </a>-->
        <a href="{{ route('admin::route.destroy', ['id' => $route->id]) }}" class="ajaxDelete">
            {!! csrf_field() !!}
            <button class="btn btn-danger btn-sm btn-flat"><i class="fa fa-times-circle"></i> </button>
        </a>
    </td>
</tr>