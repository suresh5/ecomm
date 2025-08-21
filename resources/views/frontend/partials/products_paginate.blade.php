 <div id="products-list">
                @forelse($products as $product)
                    <div class="card mb-4 shadow-sm p-3">
                        <!-- Row 1: Image + Description -->
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}" class="img-fluid rounded" alt="{{ $product->title }}">
                            </div>
                            <div class="col-md-8">
                                <h5>{{ $product->title }}</h5>
                                <p class="text-muted">{{ Str::limit($product->description, 150) }}</p>
                                @if($product->variants->isEmpty())
                                    <p class="fw-bold text-success fs-5">₹{{ number_format($product->price,2) }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Row 2: Variants / Attributes -->
                        @if($product->variants->isNotEmpty())
                            @php
                                $attributesArr = [];
                                foreach ($product->variants as $variant) {
                                    foreach ($variant->attributeValues as $value) {
                                        $attr = $value->attribute->name;
                                        $attributesArr[$attr][$value->id] = [
                                            'id' => $value->id,
                                            'value' => $value->value,
                                            'price' => $variant->price,
                                        ];
                                    }
                                }
                            @endphp
                            <div class="mt-3">
                                @foreach($attributesArr as $attrName => $values)
                                    <h6 class="fw-semibold">{{ ucfirst($attrName) }}</h6>
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        @foreach($values as $val)
                                            <div class="border p-2 rounded text-center" style="min-width:80px; cursor:pointer;">
                                                {{ $val['value'] }}
                                                @if(!is_null($val['price']))
                                                    <div class="text-success small">₹{{ number_format($val['price'],2) }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Row 3: Specifications grouped 3 columns -->
                        @if($product->specifications->isNotEmpty())
                            @php
                                $groupedSpecs = $product->specifications->groupBy('label');
                            @endphp
                            <div class="row mt-3 g-3">
                                @foreach($groupedSpecs as $label => $specs)
                                    <div class="col-md-6">
                                        <h6 class="text-primary fw-semibold">{{ $label }}</h6>
                                        <table class="table table-sm table-bordered mb-0">
                                            <tbody>
                                                @foreach($specs as $spec)
                                                    <tr>
                                                        <td class="fw-semibold" style="width:40%;">{{ $spec->name }}</td>
                                                        <td>{{ $spec->value }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-3 text-end">
        <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-primary btn-sm">
            View Details
        </a>
    </div>
                    </div>
                @empty
                    <p class="text-muted">No products found.</p>
                @endforelse

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>