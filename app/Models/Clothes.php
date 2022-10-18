<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    protected $table = "clothes";

    protected $fillable = ['title_ar' , 'title_en' , 'nota_en' ,
    'nota_ar' , 'image' , 'price' ,
    'quntaty' , 'cat_id' , 'user_id'
    , 'status'];


    public static $rules = [
        'title_ar' => 'required|min:3',
        'title_en' => 'required|min:3',
        'note_ar' => 'required|min:3',
        'note_en' => 'required|min:3',
        'price' => 'required|numeric',
        'quntaty' => 'required|numeric',
        'image' => 'required',
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class , 'cat_id'  , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id'  , 'id');
    }
    public function charityImages()
    {
        return $this->hasMany('\App\Models\CharityImage','charity_id','id');
    }

    public function ads()
    {
        return $this->hasMany(Ads::class , 'product_id ' , 'id');
    }

    public function favorites()
    {
        return $this->hasMany('\App\Models\Fav', 'charity_id', 'id');
    }
    public function Pieces()
    {
        return $this->hasMany(Pieces::class, 'clothe_id', 'id');
    }
}
