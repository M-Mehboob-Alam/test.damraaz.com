<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBundle extends Model
{
    use HasFactory;
    /**
     * Get all of the comments for the ProductBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_bundle_detail()
    {
        return $this->hasMany(ProductBundleDetail::class);
    }
    public function levels()
    {
        return $this->hasMany(BundleLevel::class, 'product_bundle_id','id')->orderBy('level');;
    }
    /**
     * Get all of the comments for the ProductBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProductBundle()
    {
        return $this->hasMany(OrderProductBundle::class, 'buy_product_bundle_id', 'product_bundle_id');
    }
}
