<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTypes extends Model
{
    use HasFactory;

    protected $table = "delivery_types";

    protected $fillable = ['title_en' , 'title_ar' , 'status' , 'time_from' , 'time_to' , 'sat'
    , 'sun' , 'mon' , 'tue' , 'wed' , 'thu' , 'fri'
];
}
