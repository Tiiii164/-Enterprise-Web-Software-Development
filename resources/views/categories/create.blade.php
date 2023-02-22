@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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