<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id')->distinct();
    }
    public function products()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
    
}
