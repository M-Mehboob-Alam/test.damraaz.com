<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    public function shop()
    {
        return $this->belongsTo(User::class,'shop_id','id');
    }
}
