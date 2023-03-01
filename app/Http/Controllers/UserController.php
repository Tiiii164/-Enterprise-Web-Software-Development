<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::get()->load('roles');
        // return $users;
        $users = User::with('roles')->get();
        $users = User::with('departments')->get();
        $roles = Role::all();
        return response()->json(['users' => $users, 'roles' => $roles, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input('user');
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt('password');
        $role  = Role::where('name', $data['role'])->first();
        $department = Departments::where('name', $data['department'])->first();
        $permission = Permissions::where('name', $data['permission'])->first();
        
        $user->save();

        $user->roles()->attach($role);
        return response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showChangePassword()
    {
        return Inertia::render('ChangePassword');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json([
                'errors' => ['current_password' =>
                ['The provided password does not match your current password.']]
            ], 422);
        }
        $validatedData = $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:3', 'different:current_password'],
            'confirm_password' => ['required', 'same:new_password'],
        ]);
        $user->update([
            'password' => Hash::make($validatedData['new_password'])
        ]);
        return response()->json(['message' => 'Password updated successfully.']);
    }
}
