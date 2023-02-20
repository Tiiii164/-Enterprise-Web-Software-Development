<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Departments::all();
        // return view('departments.index', [
        //     'departments' => $departments,
        // ]);
        return view('departments.index')->with('departments', $departments);
    }


    public function create()
    {
        $departments = Departments::all();
        return view('departments.create', [
            'departments' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $departments = Departments::create(['name' => $request->input('name')]);
        $departments->save();
        return redirect('/departments');
    }

    public function show($id)
    {
        $departments = Departments::find($id);
        return view('departments.show')->with('departments', $departments);
    }

    public function edit($id)
    {
        $departments = Departments::Find($id);
        return view('departments.edit', ['departments' => $departments]);
    }

    public function update(Request $request, $id)
    {
        $departments = Departments::where('id', $id)
            ->update([
                'id' => $request->input('id'),
                'name' => $request->input('name'),
            ]);
        return redirect('/departments');
    }

    public function destroy($id)
    {
        $departments = Departments::find($id);
        $departments->delete();
        return redirect('/departments');
    }
}
