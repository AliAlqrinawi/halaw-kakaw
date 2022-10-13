<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AppUser extends Authenticatable
{

    protected $guarded = ['id'];
    protected $connection = 'mysql';
    protected $table = 'app_users';
//    protected $fillable = [
//        'device_token', 'mobile_number',
//    ];
    public function orders()
    {
        return $this->hasMany('\App\Models\Order','user_id','id');
    }

    public function charges()
    {
        return $this->hasMany('\App\Models\Charge','user_id','id');
    }

    public function promo()
    {
        return $this->hasMany('\App\Models\Promo','user_id','id');
    }

    public function cities()
    {
        return $this->belongsTo('\App\Models\City','city','id');
    }

    public function addres()
    {
        return $this->belongsTo('\App\Models\Charge','address','id');
    }
    public function city()
    {
        return $this->belongsTo(Governorates::class,'city_id','id');
    }
    public function region()
    {
        return $this->belongsTo(Cities::class,'region_id','id');
    }
}
