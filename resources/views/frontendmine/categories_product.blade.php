@extends('frontend.layouts.app')

@section('title', 'Categories')

@section('content')
        <!-- page-title -->
        <div class="page-title" style="background-image: url('{{ asset('frontend/images/section/page-title.jpg') }}');">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Pumps</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a class="link" href="index.html">Homepage</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Pumps
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /page-title -->

         <section class="flat-spacing">
            <div class="container">
                <div class="tf-shop-control">
                    <div class="tf-control-filter">
                        <button id="filterShop" class="filterShop tf-btn-filter">
                            <span class="icon icon-filter"></span><span class="text">Filters</span></button>
                        
                    </div>
                    <ul class="tf-control-layout">
                       
                    </ul>
                    
                </div>
                 <!-- <div class="d-flex justify-content-center gap-4 mb-4">
            <button class="btn btn-primary">Agriculture</button>
            <button class="btn btn-secondary">Building Services</button>
            <button class="btn btn-success">Waste Water Solutions</button>
            <button class="btn btn-success">Solar Pumps</button>
            <button class="btn btn-success">Domestic Pumps</button>
        </div> -->
         
                <div class="wrapper-control-shop">
                    <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text"></div>
                        <div id="product-count-list" class="count-text"></div>
                        <div id="applied-filters"></div>
                        <button id="remove-all" class="remove-all-filters text-btn-uppercase" style="display: none;">REMOVE ALL <i class="icon icon-close"></i></button>
                    </div>
                      <div class="row">
                        <div class="col-xl-3">
                            @include('frontend.partials.categories.category_only_filter')
                        </div>
                        <div class="col-xl-9">

                             @include('frontend.partials.categories.product_list')
                        </div>
                </div>
            </div>
        </section>
@endsection
@push('scripts')
  <script src="{{ asset('frontend/js/shop.js') }}"></script>
@endpush