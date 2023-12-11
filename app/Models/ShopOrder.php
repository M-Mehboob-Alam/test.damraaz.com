<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the ShopOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'shop_order_id', 'id');
    }
    public function orders()
    {
        return $this->belongsTo(Order::class, 'orderId', 'orderId');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'user_id');
    }




}
