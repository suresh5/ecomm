<section class="flat-spacing">
    <div class="container position-relative">
           <div class="heading-section text-center wow fadeInUp">
            <h3>Our Products</h3>
        </div>
        <div id="certificationCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php
                    $certifications = [
                        asset('frontend/images/products/bookstore/product-bookstore-1.jpg'),
                        asset('frontend/images/products/bookstore/product-bookstore-2.jpg'),
                        asset('frontend/images/products/bookstore/product-bookstore-3.jpg'),
                        asset('frontend/images/products/bookstore/product-bookstore-4.jpg'),
                        asset('frontend/images/products/bookstore/product-bookstore-5.jpg'),
                        asset('frontend/images/products/bookstore/product-bookstore-6.jpg'),
                        asset('frontend/images/products/bookstore/product-bookstore-1.jpg'),
                        asset('frontend/images/products/bookstore/product-bookstore-2.jpg')
                    ];
                    $chunks = array_chunk($certifications, 4);
                @endphp

                @foreach ($chunks as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row gx-3">
                            @foreach ($chunk as $cert)
                                <div class="col-md-3">
                                    <div class="card border-0">
                                        <img src="{{ $cert }}" class="img-fluid" alt="Certification">
                                        <div class="mt-2 fw-semibold text-center">Motor Pumps Compressor</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Arrows positioned outside the row -->
            <button class="carousel-control-prev" type="button" data-bs-target="#certificationCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#certificationCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>



