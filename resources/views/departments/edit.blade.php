@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit Departments</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('departments.index')}}" class="btn btn-primary float-end">Back to list</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('departments.update', $departments->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>ID</strong>
                                <input type="text" name="id" value="{{$departments->id}}" class="form-control" placeholder="Enter your ID">
                            </div>
                            <div class="form-group">
                                <strong>Name</strong>
                                <input type="text" name="name" value="{{$departments->name}}" class="form-control" placeholder="Enter your name">
                            </div>
                    <button type="submit" class="btn btn-success mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection