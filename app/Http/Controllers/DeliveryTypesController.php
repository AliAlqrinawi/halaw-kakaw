<?php

namespace App\Http\Controllers;

use App\Models\Delivery_types;
use Illuminate\Http\Request;

class DeliveryTypesController extends Controller
{
    public function deliveryTypes (){
        return view('deliverytype.index');
    }

    public function get_deliveryTypes (){
        $Delivery_types = Delivery_types::get();
        if ($Delivery_types) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Delivery_types
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_deliveryTypes (Request $request){
        Delivery_types::create($request->all());
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
            // 'data' => $Delivery_types
        ]);
    }

    public function edit ($id){
        $Delivery_types = Delivery_types::find($id);
        if ($Delivery_types) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Delivery_types
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $Delivery_types = Delivery_types::find($id);
        if ($Delivery_types) {
            $Delivery_types->update($request->all());
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Delivery_types
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
        $Delivery_types = Delivery_types::find($id);
        if ($Delivery_types) {
            $Delivery_types->delete();
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
