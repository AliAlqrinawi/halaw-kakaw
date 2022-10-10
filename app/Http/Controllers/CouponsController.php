<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index (){

        return view('Coupon.index');
    }

    public function get_coupons (){
        $coupons = Coupons::get();
        if ($coupons) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $coupons
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_coupons (Request $request){
        //  return $request['use_number'];
        if($request['type'] == 0){
            $coupon = new Coupons();
            $coupon->code = $request['code'];
            $coupon->discount = 0.00;
            $coupon->count_number = $request['count_number'];
            $coupon->end_at = $request['end_at'];
            $coupon->type = $request['type'];
            $coupon->percent = $request['discount'];
            $coupon->code_limit = $request['code_limit'];
            $coupon->code_max = $request['code_max'];
            $coupon->status = $request['status'];
            $coupon->save();
        }else{
            $coupon = new Coupons();
            $coupon->code = $request['code'];
            $coupon->discount = $request['discount'];
            $coupon->count_number = $request['count_number'];
            $coupon->end_at = $request['end_at'];
            $coupon->type = $request['type'];
            $coupon->percent = 0;
            $coupon->code_limit = $request['code_limit'];
            $coupon->code_max = $request['code_max'];
            $coupon->status = $request['status'];
            $coupon->save();
        }
        
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
            // 'data' => $category
        ]);
    }

    public function edit ($id){
        $coupon = Coupons::find($id);
        if ($coupon) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $coupon
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }


    public function update (Request $request , $id){
        $coupon = Coupons::find($id);
        if ($coupon) {
            if($request['type'] == 0){
                $coupon->code = $request['code'];
                $coupon->discount = 0.00;
                $coupon->count_number = $request['count_number'];
                $coupon->end_at = $request['end_at'];
                $coupon->type = $request['type'];
                $coupon->percent = $request['discount'];
                $coupon->code_limit = $request['code_limit'];
                $coupon->code_max = $request['code_max'];
                $coupon->status = $request['status'];
                $coupon->update();
                return response()->json([
                    'message' => 'Data Found 1 ',
                    'status' => 200,
                    'data' => $coupon
                ]);
            }else{
                $coupon->code = $request['code'];
                $coupon->discount = $request['discount'];
                $coupon->count_number = $request['count_number'];
                $coupon->end_at = $request['end_at'];
                $coupon->type = $request['type'];
                $coupon->percent = 0;
                $coupon->code_limit = $request['code_limit'];
                $coupon->code_max = $request['code_max'];
                $coupon->status = $request['status'];
                $coupon->update();
                return response()->json([
                    'message' => 'Data Found 0 ',
                    'status' => 200,
                    'data' => $coupon
                ]);
            }
            }
          else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }


}