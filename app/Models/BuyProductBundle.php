<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyProductBundle extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the BuyProductBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the user associated with the BuyProductBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product_bundle()
    {
        return $this->belongsTo(ProductBundle::class,  'product_bundle_id','id');
    }
    // public function levels()
    // {
    //     return $this->belongsTo(ProductBundle::class,  'product_bundle_id','id');
    // }
}
