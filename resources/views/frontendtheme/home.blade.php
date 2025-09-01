@extends('frontendtheme.layouts.app')

@section('title', 'Home')

@section('content')
{{-- Slider Section --}}
    @include('frontendtheme.partials.home.slider')
    @include('frontendtheme.partials.home.categories', ['parentcategories' => $parentCategories])
 @include('frontendtheme.partials.home.domain_categories')

 @include('frontendtheme.partials.home.feature_products')


@include('frontendtheme.partials.home.home_about')
@include('frontendtheme.partials.home.shop_highlights')




@include('frontendtheme.partials.common.certifications')
@include('frontendtheme.partials.common.testimonials')
 @include('frontendtheme.partials.common.shop_benefits')
@endsection


 
@push('styles')
 
@endpush