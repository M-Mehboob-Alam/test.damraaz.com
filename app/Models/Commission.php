<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
     public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
     public function order_details()
    {
        return $this->belongsTo(OrderDetail::class,'order_id','id');
    }
     public function shop_orders()
    {
        return $this->belongsTo(ShopOrder::class,'shop_order_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
