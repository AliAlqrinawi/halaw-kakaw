<?php

namespace App\Http\Controllers;

use App\Models\Categories as Category;
use App\Models\Clothes as Product;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ProdectController extends Controller
{
    public function index()
    {
        if(Gate::denies('product-view')){
            abort(403);
        }
        $cat = Category::get();
        // $prodects = Product::with(['categories' , 'user'])->get();
        // dd($prodects);
        return view('Prodect.index' , compact('cat'));
    }

    public function get_prodect (Request $request){
        
        $payment_status = $request->payment_status;
        
        $prodects = Product::with(['categories' , 'user']);

        if (!empty($payment_status)) {
            if($payment_status == 1){
                $prodects->where('status' , $payment_status);
            }else{
                $prodects->where('status' , 0);
            }
        }
        else{
            $prodects->get();
        }
        $prodects=$prodects->get();
        
        if ($prodects) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $prodects 
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }
    public function index_show()
    {
        $cat = Category::get();
        return view('Prodect.show' , compact('cat'));
    }

    public function show ($id){
        $prodects = Product::where('cat_id' , $id)->with(['categories' , 'user'])->get();
        if ($prodects) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $prodects 
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_prodect (Request $request){
        $validator = Validator::make($request->all(), Product::$rules);
        $data = $request->except('image');
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $local =  request()->getSchemeAndHttpHost();
            $path = $file->storeAs('prodect' , $filename ,  ['disk' => 'uploads']);
            $data['image']  = $local .'/'.'uploads/'.$path;
        }
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            Product::create($data);
            return response()->json([
                'message' => trans('category.success_add_property'),
                'status' => 200,
            ]);
        }
    }

    public function edit ($id){
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $product
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $validator = Validator::make($request->all(), Product::$rules);
        $product = Product::find($id);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }elseif($product) {
            $data = $request->except('image');
            if ($request->hasFile('image')){
                if (File::exists($product->image)){
                    File::delete($product->image);
                }
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $local =  request()->getSchemeAndHttpHost();
                $path = $file->storeAs('category' , $filename ,  ['disk' => 'uploads']);
                $data['image']  = $local .'/'.'uploads/'.$path;
                // return $data['image'];
            }
            $product->update($data);
            return response()->json([
                'message' => trans('category.success_update_property'),
                'status' => 200,
                'data' => $product
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
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'message' => trans('category.property_delete_success'),
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
        $Product = Product::find($id);
        $Product->status = request('status');
        $Product->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }

    public function add100($id)
    {
        $Product = Product::find($id);
        $Product->quntaty +=  100;
        $Product->update();
        return redirect()->back();
    }

    public function minas100($id)
    {
        $minas = 100;
        $Product = Product::find($id);
        $Product->quntaty -=  100;
        $Product->update();
        return redirect()->back();
    }
}