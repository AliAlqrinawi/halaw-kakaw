<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(App_users::class , 'user_id' , 'id');
    }
}
