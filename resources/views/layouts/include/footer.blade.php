<!-- Footer Start -->
<footer class="section-t-space footer-section-2">
    <div class="container-fluid-lg">
        <div class="main-footer">
            <div class="row ">
                <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <a href="{{url('/')}}" class="foot-logo">
                        <img src="{{ asset('assets/images/logo/3.png') }}" class="img-fluid" alt="">
                    </a>
                    <!--<p class="information-text">it is a long established fact that a reader will be distracted-->
                    <!--    by the readable content.</p>-->
                    <ul class="social-icon">
                        <li>
                            <a href="www.facebook.com">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="www.goolge.com">
                                <i class="fab fa-google"></i>
                            </a>
                        </li>
                        <li>
                            <a href="www.twitter.com">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="www.instagram.com">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="www.pinterest.com">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="social-app mt-sm-4 mt-3 mb-4">
                        <ul>
                            <li>
                                <a href="https://play.google.com/store/apps" target="_blank">
                                    <img src="{{ asset('assets/images/playstore.svg') }}" class="blur-up lazyload"
                                        alt="">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.apple.com/in/app-store/" target="_blank">
                                    <img src="{{ asset('assets/images/appstore.svg') }}" class="blur-up lazyload"
                                        alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xxl-2 col-xl-4 col-sm-6">
                    <div class="footer-title">
                        <h4>About Damraaz</h4>
                    </div>
                    <ul class="footer-list footer-contact mb-sm-0 mb-3">
                        <li>
                            <a href="{{ route('frontend.aboutUs') }}" class="footer-contain-2">
                                <i class="fas fa-angle-right"></i>About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.contactUs.create') }}" class="footer-contain-2">
                                <i class="fas fa-angle-right"></i>Contact Us</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.terms&condition') }}" class="footer-contain-2">
                                <i class="fas fa-angle-right"></i>Terms & Coditions</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.privacy.policy') }}" class="footer-contain-2">
                                <i class="fas fa-angle-right"></i>Privacy Policy</a>
                        </li>
                        <!--<li>-->
                        <!--    <a href="careers.html" class="footer-contain-2">-->
                        <!--        <i class="fas fa-angle-right"></i>Careers</a>-->
                        <!--</li>-->
                        <!--<li>-->
                        <!--    <a href="blog-list.html" class="footer-contain-2">-->
                        <!--        <i class="fas fa-angle-right"></i>Latest Blog</a>-->
                        <!--</li>-->
                    </ul>
                </div>

                <div class="col-xxl-2 col-xl-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Useful Link</h4>
                    </div>
                    <ul class="footer-list footer-contact mb-sm-0 mb-3">
                        <!--<li>-->
                        <!--    <a href="#" class="footer-contain-2">-->
                        <!--        <i class="fas fa-angle-right"></i>Your Order</a>-->
                        <!--</li>-->
                        <li>
                            <a href="{{ route('home') }}" class="footer-contain-2">
                                <i class="fas fa-angle-right"></i>Your Account</a>
                        </li>
                        <!--<li>-->
                        <!--    <a href="#" class="footer-contain-2">-->
                        <!--        <i class="fas fa-angle-right"></i>Track Orders</a>-->
                        <!--</li>-->
                        <li>
                            <a href="{{ route('wishlist') }}" class="footer-contain-2">
                                <i class="fas fa-angle-right"></i>Your Wishlist</a>
                        </li>
                        <!--<li>-->
                        <!--    <a href="#" class="footer-contain-2">-->
                        <!--        <i class="fas fa-angle-right"></i>FAQs</a>-->
                        <!--</li>-->
                    </ul>
                </div>

                <!--<div class="col-xxl-2 col-xl-4 col-sm-6">-->
                <!--    <div class="footer-title">-->
                <!--        <h4>Categories</h4>-->
                <!--    </div>-->
                <!--    <ul class="footer-list footer-contact mb-sm-0 mb-3">-->
                <!--        <li>-->
                <!--            <a href="vegetables-demo.html" class="footer-contain-2">-->
                <!--                <i class="fas fa-angle-right"></i>Fresh Vegetables</a>-->
                <!--        </li>-->
                <!--        <li>-->
                <!--            <a href="spice-demo.html" class="footer-contain-2">-->
                <!--                <i class="fas fa-angle-right"></i>Hot Spice</a>-->
                <!--        </li>-->
                <!--        <li>-->
                <!--            <a href="bags-demo.html" class="footer-contain-2">-->
                <!--                <i class="fas fa-angle-right"></i>Brand New Bags</a>-->
                <!--        </li>-->
                <!--        <li>-->
                <!--            <a href="bakery-demo.html" class="footer-contain-2">-->
                <!--                <i class="fas fa-angle-right"></i>New Bakery</a>-->
                <!--        </li>-->
                <!--        <li>-->
                <!--            <a href="grocery-demo.html" class="footer-contain-2">-->
                <!--                <i class="fas fa-angle-right"></i>New Grocery</a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</div>-->

                <div class="col-xxl-3 col-xl-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Store infomation</h4>
                    </div>
                    <ul class="footer-address footer-contact">
                        <li>
                            <a href="javascript:void(0)">
                                <div class="inform-box flex-start-box">
                                    <i data-feather="map-pin"></i>
                                    <p>Damraaz store Pakistan</p>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="tel">
                                <div class="inform-box">
                                    <i data-feather="phone"></i>
                                    <p>Call us: +92 307 1822026</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://api.whatsapp.com/send?phone=923071822026">
                                <div class="inform-box">
                                    <i data-feather="message-square"></i>
                                    <p>Whatsapp: +92 307 1822026</p>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <div class="inform-box">
                                    <i data-feather="mail"></i>
                                    <p>Email Us: Support@damraaz.com</p>
                                </div>
                            </a>
                        </li>

                        {{-- <li>
                            <a href="javascript:void(0)">
                                <div class="inform-box">
                                    <i data-feather="printer"></i>
                                    <p>Fax: 123456</p>
                                </div>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>

        <div class="sub-footer section-small-space">
            <div class="left-footer">
                <p>{{ date('Y') }} Copyright By Damraaz.com</p>
            </div>
            <!--<div class="right-footer">-->
            <!--    <ul class="payment-box">-->
            <!--        <li>-->
            <!--            <img src="{{ asset('assets/images/icon/paymant/visa.png') }}" alt="">-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <img src="{{ asset('assets/images/icon/paymant/discover.png') }}" alt="">-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <img src="{{ asset('assets/images/icon/paymant/american.png') }}" alt="">-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <img src="{{ asset('assets/images/icon/paymant/master-card.png') }}" alt="">-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <img src="{{ asset('assets/images/icon/paymant/giro-pay.png') }}" alt="">-->
            <!--        </li>-->
            <!--    </ul>-->
            <!--</div>-->
        </div>
    </div>
</footer>
<!-- Footer End -->
