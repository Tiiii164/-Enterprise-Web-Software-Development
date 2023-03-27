<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Departments;
use Inertia\Inertia;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return Resource::collection(Departments::paginate(5));
    }

    public function showSelect()
    {
        $departments = Departments::all();
        return response()->json($departments);
    }
    
    public function count()
    {
        $departments = Departments::withCount(['ideas'=>function($q){
            $q->has('departments', '>', 0);
        }, 'users' => function($q){
            $q->has('ideas', '>', 0);
        }])->get();
        return response()->json($departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDepartmentsCreate(Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
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
        $department = new Departments();
        $department->name = $request->input('name');
        $department->save();
        return response()->json($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDepartments(Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
        return Inertia::render('DepartmentsIndex');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDepartmentsUpdate($id, Request $request)
    {
        $request->user()->authorizeRoles(['Manager', 'Admin']);
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
        $department = Departments::find($id);
        $department->update($request->all());
        return response()->json($department);
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
