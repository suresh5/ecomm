@extends('frontendtheme.layouts.app')

@section('title', $category->name ?? 'Categories')

@section('content')

<!-- page-title -->
<div class="page-title" style="background-image: url('{{ asset('frontend/images/section/bg-2.png') }}');">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">{{ $category->name ?? "SENBA'S PRODUCT CATEGORIES" }}</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>{{ $category->name ?? 'Categories' }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="flat-spacing">
    <div class="container">
        <div class="heading-section text-center align-items-center wow fadeInUp">
            <h3 class="heading mb_12">SENBA'S AQUA SOLUTIONS</h3>
            <p class="subheading text-secondary">Precision Engineering for a Better World.</p>
        </div>

        <div class="wrapper-control-shop">
            <div class="tf-list-layout wrapper-shop" id="listLayout">

                @forelse($product_lists as $product)
                <div class="card-product border rounded-3 shadow-sm p-3 mb-4 hover-shadow bg-white">

                
                    <div class="row g-4 align-items-center">
                        <!-- Product Image -->
                        <div class="col-md-4 text-center">
                            <a href="{{ route('product.detail', $product->slug) }}" class="product-img d-block">
                                <img class="lazyload img-fluid border rounded-3 bg-light p-2"
                                    data-src="{{ $product->image_url ?? 'https://www.placeholderimage.online/placeholder/468/624/f3f4f6/1f2937?font=Lato.svg' }}"
                                    src="{{ $product->image_url ?? 'https://www.placeholderimage.online/placeholder/468/624/f3f4f6/1f2937?font=Lato.svg' }}"
                                    alt="{{ $product->title ?? 'Product' }}"
                                    style="max-height:220px; object-fit:contain;">
                            </a>
                        </div>

                        <!-- Product Info -->
                        <div class="col-md-8">
                            <div class="card-product-info h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <a href="{{ route('product.detail', $product->slug) }}"
                                        class="title d-block fw-bold text-dark fs-2 lh-sm mb-2">
                                        {{ $product->title }}
                                    </a>

                                    <p class="description text-muted small mb-3">
                                        {{ $product->short_description ?? 'High-quality product for your needs.' }}
                                    </p>

                                    <!-- Variants (HP, KW, Pipe Size, Bore X Stroke) -->
                                    @if($product->variants->count())
                                    <div class="hp-options mb-3">
                                        <h6 class="fw-semibold mb-2">Available Options:</h6>
                                        <div class="d-flex flex-wrap gap-2">
                                            @php
                                            $attributesToShow = ['HP', 'KW', 'Pipe Size', 'Bore X stroke (mm)'];
                                            @endphp

                                            @foreach($attributesToShow as $attrName)
                                            @php
                                            $values = $product->variants->flatMap(function($variant) use ($attrName) {
                                            return $variant->attributeValues
                                            ->where('attribute.name', $attrName)
                                            ->pluck('value');
                                            })->unique()->filter(function($val) {
                                            return !empty($val) && $val != 0;
                                            });
                                            @endphp

                                            @foreach($values as $value)
                                            <span class="hp-box border px-3 py-2 small rounded bg-light">
                                                {{ $attrName }}: {{ $value }}
                                            </span>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif


                                    <!-- Technical Specification -->
                                    @if($product->specifications->count())
                                    @php
                                    $technicalSpecs = $product->specifications->where('label', 'TECHNICAL SPECIFICATIONS');
                                    @endphp

                                    @if($technicalSpecs->count())
                                    <div class="technical-spec">
                                        <h6 class="fw-semibold mb-2">Technical Specifications:</h6>
                                        <table class="table table-sm table-striped table-bordered align-middle text-center mb-0">
                                            <tbody>
                                                @foreach($technicalSpecs as $spec)
                                                <tr>
                                                    <td><strong>{{ $spec->name }}</strong></td>
                                                    <td>{{ $spec->value }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                    @endif


                                </div>

                                <!-- Actions -->
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
                <div class="text-center py-5">
                    <h5>No products available in this category.</h5>
                </div>
                @endforelse

                <!-- Pagination -->
                @if ($product_lists->hasPages())
                <ul class="wg-pagination d-flex justify-content-center list-unstyled gap-2 my-4">
                    {{-- Previous Page Link --}}
                    @if ($product_lists->onFirstPage())
                    <li class="disabled">
                        <div class="pagination-item text-button"><i class="icon-arrLeft"></i></div>
                    </li>
                    @else
                    <li>
                        <a href="{{ $product_lists->previousPageUrl() }}" class="pagination-item text-button"><i class="icon-arrLeft"></i></a>
                    </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($product_lists->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $product_lists->currentPage())
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
                    @if ($product_lists->hasMorePages())
                    <li>
                        <a href="{{ $product_lists->nextPageUrl() }}" class="pagination-item text-button"><i class="icon-arrRight"></i></a>
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
</section>

@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('frontend/js/nouislider.min.js')}}"></script>
<script src="{{ asset('frontend/js/shop.js') }}"></script>
@endpush