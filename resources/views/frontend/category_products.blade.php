@extends('frontend.layouts.master')
@section('title','E-SHOP || CATEGORY LISTING PAGE')
@section('main-content')

<!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
            </li>

            @if($category->parent)
                <li class="breadcrumb-item">
                    <a href="{{ route('category.products', $category->parent->slug) }}">
                        {{ $category->parent->title }}
                    </a>
                </li>
            @endif

            <li class="breadcrumb-item active fw-bold" aria-current="page">
                {{ $category->title }}
            </li>
        </ol>
    </nav>

    <!-- Main Title -->
    <h2 class="fw-bold text-center mb-5 text-dark">
        {{ $category->title }}
    </h2>


@include('frontend.partials.productlists')






@endsection

@push('styles')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    
@endpush

