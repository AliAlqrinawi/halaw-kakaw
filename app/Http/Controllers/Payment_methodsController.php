<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class Payment_methodsController extends Controller
{
    public function payment (){
        return view('Payment.index');
    }

    public function get_payments (){
        $payments = Payment::get();
        if ($payments) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $payments
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_payment (Request $request){
        $payment =  new Payment();
        $payment->title_ar = $request->title_ar;
        $payment->title_en = $request->title_en;
        $payment->slug = Str::slug($request->title_ar);
        $payment->save();
        return response()->json([
            'message' => trans('category.success_add_property'),
            'status' => 200,
            // 'data' => $Payment
        ]);
    }

    public function edit ($id){
        $payment = Payment::find($id);
        if ($payment) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $payment
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $payment = Payment::find($id);
        if ($payment) {
            $payment->title_ar = $request->title_ar;
            $payment->title_en = $request->title_en;
            $payment->slug = Str::slug($request->title_ar);
            $payment->update();
            return response()->json([
                'message' => trans('category.success_update_property'),
                'status' => 200,
                'data' => $payment
            ]);
            }
          else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $categories = Payment::find($id);
        $categories->status = request('status');
        $categories->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }

    public function delete ($id){
        $payment = Payment::find($id);
        if ($payment) {
            $payment->delete();
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
}
