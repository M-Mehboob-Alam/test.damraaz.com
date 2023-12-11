<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralBundle extends Model
{
    use HasFactory;
    /**
     * Get the product_bundle associated with the ReferralBundle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product_bundle()
    {
        return $this->hasOne(ProductBundle::class, 'id', 'product_bundle_id');
    }
}
