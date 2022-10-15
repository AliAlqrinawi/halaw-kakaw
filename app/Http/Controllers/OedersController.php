<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OedersController extends Controller
{
    public function orders (){
        // $categories = Order::with(['user' , 'payment' , 'address' , 'deliveryTypeTitle' , 'pieces'])->get();
        // return $categories;
        return view('order.index');
    }

    public function get_orders (){
        $categories = Order::with(['user' , 'payment' , 'address' , 'deliveryTypeTitle' , 'pieces'])->get();
        if ($categories) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $categories
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_category (Request $request){

        Order::create($request);
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
            // 'data' => $category
        ]);
    }



    public function edit ($id){
        $category = Order::find($id);
        if ($category) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $category
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $category = Order::find($id);
        if ($category) {
            $category->update($request);
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $category
            ]);
            }
          else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function delete ($id){
        $category = Order::find($id);
        if ($category) {
            $category->delete();
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
        $categories = Order::find($id);
        $categories->status = request('status');
        $categories->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }
}
