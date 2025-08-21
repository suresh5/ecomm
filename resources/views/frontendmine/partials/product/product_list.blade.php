@php
    $products = [
        [
            'title' => 'AMB - Mini Booster Pump',
            'price_old' => '$98.00',
            'price' => '$219.99',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'The garments labelled as Committed are products that have been produced using sustainable fibres or processes, reducing their environmental impact.',
            'colors' => [
                ['label' => 'Green', 'color' => 'bg-light-green', 'img' => 'frontend/images/products/motor.jpg'],
                ['label' => 'Grey', 'color' => 'bg-grey-2', 'img' => 'frontend/images/products/motor.jpg'],
                ['label' => 'White', 'color' => 'bg-white', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['S', 'M', 'L', 'XL', 'XXL']
        ],
        [
            'title' => 'Hooded Puffer Jacket',
            'price_old' => '$120.00',
            'price' => '$85.00',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Stylish puffer jacket perfect for winter. Water-resistant and ethically made.',
            'colors' => [
                ['label' => 'Black', 'color' => 'bg-black', 'img' => 'frontend/images/products/motor.jpg'],
                ['label' => 'Navy', 'color' => 'bg-dark-blue', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['S', 'M', 'L', 'XL']
        ],
        [
            'title' => 'Slim Fit Jeans',
            'price_old' => '$75.00',
            'price' => '$65.00',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Comfortable and stretchy jeans for everyday wear. Sustainably sourced materials.',
            'colors' => [
                ['label' => 'Blue', 'color' => 'bg-blue', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['XS', 'S', 'M', 'L', 'XL']
        ],
        [
            'title' => 'Knit Sweater',
            'price_old' => '$50.00',
            'price' => '$39.99',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Soft knit sweater made from recycled yarns. Ideal for layering.',
            'colors' => [
                ['label' => 'Beige', 'color' => 'bg-light-brown', 'img' => 'frontend/images/products/motor.jpg'],
                ['label' => 'Pink', 'color' => 'bg-pink', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['S', 'M', 'L']
        ],
        [
            'title' => 'Linen Shirt Dress',
            'price_old' => '$110.00',
            'price' => '$95.00',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Breathable linen dress with tie waist and side pockets.',
            'colors' => [
                ['label' => 'Olive', 'color' => 'bg-olive', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['S', 'M', 'L', 'XL']
        ],
        [
            'title' => 'Belted Blazer',
            'price_old' => '$150.00',
            'price' => '$119.99',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Tailored blazer with waist belt. Perfect for workwear.',
            'colors' => [
                ['label' => 'Camel', 'color' => 'bg-light-brown', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['S', 'M', 'L', 'XL']
        ],
        [
            'title' => 'Casual Cotton Tee',
            'price_old' => '$25.00',
            'price' => '$18.00',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Basic cotton t-shirt made from 100% organic cotton.',
            'colors' => [
                ['label' => 'White', 'color' => 'bg-white', 'img' => 'frontend/images/products/motor.jpg'],
                ['label' => 'Grey', 'color' => 'bg-grey-2', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['XS', 'S', 'M', 'L']
        ],
        [
            'title' => 'High Waist Skirt',
            'price_old' => '$60.00',
            'price' => '$45.00',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Flowy skirt with a high-rise waistband and floral print.',
            'colors' => [
                ['label' => 'Red', 'color' => 'bg-red', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['S', 'M', 'L']
        ],
        [
            'title' => 'Wrap Dress',
            'price_old' => '$89.00',
            'price' => '$69.99',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Elegant wrap dress with v-neckline and flared hem.',
            'colors' => [
                ['label' => 'Blue', 'color' => 'bg-blue', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['S', 'M', 'L', 'XL']
        ],
        [
            'title' => 'Fleece Joggers',
            'price_old' => '$55.00',
            'price' => '$40.00',
            'img1' => 'frontend/images/products/motor.jpg',
            'img2' => 'frontend/images/products/motor.jpg',
            'description' => 'Soft fleece joggers with elastic waistband and pockets.',
            'colors' => [
                ['label' => 'Grey', 'color' => 'bg-grey-2', 'img' => 'frontend/images/products/motor.jpg']
            ],
            'sizes' => ['S', 'M', 'L', 'XL']
        ]
    ];
@endphp

<div class="tf-list-layout wrapper-shop" id="listLayout">
    @foreach($products as $product)
        <div class="card-product style-list">
            <div class="card-product-wrapper">
                <a href="#" class="product-img">
                    <img class="lazyload img-product" data-src="{{ asset($product['img1']) }}" src="{{ asset($product['img1']) }}" alt="image-product">
                    <img class="lazyload img-hover" data-src="{{ asset($product['img2']) }}" src="{{ asset($product['img2']) }}" alt="image-product">
                </a>
            </div>
            <div class="card-product-info">
                <a href="#" class="title link">{{ $product['title'] }}</a>
                <div class="price">
                    <span class="old-price">{{ $product['price_old'] }}</span>
                    <span class="current-price">{{ $product['price'] }}</span>
                </div>
                <p class="description text-secondary text-line-clamp-2">{{ $product['description'] }}</p>
                <div class="variant-wrap-list">
                    <ul class="list-color-product">
                        @foreach($product['colors'] as $index => $color)
                            <li class="list-color-item color-swatch {{ $index === 0 ? 'active line' : '' }}">
                                <span class="d-none text-capitalize color-filter">{{ $color['label'] }}</span>
                                <span class="swatch-value {{ $color['color'] }}"></span>
                                <img class="lazyload" data-src="{{ asset($color['img']) }}" src="{{ asset($color['img']) }}" alt="image-product">
                            </li>
                        @endforeach
                    </ul>
                    <div class="size-box list-product-btn">
                        @foreach($product['sizes'] as $size)
                            <span class="size-item box-icon {{ $size == 'L' ? 'active' : '' }} {{ $size == 'XXL' ? 'disable' : '' }}">{{ $size }}</span>
                        @endforeach
                    </div>
                    <div class="list-product-btn">
                        <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                        <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                            <span class="icon icon-heart"></span>
                            <span class="tooltip">Wishlist</span>
                        </a>
                        <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare" class="box-icon compare btn-icon-action">
                            <span class="icon icon-gitDiff"></span>
                            <span class="tooltip">Compare</span>
                        </a>
                        <a href="#quickView" data-bs-toggle="modal" class="box-icon quickview tf-btn-loading">
                            <span class="icon icon-eye"></span>
                            <span class="tooltip">Quick View</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <ul class="wg-pagination">
        <li><a href="#" class="pagination-item text-button">1</a></li>
        <li class="active"><div class="pagination-item text-button">2</div></li>
        <li><a href="#" class="pagination-item text-button">3</a></li>
        <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a></li>
    </ul>
</div>
