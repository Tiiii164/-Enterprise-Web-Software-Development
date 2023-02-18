@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Manage Departments</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('departments.create')}}" class="btn btn-primary float-end">Add new content</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('Alert'))
                    <div class="alert alert-success">
                        {{Session::get('Alert')}}
                    </div>
                @endif
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $dp)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$dp->id}}</td>
                                <td>{{$dp->name}}</td>
                                <td>
                                    <form action="{{route('departments.destroy', $dp->id)}}" method="POST">
                                        <a href="{{route('departments.edit', $dp->id)}}" class="btn btn-info">Edit</a>
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