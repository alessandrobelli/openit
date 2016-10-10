<tr>
    <td>{{ $pin->name }}</td>
    <td>{{ $pin->latitude }}</td>
    <td>{{ $pin->longitude }}</td>
    <td>{{ $pin->crit ? 'Yes' : 'No' }}</td>
    <td>{{ $pin->notes }}</td>
    <td><img src="{{ asset('storage/' . $pin->image) }}" alt="Image" height="25px"></td>
    <td>
        @foreach($pin->mapRoutes as $route)
            {{ $route->name . ',' }}
        @endforeach
    </td>
    <td>{{ $pin->disabilityType->name }}</td>
    <td>
        <a href="{{ route('admin::pin.edit', ['id' => $pin->id]) }}" class="">
            <button class="btn btn-success btn-sm btn-flat"><i class="fa fa-pencil-square-o"></i> </button>
        </a>
        <a href="{{ route('admin::pin.show', ['id' => $pin->id]) }}" class="">
            <button class="btn btn-info btn-sm btn-flat"><i class="fa fa-info-circle"></i> </button>
        </a>
        <a href="{{ route('admin::pin.destroy', ['id' => $pin->id]) }}" class="ajaxDelete">
            {!! csrf_field() !!}
            <button class="btn btn-danger btn-sm btn-flat"><i class="fa fa-times-circle"></i> </button>
        </a>
    </td>
</tr>