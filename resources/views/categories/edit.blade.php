@extends('layouts.layout')

@section('content')
    <form action="/categories/{{$categories->id}}" method="post">
        @csrf
        @method('PUT')  
        <input class="form-control" 
          type="text" name="name" value="{{$categories->name}}"
          placeholder="Enter category name">
        <button class="btn btn-primary" type="submit">
            Update
        </button>
      </form>
</head>
@endsection