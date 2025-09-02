@extends('frontend.layouts.master')
@section('title', $product->title)
@section('main-content')

<div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <img id="product-image" src="{{ $product->image_url ?? 'https://via.placeholder.com/500x400' }}" class="img-fluid rounded shadow-sm" alt="{{ $product->title }}">
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->title }}</h2>
            <p class="text-muted">{{ $product->description }}</p>

            <!-- Variant Selection -->
            @if($product->variants->isNotEmpty())
            <div class="mt-3">
                @php
                // Collect all unique variant values
                $uniqueVariants = $product->variants
                ->map(fn($variant) => $variant->attributeValues->map(fn($v) => $v->value)->implode(' / '))
                ->unique()
                ->values();
                @endphp

                @foreach($uniqueVariants as $index => $variantName)
                <button type="button"
                    class="btn mb-2 variant-btn {{ $index === 0 ? 'btn-primary' : 'btn-outline-secondary' }}"
                    data-variant-id="{{ $product->variants[$index]->id ?? '' }}"
                    data-price="{{ $product->variants[$index]->price ?? '' }}"
                    data-specs='@json($product->variants[$index]->specifications ?? [])'>
                    {{ $variantName }}
                </button>
                @endforeach
            </div>
            @endif


            <!-- Price -->
            <p class="fw-bold fs-4 text-success" id="product-price">
                @if($product->variants->isNotEmpty())
                ₹{{ number_format($product->variants->first()->price, 2) }}
                @else
                ₹{{ number_format($product->price, 2) }}
                @endif
            </p>
            <!-- Variant-Specific Specifications (Flat Table) -->
            @if($product->variants->isNotEmpty())
            <div class="mt-4">
                <h4 class="fw-semibold mb-3">Variant Specifications</h4>
                <table class="table table-bordered" id="variant-spec-table">
                    <thead>
                        <tr>
                            <th>Specification</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->variants->first()->specifications as $spec)
                        <tr>
                            <td>{{ $spec->spec_name }}</td>
                            <td>{{ $spec->spec_value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <!-- Add to Cart -->
            <div class="mt-3">
                <a href="#" class="btn btn-primary btn-lg">Add to Cart</a>
            </div>
        </div>
    </div>



    <!-- Common Product Specifications (Grouped by Label) -->
    @if($product->specifications->isNotEmpty())
    <div class="mt-5">
        <h4 class="fw-semibold mb-3">Common Specifications</h4>
        @php
        $groupedCommonSpecs = $product->specifications->groupBy('label');
        @endphp
        <div class="row">
            @foreach($groupedCommonSpecs as $label => $specs)
            <div class="col-md-4 mb-3">
                <h6 class="text-primary fw-semibold">{{ $label }}</h6>
                <table class="table table-sm table-bordered mb-0">
                    <tbody>
                        @foreach($specs as $spec)
                        <tr>
                            <td class="fw-semibold">{{ $spec->name }}</td>
                            <td>{{ $spec->value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const variantButtons = document.querySelectorAll('.variant-btn');
        const priceElement = document.getElementById('product-price');
        const variantSpecTableBody = document.querySelector('#variant-spec-table tbody');

        variantButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const price = this.dataset.price;
                const specs = JSON.parse(this.dataset.specs);

                // Update price
                priceElement.textContent = '₹' + parseFloat(price).toFixed(2);

                // Update variant-specific specs (flat list)
                variantSpecTableBody.innerHTML = '';
                specs.forEach(spec => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td>${spec.spec_name}</td><td>${spec.spec_value}</td>`;
                    variantSpecTableBody.appendChild(tr);
                });

                // Highlight selected variant button
                variantButtons.forEach(b => b.classList.remove('btn-primary'));
                variantButtons.forEach(b => b.classList.add('btn-outline-secondary'));
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-primary');
            });
        });
    });
</script>
@endpush