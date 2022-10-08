<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RolesController extends Controller
{
    public function index (){
        return view('roles.index');
    }
    
    public function get_roles (){
        $roles = Role::withCount('users')->with('users')->get();
        if ($roles) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $roles
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function store (Request $request){
        $role = new Role();
        $role->name = $request->name;
        $role->permissions = $request->permissions;
        $role->save();
        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $role_user = new RoleUser();
        $role_user->role_id = $role->id;
        $role_user->user_id = $user->id;
        $role_user->save();
    }

    public function edit_role($id , $user_id)
    {
        $role = Role::find($id);
        $user = User::find($user_id);
        if ($role && $user) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $role,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required' , 'permissions' => 'required'] );
        $role->update($request->all());
        
        return redirect()->route('roles.index')->with('success' , 'updated is success.');
    }

    public function destroy($id)
    {
        Role::destroy($id);
    }
}
