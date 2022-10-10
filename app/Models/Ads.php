<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    protected $table = "ads";

    protected $fillable = ['url' , 'layout' , 'lauout_title' , 
    'image' , 'days' , 'cost' ,
    'status' , 'cat_id' , 'product_id'];
    
    public function categories()
    {
        return $this->belongsTo(Category::class , 'cat_id'  , 'id');
    }

    public function Products()
    {
        return $this->belongsTo(Product::class , 'product_id'  , 'id');
    }
}
