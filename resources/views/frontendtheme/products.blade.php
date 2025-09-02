@extends('frontendtheme.layouts.app')

@section('title', 'Categories')

@section('content')

<!-- page-title -->
<div class="page-title" style="background-image: url('{{ asset('frontend/images/section/bg-2.png') }}');">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">SENBA'S PRODUCTS</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="{{ route('home') }}">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Products</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- Section product -->
<section class="flat-spacing">
    <div class="container">
        <div class="row align-items-center mb-3">
            <!-- Left: Filter Button -->
            <div class="col-12 col-xl-3 mb-2 mb-xl-0">
                <button id="filterShop" class="filterShop tf-btn-filter btn btn-outline-primary d-inline-flex align-items-center">
                    <span class="icon icon-filter me-2"></span>
                    <span>Filters</span>
                </button>
            </div>

            <!-- Right: Short Description -->
            <div class="col-12 col-xl-9">
                <p class="mb-0 text-muted fw-semibold">
                    Browse our collection of high-performance motors and pumps,
                    designed for reliable domestic and industrial use.
                </p>
            </div>
        </div>

        <div class="wrapper-control-shop">
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-xl-3">
                    <div class="sidebar-filter canvas-filter left">
                        <div class="canvas-wrapper">
                            <div class="canvas-header d-flex d-xl-none">
                                <h5>Filters</h5>
                                <span class="icon-close close-filter"></span>
                            </div>
                            <div class="canvas-body">
                                <form id="filterForm" method="GET" action="{{ route('products') }}">
                                    <!-- Categories -->
                                    <div class="widget-facet facet-categories">
                                        <h6 class="facet-title">Product Categories</h6>
                                        <ul class="facet-content">
                                            @foreach($parentCategories as $category)
                                            <li>
                                                <label>
                                                    <input type="radio" name="category" value="{{ $category->slug }}"
                                                        {{ request('category') == $category->slug ? 'checked' : '' }}>
                                                    {{ $category->title }}
                                                    <span class="count-cate">({{ $category->products_count ?? 0 }})</span>
                                                </label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Attributes -->
                                    <h6 class="facet-title">Attributes</h6>
                                    <div class="widget-facet">
                                        @foreach($attributes as $attribute)
                                        <div class="facet-fieldset mb-4 p-2 border rounded" style="max-height: 200px; overflow-y: auto;">
                                            <h6 class="facet-title">{{ $attribute->name }}</h6>
                                            <div class="box-fieldset-item">
                                                @foreach($attribute->values as $value)
                                                <fieldset class="fieldset-item mt-2">
                                                    <input
                                                        type="checkbox"
                                                        name="attributes[{{ $attribute->id }}][]"
                                                        class="tf-check"
                                                        value="{{ $value->id }}"
                                                        {{ in_array($value->id, request()->input('attributes.' . $attribute->id, [])) ? 'checked' : '' }}>
                                                    <label>{{ $value->value }}</label>
                                                </fieldset>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>


                                    <!-- Buttons -->
                                    <div class="mt-3 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                                        <a href="{{ route('products') }}" class="btn btn-secondary btn-sm">Reset</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Products Section -->
                <div class="col-xl-9">
                    <div class="tf-list-layout wrapper-shop" id="listLayout">

                        @forelse($products as $product)
                        <div class="card-product border rounded-3 shadow-sm p-3 mb-4 hover-shadow bg-white">
                            <div class="row g-4 align-items-center">
                                <!-- Product Image -->
                                <div class="col-md-4 text-center">
                                    <a href="{{ route('product.detail', $product->slug) }}" class="product-img d-block">
                                        <img class="lazyload img-fluid border rounded-3 bg-light p-2"
                                            data-src="{{ $product->image_url ?? 'https://www.placeholderimage.online/placeholder/468/624/f3f4f6/1f2937?font=Lato.svg' }}"
                                            src="{{ $product->image_url ?? 'https://www.placeholderimage.online/placeholder/468/624/f3f4f6/1f2937?font=Lato.svg' }}"
                                            alt="{{ $product->title }}"
                                            style="max-height:220px; object-fit:contain;">
                                    </a>
                                </div>

                                <!-- Product Info -->
                                <div class="col-md-8">
                                    <div class="card-product-info h-100 d-flex flex-column justify-content-between">
                                        <div>
                                            <a href="{{ route('product.detail', $product->slug) }}"
                                                class="title d-block fw-bold text-dark fs-5 mb-2">
                                                {{ $product->title }}
                                            </a>
                                            <p class="description text-muted small mb-3">
                                                {{ Str::limit($product->description, 120) }}
                                            </p>

                                            <!-- Horse Power -->
                                            <!-- @if($product->variants->count())
                                            <div class="hp-options mb-3">
                                                <h6 class="fw-semibold mb-2">Available HP:</h6>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach($product->variants as $variant)
                                                    @php
                                                    $hpValue = $variant->attributeValues
                                                    ->firstWhere('attribute.name', 'kw');
                                                    @endphp
                                                    @if($hpValue)
                                                    <span class="hp-box border px-3 py-2 small rounded bg-light">
                                                        {{ $hpValue->value }}
                                                    </span>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif -->

                                            @if($product->variants->count())
                                            <div class="hp-options mb-3">
                                                @php
                                                $attributesToShow = ['HP', 'kw', 'Pipe Size', 'Bore X stroke (mm)'];
                                                @endphp

                                                @foreach($attributesToShow as $attrName)
                                                @php
                                                // Collect all unique values for this attribute
                                                $values = $product->variants->flatMap(function($variant) use ($attrName) {
                                                return $variant->attributeValues
                                                ->where('attribute.name', $attrName)
                                                ->pluck('value');
                                                })->unique();
                                                @endphp

                                                @if($values->isNotEmpty())
                                                <div class="mb-2">
                                                    <h6 class="fw-semibold mb-2">Available {{ $attrName }}:</h6>
                                                    @foreach($values as $value)
                                                    <span class="hp-box border px-3 py-1 small rounded bg-light">
                                                        {{ $value }}
                                                    </span>
                                                    @endforeach
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                            @endif




                                            <!-- Technical Specifications -->
                                            @if($product->specifications->count())
                                            <div class="technical-spec">
                                                <h6 class="fw-semibold mb-2">Technical Specifications:</h6>
                                                <table class="table table-sm table-striped table-bordered align-middle text-center mb-0">
                                                    <tbody>
                                                        @foreach($product->specifications->take(5) as $spec)
                                                        <tr>
                                                            <td><strong>{{ $spec->name }}</strong></td>
                                                            <td>{{ $spec->value }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Buttons -->
                                        <div class="mt-4 d-flex gap-2">
                                            <a href="{{ route('product.detail', $product->slug) }}"
                                                class="btn btn-outline-secondary flex-fill fw-semibold rounded-pill">
                                                View Details
                                            </a>
                                            <a href="#enquiryForm" data-bs-toggle="modal"
                                                class="btn btn-primary flex-fill fw-semibold rounded-pill">
                                                Send Enquiry
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-muted">No products found.</p>
                        @endforelse

                        <!-- Pagination -->
                        @if ($products->hasPages())
                        <ul class="wg-pagination d-flex justify-content-center list-unstyled gap-2 my-4">
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                            <li class="disabled">
                                <div class="pagination-item text-button"><i class="icon-arrLeft"></i></div>
                            </li>
                            @else
                            <li>
                                <a href="{{ $products->previousPageUrl() }}" class="pagination-item text-button"><i class="icon-arrLeft"></i></a>
                            </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($products->links()->elements[0] ?? [] as $page => $url)
                            @if ($page == $products->currentPage())
                            <li class="active">
                                <div class="pagination-item text-button">{{ $page }}</div>
                            </li>
                            @else
                            <li>
                                <a href="{{ $url }}" class="pagination-item text-button">{{ $page }}</a>
                            </li>
                            @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                            <li>
                                <a href="{{ $products->nextPageUrl() }}" class="pagination-item text-button"><i class="icon-arrRight"></i></a>
                            </li>
                            @else
                            <li class="disabled">
                                <div class="pagination-item text-button"><i class="icon-arrRight"></i></div>
                            </li>
                            @endif
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Section product -->
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('frontend/js/nouislider.min.js')}}"></script>
<script src="{{ asset('frontend/js/shop.js') }}"></script>
@endpush