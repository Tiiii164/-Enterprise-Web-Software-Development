<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return response()->json($categories);
    }
    public function showCategoriesCreate(Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
        return Inertia::render('CategoriesCreate');
    }

    public function getCategories()
    {
        $data = Categories::get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $categories = new Categories();
        $categories->name = $request->input('name');
        $categories->save();
        return response()->json($categories);
    }

    public function showCategories(Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
        return Inertia::render('CategoriesIndex');
    }

    public function showCategoriesUpdate($id, Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
        return Inertia::render('CategoriesUpdate');
    }


    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        $category->update($request->all());
        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return response()->json(['message' => 'Category has been deleted']);
    }
}
