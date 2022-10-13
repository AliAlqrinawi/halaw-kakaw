<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    public function category (){
        return view('Category/index');
    }

    public function get_categories (){
        $categories = Category::get();
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
        $data = $request->except('image');
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $local =  request()->getSchemeAndHttpHost();
            $path = $file->storeAs('category' , $filename ,  ['disk' => 'uploads']);
            $data['image']  = $local .'/'.'uploads/'.$path;
        }
        // $category = new Category();
        // $category->title = $request->title;
        // $category->description = $request->description;
        // $category->image = $request->image;
        // $category->status = $request->status;
        // $category->save();
        Category::create($data);
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
            // 'data' => $category
        ]);
    }



    public function edit ($id){
        $category = Category::find($id);
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
        $category = Category::find($id);
        if ($category) {
            $data = $request->except('image');
            if ($request->hasFile('image')){
                if (File::exists($category->image)){
                    File::delete($category->image);
                }
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $local =  request()->getSchemeAndHttpHost();
                $path = $file->storeAs('category' , $filename ,  ['disk' => 'uploads']);
                $data['image']  = $local .'/'.'uploads/'.$path;
                return $data['image'];
            }
            $category->update($data);
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
        $category = Category::find($id);
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
        $categories = Category::find($id);
        $categories->status = request('status');
        $categories->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }
}