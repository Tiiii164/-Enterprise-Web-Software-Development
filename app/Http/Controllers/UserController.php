<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Role;
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
        $roles = Role::all();
        return response()->json(['users' => $users, 'roles' => $roles]);
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
                'password' => 'required|confirmed|min:4',
                'department_id' => 'required'
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        
        $user->save();

        $role = Role::where('id', $request->role)->first();
        $user->roles()->attach($role);
        $permission  = Permissions::where('id', $request->permission)->first();
        $user->permissions()->attach($permission);
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
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'User has been deleted']);
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
