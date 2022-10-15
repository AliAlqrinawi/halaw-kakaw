<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pieces extends Model
{
    use HasFactory;

    protected $table = 'orders_pices';
    
    public function orders()
    {
        return $this->hasMany(Order::class , 'order_id' , 'id');
    }

}
