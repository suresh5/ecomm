@extends('frontend.layouts.master')
@section('title','E-SHOP || PRODUCTS')
@section('main-content')
<div class="container my-5">
    <div class="row">
        <!-- Left Sidebar Filters -->
        <div class="col-md-3">
              @include('frontend.partials.products_filter', ['categories' => $categories, 'attributes'=> $attributes])
        </div>

        <!-- Right Products Section -->
        <div class="col-md-9">
            @include('frontend.partials.products_paginate', ['products' => $products])
         
        </div>
    </div>
</div>
@endsection
