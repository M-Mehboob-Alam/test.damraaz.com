<!-- Header Start -->

<header class="header-2">
    <!--<div class="header-notification theme-bg-color overflow-hidden py-2">-->
    <!--    <div class="notification-slider">-->
    <!--        <div>-->
    <!--            <div class="timer-notification text-center">-->
    <!--                <h6><strong class="me-1">Welcome to Damraaz!</strong>Wrap new offers/gift-->
    <!--                    every signle day on Weekends.<strong class="ms-1">New Coupon Code: Fast024-->
    <!--                    </strong>-->
    <!--                </h6>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div>-->
    <!--            <div class="timer-notification text-center">-->
    <!--                <h6>Something you love is now on sale!<a href="shop-left-sidebar.html" class="text-white">Buy-->
    <!--                        Now-->
    <!--                        !</a>-->
    <!--                </h6>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <button class="btn close-notification"><span>Close</span> <i class="fas fa-times"></i></button>-->
    <!--</div>-->
    <div class="top-nav top-header sticky-header sticky-header-3">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-block p-0 me-3" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                            <span class="navbar-toggler-icon">
                                <i class="iconly-Category icli theme-color"></i>
                            </span>
                        </button>
                        <a href="{{ url('/') }}" class="web-logo nav-logo">
                            <img src="{{ asset('images/logo_new.jpeg') }}" class="img-fluid blur-up lazyload"
                                alt="">
                        </a>

                        <div class="search-full">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i data-feather="search" class="font-light"></i>
                                </span>
                                <input type="text" class="form-control search-type" placeholder="Search here..">
                                <span class="input-group-text close-search">
                                    <i data-feather="x" class="font-light"></i>
                                </span>
                            </div>
                        </div>

                        <div class="middle-box">
                            <div class="center-box">
                                <form method="get" action="{{ route('frontend.all_product') }}"
                                    class="searchbar-box order-xl-1 d-none d-xl-block">
                                    <input type="search" name="name" class="form-control"
                                        value="{{ request()->name }}" id=""
                                        placeholder="search for product, delivered to your door...">
                                    <button class="btn search-button" type="submit">
                                        <i class="iconly-Search icli"></i>
                                    </button>
                                </form>
                                <span id="product-list"></span>
                                <!--<div class="location-box-2">-->
                                <!--    <button class="btn location-button" data-bs-toggle="modal"-->
                                <!--        data-bs-target="#locationModal">-->
                                <!--        <i class="iconly-Location icli"></i>-->
                                <!--        <span class="locat-name">Your Location</span>-->
                                <!--        <i class="fa-solid fa-angle-down down-arrow"></i>-->
                                <!--    </button>-->
                                <!--</div>-->
                            </div>
                        </div>
                        
                        <div class="rightside-menu">
                            <div class="dropdown-dollar d-block">
                                <div class="dropdown">
                                    <button class="dropdown-toggle m-0" type="button" id="dropdownMenuButton2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>Account</span> <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        @auth
                                            <li><a id="eur" class="dropdown-item"
                                                    href="{{ route('home') }}">Profile</a></li>
                                            <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                    class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        @else
                                            <li><a id="usd" class="dropdown-item"
                                                    href="{{ route('login') }}">Login</a> </li>
                                            <li><a id="inr" class="dropdown-item"
                                                    href="{{ route('register') }}">Register</a></li>
                                        @endauth
                                        <li>
                                    </ul>
                                </div>
                            </div>

                            <div class="option-list">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)" class=" d-none header-icon user-icon search-icon">
                                            <i class="iconly-Profile icli"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0)" class=" d-none header-icon search-box search-icon">
                                            <i class="iconly-Search icli"></i>
                                        </a>
                                    </li>

                                    <!--<li>-->
                                    <!--    <a href="{{ route('compare') }}" class="header-icon">-->
                                    <!--        <small class="badge-number">{{ count((array) session('compare')) }}</small>-->
                                    <!--        <i class="iconly-Swap icli"></i>-->
                                    <!--    </a>-->
                                    <!--</li>-->

                                    <li class="onhover-dropdown">
                                        <a href="{{ route('wishlist') }}" class="header-icon swap-icon">
                                            <small
                                                class="badge-number">{{ count((array) session('wishlist')) }}</small>
                                            <i class="iconly-Heart icli"></i>
                                        </a>

                                    </li>

                                    <li class="onhover-dropdown">
                                        <a href="{{ route('cart') }}" class="header-icon bag-icon">
                                            <small class="badge-number">{{ count((array) session('cart')) }}</small>
                                            <i class="iconly-Bag-2 icli"></i>
                                        </a>
                                        <div class="onhover-div">
                                            <ul class="cart-list">
                                                @php $total = 0 @endphp
                                                @if (session('cart'))
                                                    @foreach (session('cart') as $id => $details)
                                                        @php $total += $details['discount_price'] * $details['quantity'] @endphp
                                                        <li>
                                                            <div class="drop-cart">
                                                                @php $image=json_decode($details['images']);@endphp
                                                                <a href="{{ route('product.show', $id) }}"
                                                                    class="drop-image">
                                                                    <img src="{{ asset($image[0]) }}"
                                                                        class="blur-up lazyload" alt="">
                                                                </a>

                                                                <div class="drop-contain">
                                                                    <a href="{{ route('product.show', $id) }}">
                                                                        <h5>{{ $details['name'] }}</h5>
                                                                    </a>
                                                                    <h6><span>{{ $details['quantity'] }} x</span> Rs.
                                                                        {{ $details['discount_price'] }}</h6>
                                                                    <!--<button class="close-button">-->
                                                                    <!--    <i class="fa-solid fa-xmark"></i>-->
                                                                    <!--</button>-->
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    Add to cart products first.
                                                @endif
                                            </ul>


                                            <div class="price-box">
                                                <h5>Price :</h5>
                                                <h4 class="theme-color fw-bold">{{ $total }}</h4>
                                            </div>

                                            <div class="button-group">
                                                <a href="{{ route('cart') }}" class="btn btn-sm cart-button">View
                                                    Cart</a>
                                                <a href="{{ route('checkout') }}"
                                                    class="btn btn-sm cart-button theme-bg-color
                                                text-white">Checkout</a>
                                            </div>
                                        </div>
                                    </li>
                                    @auth
                                        @php
                                            $user = Auth()->user();
                                            $notifications = App\Models\Notification::where('user_id', $user->id)
                                                ->where('is_admin', false)
                                                ->where('is_read', false)
                                                ->latest()
                                                ->paginate(6);
                                        @endphp
                                        <li class="onhover-dropdown d-block ">
                                            <a href="#" class="header-icon bag-icon d-block">
                                                <small class="badge-number">{{ $notifications->total() }}</small>
                                                <i class="fa-regular fa-bell icli "></i>
                                            </a>


                                            <div class="onhover-div">
                                                <ul class="cart-list">

                                                    @forelse($notifications as $notification)
                                                        <li>
                                                            <div class="drop-cart">
                                                                <!--<a href="#" class="drop-image">-->
                                                                <!--    <img src="#"-->
                                                                <!--        class="blur-up lazyload" alt="">-->
                                                                <!--</a>-->

                                                                <div class="drop-contain">
                                                                    <a href="#">
                                                                        <h5>{{ $notification->name ?? '' }}</h5>
                                                                    </a>
                                                                    <h6>{{ $notification->message ?? '' }}</h6>
                                                                    <!--<button class="close-button">-->
                                                                    <!--    <i class="fa-solid fa-xmark"></i>-->
                                                                    <!--</button>-->
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <li>No New Notificaton found</li>
                                                    @endforelse
                                                </ul>

                                                <div class="button-group">
                                                    <a href="{{ route('user.notification.index') }}"
                                                        class="btn btn-sm cart-button">View Notification</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="main-nav">
                    <div class="header-nav-left">
                        <button class="dropdown-category dropdown-category-2">
                            <i class="iconly-Category icli"></i>
                            <span>All Categories</span>
                        </button>

                        <div class="category-dropdown">
                            <div class="category-title">
                                <h5>Categories</h5>
                                <button type="button" class="btn p-0 close-button text-content">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            @php
                                $categories = App\Models\Category::with('products')->get();
                            @endphp
                            <ul class="category-list">
                                @forelse($categories as $category)
                                    <li class="onhover-category-list">
                                        <a href="{{  route('category.show', $category->id) }}" class="category-name">
                                            <img src="{{ asset($category->image) }}" alt="">
                                            <h6>{{ $category->name ?? '' }}</h6>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>

                                        <div class="onhover-category-box w-100">
                                            <div class="list-1">
                                                <div class="category-title-box">
                                                    <h5>Products</h5>
                                                </div>
                                                <ul>
                                                    @forelse ($category->products as $product)
                                                        <li>
                                                            <a href="{{ route('product.show', $product->id) }}">{{ $product->name ?? '' }}</a>
                                                        </li>
                                                    @empty
                                                        No Product Found
                                                    @endforelse
                                                </ul>
                                            </div>
                                    </li>
                                @empty
                                    No Category Found
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                        <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                            <div class="offcanvas-header navbar-shadow">
                                <h5>Menu</h5>
                                <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav">
                                    <!--<li class="nav-item dropdown dropdown-mega">-->
                                    <!--    <a class="nav-link dropdown-toggle ps-xl-2 ps-0" href="javascript:void(0)"-->
                                    <!--        data-bs-toggle="dropdown">Mega Menu</a>-->

                                    <!--    <div class="dropdown-menu dropdown-menu-2">-->
                                    <!--        <div class="row">-->
                                    <!--            <div class="dropdown-column col-xl-3">-->
                                    <!--                <h5 class="dropdown-header">Daily Vegetables</h5>-->
                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Beans &-->
                                    <!--                    Brinjals</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Broccoli-->
                                    <!--                    & Cauliflower</a>-->

                                    <!--                <a href="shop-left-sidebar.html" class="dropdown-item">Chilies,-->
                                    <!--                    Garlic</a>-->

                                    <!--                <a class="dropdown-item"-->
                                    <!--                    href="shop-left-sidebar.html">Vegetables & Salads</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Gourd,-->
                                    <!--                    Cucumber</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Herbs &-->
                                    <!--                    Sprouts</a>-->

                                    <!--                <a href="demo-personal-portfolio.html"-->
                                    <!--                    class="dropdown-item">Lettuce & Leafy</a>-->
                                    <!--            </div>-->

                                    <!--            <div class="dropdown-column col-xl-3">-->
                                    <!--                <h5 class="dropdown-header">Baby Tender</h5>-->
                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Beans &-->
                                    <!--                    Brinjals</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Broccoli-->
                                    <!--                    & Cauliflower</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Chilies,-->
                                    <!--                    Garlic</a>-->

                                    <!--                <a class="dropdown-item"-->
                                    <!--                    href="shop-left-sidebar.html">Vegetables & Salads</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Gourd,-->
                                    <!--                    Cucumber</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Potatoes-->
                                    <!--                    & Tomatoes</a>-->

                                    <!--                <a href="shop-left-sidebar.html" class="dropdown-item">Peas &-->
                                    <!--                    Corn</a>-->
                                    <!--            </div>-->

                                    <!--            <div class="dropdown-column col-xl-3">-->
                                    <!--                <h5 class="dropdown-header">Exotic Vegetables</h5>-->
                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Asparagus-->
                                    <!--                    & Artichokes</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Avocados-->
                                    <!--                    & Peppers</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Broccoli-->
                                    <!--                    & Zucchini</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Celery,-->
                                    <!--                    Fennel & Leeks</a>-->

                                    <!--                <a class="dropdown-item" href="shop-left-sidebar.html">Chilies &-->
                                    <!--                    Lime</a>-->
                                    <!--            </div>-->

                                    <!--            <div class="dropdown-column dropdown-column-img col-3"></div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</li>-->

                                    <!--<li class="nav-item dropdown">-->
                                    <!--    <a class="nav-link dropdown-toggle" href="javascript:void(0)"-->
                                    <!--        data-bs-toggle="dropdown">Blog</a>-->
                                    <!--    <ul class="dropdown-menu">-->
                                    <!--        <li>-->
                                    <!--            <a class="dropdown-item" href="blog-detail.html">Blog Detail</a>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <a class="dropdown-item" href="blog-grid.html">Blog Grid</a>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <a class="dropdown-item" href="blog-list.html">Blog List</a>-->
                                    <!--        </li>-->
                                    <!--    </ul>-->
                                    <!--</li>-->

                                    <!--<li class="nav-item dropdown new-nav-item">-->
                                    <!--<label class="new-dropdown">New</label>-->
                                    <!--    <a class="nav-link dropdown-toggle" href="javascript:void(0)"-->
                                    <!--        data-bs-toggle="dropdown">About Us</a>-->
                                    <!--    <ul class="dropdown-menu">-->

                                    <!--        <li>-->
                                    <!--            <a class="dropdown-item" href="{{ route('frontend.aboutUs') }}">About Us</a>-->
                                    <!--        </li>-->

                                    <!--<li>-->
                                    <!--    <a class="dropdown-item" href="faq.html">Faq</a>-->
                                    <!--</li>-->

                                    <!--    </ul>-->
                                    <!--</li>-->

                                    <li class="nav-item dropdown">
                                        <a class="nav-link " href="{{ route('frontend.aboutUs') }}">About Us</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link " href="{{ route('frontend.contactUs.create') }}">Contact
                                            Us</a>
                                    </li>
                                    @auth
                                        {{-- <li class="nav-item dropdown">
                                        <a class="nav-link " href="{{route('user.order.track')}}">Track Order</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link " href="{{route('user.withdraw.create')}}">Withdraw Commission</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link " href="{{route('user.order.index')}}">Orders Record</a>
                                    </li> --}}
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="right-nav">
                        <div class="nav-number">
                            <img src="{{asset('assets/images/icon/music.png')}}" class="img-fluid blur-up lazyload" alt="">
                            <span>(123) 456 7890</span>
                        </div>
                        <a href="javascript:void(0)" class="btn theme-bg-color ms-3 fire-button"
                            data-bs-toggle="modal" data-bs-target="#deal-box">
                            <div class="fire">
                                <img src="{{asset('assets/images/icon/hot-sale.png')}}" class="img-fluid" alt="">
                            </div>
                            <span>Hot Deals</span>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->

