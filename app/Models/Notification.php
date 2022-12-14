<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{


    protected $guarded = ['id'];
    protected $connection = 'mysql';
    protected $table = 'notification_log';

    public function user()
    {
        return $this->belongsTo('\App\Models\AppUser');
    }
    public function driver()
    {
        return $this->belongsTo('\App\Models\Drivers');
    }

}
