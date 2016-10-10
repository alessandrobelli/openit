<tr>
    <td>{{ $disability->name }}</td>
    <td>
        <a href="{{ route('admin::disability.edit', ['id' => $disability->id]) }}" class="ajaxShowRow">
            <button class="btn btn-success btn-sm btn-flat"><i class="fa fa-pencil-square-o"></i> </button>
        </a>
        <a href="{{ route('admin::disability.destroy', ['id' => $disability->id]) }}" class="ajaxDelete">
            {!! csrf_field() !!}
            <button class="btn btn-danger btn-sm btn-flat"><i class="fa fa-times-circle"></i> </button>
        </a>
    </td>
</tr>