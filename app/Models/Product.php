<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Product extends Model
{
    use HasFactory;
    use Sluggable;
    public function ordersDetail()
    {
        return $this->hasMany(OrderDetail::class,'product_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orders()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function scopeFilterName($query, $value)
    {
        if ($value) {
            return $query->where('name', 'like', '%' . $value . '%');
        }
        return $query;
    }
    public function scopeFilterSortPrice($query, $value)
    {
        if ($value) {
            return $query->where('discount_price', $value);
        }
        return $query;
    }
    public function scopeFilterPriceBetween($query, $min, $max)
    {
        if ($min || $max) {
            return $query->whereBetween('discount_price', [$min, $max]);
        }
        return $query;
    }


    public function setOfferAttribute($value)
    {
        $this->attributes['offer'] = strtolower($value);
    }

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'user_id', 'user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_detail()
    {
        return $this->hasOne(OrderDetail::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branding()
    {
        return $this->belongsTo(Branding::class, 'branding_id', 'id');
    }
}
