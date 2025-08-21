<!-- resources/views/partials/categories.blade.php -->
<section class="flat-spacing">
    <div class="container">
        <div class="heading-section text-center wow fadeInUp">
            <h3 class="heading">Popular Categories</h3>
        </div>
        <div class="flat-collection-circle wow fadeInUp" data-wow-delay="0.1s">
            <div dir="ltr" class="swiper tf-sw-categories"
                 data-preview="7"
                 data-tablet="4"
                 data-mobile-sm="3"
                 data-mobile="2"
                 data-space-lg="30"
                 data-space-md="20"
                 data-space="15"
                 data-pagination="2"
                 data-pagination-md="4"
                 data-pagination-lg="1">

                <div class="swiper-wrapper">
                    @php
                        $categories = [
                            ['title' => 'Electronics', 'image' => 'cls-electronic1.jpg'],
                            ['title' => 'Appliances', 'image' => 'cls-electronic2.jpg'],
                            ['title' => 'Kitchen',     'image' => 'cls-electronic3.jpg'],
                            ['title' => 'Audio',       'image' => 'cls-electronic4.jpg'],
                            ['title' => 'Smart Home',  'image' => 'cls-electronic5.jpg'],
                            ['title' => 'Game',        'image' => 'cls-electronic6.jpg'],
                            ['title' => 'Office',      'image' => 'cls-electronic7.jpg'],
                            ['title' => 'Electronics', 'image' => 'cls-electronic1.jpg']
                        ];
                    @endphp

                    @foreach($categories as $category)
                        <div class="swiper-slide">
                            <div class="collection-circle hover-img">
                                <a href="{{ url('/shop-categories-top') }}" class="img-style">
                                    <img class="lazyload"
                                         data-src="{{ asset('frontend/images/collections/collection-circle/' . $category['image']) }}"
                                         src="{{ asset('frontend/images/collections/collection-circle/' . $category['image']) }}"
                                         alt="collection-img">
                                </a>
                                <div class="collection-content text-center">
                                    <div>
                                        <a href="{{ url('/shop-categories-top') }}" class="cls-title">
                                            <h6 class="text">{{ $category['title'] }}</h6>
                                            <i class="icon icon-arrowUpRight"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex d-lg-none sw-pagination-categories sw-dots type-circle justify-content-center"></div>
            </div>
            <div class="nav-prev-categories d-none d-lg-flex nav-sw style-line nav-sw-left">
                <i class="icon icon-arrLeft"></i>
            </div>
            <div class="nav-next-categories d-none d-lg-flex nav-sw style-line nav-sw-right">
                <i class="icon icon-arrRight"></i>
            </div>
        </div>
    </div>
</section>
