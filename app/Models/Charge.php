<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{


    protected $guarded = ['id'];
    protected $connection = 'mysql';
    protected $table = 'app_users_charges';

    public function user()
    {
        return $this->belongsTo('\App\Models\AppUser');
    }

    public function cityData()
    {
        return $this->belongsTo(Governorates::class,'city_id','id');
    }
    public function regionData()
    {
        return $this->belongsTo(Cities::class,'region_id','id');
    }


}
