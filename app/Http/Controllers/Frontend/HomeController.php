<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("frontend.home");
    }
      public function about(){
        return view("frontend.about");
    }
         public function shop_collection(){
        return view("frontend.shop-collection");
    }
        public function shop_pagination(){
        return view("frontend.shop-pagination");
    }
          public function shop_left_sidebar(){
        return view("frontend.shop-left-sidebar");
    }
    public function product_detail(){
        return view("frontend.product-detail");
    }
    public function product_swatch_rounded_color(){
        return view("frontend.product-swatch-rounded-color");
    }
     public function product_variable(){
        return view("frontend.product-variable");
    }
    
    public function product_deals_grid(){
        return view("frontend.product-deals-grid");
    }
    
    public function blog_grid(){
        return view("frontend.blog-grid");
    }
    public function blog_detail_02(){
        return view("frontend.blog-detail-02");
    }
    public function N404(){
        return view("frontend.404");
    }
}
