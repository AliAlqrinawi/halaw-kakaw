<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class OedersController extends Controller
{
    public function orders (){
        $payment = Payment::get();
        return view('order.index' , compact('payment'));
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
            'message' => trans('category.success_add_property'),
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
                'message' => trans('category.success_update_property'),
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
                'message' => trans('category.success_delete_property'),
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
        // return $request->all();
        $id = $request->id;
        $categories = Order::find($id);
        if($request->status == 'new'){
            $categories->status = 'shipping';
        }
        if($request->status == 'shipping'){
            $categories->status = 'shipping_complete';
        }
        if($request->status == 'shipping_complete'){
            $categories->status = 'complete';
        }
        $categories->update();
        return response()->json([
            // 'message' => 'Update Success',
            'status' => 200,
        ]);
    }

    public function flters(Request $request)
    {
        $payment_status = $request->payment_status ;
        $type_customer = $request->type_customer ;
        $entry_status = $request->entry_status;
        $cat_id = $request->cat_id;

        $this->payment_status = $request->payment_status ;
        $this->type_customer = $request->type_customer ;
        $this->entry_status = $request->entry_status;
        $this->cat_id = $request->cat_id;
        $order = Order::with(['user' , 'payment' , 'address' , 'deliveryTypeTitle' , 'pieces']);
        if (!empty($payment_status)) {
            $order->where('status' , $payment_status);
        }
        if (!empty($type_customer)) {
            $order->where('payment_id' , $type_customer);
        }
        if (!empty($entry_status)) {
            $u = AppUser::where('mobile_number', $entry_status)->first();
            if($u){
                $order->where('user_id' , $u->id);
            }else{
                $order->where('user_id' , 00000000);
            }
           
        }
        if (!empty($cat_id)) {
            $order->where('payment_status' , $cat_id);
        }
        else{
            $order->get();
        }
        $order=$order->get();
        if($order){
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $order
            ]);
        }
        else{
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

}