@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <form action="/create" method="get">
        @csrf
        <div class="mb-3">
          <label for="text" class="form-label">Text</label>
          <input type="text" class="form-control" id="text">
        </div>
        <div class="mb-3">
            <label for="file_path" class="form-label">File path</label>
            <input type="text" class="form-control" id="file_path">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">File</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <select name="category_id" class="form-select" aria-label="Default select example">
            <option selected>Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                  {{ $category->name }}
                </option>    
              @endforeach  
          </select>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Term</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</head>
<body>
    
</body>
</html>