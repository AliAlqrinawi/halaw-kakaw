<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function ads (){
        $coupons = Ads::with(['categories' , 'Products'])->get();
        dd($coupons);
        return view('Ads.index');
    }

    public function get_ads (){
        $coupons = Ads::with(['categories' , 'Products'])->get();
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

    // public function add_category (Request $request){
    //     $data = $request->except('image');
    //     if ($request->hasFile('image')){
    //         $file = $request->file('image');
    //         $filename = $file->getClientOriginalName();
    //         $local =  request()->getSchemeAndHttpHost();
    //         $path = $file->storeAs('category' , $filename ,  ['disk' => 'uploads']);
    //         $data['image']  = $local .'/'.'uploads/'.$path;
    //     }
    //     // $category = new Category();
    //     // $category->title = $request->title;
    //     // $category->description = $request->description;
    //     // $category->image = $request->image;
    //     // $category->status = $request->status;
    //     // $category->save();
    //     Category::create($data);
    //     return response()->json([
    //         'message' => 'Data Found',
    //         'status' => 200,
    //         // 'data' => $category
    //     ]);
    // }

    // public function edit ($id){
    //     $category = Category::find($id);
    //     if ($category) {
    //         return response()->json([
    //             'message' => 'Data Found',
    //             'status' => 200,
    //             'data' => $category
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Data Not Found',
    //             'status' => 404,
    //         ]);
    //     }
    // }

    // public function update (Request $request , $id){
    //     $category = Category::find($id);
    //     if ($category) {
    //         $data = $request->except('image');
    //         if ($request->hasFile('image')){
    //             if (File::exists($category->image)){
    //                 File::delete($category->image);
    //             }
    //             $file = $request->file('image');
    //             $filename = $file->getClientOriginalName();
    //             $local =  request()->getSchemeAndHttpHost();
    //             $path = $file->storeAs('category' , $filename ,  ['disk' => 'uploads']);
    //             $data['image']  = $local .'/'.'uploads/'.$path;
    //             return $data['image'];
    //         }
    //         $category->update($data);
    //         return response()->json([
    //             'message' => 'Data Found',
    //             'status' => 200,
    //             'data' => $category
    //         ]);
    //         }
    //       else {
    //         return response()->json([
    //             'message' => 'Data Not Found',
    //             'status' => 404,
    //         ]);
    //     }
    // }

    // public function delete ($id){
    //     $category = Category::find($id);
    //     if ($category) {
    //         $category->delete();
    //         return response()->json([
    //             'message' => 'Data Found',
    //             'status' => 200,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Data Not Found',
    //             'status' => 404,
    //         ]);
    //     }
    // }
}
