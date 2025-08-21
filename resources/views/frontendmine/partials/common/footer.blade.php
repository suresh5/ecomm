<!-- resources/views/partials/footer.blade.php -->
<footer id="footer" class="footer bg-main">
    <div class="footer-wrap">
        <div class="footer-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-infor">
                            <div class="footer-logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('frontend/images/logo/logo-white.svg') }}" alt="">
                                </a>
                            </div>
                            <div class="footer-address">
                                <p>549 Oak St.Crystal Lake, IL 60014</p>
                                <a href="{{ url('/contact') }}" class="tf-btn-default style-white fw-6">GET DIRECTION<i class="icon-arrowUpRight"></i></a>
                            </div>
                            <ul class="footer-info">
                                <li>
                                    <i class="icon-mail"></i>
                                    <p>themesflat@gmail.com</p>
                                </li>
                                <li>
                                    <i class="icon-phone"></i>
                                    <p>315-666-6688</p>
                                </li>
                            </ul>
                            <ul class="tf-social-icon style-white">
                                <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                <li><a href="#" class="social-twiter"><i class="icon icon-x"></i></a></li>
                                <li><a href="#" class="social-instagram"><i class="icon icon-instagram"></i></a></li>
                                <li><a href="#" class="social-tiktok"><i class="icon icon-tiktok"></i></a></li>
                                <li><a href="#" class="social-amazon"><i class="icon icon-amazon"></i></a></li>
                                <li><a href="#" class="social-pinterest"><i class="icon icon-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-menu">
                            <div class="footer-col-block">
                                <div class="footer-heading text-button footer-heading-mobile">Infomation</div>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li><a href="{{ url('/about-us') }}" class="footer-menu_item">About Us</a></li>
                                        <li><a href="#" class="footer-menu_item">Our Stories</a></li>
                                        <li><a href="#" class="footer-menu_item">Size Guide</a></li>
                                        <li><a href="{{ url('/contact') }}" class="footer-menu_item">Contact us</a></li>
                                        <li><a href="#" class="footer-menu_item">Career</a></li>
                                        <li><a href="{{ url('/my-account') }}" class="footer-menu_item">My Account</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-col-block">
                                <div class="footer-heading text-button footer-heading-mobile">Customer Services</div>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li><a href="#" class="footer-menu_item">Shipping</a></li>
                                        <li><a href="#" class="footer-menu_item">Return & Refund</a></li>
                                        <li><a href="#" class="footer-menu_item">Privacy Policy</a></li>
                                        <li><a href="{{ url('/term-of-use') }}" class="footer-menu_item">Terms & Conditions</a></li>
                                        <li><a href="{{ url('/FAQs') }}" class="footer-menu_item">Orders FAQs</a></li>
                                        <li><a href="{{ url('/wish-list') }}" class="footer-menu_item">My Wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-col-block">
                            <div class="footer-heading text-button footer-heading-mobile">Newletter</div>
                            <div class="tf-collapse-content">
                                <div class="footer-newsletter">
                                    <p class="text-caption-1">Sign up for our newsletter and get 10% off your first purchase</p>
                                    <!-- Replace form action with your real newsletter endpoint -->
                                    <form method="POST" class="form-newsletter style-black">
                                        <input class="input radius-60" type="email" name="email" placeholder="Enter your e-mail..." required>
                                        <button type="submit" class="subscribe-button radius-60">
                                            <i class="icon icon-arrowUpRight"></i>
                                        </button>
                                    </form>
                                    <div class="tf-cart-checkbox mt-2">
                                        <div class="tf-checkbox-wrapp">
                                            <input type="checkbox" id="footer-Form_agree" name="agree_checkbox">
                                            <div><i class="icon-check"></i></div>
                                        </div>
                                        <label class="text-caption-1" for="footer-Form_agree">
                                            By clicking subscribe, you agree to the <a class="fw-6 link" href="{{ url('/term-of-use') }}">Terms of Service</a> and <a class="fw-6 link" href="#">Privacy Policy</a>.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-wrap">
                    <div class="left">
                        <p class="text-caption-1">©{{ date('Y') }} Modave. All Rights Reserved.</p>
                        <div class="tf-cur justify-content-end">
                            <div class="tf-currencies">
                                <select class="image-select center style-default type-currencies color-secondary-2">
                                    <option selected data-thumbnail="{{ asset('frontend/images/country/us.svg') }}">USD</option>
                                    <option data-thumbnail="{{ asset('frontend/images/country/vn.svg') }}">VND</option>
                                    <option data-thumbnail="{{ asset('frontend/images/country/fr.svg') }}">EUR</option>
                                </select>
                            </div>
                            <div class="tf-languages">
                                <select class="image-select center style-default type-languages color-secondary-2">
                                    <option>English</option>
                                    <option>Vietnam</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tf-payment">
                        <p class="text-caption-1">Payment:</p>
                        <ul>
                            @for ($i = 1; $i <= 6; $i++)
                                <li><img src="{{ asset('frontend/images/payment/img-' . $i . '.png') }}" alt="payment-{{ $i }}"></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
