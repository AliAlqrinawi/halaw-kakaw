<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = "clothes";

    protected $fillable = ['title_ar' , 'title_en' , 'nota_en' , 
    'nota_ar' , 'image' , 'price' ,
    'quntaty' , 'cat_id' , 'user_id'
    , 'status'];
    
    public function categories()
    {
        return $this->belongsTo(Category::class , 'cat_id'  , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id'  , 'id');
    }

    
    public function ads()
    {
        return $this->hasMany(Ads::class , 'product_id ' , 'id');
    }
}
