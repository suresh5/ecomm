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
                            <li>
                                <a class="link" href="index.html">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Products
                            </li>
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
                        <div class="col-xl-3">
                            <div class="sidebar-filter canvas-filter left">
                                <div class="canvas-wrapper">
                                    <div class="canvas-header d-flex d-xl-none">
                                        <h5>Filters</h5>
                                        <span class="icon-close close-filter"></span>
                                    </div>
                                    <div class="canvas-body">
                                       <div class="widget-facet facet-categories">
    <h6 class="facet-title">Product Categories</h6>
    <ul class="facet-content">
        @foreach($parentCategories as $category)
            <li>
                <a href="{{ route('category.products', $category->slug) }}" 
                   class="categories-item {{ request()->is('category/'.$category->slug) ? 'active' : '' }}">
                    {{ $category->title }}
                    <span class="count-cate">({{ $category->products_count ?? 0 }})</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
                                         
                                       
                                       
                                        
                                        <div class="widget-facet facet-fieldset">
    @foreach($attributes as $attribute)
        <h6 class="facet-title mt-3">{{ $attribute->name }}</h6>
        <div class="box-fieldset-item">
            @foreach($attribute->values as $value)
                <fieldset class="fieldset-item mt-2">
                    <input type="checkbox" 
                           name="attributes[{{ $attribute->id }}][]" 
                           class="tf-check attribute-checkbox" 
                           id="attr{{ $value->id }}" 
                           value="{{ $value->id }}">
                    <label for="attr{{ $value->id }}">
                        {{ $value->value }}
                        
                    </label>
                </fieldset>
            @endforeach
        </div>
    @endforeach
</div>


                                    </div>
                                    <div class="canvas-bottom d-block d-xl-none">
                                        <button id="reset-filter" class="tf-btn btn-reset">Reset Filters</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            <div class="tf-list-layout wrapper-shop" id="listLayout">
                             <!--- -->

<div class="card-product border rounded-3 shadow-sm p-3 mb-4 hover-shadow bg-white">
    <div class="row g-4 align-items-center">
        
        <!-- Product Image -->
        <div class="col-md-4 text-center">
            <a href="product-detail.html" class="product-img d-block">
                <img class="lazyload img-fluid border rounded-3 bg-light p-2" 
                     data-src="https://www.placeholderimage.online/placeholder/468/624/f3f4f6/1f2937?font=Lato.svg" 
                     src="https://www.placeholderimage.online/placeholder/468/624/f3f4f6/1f2937?font=Lato.svg" 
                     alt="Pump / Motor"
                     style="max-height:220px; object-fit:contain;">
            </a>
        </div>

        <!-- Product Info -->
        <div class="col-md-8">
            <div class="card-product-info h-100 d-flex flex-column justify-content-between">
                
                <!-- Title + Price -->
                <div>
                    <a href="product-detail.html" 
                       class="title d-block fw-bold text-dark fs-5 mb-2">
                        High Performance Water Pump
                    </a>
                    
                     

                    <p class="description text-muted small mb-3">
                        Durable and energy-efficient motor pump suitable for domestic and industrial use.
                    </p>

                    <!-- Horse Power Options -->
                    <div class="hp-options mb-3">
                        <h6 class="fw-semibold mb-2">Available HP:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="hp-box border px-3 py-2 small rounded bg-light">0.5 HP</span>
                            <span class="hp-box border px-3 py-2 small rounded bg-light">1 HP</span>
                            <span class="hp-box border px-3 py-2 small rounded bg-light">1.5 HP</span>
                            <span class="hp-box border px-3 py-2 small rounded bg-light">2 HP</span>
                            <span class="hp-box border px-3 py-2 small rounded bg-light">3 HP</span>
                        </div>
                    </div>

                    <!-- Technical Specification -->
                    <div class="technical-spec">
                        <h6 class="fw-semibold mb-2">Technical Specifications:</h6>
                        <table class="table table-sm table-striped table-bordered align-middle text-center mb-0">
                            <tbody>
                                <tr>
                                    <td><strong>Power</strong></td>
                                    <td>1 HP</td>
                                </tr>
                                <tr>
                                    <td><strong>Voltage</strong></td>
                                    <td>220V</td>
                                </tr>
                                <tr>
                                    <td><strong>Flow Rate</strong></td>
                                    <td>60 L/min</td>
                                </tr>
                                <tr>
                                    <td><strong>Head</strong></td>
                                    <td>25 m</td>
                                </tr>
                                <tr>
                                    <td><strong>Warranty</strong></td>
                                    <td>1 Year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-4 d-flex gap-2">
                    <a href="product-detail.html" 
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


                               
<!-- -->
                                <!-- pagination -->
                                <ul class="wg-pagination d-flex justify-content-center list-unstyled gap-2 my-4">
                                    <li><a href="#" class="pagination-item text-button">1</a></li>
                                    <li class="active"><div class="pagination-item text-button">2</div></li>
                                    <li><a href="#" class="pagination-item text-button">3</a></li>
                                    <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a></li>
                                </ul>
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