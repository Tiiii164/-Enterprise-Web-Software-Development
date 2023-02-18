This is roles index <br>

<a href="{{ route('roles.create') }}">Create</a> <br>

@foreach ($roles as $item)
    Roles name: {{ $item->name }}
    <form action="{{ route('roles.destroy', $item->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
    </form>
    <form action="{{ route('roles.edit', $item->id) }}" method="GET">
        @csrf
        <button type="submit">Edit</button>
    </form>
@endforeach