<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(AppUsers::class , 'user_id' , 'id');
    }
}
