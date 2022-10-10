<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
    protected $table = "coupons";

    protected $fillable = ['code' , 'discount' , 'count_number' , 
    'end_at' , 'type' , 'percent' ,
    'use_number' , 'code_limit' , 'code_max'
    , 'status'];
}
