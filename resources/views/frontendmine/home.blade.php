@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

    {{-- Slider Section --}}
    @include('frontend.partials.home.slider')

    {{-- Categories Section --}}
    @include('frontend.partials.home.categories')

    {{-- Categories Section --}}
    @include('frontend.partials.home.domain_categories')


    {{-- Featured Products Section --}}
    @include('frontend.partials.home.product_designs')


     {{-- Featured Products Section --}}
    @include('frontend.partials.home.feature_products')

    
     {{-- Featured Products Section --}}
    @include('frontend.partials.common.aboutus')

     {{-- Featured Products Section --}}
    @include('frontend.partials.common.certifications')
    {{-- Featured Products Section --}}
    @include('frontend.partials.common.testimonials')

     {{-- Featured Products Section --}}
    @include('frontend.partials.common.shop_benefits')
@endsection


 
@push('styles')
<style>
    .carousel-control-prev,
    .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.9); /* white background for visibility */
        border-radius: 50%;
        z-index: 1050; /* Ensure above all */
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 5px rgba(0,0,0,0.3);
    }

    .carousel-control-prev {
        left: -50px;
    }

    .carousel-control-next {
        right: -50px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-image: none; /* Remove default Bootstrap icon */
        width: 20px;
        height: 20px;
        border: solid black;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 4px;
    }

    .carousel-control-prev-icon {
        transform: rotate(135deg);
    }

    .carousel-control-next-icon {
        transform: rotate(-45deg);
    }

    @media (max-width: 767px) {
        .carousel-control-prev {
            left: -20px;
        }

        .carousel-control-next {
            right: -20px;
        }
    }
</style>
@endpush