<!-- resources/views/partials/categories.blade.php -->


  <!-- collection -->
        <section class="flat-spacing-2">
            <div class="container">
                 <div class="heading-section  text-center align-items-center wow fadeInUp">
            <h3 class="heading mb_12">SENBA'S AQUA SOLUTIONS</h3>
            <p class="subheading text-secondary">Precision Engineering for a Better World.</p>
        </div>
                <div class="flat-collection-circle wow fadeInUp" data-wow-delay="0.1s">
                    <div dir="ltr" class="swiper tf-sw-collection" data-preview="5" data-tablet="3" data-mobile="2" data-space-lg="20" data-space-md="20" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                        <div class="swiper-wrapper">
                            <!-- item 1 -->
                             @foreach($parentCategories as $category)
                            <div class="swiper-slide">
                                <div class="collection-circle hover-img">
                                    <a href="shop-collection.html" class="img-style radius-12">
                                        <img class="lazyload" data-src="https://www.placeholderimage.online/placeholder/468/624/f3f4f6/1f2937?font=Lato.svg" alt="collection-img">
                                    </a>
                                    <div class="collection-content text-center">
                                        <div>
                                            <a href="shop-collection.html" class="cls-title">
                                                <h6 class="text">{{$category->title}}</h6>
                                                <i class="icon icon-arrowUpRight"></i>    
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           
                        </div>
                        <div class="d-flex d-lg-none sw-pagination-collection sw-dots type-circle justify-content-center"></div>
                    </div>
                    <div class="nav-prev-collection d-none d-lg-flex nav-sw style-line nav-sw-left"><i class="icon icon-arrLeft"></i></div>
                    <div class="nav-next-collection d-none d-lg-flex nav-sw style-line nav-sw-right"><i class="icon icon-arrRight"></i></div>
                </div>
            </div>
        </section>
        <!-- /collection -->

























