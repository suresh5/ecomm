@extends('frontendtheme.layouts.app')

@section('title', 'Categories')

@section('content')
         
        <!-- page-title -->
        <div class="page-title" style="background-image: url('{{ asset('frontend/images/section/bg-2.png') }}');">

            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">SENBA'S PRODUCT CATEGORIES</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a class="link" href="index.html">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Categories
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       
        <section class="flat-spacing">
            <div class="container">
                <div class="heading-section  text-center align-items-center wow fadeInUp">
            <h3 class="heading mb_12">SENBA'S AQUA SOLUTIONS</h3>
            <p class="subheading text-secondary">Precision Engineering for a Better World.</p>
        </div>
                <div class="wrapper-control-shop">
                    
                    <div class="tf-list-layout wrapper-shop" id="listLayout">
                        <!-- card product list 1 -->
                        
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
                       class="title d-block fw-bold text-dark fs-2 lh-sm mb-2">
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
                         
                         <ul class="wg-pagination d-flex justify-content-center list-unstyled gap-2 my-4">
                                    <li><a href="#" class="pagination-item text-button">1</a></li>
                                    <li class="active"><div class="pagination-item text-button">2</div></li>
                                    <li><a href="#" class="pagination-item text-button">3</a></li>
                                    <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a></li>
                                </ul>
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