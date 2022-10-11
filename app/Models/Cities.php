<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    public function app_users()
    {
        return $this->hasMany(App_users::class , 'city_id' , 'id');
    }
}
