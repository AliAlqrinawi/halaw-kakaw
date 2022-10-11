<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorates extends Model
{
    use HasFactory;

    public function governorates()
    {
        return $this->hasMany(App_users::class , 'region_id ' , 'id');
    }
}
