<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantSpecification extends Model
{
      use HasFactory;

    protected $fillable = [
        'product_variant_id',
        'spec_name',
        'spec_value'
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
