<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Clothes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class ProductsDetailsController extends Controller
{
    public function index()
    {
        if(Gate::denies('productList-view')){
            abort(403);
        }
        $cat = Categories::get();
        return view('Prodect.indexd' , compact('cat'));
    }

    public function get_d()
    {
        $prodects = Clothes::orderBy('pieces_count', 'DESC')->withCount('Pieces')->with(['categories' , 'user'])->get();
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
            'data' => $prodects 
        ]);
    }


    public function indexm()
    {        
        if(Gate::denies('productList-view')){
            abort(403);
        }
        $cat = Categories::get();
        return view('Prodect.indexm' , compact('cat'));
    }

    public function get_m()
    {
        $prodects = Clothes::with(['categories' , 'user'])->paginate(50);
        $data_arr = array();
        $sno = 1;
        foreach($prodects as $record){
            $id = $record->id;
            if(App::getLocale() == 'en'){
                $title = $record->title_en;
            }else{
                $title = $record->title_ar;
            }
            $image = $record->image;
            $price = $record->price;
            $quntaty = $record->quntaty;
            $status = $record->status;
            if(App::getLocale() == 'en'){
                $title_c = $record->categories->title_en;
            }else{
                $title_c = $record->categories->title_ar;
            }
            $data_arr[] = array(
                "id" => $id,
                "title_en" => $title,
                // "title_ar" => $title_ar,
                "image" => $image,
                "price" => $price,
                "quntaty" => $quntaty,
                "status" => $status,
                "title_c" => $title_c,
                // "title_ar_c" => $title_ar_c,
            );
        }
        // return ;
        return response()->json([
            'message' => 'Data Found',
            'status' => 200,
            'data' => $data_arr 
        ]);
    }
}