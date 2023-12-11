<!DOCTYPE html>
<!-- Html start -->
<html lang="en">
  <!-- Head Start -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="We are delighted to announce the launch of our  online store! Our new online store provides our existing and prospective clients with an easier, more intuitive, user friendly shopping and checkout experience." />
    <meta name="keywords" content="We are delighted to announce the launch of our  online store! Our new online store provides our existing and prospective clients with an easier, more intuitive, user friendly shopping and checkout experience." />
    <meta name="author" content="Damraaz" />
    <link rel="icon" href="{{asset('logo192.png')}}" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="128x128" href="{{asset('logo128.png')}}">
    <link rel="icon" sizes="192x192" href="{{asset('logo192.png')}}">
    {{-- <link rel="shortcut icon" href="{{asset('newtheme/assets/images/favicon/favicon.png')}}" type="image/x-icon" /> --}}
    <link rel="manifest" href="{{asset('newtheme/assets/js/manifest.json')}}" />
    {{-- <link rel="icon" href="{{asset('newtheme/assets/images/favicon/favicon.png')}}" type="image/x-icon" /> --}}
    {{-- <link rel="apple-touch-icon" href="{{asset('newtheme/assets/images/favicon/favicon.png')}}" /> --}}
    <meta name="theme-color" content="#0f8fac" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="Damraaz" />
    <meta name="google-site-verification" content="Jn1IhcaNP53VC1u_0dNJZzdClJFDGf-TjUA9V_GSNXs" />
    {{-- <meta name="msapplication-TileImage" content="../assets/images/favicon/favicon.png')}}" /> --}}
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title') - {{env('APP_NAME')}}</title>


    <!-- Google Jost Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Google Monsterrat Font -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet" />

    <!-- Google Leckerli Font -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> --}}
    <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap Css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{asset('newtheme/assets/css/vendors/bootstrap.css')}}" />

    <!-- Wow Animation Css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('newtheme/assets/css/vendors/wow-animate.css')}}" /> --}}

    <!-- Swiper Slider Css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('newtheme/assets/css/vendors/swiper-bundle.min.css')}}" /> --}}

    <!-- Style Css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="{{asset('newtheme/assets/css/style.css')}}" />
  </head>
  <!-- Head End -->
  <style>
    .shopingbag .onhover-show-div .card-wrap {
    overflow-y: auto;
    height: 250px;
}
div#product-list {
    display: block !important;
    width: 50%;
    position: absolute;
    margin: 0px auto !important;
    background: gray;
    top: 85%;
    left: 5%;
}
@media screen and (max-width:1199px){
    #for_desktop{
        display: none;
    }
}
@media screen and (max-width:992px){
    .header-common .top-header {
        display: block !important;
    }
}


div.our_offcanvas_cat {

    --bs-offcanvas-width: 100% !important;

}
div.our_offcanvas_cat{

    width: 100% !important;

}
div.our_offcanvas_cat .offcanvas-body {

    padding: 5px !important;

}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #25d366;
    width: 80px;
    /* font-size: 13px; */
    height: 90px;
}



