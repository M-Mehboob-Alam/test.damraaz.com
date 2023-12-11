<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
{
    use HasFactory;
    use Sluggable;
    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function scopeFilterProductName($query, $filters)
    {
        if (isset($filters['name'])) {
            $query->whereHas('products', function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['name'] . '%');
            });
        }

        if (isset($filters['min_price'])) {
            $query->where('discount_price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('discount_price', '<=', $filters['max_price']);
        }

        return $query;
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }
}
