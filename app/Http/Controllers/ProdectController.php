<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdectController extends Controller
{
    public function index()
    {
        $cat = Category::get();
        // $prodects = Product::with(['categories' , 'user'])->get();
        // dd($prodects);
        return view('Prodect.index' , compact('cat'));
    }

    public function get_prodect (){
        $prodects = Product::with(['categories' , 'user'])->get();
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
        $data = $request->except('image');
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $local =  request()->getSchemeAndHttpHost();
            $path = $file->storeAs('prodect' , $filename ,  ['disk' => 'uploads']);
            $data['image']  = $local .'/'.'uploads/'.$path;
        }
        Product::create($data);
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
        ]);
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
        $product = Product::find($id);
        if ($product) {
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
                return $data['image'];
            }
            $product->update($data);
            return response()->json([
                'message' => 'Data Found',
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
