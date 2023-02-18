@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit topics</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('topics.index')}}" class="btn btn-primary float-end">Back to list</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('topics.update', $topics->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>ID</strong>
                                <input type="text" name="id" value="{{$topics->id}}" class="form-control" placeholder="Enter Topics ID">
                            </div>
                            <div class="form-group">
                                <strong>Name</strong>
                                <input type="text" name="name" value="{{ $topics->name }}" class="form-control" placeholder="Enter Topic">
                            </div>
                            <div class="form-group">
                                <strong>Closure Date</strong>
                                <input type="date" name="closure_date" value="{{ $topics->closure_date }}"  class="form-control" placeholder="Enter Closure Date">
                            </div>
                            <div class="form-group">
                                <strong>Final Closure Date</strong>
                                <input type="date" name="final_closure_date" value="{{ $topics->final_closure_date }}" class="form-control" placeholder="Enter Final Closure Date">
                            </div>
                    <button type="submit" class="btn btn-success mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
{{-- //action="/s/{{ $-> id }}" method="post">     --}}