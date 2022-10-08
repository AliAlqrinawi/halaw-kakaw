<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersAndAdminController extends Controller
{

    // Admins
    public function admin (){
        return view('Admin/index');
    }

    public function get_admins (){
        $admins = User::get();
        if ($admins) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $admins
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_admin (Request $request){
        $role = new Role();
        $role->name = $request->name;
        $role->permissions = $request->permissions;
        $role->save();
        $admin = new User();
        $admin->name = $request->user_name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = Hash::make($request->password);
        $admin->save();
        $role_user = new RoleUser();
        $role_user->role_id = $role->id;
        $role_user->user_id = $admin->id;
        $role_user->save();
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
            'data' => $admin
        ]);
    }

    public function edit ($id){
        $admin = User::find($id);
        if ($admin) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $admin
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $admin = User::find($id);
        if ($admin) {
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->password = Hash::make($request->password);
            $admin->update();
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $admin
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function delete ($id){
        $admin = User::find($id);
        if ($admin) {
            $admin->delete();
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    //Clients
    public function client (){
        return view('Client/index');
    }

    public function get_clients (){
        $clients = Client::get();
        if ($clients) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $clients
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_client (Request $request){
        $client = Client::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'status' => $request->status,
                ]);
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
            'data' => $client
        ]);
    }

    public function client_edit ($id){
        $client = Client::find($id);
        if ($client) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $client
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function client_update (Request $request , $id){
        $client = Client::find($id);
        if ($client) {
            $client->name = $request->name;
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->status = $request->status;
            $client->update();
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $client
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function client_delete ($id){
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

}