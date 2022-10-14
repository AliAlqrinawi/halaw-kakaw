<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUsers extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'mysql';
    protected $table = 'app_users';
    public function cities()
    {
        return $this->belongsTo(Cities::class , 'city_id' , 'id');
    }

    public function governorates()
    {
        return $this->belongsTo(Governorates::class , 'region_id ' , 'id');
    }

    public function charges()
    {
        return $this->hasMany('\App\Models\Charge','user_id','id');
    }

    public function addres()
    {
        return $this->belongsTo('\App\Models\Charge','address','id');
    }

    public function promo()
    {
        return $this->hasMany('\App\Models\Promo','user_id','id');
    }

    public function city()
    {
        return $this->belongsTo(Governorates::class,'city_id','id');
    }


    public function region()
    {
        return $this->belongsTo(Cities::class,'region_id','id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class , 'user_id' , 'id');
    }
}
