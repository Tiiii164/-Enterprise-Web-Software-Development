<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <input type="text" name='name' placeholder="Enter Roles" required><br>
    <button type="submit">Create</button>
</form>
