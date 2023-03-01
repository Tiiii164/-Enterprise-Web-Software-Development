@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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