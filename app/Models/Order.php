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
    protected $guarded = ['id'];
        protected $connection = 'mysql';
        protected $table = 'orders';
        protected $appends = ['total_wallet'];
    
        public function getTotalWalletAttribute($value)
        {
            return $this->attributes['total_cost'] - $this->attributes['credit'];
        }
    
        public function user()
         {
             return $this->belongsTo(AppUser::class , 'user_id' , 'id');
         }
    
        public function cat()
        {
            return $this->belongsTo('\App\Models\Categories');
        }
    
        public function orderStatus()
        {
            return $this->hasMany(Status::class, 'order_id' , 'id');
        }
    
        public function pieces()
        {
            return $this->hasMany(Pieces::class , 'order_id' , 'id');
        }
    
        public function driver()
        {
            return $this->belongsTo(Drivers::class , 'driver_id' , 'id');
        }
    
    
        public function payment()
        {
            return $this->belongsTo(Payment::class , 'payment_id' , 'id');
        }
    
    
        public function delivery()
        {
            return $this->belongsTo(Delivery::class , 'delivery_id' , 'id');
        }
    
    
        public function time()
        {
            return $this->belongsTo(Times::class , 'time_id' , 'id');
        }
    
    
        public function deliveryTypeTitle()
        {
            return $this->belongsTo(DeliveryTypes::class , 'delivery_type','id');
        }
    
        public function address()
        {
            return $this->belongsTo(Charge::class , 'address_id' , 'id');
        }
    
        public function promo()
        {
            return $this->belongsTo(Coupons::class , 'promo_code' , 'id');
        }
    
}
