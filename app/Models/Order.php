<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shop_orders()
    {
        return $this->hasMany(ShopOrder::class, 'orderId', 'orderId');
    }


    public function order_detail(){
        return $this->hasMany(OrderDetail::class);
    }
    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function ordersDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function track_order()
    {
        return $this->hasMany(TrackOrder::class)->latest();
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, OrderDetail::class, 'order_id','id','id','product_id');
    }
    public function returnDetail()
    {
        return $this->hasOne(ReturnDetail::class);
    }

    public function scopeFilterOrderId($query, $value)
    {
        if($value)
        {
            return $query->where('orderId','like', '%' . $value . '%');
        }
        return $value;

    }

}
