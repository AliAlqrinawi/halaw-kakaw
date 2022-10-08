<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "category";

    protected $fillable = ['title_en' , 'title_ar' , 'description_en'  , 'description_ar' , 'image' , 'status'];
}
