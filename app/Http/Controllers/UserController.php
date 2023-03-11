<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Departments;
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
        $users = User::with('roles', 'departments')->get();
        $roles = Role::all();
        $permissions = Permission::all();
        $departments = Departments::all();
        return response()->json(['users' => $users, 
                                 'roles' => $roles,
                                 'permissions' => $permissions,
                                 'departments' => $departments]);
    }
    public function count()
    {
        $users = User::withCount('ideas')->has('ideas', '>', 0)->get();
        return response()->json($users);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsersCreate()
    {
        return Inertia::render('UsersCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|confirmed|min:3',
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        
        $user->roles()->attach(Role::where('id', $request->role)->first());
        $user->departments()->attach(Departments::where('id', $request->department)->first()->id);
        return response('success');   
}
                
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        return Inertia::render('UsersIndex');
    }

    public function showUsersUpdate($id)
    {
        return Inertia::render('UsersUpdate');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        $user->roles()->detach($user->role_id);
        $user->roles()->attach($request->role);
        $user->departments()->detach($user->department_id);
        $user->departments()->attach($request->department);
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
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'User has been deleted']);
    }
}