/* categories */
.category_menu {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 200px;
}
.category_menu > li {
  border-bottom: 1px solid;
  float: left;
  padding: 9px 10px;
  width: 100%;
  position:relative;
}
.right_sliding {
  display: none;
}
.category_menu li a {
  color: #000;
  font-size: 14px;
  text-decoration: none;
}
.fa.fa-arrow-right {
  float: right;
  font-size: 10px;
  margin: 7px 0 0;
}
.category_menu > li > ul {

    position: absolute;
  position: absolute;
    right: -110px;
    border-radius: 10px;
    background-color: white;
    top: 6px;
    padding: 1rem 10px;
}
.category_menu > li:hover > ul {
display:block;
}

  </style>
  @php
      $marquee = \App\Models\Marquee::first();
  @endphp
  <!-- Body Start -->
  <body>


      <!-- Overlay -->
      <a href="javascript:void(0)" class="overlay-general overlay-common"></a>
      <!-- Header Start -->
      <header class="header-common">
        <!-- Top Header -->
        <div class="top-header">
            <marquee behavior="" direction="" scrollamount="4" style="color:white">{{$marquee->message}}</marquee>
          {{-- <p class="marquee" ><span scrollamount='5'> {{$marquee->message}}</span></p> --}}
        </div>
        <div class="container-lg">
          <div class="nav-wrap">
            <!-- Navigation Start -->
            <nav class="navigation">
              <div class="nav-section">
                <div class="header-section">
                  <div class="navbar navbar-expand-xl navbar-light navbar-sticky p-0">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#primaryMenu" aria-controls="primaryMenu">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <a href="{{route('/')}}" class="logo-link">
                      <img class="logo logo-dark" src="{{asset('images/logo_new.jpeg')}}" alt="logo" />
                      <img class="logo logo-light" src="{{asset('images/logo_new.jpeg')}}" alt="logo" />
                    </a>
                    <div class="offcanvas offcanvas-collapse order-lg-2" id="primaryMenu">
                      <div class="offcanvas-header navbar-shadow">
                        <h5 class="mt-1 mb-0">Menu</h5>
                        @auth
                        <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        href="{{ route('logout') }}">Logout</a>
                        <li><a  href="{{ route('bundles.home') }}">Bundles Dashboard</a></li>

                        @endauth

                        @guest
                            <a href="{{route('login')}}">Login</a>
                            <a href="{{route('register')}}">Register</a>
                        @endguest
                        <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>

                      <div class="offcanvas-body">
                        <!-- Menu-->
                        <ul class="navbar-nav">
                          <!-- Home -->
                          <li class="nav-item dropdown dropdown-mega">
                            <a class="nav-link " href="{{route('/')}}" >Home</a>

                          </li>
                          <li class="nav-item dropdown dropdown-mega">
                            <a class="nav-link position-relative" href="{{route('frontend.megaSale')}}">Mega Sales
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    Hot
                                    <span class="visually-hidden">Mega Sales</span>
                                  </span>
                            </a>

                          </li>
                          <li class="nav-item dropdown dropdown-mega">
                            <a class="nav-link position-relative" href="{{route('frontend.productBundles')}}">Bundles
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    Hot
                                    <span class="visually-hidden">Bundles</span>
                                  </span>
                            </a>

                          </li>
                          <li class="nav-item dropdown dropdown-mega">
                            <a class="nav-link " href="{{route('user.product.shop')}}" >Shop</a>
                          </li>
                          <li class="nav-item dropdown " id="for_desktop">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
                            <div class="dropdown-menu" >
                                <div class="row">
                                @php
                                    $categories = \App\Models\Category::with(['parent','children','descendants'])->where('parent_id', null)->get();
                                @endphp
                                 <ul class="category_menu">
                                    @foreach ($categories as $kia => $item)

                                        <li>
                                          <a href="#">
                                            <span class="cat_name">{{$item->name}}</span>
                                            <span class="fa fa-arrow-right"></span>
                                          </a>

                                            @if (!blank($item->children))
                                            <ul class="right_sliding">
                                                    @foreach ($item->children as $ch)
                                                        <li class=" ">
                                                            <a class="" href="{{route('category.show', ['id'=>$ch->slug])}}" >{{$ch->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                 </ul>
                                </div>
                              </div>

                              <style>

                                .show-cat{
                                    display: none;
                                }
                                ul.show-cat_m{
                                    display: none;
                                }
                                .show-cat .active{
                                    display: inline-block;
                                }
                                .show-cat_m.active{
                                    display: inline-block;
                                }
                                ul.show-cat.active.dropdown-item {
                                    display: flex;
                                    flex-direction: column;
                                    padding-left: 1rem;
                                }
                                ul.show-cat_m.active.dropdown-item {
                                    display: flex;
                                    flex-direction: column;
                                    padding-left: 1rem;
                                }

                                .show-cat .active .child_li .child{
                                    display: flex;
                                    color: red;
                                }
                                .show-cat .active .child{
                                    display: flex;
                                    color: red;
                                }
                                .show-cat_m .active .child_li .child{
                                    display: flex;
                                    color: red;
                                }
                                .show-cat_m .active .child{
                                    display: flex;
                                    color: red;
                                }


                              </style>
                          </li>
                          <li class="nav-item dropdown dropdown-mega">
                            <a class="nav-link " href="{{ route('frontend.aboutUs') }}" >About Us</a>

                          </li>
                          <li class="nav-item dropdown dropdown-mega">
                            <a class="nav-link " href="{{ route('frontend.contactUs.create') }}" >Contact Us</a>

                          </li>

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
            <!-- Navigation End -->

            <!-- Menu Right Start  -->
            <div class="menu-right">


              <!-- Icon Menu Start -->
              <ul class="icon-menu">
                <li>
                  <button class="search-button" id="search_clicker"><i data-feather="search"></i></button>
                  <!-- Search Input Start -->
                  <div class="search-full " id="search_opener">
                    <div class="input-group">
                      <span class="input-group-text">
                        <i data-feather="search"></i>
                      </span>
                      <input type="text" class="form-control search-type" id="searchUser" placeholder="Search here.." />
                      <span class="input-group-text close-search">
                        <i id="search_closer"  data-feather="x"></i>
                      </span>

                    </div>
                     <!-- Suggestion Start -->
                  <div class="" id="product-list">

                  </div>
                  <!-- Suggestion Start -->

                  </div>
                  <!-- Search Input End -->
                </li>

                <li class="user">
                  <div class="dropdown user-dropdown">
                    <a href="javascript:void(0)"><i data-feather="user"></i></a>
                    <ul class="onhover-show-div">
                        @auth
                        <li><a  href="{{ route('home') }}">User Dashboard</a></li>
                        <li><a  href="{{ route('bundles.home') }}">Bundles Dashboard</a></li>
                        <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                 href="{{ route('logout') }}">Logout</a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    @else
                        <li><a
                                href="{{ route('login') }}">Login</a> </li>
                        <li><a
                                href="{{ route('register') }}">Register</a></li>
                    @endauth

                    </ul>
                  </div>
                </li>

                <li>
                  <div class="dropdown whislist-dropdown">
                    <a href="{{ count((array) session('wishlist')) == 0 ? 'javascript:void(0)' : route('wishlist') }}"><i data-feather="heart"></i> <span class="notification-label">{{ count((array) session('wishlist')) }}</span></a>
                    @if (count((array) session('wishlist')) == 0)

                    <div class="onhover-show-div">

                      <a href="{{ route('wishlist') }}"> <img src="{{asset('newtheme/assets/icons/svg/box.svg')}}" class="img-fluid" alt="box" /> </a>
                      <div class="content">
                        <a href="{{ route('wishlist') }}">
                          <h6>Your wishlist empty !!</h6>
                          <p>explore more and shortlist items.</p>
                        </a>
                      </div>
                    </div>
                    @endif
                  </div>
                </li>
                <br>

                <!-- Cart Menu Start -->
                <li>
                    @php
                    $product_counter = 0;


                @endphp
                    @if (session('cart'))

                    @foreach (session('cart') as $key => $item)
                        @foreach ($item['products'] as $items)
                        @php
                          $product_counter++;
                        @endphp
                        @endforeach

                    @endforeach
                    @endif
                  <div class="dropdown shopingbag">
                    <a href="javascript:void(0)" class="cart-button"><i data-feather="shopping-bag"></i> <span class="notification-label">{{ $product_counter }}</span></a>
                    <a href="javascript:void(0)" class="overlay-cart overlay-common"></a>
                    <div class="onhover-cart-dropdown">
                      <div class="onhover-show-div">
                        <div class="dropdown-header">
                          <div class="control">
                            <a href="{{ route('cart') }}">Shopping Cart</a>
                            <button class="back-cart"><i data-feather="arrow-right"></i></button>
                          </div>
                        </div>

                        <div class="card-wrap custom-scroll">
                            @php $total = 0 @endphp

                            @if (session('cart'))
                            {{-- {{dd(session('cart'))}} --}}
                                @foreach (session('cart') as $id => $details)
                                    @foreach ($details['products'] as $item)
                                     {{-- {{dd($details['products'])}} --}}
                                     {{-- @php

                                         echo $item;
                                     @endphp --}}
                                    @php $total += $item['discount_price'] * $item['quantity'] @endphp





                                    <div class="cart-card media">
                                        <a href="{{ route('product.show', $item['slug']) }}"> <img src="{{ asset($item['images']) }}" class="img-fluid" alt="{{ $item['name'] }}" /> </a>
                                        <div class="media-body">
                                          <a href="{{ route('product.show', $item['slug']) }}"> <h6>{{ $item['name'] }}</h6></a>
                                          <span>{{ $item['quantity'] }}X{{ $item['discount_price'] }}</span>
                                          {{-- <div class="plus-minus">
                                            <i class="sub" data-feather="minus"></i>
                                            <input type="number" value="1" min="1" max="10" />
                                            <i class="add" data-feather="plus"></i>
                                          </div> --}}
                                        </div>
                                        <button class="remove-cart"><i data-feather="x"></i></button>
                                      </div>
                                      @endforeach
                                @endforeach
                            @else
                                Add to cart products first.
                            @endif

                          <!-- Cart Item End -->
                        </div>
                        <div class="dropdown-footer">
                          <div class="freedelevery">
                            <p class="terms-condition">FREE SHIPPING! Continue Shopping to add more product to you cart and receive free shipping for orders over <strong>$500</strong></p>
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">70%</div>
                            </div>
                          </div>
                          <div class="total-price">
                            <span>Total</span>
                            <span>$450</span>
                          </div>

                          <div class="btn-group block-group">
                            <a href="{{ route('cart') }}" class="btn-solid">View Cart</a>
                            <a href="payment.html" class="btn-outline">Checkout</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- Cart Menu End -->
              </ul>
              <!-- Icon Menu End -->
            </div>
            <!-- Menu Right End  -->
          </div>
        </div>
      </header>
      <!-- Header End -->
      <main class="main">

          @yield('content')
      </main>




          <!-- Document Footer Start -->
    <footer class="footer-document ratio_asos mb-xxl">

      <div class="bg-footer-l">
        {{-- <img src="{{asset('newtheme/assets/images/fashion/banner/bg-footer-l.png')}}" alt="banner" /> --}}
      </div>
      <div class="bg-footer-r">
        {{-- <img src="{{asset('newtheme/assets/images/fashion/banner/bg-footer-r.png')}}" alt="banner" /> --}}
      </div>
      <div>
        <div class="container-lg">
          <div class="main-footer">
            <div class="content-box  "  style="width:70% !important; margin: 0rem auto !important; margin-bottom:3rem !important;">
                <div class="subscribe-box " >
                    <h5>Newsletter Sign Up</h5>
                    <p>Receive our latest updates about our products & promotions.</p>
                  </div>

                  <form action="{{route('subscribeNewsLetter')}}" method="POST" class="footer-form" >
                    @csrf
                    <input required type="email" class="form-control" name="email" placeholder="Your email address" />
                    <button type="submit" class="btn-solid">SUBMIT <i class="arrow"></i></button>
                  </form>
            </div>
            <div class="row gy-3 gy-md-4 gy-xl-0">
              <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="content-box">
                  <img class=" img-fluid" src="{{asset('images/damraaz_logo.jpg')}}" alt="logo-white" />
                  @php
                      $store = \App\Models\StoreInformation::findOrFail(1);
                  @endphp
                  <ul>
                    <li><i data-feather="map-pin"></i> <span> {{$store->location}} </span></li>
                    <li>
                      <i data-feather="phone"></i><a class="nav" href="tel:{{$store->phone}}"><span> {{$store->phone}} </span></a>
                    </li>
                    <li>
                      <i data-feather="mail"></i><a class="nav" href="mailto:{{$store->email}}"><span> {{$store->email}} </span></a>
                    </li>
                  </ul>
                </div>
              </div>



              <div class="nav-footer col-xl-2 col-lg-3 col-md-4 order-md-4 order-lg-3">
                <div class="nav d-md-block content-box">
                  <h5 class="heading-footer">Information</h5>
                  <ul>
                    <li><a class="nav" href="{{route('/')}}">Home </a></li>
                    <li><a class="nav" href="{{route('frontend.megaSale')}}">Mega Sales </a></li>
                    <li><a class="nav" href="{{route('frontend.all_product')}}">Shop </a></li>
                    <li><a class="nav" href="{{route('frontend.aboutUs')}}">About Us</a></li>
                    {{-- <li><a class="nav" href="blog-detail.html">Blog </a></li> --}}
                    <li><a class="nav" href="{{route('frontend.contactUs.create')}}">Contact </a></li>
                  </ul>
                </div>
              </div>

              <div class="nav-footer col-xl-2 col-lg-3 col-md-4 order-md-5 order-lg-4">
                <div class="nav d-md-block content-box">
                  <h5 class="heading-footer">Get Help</h5>
                  <ul>
                    <li><a class="nav" href="{{route('order.delivered')}}">Your Orders </a></li>
                    <li><a class="nav" href="{{route('home')}}">Your Account </a></li>
                    {{-- <li><a class="nav" href="user-dashboard.html">Track Order</a></li> --}}
                    <li><a class="nav" href="{{route('wishlist')}}">Your Wishlist</a></li>
                    {{-- <li><a class="nav" href="search.html">Search</a></li>
                    <li><a class="nav" href="faqs.html">Faqs</a></li> --}}
                  </ul>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 col-lg-4 order-md-2 order-lg-5">
                <div class="content-box">
                  <h5 class="heading-footer">Follow Us</h5>
                  <div class="follow-wrap">
                    <ul>
                      <li>
                        <a href="https://www.facebook.com/"> <img src="{{asset('newtheme/assets/icons/svg/social/fb.svg')}}" alt="fb" /> </a>
                      </li>
                      <li>
                        <a href="https://www.instagram.com/accounts/login/?source=auth_switcher"> <img src="{{asset('newtheme/assets/icons/svg/social/inta.svg')}}" alt="fb" /> </a>
                      </li>
                      <li>
                        <a href="https://twitter.com/i/flow/login"> <img src="{{asset('newtheme/assets/icons/svg/social/tw.svg')}}" alt="fb" /> </a>
                      </li>
                      <li>
                        <a href="https://in.pinterest.com/"> <img src="{{asset('newtheme/assets/icons/svg/social/pint.svg')}}" alt="fb" /> </a>
                      </li>
                    </ul>
                  </div>


                </div>
              </div>
            </div>
          </div>

          <div class="sub-footer">
            <div class="row gy-3">
              <div class="col-md-6">
                <ul>
                  <li>
                    <a href="javascript:void(0)"> <img src="{{asset('newtheme/assets/icons/png/1.png')}}" class="img-fluid blur-up lazyload" alt="payment icon" /></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)"> <img src="{{asset('newtheme/assets/icons/png/2.png')}}" class="img-fluid blur-up lazyload" alt="payment icon" /></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)"> <img src="{{asset('newtheme/assets/icons/png/3.png')}}" class="img-fluid blur-up lazyload" alt="payment icon" /></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)"> <img src="{{asset('newtheme/assets/icons/png/4.png')}}" class="img-fluid blur-up lazyload" alt="payment icon" /></a>
                  </li>
                </ul>
              </div>
              <div class="col-md-6">
                <p class="mb-0">Copyright© {{ date('Y') }} By Damraaz</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Document Footer End -->

    <!-- Mobile Menu Footer Start -->
    <footer class="mobile-menu-footer d-sm-none">
      <ul>
        <li>
          <a href="{{route('/')}}" class="active">
            <i data-feather="home"></i>
            <span>Home</span>
          </a>
        </li>

        <li>
          <a href="{{route('frontend.all_product')}}" class="search-link">
            <i data-feather="search"></i>
            <span>Search</span>
          </a>
        </li>
        <li >
            <a  href="{{ route('category.index')}}">
                <i data-feather="shopping-bag"></i>
                <span>Categories</span>
            </a>


          </li>
        <li>
          <a href="{{ route('cart') }}">
            <i data-feather="shopping-bag"></i>
            <span>Cart</span>
          </a>
        </li>
        <li>
          <a href="{{ route('order.inProgress') }}">
            <i data-feather="shopping-bag"></i>
            <span>Orders</span>
          </a>
        </li>
        {{-- <li>
          <a href="{{route('wishlist')}}">
            <i data-feather="heart"></i>
            <span>Wishlist</span>
          </a>
        </li> --}}
        <li>
          <a href="{{route('home')}}">
            <i data-feather="user"></i>
            <span>Account</span>
          </a>
        </li>
      </ul>
    </footer>
    <!-- Mobile Menu Footer End -->
{{--
    <div class="offcanvas offcanvas-start our_offcanvas_cat" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Categories</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills  me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach ($categories as $kia => $item)
                    <a class="nav-link {{$kia==0 ? 'active':''}}" id="v-pills-{{$item->name}}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{$item->name}}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <img src="{{asset($item->image)}}" alt="" class=""  style="height: 50px; width:50px; object-fit:contain">
                        <br>
                        {{$item->name}}
                    </a>
                    @endforeach
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    @foreach ($categories as $kia => $item)

                  <div class="tab-pane fade {{$kia==0 ? 'show active':''}} " id="v-pills-{{$item->name}}" role="tabpanel" aria-labelledby="v-pills-{{$item->name}}-tab" tabindex="0">
                    @if (!blank($item->children))
                        <div class="row ">
                            @foreach ($item->children as $ch)

                            <div class="col-4">
                                    <a class="text-center" href="{{route('category.show', ['id'=>$ch->slug])}}">
                                        <img src="{{asset($ch->image)}}" alt="" class=" my-1" style="height: 50px; width:50px; object-fit:contain">
                                        <br>
                                        {{$ch->name}}
                                    </a>
                                  </div>
                            @endforeach
                        </div>
                    @endif
                   </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div> --}}

    @php
        $whatsapp = \App\Models\Whatsapp::where('id', '!=', null)->first();
    @endphp


    <a href="https://wa.me/{{$whatsapp->whatsapp}}?text={{$whatsapp->message}}" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
        </a>
        <style>
            ul.dropdown-menu.show {
    display: flex;
    flex-direction: column;
}
            .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:80px;
	right:10px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
    @media only screen and (min-width:500px){
        .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:20px;
	right:10px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}
    }

