@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Topics</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('topics.create')}}" class="btn btn-primary float-end">Add new content</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
          
                
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Topic's Name</th>
                            <th>Closure Date</th>
                            <th>Final Closure Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($topics as $topic)
                        
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $topic -> id}}</td>
                                <td>{{ $topic -> name}}</td>
                                <td>{{ $topic -> closure_date}}</td>
                                <td>{{ $topic -> final_closure_date}}</td>
                                <td>
                                    <form action="{{route('topics.destroy', $topic->id)}}" method="POST">
                                        <a href="{{route('topics.edit', $topic->id)}}" class="btn btn-info">Edit</a>
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
@endsection


{{-- @foreach ($foods as $food)
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
    <div class="fw-bold">
      <a href="/foods/{{ $food->id }}">
        
        {{ $food->name }}
      </a>      
    </div>
    {{ $food->description }}
    </div>
    <span class="badge bg-primary rounded-pill">
        {{ $food->count }}
    </span>
    <a href="foods/{{ $food->id }}/edit">
        Edit
    </a>
    {{-- Delete a food --}}
    {{-- <form action="/foods/{{ $food->id }}" method="post">
      @csrf
      @method('delete')
      <button type="submit" class="btn btn-danger">
        Delete
      </button>
    </form>
  </li>           --}}