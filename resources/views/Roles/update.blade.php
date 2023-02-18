<form action="{{ route('roles.update', $roles->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="text" name='name' value="{{ $roles->name }}"><br>
    <button type="submit">Update</button>
</form>