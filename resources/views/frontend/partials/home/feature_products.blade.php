<!-- Most-viewed Products -->
<section class="flat-spacing">
    <div class="container">
        <div class="heading-section-2 wow fadeInUp">
            <h4>Most-viewed Products</h4>
            <a href="{{ url('shop-default-grid') }}" class="line-under">See All Products</a>
        </div>
        <div dir="ltr" class="swiper tf-sw-products"
             data-preview="6" data-tablet="4" data-mobile="2"
             data-space-lg="30" data-space-md="30" data-space="15"
             data-pagination="1" data-pagination-md="1" data-pagination-lg="1">

            <div class="swiper-wrapper">
                @php
                    $mostViewedProducts = [
                        [
                            'delay' => '0s',
                            'title' => 'Kodak Pixpro Fz45-bk 45mm',
                            'img1' => 'electronic-11.jpg',
                            'img2' => 'electronic-12.jpg',
                        ],
                        [
                            'delay' => '0.1s',
                            'title' => 'PlayStation DualSense Wireless Controller',
                            'img1' => 'electronic-1.jpg',
                            'img2' => 'electronic-2.jpg',
                            'sale' => '-25%',
                        ],
                        [
                            'delay' => '0.2s',
                            'title' => 'Apple iPhone 14 Plus, Gold/Blue 128GB',
                            'img1' => 'electronic-13.jpg',
                            'img2' => 'electronic-14.jpg',
                        ],
                        [
                            'delay' => '0.3s',
                            'title' => 'LG AI DD™ Inverter 16kg automatic F2721HVRB',
                            'img1' => 'electronic-15.jpg',
                            'img2' => 'electronic-16.jpg',
                        ],
                        [
                            'delay' => '0.4s',
                            'title' => 'Instant Pot Vortex Plus XL 8-quart Dual',
                            'img1' => 'electronic-19.jpg',
                            'img2' => 'electronic-20.jpg',
                        ],
                         [
            'delay' => '0.5s',
            'title' => 'Samsung Galaxy Tab S9 Ultra – Graphite',
            'img1' => 'electronic-9.jpg',
            'img2' => 'electronic-10.jpg',
        ],
                    ];
                @endphp

                @foreach ($mostViewedProducts as $product)
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="{{ $product['delay'] }}">
                            <div class="card-product-wrapper">
                                <a href="{{ url('product-detail') }}" class="product-img">
                                    <img class="lazyload img-product"
                                         data-src="{{ asset('frontend/images/products/electronic/' . $product['img1']) }}"
                                         src="{{ asset('frontend/images/products/electronic/' . $product['img1']) }}"
                                         alt="image-product">
                                    <img class="lazyload img-hover"
                                         data-src="{{ asset('frontend/images/products/electronic/' . $product['img2']) }}"
                                         src="{{ asset('frontend/images/products/electronic/' . $product['img2']) }}"
                                         alt="image-product">
                                </a>

                               
                                 
                                
                            </div>

                            <div class="card-product-info">
                                <a href="{{ url('product-detail') }}" class="title link">{{ $product['title'] }}</a>
                                 
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="sw-pagination-products sw-dots type-circle justify-content-center"></div>
        </div>
    </div>
</section>
<!-- /Most-viewed Products -->
