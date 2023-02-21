@extends('layouts.layout')

@section('content')
    <a href="/categorycreate" 
    class="btn btn-primary"
    role="button">
      Create a new category
  </a>
  
  @foreach ($categories as $category)
  <li class="list-group-item d-flex justify-content-between align-items-start">
    {{-- <div class="ms-2 me-auto"> --}}
    <div class="h5">
      <a href="/categoryindex">
        {{ $category->id }}
        {{--show details--}}
        {{ $category->name }}
      </a>
      <br>
      <a href="categories/{{ $category->id }}/edit">
        Edit
      </a>
    {{-- Delete --}}
    <form action="/categories/{{ $category->id }}" method="post">
      @csrf
      @method('delete')
      <button type="submit" class="btn btn-danger">
        Delete
      </button>     
    </div>
    
    </form>
  </li>          
  @endforeach
@endsection