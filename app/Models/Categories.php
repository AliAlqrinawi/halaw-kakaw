<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = "categories";


    protected $fillable = ['title_en' , 'title_ar' , 'description_en'  , 'description_ar' , 'image' , 'status','home'];


//    protected $fillable = ['title_en' , 'title_ar' , 'description_en'  , 'description_ar' , 'image' , 'status'];

    public static $rules = [
        'title_ar' => 'required|min:3',
        'title_en' => 'required|min:3',
        'description_en' => 'required|min:3',
        'description_ar' => 'required|min:3',
        'image' => 'required',
    ];

    public function products()
    {
        return $this->hasMany(Clothes::class , 'cat_id' , 'id');
    }

    public function ads()
    {
        return $this->hasMany(Ads::class , 'cat_id' , 'id');
    }

}
