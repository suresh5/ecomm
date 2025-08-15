<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AttributeValue;
class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'brand_id',
        'sku',
        'price',
        'discount',
        'stock',
        'variant_photo',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function values()
    {
        return $this->hasMany(ProductVariantValue::class);
    }

    public function specifications()
    {
        return $this->hasMany(VariantSpecification::class);
    }

    public function attributeValues()
{
    return $this->belongsToMany(AttributeValue::class, 'product_variant_values')
        ->withPivot('attribute_id') // Include attribute_id if you want
        ->withTimestamps();
}
}
