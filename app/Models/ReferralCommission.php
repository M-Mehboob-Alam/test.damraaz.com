<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommission extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
     public function order_details()
    {
        return $this->belongsTo(OrderDetail::class,'rewardOn','id');
    }
}
