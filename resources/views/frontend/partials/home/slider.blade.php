<!-- resources/views/partials/slider.blade.php -->
<div class="tf-slideshow slider-style2 slider-electronic slider-position slider-effect-fade">
    <div dir="ltr" class="swiper tf-sw-slideshow"
         data-effect="fade"
         data-preview="1"
         data-tablet="1"
         data-mobile="1"
         data-centered="false"
         data-space="0"
         data-space-mb="0"
         data-loop="true"
         data-auto-play="true">

        <div class="swiper-wrapper">
            @php
                $slides = [
                    [
                        'image' => 'slider-electronic.jpg',
                        'title' => 'Dji Phantom 3 <br> Professional',
                        'text'  => 'Metallic press stud fastening. Beaded detail. Festival Season.',
                        'url'   => 'shop-default-grid.html'
                    ],
                    [
                        'image' => 'slider-electronic2.jpg',
                        'title' => 'Marshall <br> Woburn White',
                        'text'  => 'Metallic press stud fastening. Beaded detail. Festival Season.',
                        'url'   => 'shop-default-grid.html'
                    ],
                    [
                        'image' => 'slider-electronic3.jpg',
                        'title' => 'Apple MagSafe <br> For Iphone',
                        'text'  => 'Metallic press stud fastening. Beaded detail. Festival Season.',
                        'url'   => 'shop-default-grid.html'
                    ],
                ];
            @endphp

            @foreach($slides as $slide)
                <div class="swiper-slide">
                    <div class="wrap-slider">
                        <img src="{{ asset('frontend/images/slider/' . $slide['image']) }}" alt="slideshow">
                        <div class="box-content">
                            <div class="container">
                                <div class="content-slider">
                                    <div class="box-title-slider">
                                        <div>
                                            <p class="fade-item fade-item-1 subtitle text-btn-uppercase text-primary">SALE! UP TO 50% OFF!</p>
                                            <div class="fade-item fade-item-2 title-display heading">{!! $slide['title'] !!}</div>
                                        </div>
                                        <p class="fade-item fade-item-3 body-text-1 subheading">{{ $slide['text'] }}</p>
                                    </div>
                                    <div class="fade-item fade-item-4 box-btn-slider">
                                        <a href="{{ url($slide['url']) }}" class="tf-btn btn-fill">
                                            <span class="text">Shop Now</span>
                                            <i class="icon icon-arrowUpRight"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="wrap-pagination d-block">
        <div class="container">
            <div class="sw-dots sw-pagination-slider type-square justify-content-center"></div>
        </div>
    </div>
</div>
