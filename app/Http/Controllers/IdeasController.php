<?php

namespace App\Http\Controllers;
use App\Models\Ideas;
use App\Models\Categories;
use Illuminate\Http\Request;

use App\Http\Requests\CreateValidationRequest;



class IdeasController extends Controller
{
    public function index()
    {
        $ideas = Ideas::all();
        return view('ideas.index', [
            'ideas' => $ideas,
        ]);
    }
    public function create()
    {
        $categories = Categories::all();
        return view('ideas.create', [
            'categories' => $categories,
        ]);
    }

    public function getdata(Request $request)
    {
        $request->validate([
        'text' => 'required',
        'file_path' => 'required'
        
        ]);

    }
}
