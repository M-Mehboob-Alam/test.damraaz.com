<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductBundle extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the OrderProductBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_bundle()
    {
        return $this->belongsTo(ProductBundle::class,'product_bundle_id', 'id', );
    }
    /**
     * Get the user that owns the OrderProductBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    /**
     * Get the user that owns the OrderProductBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buy_product_bundle()
    {
        return $this->belongsTo(BuyProductBundle::class,  'buy_product_bundle_id','id');
    }
    /**
     * Get the user associated with the OrderProductBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function product_bundle()
    // {
    //     return $this->hasOneThrough( ProductBundle::class,BuyProductBundle::class,'product_bundle_id','id');
    // }
}