{{-- for mobile  --}}
<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class="{{ Request::routeIs('/') ? 'active' : '' }}">
            <a href="{{ url('/') }}">
                <i class="iconly-Home icli"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="mobile-category ">
            <a href="javascript:void(0)">
                <i class="iconly-Category icli js-link"></i>
                <span>Category</span>
            </a>
        </li>

        <li {{ Request::routeIs('frontend.all_product') ? 'active' : '' }}>
            <a href="{{ route('frontend.all_product') }}" class="search-box">
                <i class="iconly-Search icli"></i>
                <span>Search</span>
            </a>
        </li>

        {{-- <li>
            <a href="{{ route('home') }}#pills-order" class="nav-link" id="pills-order-tab" data-bs-toggle="tab"
            data-bs-target="#pills-order"  role="tab"
            aria-controls="pills-order" aria-selected="false">
                <i class="iconly-Heart icli"></i>
                <span>Orders</span>
            </a>
        </li> --}}
        @auth
            <li {{ Request::routeIs('order.inProgress') ? 'active' : '' }}>
                <a href="{{ route('order.inProgress') }}">
                    <i class="iconly-Bag-2 icli"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="">
                    <i class="iconly-Profile icli"></i>
                    <span>Profile</span>
                </a>
            </li>
        @endauth

        {{-- <li>
            <a href="{{ route('cart') }}">
                <i class="iconly-Bag-2 icli fly-cate"></i>
                <span>Cart</span>
            </a>
        </li> --}}
    </ul>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <script type="text/javascript">
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
</script>
{{-- /for mobile  --}}
