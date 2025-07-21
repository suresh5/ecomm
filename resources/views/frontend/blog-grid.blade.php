@extends('frontend.layout.common')
@section('content')
  <!-- tf-add-cart-success -->
        <div class="tf-add-cart-success">
            <div class="tf-add-cart-heading">
                <h5>Shopping Cart</h5>
                <i class="icon icon-close tf-add-cart-close"></i>
            </div>
            <div class="tf-add-cart-product">
                <div class="image">
                    <img class=" ls-is-cached lazyloaded" data-src="images/products/womens/women-3.jpg" alt="" src="images/products/womens/women-3.jpg">
                </div>
                <div class="content">
                    <div class="text-title">
                        <a class="link" href="product-detail.html">Biker-style leggings</a>
                    </div>
                    <div class="text-caption-1 text-secondary-2">Green, XS, Cotton</div>
                    <div class="text-title">$68.00</div>
                </div>
            </div>
            <a href="shopping-cart.html" class="tf-btn w-100 btn-fill radius-4"><span class="text text-btn-uppercase">View cart</span></a>
        </div>
        <!-- /tf-add-cart-success -->
     
        <!-- page-title -->
        <div class="page-title" style="background-image: url(images/section/page-title.jpg);">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Blog Grid</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a class="link" href="index.html">Homepage</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                <a class="link" href="#">Blog</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Blog Grid
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->

        <!-- blog-grid -->
        <div class="main-content-page">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tf-grid-layout md-col-3">
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-1.jpg" src="images/blog/blog-grid-1.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">How Technology is Transforming the Industry</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-2.jpg" src="images/blog/blog-grid-2.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">The Future of Fashion How Technology Transforms the Industry</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-3.jpg" src="images/blog/blog-grid-3.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">From Concept to Closet The Journey of Sustainable Fashion</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-4.jpg" src="images/blog/blog-grid-4.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">Unlocking Style Potential Personalization in Fashion Retail</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-5.jpg" src="images/blog/blog-grid-5.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">Fashion Forward Embracing Diversity and Inclusion in Design</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-6.jpg" src="images/blog/blog-grid-6.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">The Ultimate Guide: Dressing Stylishly with Minimal Effort</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-7.jpg" src="images/blog/blog-grid-7.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">How to Transition Your Wardrobe from Day to Night</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-8.jpg" src="images/blog/blog-grid-8.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">How to Incorporate Classic Pieces into Modern Outfits</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="images/blog/blog-grid-9.jpg" src="images/blog/blog-grid-9.jpg" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">How to Wear the Latest Fashion Trends Every Day</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                            <ul class="wg-pagination justify-content-center">
                                <li><a href="#" class="pagination-item text-button">1</a></li>
                                <li class="active"><div class="pagination-item text-button">2</div></li>
                                <li><a href="#" class="pagination-item text-button">3</a></li>
                                <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /blog-grid -->
        
@endsection