 <header id="header" class="header-default  header-style-6">
     <div class="container-full2">
         <div class="row wrapper-header align-items-center">
             <div class="col-md-4 col-3 d-xl-none">
                 <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                     <i class="icon icon-categories"></i>
                 </a>
             </div>
             <div class="col-xl-9 col-md-4 col-6">
                 <div class="header-left justify-content-xl-start justify-content-center">
                     <a href="index.html" class="logo-header">
                         <img src="{{asset('frontend/images/logo/waglogo.png')}}" alt="logo" class="logo">
                     </a>
                     <div class="tf-list-categories style-2 d-none d-xl-block">
                         <a href="#" class="categories-title text-title">
                             <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <g clip-path="url(#clip0_19494_2169)">
                                     <path
                                         d="M9.75 3.75H5.25C4.83579 3.75 4.5 4.08579 4.5 4.5V19.5C4.5 19.9142 4.83579 20.25 5.25 20.25H9.75C10.1642 20.25 10.5 19.9142 10.5 19.5V4.5C10.5 4.08579 10.1642 3.75 9.75 3.75Z"
                                         stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                     <path
                                         d="M20.4065 19.2907L16.018 20.2282C15.9213 20.2488 15.8215 20.25 15.7242 20.2318C15.627 20.2137 15.5344 20.1765 15.4516 20.1224C15.3688 20.0683 15.2976 19.9983 15.2419 19.9166C15.1863 19.8348 15.1474 19.7428 15.1274 19.646L12.0168 4.85599C11.9749 4.66061 12.0121 4.45662 12.1201 4.28853C12.2281 4.12044 12.3982 4.00191 12.5933 3.9588L16.9818 3.0213C17.0785 3.00072 17.1784 2.99948 17.2756 3.01764C17.3728 3.03579 17.4654 3.073 17.5482 3.12711C17.631 3.18122 17.7022 3.25116 17.7579 3.33292C17.8135 3.41468 17.8524 3.50663 17.8724 3.60349L20.983 18.3935C21.0249 18.5889 20.9877 18.7929 20.8797 18.9609C20.7717 19.129 20.6016 19.2476 20.4065 19.2907Z"
                                         stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                     <path d="M4.5 6.75H10.5" stroke="black" stroke-linecap="round"
                                         stroke-linejoin="round" />
                                     <path d="M4.5 17.25H10.5" stroke="black" stroke-linecap="round"
                                         stroke-linejoin="round" />
                                     <path d="M12.4844 7.07648L18.3391 5.81836" stroke="black"
                                         stroke-linecap="round" stroke-linejoin="round" />
                                     <path d="M13.1094 10.0355L18.965 8.77734" stroke="black"
                                         stroke-linecap="round" stroke-linejoin="round" />
                                     <path d="M14.6641 17.432L20.5187 16.1738" stroke="black"
                                         stroke-linecap="round" stroke-linejoin="round" />
                                 </g>
                                 <defs>
                                     <clipPath id="clip0_19494_2169">
                                         <rect width="24" height="24" fill="white" />
                                     </clipPath>
                                 </defs>
                             </svg>
                             <span class="d-none d-xxl-block">Browse by Category</span>
                             <span class="icon icon-arrow-down"></span>
                         </a>
                         <div class="list-categories-inner">
                             <ul class="text-title">
                                 @foreach($parentCategories as $category)
                                 @if($category->children->isNotEmpty())
                                 <li class="sub-categories2">
                                     <a href="{{ route('category.products', $category->slug) }}" class="categories-item">
                                         <span class="inner-left">{{ $category->title }}</span>
                                         <i class="icon icon-arrRight"></i>
                                     </a>

                                     <ul class="list-categories-inner">
                                         @foreach($category->children as $child)
                                         <li>
                                             <a href="{{ route('category.products', $child->slug) }}" class="categories-item text-title">
                                                 <span class="inner-left">{{ $child->title }}</span>
                                             </a>
                                         </li>
                                         @endforeach
                                     </ul>
                                 </li>
                                 @else
                                 <li>
                                     <a href="{{ route('category.products', $category->slug) }}" class="categories-item">
                                         <span class="inner-left">{{ $category->title }}</span>
                                     </a>
                                 </li>
                                 @endif
                                 @endforeach
                             </ul>

                         </div>
                     </div>
                     <nav class="box-navigation text-center d-none d-xl-block">
                         <ul class="box-nav-ul d-flex align-items-center justify-content-center">
                             <li class="menu-item active"><a href="{{ route('home') }}"
                                     class="item-link">Home</a></li>
                             <li class="menu-item position-relative">
                                 <a href="#" class="item-link">Applications<i class="icon icon-arrow-down"></i></a>
                                 <div class="sub-menu submenu-default">
                                     <ul class="menu-list">
                                         <li><a href="blog-default.html" class="menu-link-text">Agriculture</a>
                                         </li>
                                         <li><a href="blog-list.html" class="menu-link-text">Agriculture</a></li>
                                         <li><a href="blog-grid.html" class="menu-link-text">Agriculture</a></li>
                                         <li><a href="blog-detail.html" class="menu-link-text">Agriculture</a>
                                         </li>
                                         <li><a href="blog-detail-02.html" class="menu-link-text">Agriculture</a></li>
                                     </ul>
                                 </div>
                             </li>
                             <li class="menu-item"><a href="{{ route('products') }}"
                                     class="item-link">Products</a></li>
                             <li class="menu-item"><a href="{{ route('about-us') }}"
                                     class="item-link">About</a></li>
                             <li class="menu-item"><a href="{{ route('contact') }}"
                                     class="item-link">Contact Us</a></li>



                         </ul>
                     </nav>
                 </div>
             </div>
             <div class="col-xl-3 col-md-4 col-3">
                 <div class="header-right">
                     <a href="#enquiryModal"
                         class="btn btn-primary btn-sm px-3 py-2"
                         data-bs-toggle="modal">
                         Quick Enquiry
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </header>