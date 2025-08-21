<div class="container my-4">
    @foreach($product_lists as $product)
        <div class="product-card w-100 p-4 mb-5 border rounded shadow-sm bg-white">
            
            <!-- Title -->
            <h3 class="mb-2">{{ $product->title }}</h3>

            <!-- Short description -->
            <p class="text-muted">{{ $product->description }}</p>

            <!-- Variants -->
            @if($product->variants->isNotEmpty())
                @php
                    $attributes = [];
                    foreach ($product->variants as $variant) {
                        foreach ($variant->attributeValues as $value) {
                            $attr = $value->attribute->name;
                            $attributes[$attr][$value->id] = [
                                'id'    => $value->id,
                                'value' => $value->value,
                                'price' => $variant->price,
                            ];
                        }
                    }
                @endphp

                <div class="variants">
                    @foreach($attributes as $attrName => $values)
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">{{ ucfirst($attrName) }}</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($values as $val)
                                    <div class="variant-box p-2 border rounded text-center"
                                         style="min-width:100px; cursor:pointer;">
                                        {{ $val['value'] }}
                                        @if(!is_null($val['price']))
                                            <div class="small text-success">
                                                ₹{{ number_format($val['price'], 2) }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Simple product -->
                <p class="fw-bold fs-5 text-success">
                    ₹{{ number_format($product->price, 2) }}
                </p>
                <small class="text-muted">No variant configurations</small>
            @endif

            <!-- Technical Specifications -->
@if($product->specifications->isNotEmpty())
    <div class="specifications mt-4">
        
        @php
            $groupedSpecs = $product->specifications->groupBy('label');
        @endphp

        @foreach($groupedSpecs as $label => $specs)
            <div class="mb-3">
                <h6 class="text-primary fw-semibold">{{ $label }}</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
                        <tbody>
                            @foreach($specs as $spec)
                                <tr>
                                    <td class="fw-semibold" style="width: 40%;">{{ $spec->name }}</td>
                                    <td>{{ $spec->value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endif
 <div class="mt-3 ">
        <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-primary btn-sm">
            View Details
        </a>
    </div>
        </div>
    @endforeach
</div>