</style>





    <!-- Tap To Top Button Start -->
    <div class="tap-to-top-box hide">
      <button class="tap-to-top-button"><i data-feather="chevrons-up"></i></button>
    </div>
    <!-- Tap To Top Button End -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Bootstrap Js -->
    <script src="{{asset('newtheme/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

    <!-- Feather Icon -->
    <script src="{{asset('newtheme/assets/js/feather/feather.min.js')}}"></script>

    <!-- Swiper Slider Js -->
    {{-- <script src="{{asset('newtheme/assets/js/swiper-slider/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('newtheme/assets/js/swiper-slider/swiper-custom.min.js')}}"></script> --}}

    <!-- Timer Js -->
    {{-- <script src="{{asset('newtheme/assets/js/timer.js')}}"></script> --}}

    <!-- Header Sticky js  -->
    <script src="{{asset('newtheme/assets/js/sticky-header.js')}}"></script>

    <!-- Active Class js  -->
    <script src="{{asset('newtheme/assets/js/active-class.js')}}"></script>

    <!-- Wow Js -->
    <script src="{{asset('newtheme/assets/js/wow.js')}}"></script>
    <script src="{{asset('newtheme/assets/js/wow-custom.js')}}"></script>

    <!-- Script Js -->
    <script src="{{asset('newtheme/assets/js/script.js')}}"></script>
    <script>
        function preventBack() {
        window.history.forward();
         }

        setTimeout("preventBack()", 0);

        window.onunload = function () { null };
    </script>
    @stack('scripts')
    <script>

        $(document).ready(function(){
          
          $( "form" ).on( "submit", function( event ) {
                  $("button").hide();
                  $(":submit").hide();
          });
           $('#search_clicker').on('click', function(){
            $('#search_opener').addClass("open");
           });
           $('#search_closer').on('click', function(){
            $('#search_opener').removeClass("open");
           });

           $('#searchUser').on('keyup',function() {
        var query = $(this).val();
        $.ajax({
            url:"{{ route('search') }}",
            type:"GET",
            data:{'query':query},
            success:function (data) {
                $('#product-list').html(data);
            }
        })
    });
    $('body').on('click', 'li', function(){
        var value = $(this).text();
        //do what ever you want
    });

    $('#cat_click').on('click', function(){
        var cat_id = $(this).attr('cat-id');
        // alert(cat_id);

        $(`#child${cat_id}`).addClass('active dropdown-item');

    });
    $('#cat_click_m').on('click', function(){
        var cat_id = $(this).attr('cat-id');
        // alert(cat_id);

        $(`#child_m${cat_id}`).addClass('active dropdown-item');

    });
        });
    </script>

    <!--Start of Tawk.to Script-->
{{-- <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/650ff2ebb1aaa13b7a7897d8/1hb34prgt';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script> --}}
    <!--End of Tawk.to Script-->
  </body>
  <!-- Body End -->
</html>

<!-- Html End -->

<style>
    .header-common .top-header .marquee {
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    width: 100% !important;
    line-height: 20px;
    margin: 0 auto;
    white-space: nowrap;
    overflow: hidden;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

</style>
