 <header id="header" class="header-default header-style-5 header-white">
            <div class="main-header bg-purple">
                <div class="container">
                    <div class="row wrapper-header align-items-center line-top-rgba">
                        <div class="col-md-4 col-3 d-xl-none">
                            <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                                <i class="icon text-white icon-categories"></i>
                            </a>
                        </div>
                        <div class="col-xl-8 col-md-4 col-6">
                            <div class="wrapper-header-left justify-content-center justify-content-xl-start">
                                <a href="index.html" class="logo-header">
                                    <img src="{{ asset('frontend/images/logo/logo-white.svg') }}" alt="logo" class="logo">
                                </a>
                                <div class="d-xl-block d-none">
                                    <form>
                                        <div class="form-search-select">
                                           
                                            <input type="text" placeholder="What are you looking for today?">
                                            <button class="tf-btn"><span class="text">Search</span></button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-xl-4 col-md-4 col-3">
                            <div class="wrapper-header-right">
                                 
                                <ul class="nav-icon d-flex justify-content-end align-items-center">
                                    <li class="nav-search d-inline-flex d-xl-none"><a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                            
                                    </a></li>
                                    <li class="nav-account">
                                        <a href="#" class="nav-icon-item">
                                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <div class="dropdown-account dropdown-login">
                                            <div class="sub-top">
                                                <a href="login.html" class="tf-btn btn-reset">Login</a>
                                                <p class="text-center text-secondary-2">Don’t have an account? <a href="register.html">Register</a></p>
                                            </div>
                                            <div class="sub-bot">
                                                <span class="body-text-">Support</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-wishlist"><a href="wish-list.html" class="nav-icon-item">
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>  
                                        </a>
                                    </li>
                                    <li class="nav-cart"><a href="#shoppingCart" data-bs-toggle="modal" class="nav-icon-item">
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>  
                                        <span class="count-box">1</span></a>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom bg-purple d-none d-xl-block">
                <div class="container">
                    <div class="wrapper-header d-flex justify-content-center align-items-center">
                        <div class="box-left">
                           

<div class="tf-list-categories">
     
     
</div>
                            <nav class="box-navigation">
                                <ul class="box-nav-ul d-flex align-items-center">
                                      <li class="menu-item active"><a href="" class="item-link">Home</a></li>
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

<li class="menu-item">
    <a href="#" class="item-link">Categories <i class="icon icon-arrow-down"></i></a>
    <div class="sub-menu mega-menu">
        <div class="container">
            <div class="row-demo">
                @foreach ($categories as $category)
                    <div class="demo-item">
                        <a href="#">
                            <div class="demo-image position-relative">
                                <img class="lazyload" 
                                     data-src="{{ asset('frontend/images/collections/collection-circle/' . $category['image']) }}" 
                                     src="{{ asset('frontend/' . $category['image']) }}" 
                                     alt="{{ $category['title'] }}">
                            </div>
                            <span class="demo-name">{{ $category['title'] }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center view-all-demo">
                <a href="#" class="tf-btn"><span class="text">View All Categories</span></a>
            </div>
        </div>
    </div>
</li>


                                    <li class="menu-item">
                                        <a href="#" class="item-link">Products<i class="icon icon-arrow-down"></i></a>
                                        <div class="sub-menu mega-menu">
                                            <div class="container">
                                                @php
$categories = [
    [
        'title' => 'Motors',
        'products' => [
            ['name' => 'Industrial Motor 5HP', 'url' => '#', 'badge' => 'New'],
            ['name' => 'Electric Motor 1HP', 'url' => '#'],
        ],
    ],
    [
        'title' => 'Pumps',
        'products' => [
            ['name' => 'Submersible Pump 1.5HP', 'url' => '#', 'badge' => 'Hot'],
            ['name' => 'Centrifugal Pump 2HP', 'url' => '#'],
        ],
    ],
    [
        'title' => 'Fan',
        'products' => [
            ['name' => 'Ceiling Fan 1200mm', 'url' => '#'],
            ['name' => 'Exhaust Fan 9"', 'url' => '#'],
        ],
    ],
    [
        'title' => 'Light',
        'products' => [
            ['name' => 'LED Tube Light 20W', 'url' => '#'],
            ['name' => 'Emergency Light 9W', 'url' => '#', 'badge' => 'New'],
        ],
    ],
];
@endphp
                                                <div class="row">
                                                    @foreach ($categories as $cat)
                                                    <div class="col-lg-3">
                                                        <div class="mega-menu-item">
                                                            <div class="menu-heading">{{ $cat['title'] }}</div>
                                                                <ul class="menu-list">
                                                                @foreach ($cat['products'] as $product)
                                                                <li>
                                                                <a href="{{ $product['url'] }}" class="menu-link-text">
                                                                {{ $product['name'] }}
                                                                @if (isset($product['badge']))
                                                                <div class="demo-label">
                                                                <span class="demo-new">{{ $product['badge'] }}</span>
                                                                </div>
                                                                @endif
                                                                </a>
                                                                </li>
                                                                @endforeach
                                                        
                                                             </ul>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                     <div class="text-center view-all-demo">
                <a href="#" class="tf-btn"><span class="text">View All Products</span></a>
            </div>
                                                    <div class="col-lg-3">
                                                  
                                                    <!-- <div class="sec-cls-header">
                                                        <div class="collection-position hover-img">
                                                            
                                                            <div class="content">
                                                                 
                                                                <div>
                                                                    <a href="shop-collection.html" class="tf-btn btn-md btn-white"><span class="text">View All Products</span><i class="icon icon-arrowUpRight"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>



 
                                         <li class="menu-item"><a href="" class="item-link">About Us</a></li>
                          
                                        

                                    
  
                                    <li class="menu-item position-relative">
                                        <a href="#" class="item-link">Customer Care<i class="icon icon-arrow-down"></i></a>
                                        <div class="sub-menu submenu-default">
                                            <ul class="menu-list">
                                                <li><a href="blog-default.html" class="menu-link-text">Customer Support</a></li>
                                                       </ul>
                                        </div>
                                    </li>
                                      <li class="menu-item"><a href="" class="item-link">Store Locator</a></li>
                          
                                     <li class="menu-item"><a href="" class="item-link">Contact Us</a></li>
                          
                                    
                                                 </ul>
                            </nav>
                        </div>
                         
                    </div>
                </div>
            </div>
        </header>