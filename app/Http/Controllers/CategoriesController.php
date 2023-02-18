<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Requests\CreateValidationRequest;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', [
            'categories' => $categories,
        ]);
    }
    public function create()
    {
        $categories = Categories::all();
        return view('categories.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required'
        ]);
        $categories = Categories::create([
            'name' => $request->input('name')
        ]);
    
        $categories->save();
        return redirect('/index');
    }

    public function edit($id)
    {
        $categories = Categories::find($id);
        return view('categories.edit')->with('categories', $categories);
    }

    public function update(Request $request, $id)
    {
        $categories = Categories::where('id', $id)->update([
                    'name' => $request->input('name'),
                ]);
        
        return redirect('/index');
    }

    public function destroy($id)
    {
        $categories = Categories::find($id);
        $categories->delete();
        return redirect('/index');
    }
}
