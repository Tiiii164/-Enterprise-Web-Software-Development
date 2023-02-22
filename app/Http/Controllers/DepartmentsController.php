<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;
use Inertia\Inertia;

class DepartmentsController extends Controller
{
    public function index()
    {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        $departments = Departments::all();
        // return view('departments.index', [
        //     'departments' => $departments,
        // ]);
        return response()->json($departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDepartmentsCreate()
    {
        return Inertia::render('DepartmentsCreate');
    }

    // public function create()
    // {
    //     $departments = Departments::all();
    //     return view('departments.create', [
    //         'departments' => $departments,
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departments = new Departments();
        $departments->name = $request->input('name');
        $departments->save();
        return response()->json($departments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDepartments()
    {
        return Inertia::render('DepartmentsIndex');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDepartmentsUpdate($id)
    {
        return Inertia::render('DepartmentsUpdate');
    }


    // public function show($id)
    // {
    //     $departments = Departments::find($id);
    //     return view('departments.show')->with('departments', $departments);
    // }

    // public function edit($id)
    // {
    //     $departments = Departments::Find($id);
    //     return view('departments.edit', ['departments' => $departments]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $departments = Departments::where('id', $id)
        //     ->update([
        //         'id' => $request->input('id'),
        //         'name' => $request->input('name'),
        //     ]);
        //     return response()->json($departments);
        $departments = Departments::find($id);
        $departments->update($request->all());
        return response()->json($departments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departments = Departments::find($id);
        $departments->delete();
        return response()->json(['message' => 'Departments deleted']);
    }
}
