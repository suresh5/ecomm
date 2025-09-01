@php
$testimonials = [
    [
        'name' => 'Sybil Sharp',
        'message' => 'Stylish and high-quality glass vase. Its elegant design and premium finish make it a perfect choice for any flower display. Highly recommended!',
        'testimonial_image' => 'frontend/images/testimonial/tes-5.jpg',
        'product_image' => 'frontend/images/products/furniture/furniture34.jpg',
        'product_name' => 'Classic Grace Premium Glass',
        'price' => '$60.00'
    ],
    [
        'name' => 'Mark G.',
        'message' => 'Stylish and high-quality glass vase. Its elegant design and premium finish make it a perfect choice for any flower display. Highly recommended!',
        'testimonial_image' => 'frontend/images/testimonial/tes-6.jpg',
        'product_image' => 'frontend/images/products/furniture/furniture37.jpg',
        'product_name' => 'Serene Garden Premium Porcelain',
        'price' => '$60.00'
    ],
    [
        'name' => 'Sybil Sharp',
        'message' => 'Stylish and high-quality glass vase. Its elegant design and premium finish make it a perfect choice for any flower display. Highly recommended!',
        'testimonial_image' => 'frontend/images/testimonial/tes-5.jpg',
        'product_image' => 'frontend/images/products/furniture/furniture34.jpg',
        'product_name' => 'Classic Grace Premium Glass',
        'price' => '$60.00'
    ]
];
@endphp
<section class="flat-spacing">
    <div class="container">
        <div class="heading-section text-center wow fadeInUp">
            <h3 class="heading">Customer Say!</h3>
            <p class="subheading">Our customers adore our products, and we constantly aim to delight them.</p>
        </div>

        <div dir="ltr" class="swiper tf-sw-testimonial wow fadeInUp" data-wow-delay="0.1s" data-preview="2" data-tablet="1.3" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $item)
                    <div class="swiper-slide">
                        <div class="testimonial-item hover-img">
                            <div class="img-style">
                                <img data-src="{{ asset($item['testimonial_image']) }}" src="{{ asset($item['testimonial_image']) }}" alt="img-testimonial">
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip center">
                                    <span class="icon icon-eye"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                            <div class="content">
                                <div class="content-top">
                                    <div class="list-star-default">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="icon icon-star"></i>
                                        @endfor
                                    </div>
                                    <p class="text-secondary">"{{ $item['message'] }}"</p>
                                    <div class="box-author">
                                        <div class="text-title author">{{ $item['name'] }}</div>
                                        <svg class="icon" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0)">
                                                <path d="M6.875 11.6255L8.75 13.5005L13.125 9.12549" stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M10 18.5005C14.1421 18.5005 17.5 15.1426 17.5 11.0005C17.5 6.85835 14.1421 3.50049 10 3.50049C5.85786 3.50049 2.5 6.85835 2.5 11.0005C2.5 15.1426 5.85786 18.5005 10 18.5005Z" stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0">
                                                    <rect width="20" height="20" fill="white" transform="translate(0 0.684082)"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="box-avt">
                                    <div class="avatar avt-60 round">
                                        <img src="{{ asset($item['product_image']) }}" alt="avt">
                                    </div>
                                    <div class="box-price">
                                        <p class="text-title text-line-clamp-1">{{ $item['product_name'] }}</p>
                                        <div class="text-button price">{{ $item['price'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center"></div>
        </div>
    </div>
</section>
