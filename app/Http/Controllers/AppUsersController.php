<?php

namespace App\Http\Controllers;

use App\Models\App_users;
use Illuminate\Http\Request;

class AppUsersController extends Controller
{
    public function app_user (){
        return view('app_user.index');
    }

    public function get_appUser (){
        $app_users = App_users::get();
        if ($app_users) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $app_users
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function delete ($id){
        $app_user = App_users::find($id);
        if ($app_user) {
            $app_user->delete();
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

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $categories = App_users::find($id);
        $categories->status = request('status');
        $categories->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }

    public function add100(Request $request)
    {
        $id = $request->id;
        $Product = App_users::find($id);
        $Product->credit = $request->credit;
        $Product->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }
}
