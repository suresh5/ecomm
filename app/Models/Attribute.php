<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariantValue;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
    public function categories()
{
    return $this->belongsToMany(Category::class, 'attribute_category');
}

public function variantValues()
{
    return $this->hasMany(ProductVariantValue::class, 'attribute_id');
}

public function variantAttributes()
{
    return $this->hasMany(ProductVariantValue::class);
}
}
