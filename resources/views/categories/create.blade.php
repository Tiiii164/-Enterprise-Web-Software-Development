@extends('layouts.layout')

@section('content')
    <form action="/categories" method="post">
        @csrf
        <input id = "name" class="form-control" 
          type="text" name="name" 
          placeholder="Enter category name">
        <button class="btn btn-primary" type="submit">
            Submit
        </button>
      </form>
@endsection