<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeListing extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'item_title',
        'item_description',
        'city',
        'address',
        'image',
        'images',
        'item_price',
        'status'  
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
