 @php
$products = [
    [
        'title' => 'Sanctuary of the Shadow',
        'price' => '$9.99',
        'old_price' => null,
        'image' => asset('frontend/images/products/bookstore/product-bookstore-1.jpg'),
        'rating' => 5,
        'reviews' => 1234,
        'discount' => '-25%'
    ],
    [
        'title' => 'The Atlas Six',
        'price' => '$19.99',
        'old_price' => '$24.00',
        'image' => asset('frontend/images/products/bookstore/product-bookstore-2.jpg'),
        'rating' => 5,
        'reviews' => 1234,
        'discount' => '-25%'
    ],
    [
        'title' => 'The Invisible Life of Addie LaRue',
        'price' => '$14.99',
        'old_price' => null,
        'image' => asset('frontend/images/products/bookstore/product-bookstore-3.jpg'),
        'rating' => 4,
        'reviews' => 860,
        'discount' => '-15%'
    ],
    [
        'title' => 'A Court of Thorns and Roses',
        'price' => '$12.99',
        'old_price' => '$18.00',
        'image' => asset('frontend/images/products/bookstore/product-bookstore-4.jpg'),
        'rating' => 5,
        'reviews' => 2560,
        'discount' => '-30%'
    ],
    [
        'title' => 'The Priory of the Orange Tree',
        'price' => '$22.00',
        'old_price' => null,
        'image' => asset('frontend/images/products/bookstore/product-bookstore-5.jpg'),
        'rating' => 5,
        'reviews' => 1890,
        'discount' => null
    ],
     [
        'title' => 'The Priory of the Orange Tree',
        'price' => '$22.00',
        'old_price' => null,
        'image' => asset('frontend/images/products/bookstore/product-bookstore-5.jpg'),
        'rating' => 5,
        'reviews' => 1890,
        'discount' => null
    ],
     [
        'title' => 'The Priory of the Orange Tree',
        'price' => '$22.00',
        'old_price' => null,
        'image' => asset('frontend/images/products/bookstore/product-bookstore-5.jpg'),
        'rating' => 5,
        'reviews' => 1890,
        'discount' => null
    ],
     [
        'title' => 'The Priory of the Orange Tree',
        'price' => '$22.00',
        'old_price' => null,
        'image' => asset('frontend/images/products/bookstore/product-bookstore-5.jpg'),
        'rating' => 5,
        'reviews' => 1890,
        'discount' => null
    ],
];
@endphp

<section class="flat-spacing">
    <div class="container">

    <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">SENBA'S FEATURED PRODUCTS</h3>
                   <p class="subheading text-secondary">Precision Engineering for a Better World.</p>
                </div>
        

        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 border rounded-3 p-2 shadow-sm">
                        <div class="card-product-wrapper" style="height: 300px; overflow:hidden; border-radius:12px;">
                            <a href="product-detail.html" class="product-img d-flex align-items-center justify-content-center w-100 h-100">
                                <img class="mx-auto d-block h-100 object-fit-cover" 
                                     src="https://www.placeholderimage.online/placeholder/350/470/f3f4f6/1f2937?font=Lato.svg" 
                                     alt="{{ $product['title'] }}">
                            </a>
                            @if($product['discount'])
                                <div class="on-sale-wrap"><span class="on-sale-item">{{ $product['discount'] }}</span></div>
                            @endif
                        </div>
                        <!-- Text Below -->
                        <div class="card-body text-center mt-3">
                            <a href="product-detail.html" class="title link d-block mb-1">{{ $product['title'] }}</a>
                            <p class="fw-bold text-dark mb-0">
                                @if($product['old_price'])
                                    <span class="text-decoration-line-through text-secondary me-1">{{ $product['old_price'] }}</span>
                                @endif
                                {{ $product['price'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>