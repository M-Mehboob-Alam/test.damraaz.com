@extends('layouts.app')
@section('content')
<style>
    .circular-progress {
        /* margin-top: 60px; */
        position: relative;
        display: inline-block;
        width: 140px;
        height: 140px;
        border-radius: 50%;
    }

    .circular-progress svg {
        transform: rotate(270deg);
    }

    .circular-progress circle {
        stroke-width: 5;
        fill: none;
        stroke-linecap: round;
    }

    .circular-progress circle:nth-of-type(1) {
        stroke: #dee2e6;
    }

    .circular-progress circle:nth-of-type(2) {
        stroke:var(--theme-color);
        stroke-dasharray: 251.4285714286;
        stroke-dashoffset: 75.4285714286;
    }

    .circular-progress .pct {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
    <!-- home section start -->
    {{-- <section class="home-section-2 home-section-small section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-6 col-md-8">
                    <div class="home-contain h-100">
                        <img src="{{ asset('assets/images/veg-3/home/1.png') }}" class="img-fluid bg-img blur-up lazyload"
                            alt="">
                        <div class="home-detail home-width p-center-left position-relative">
                            <div>
                                <h6 class="ls-expanded theme-color">ORGANIC</h6>
                                <h1 class="fw-bold w-100">100% Fresh</h1>
                                <h3 class="text-content fw-light">Accessoriess</h3>
                                <p class="d-sm-block d-none">Free shipping on all your order. we deliver you enjoy</p>
                                <button onclick="location.href = '{{ route('frontend.all_product') }}';"
                                    class="btn mt-sm-4 btn-2 theme-bg-color text-white mend-auto btn-2-animation">Shop
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-4 ratio_medium d-md-block d-none">
                    <div class="home-contain home-small h-100">
                        <div class="h-100">
                            <img src="{{ asset('assets/images/veg-3/home/2.png') }}"
                                class="img-fluid bg-img blur-up lazyload" alt="">
                        </div>
                        <div class="home-detail text-center p-top-center w-100 text-white">
                            <div>
                                <h4 class="fw-bold">Fresh & 100% Organic</h4>
                                <h5 class="text-center">famer's market</h5>
                                <button class="btn bg-white theme-color mt-3 home-button mx-auto btn-2"
                                    onclick="location.href = '{{ route('frontend.all_product') }}';">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 ratio_65 d-xxl-block d-none">
                    <div class="row g-3">
                        <div class="col-xxl-12 col-sm-6">
                            <div class="home-contain">
                                <a href="{{ route('frontend.all_product') }}">
                                    <img src="{{ asset('assets/images/veg-3/home/3.png') }}"
                                        class="img-fluid bg-img blur-up lazyload" alt="">
                                </a>
                                <div class="home-detail text-white p-center text-center">
                                    <div>
                                        <h4 class="text-center">Organic Lifestyle</h4>
                                        <h5 class="text-center">Best Weekend Sales</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12 col-sm-6">
                            <div class="home-contain">
                                <a href="{{ route('frontend.all_product') }}">
                                    <img src="{{ asset('assets/images/veg-3/home/4.png') }}"
                                        class="img-fluid bg-img blur-up lazyload" alt="">
                                </a>
                                <div class="home-detail text-white w-50 p-center-left home-p-sm">
                                    <div>
                                        <h4 class="fw-bold">Safe food saves lives</h4>
                                        <h5>Discount Offer</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Poster Section End -->
    <section>
        <div class="container-fluid-lg">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($sliders as $slider)
                        <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}" data-bs-interval="10000">
                            <img src="{{ asset($slider->image) }}" class="d-block w-100 rounded" alt="not found">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!--marquee section-->
    <section>
        <div class="container-fluid-lg">
            <marquee class="theme-bg-color  p-2 text-white rounded" scrollamount="7" direction="left">
                {{ $marquee->message ?? '' }}</marquee>
        </div>
    </section>
    <!--marquee section end-->
@auth
<section>
    <div class="container">
        <div class="row">
            <div class="col-6 pt-5">
                <h4>Completed Orders</h4>
            </div>
            <div class="col-6 mx-auto d-flex">
                <div class="circular-progress">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' aria-labelledby='title' role='graphic'>
                        <circle cx="50" cy="50" r="40"></circle>
                        <circle cx="50" cy="50" r="40" id='pct-ind'></circle>
                    </svg>
                    
                    <p class="pct">
                        @if($countCompletedOrders<10)  
                        {{$countCompletedOrders}}/10
                        @else
                            <button onclick=location.href="{{route('user.bonus.claim')}}" title="Claim Bonus" class=" btn theme-bg-color  btn-md  text-white fw-bold ">Claim</button>
                                                   
                        @endif
                    </p>
                </div>
                {{-- <div class="my-auto">

                </div> --}}
            </div>
        </div>
    </div>
</section>
@endauth
    <!-- Product Sction Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="title title-flex-2">
                <h2>Our Products</h2>
                <ul class="nav nav-tabs tab-style-color-2 tab-style-color" id="myTab">
                    <li class="nav-item">
                        <button class="nav-link btn active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                            type="button">All</button>
                    </li>
                    @foreach ($tabCategories as $cateTab)
                        <li class="nav-item">
                            <button class="nav-link btn" id="{{ $cateTab->id }}{{ $cateTab->id }}"
                                data-bs-toggle="tab" data-bs-target="#tab{{ $cateTab->id }}"
                                type="button">{{ $cateTab->name ?? '' }}</button>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a href="{{ route('frontend.all_product') }}" class="nav-link btn " id="all-products">See
                            More</a>
                    </li>

                    <!--<li class="nav-item">-->
                    <!--    <button class="nav-link btn" id="cooking-tab" data-bs-toggle="tab" data-bs-target="#cooking"-->
                    <!--        type="button"> Cooking</button>-->
                    <!--</li>-->

                    <!--<li class="nav-item">-->
                    <!--    <button class="nav-link btn" id="fruits-tab" data-bs-toggle="tab" data-bs-target="#fruits"-->
                    <!--        type="button">Fruits & Accessoriess</button>-->
                    <!--</li>-->
                </ul>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row g-8">
                        @forelse($products as $id=> $product)
                            @php
                                $wishlists = session('wishlist');
                                $search = false;
                                if ($wishlists) {
                                    $search = array_key_exists($product->id, $wishlists);
                                }
                            @endphp
                            <div class="col-xxl-2 col-lg-3 col-md-4 col-6 wow fadeInUp">
                                <div class="product-box-4">
                                    <div class="product-image">
                                        <div class="label-flex">
                                            <a href="{{ route('add.to.wishlist', $product->id) }}"
                                                class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                                {{-- <i class="iconly-Heart icli"></i> --}}
                                                <i
                                                    class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }} fa-heart"></i>

                                            </a>
                                        </div>
                                        @php
                                            $image = json_decode($product->images);
                                        @endphp
                                        <a href="{{ route('product.show', $product->id) }}">
                                            <img src="{{ asset($image[0]) }}" class="img-fluid" alt="not found">
                                        </a>

                                        <ul class="option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#viewDetail{{ $product->id }}">
                                                    <i class="iconly-Show icli"></i>
                                                </a>
                                            </li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Buy Now">
                                                <form action="{{ route('add.to.cart', $product->id) }}">
                                                    <input type="hidden" name="checkout" value="yes">
                                                    <button class="btn" type="submit">
                                                        <i class="iconly-Bag-2 icli"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product-detail">
                                        <!--<ul class="rating">-->
                                        <!--    <li>-->
                                        <!--        <i data-feather="star" class="fill"></i>-->
                                        <!--    </li>-->
                                        <!--    <li>-->
                                        <!--        <i data-feather="star" class="fill"></i>-->
                                        <!--    </li>-->
                                        <!--    <li>-->
                                        <!--        <i data-feather="star"></i>-->
                                        <!--    </li>-->
                                        <!--    <li>-->
                                        <!--        <i data-feather="star"></i>-->
                                        <!--    </li>-->
                                        <!--    <li>-->
                                        <!--        <i data-feather="star"></i>-->
                                        <!--    </li>-->
                                        <!--</ul>-->
                                        <a href="{{ route('product.show', $product->id) }}">
                                            <h5 class="name">{{ $product->name ?? '' }}</h5>
                                        </a>
                                        <h5 class="price theme-color">Rs. {{ $product->discount_price ?? '' }}<del>Rs.
                                                {{ $product->price ?? '' }}</del></h5>
                                        <form method="get" class="price-qty"
                                            action="{{ route('add.to.cart', $product->id) }}">
                                            <div class="counter-number">
                                                <div class="counter">
                                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </div>
                                                    <input class="form-control input-number qty-input" type="number"
                                                        name="quantity" value="0">
                                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </div>
                                                    <div data-href="{{ route('product.show', $product->id) }}"
                                                        class="qty-right-plus product_item" data-type="plus"
                                                        data-field="">
                                                        <i class="fas fa-share"></i>
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- <!--data-bs-toggle="modal" data-bs-target="#addToCart{{$product->id}}"--> --}}

                                            <button type="submit" class="buy-button buy-button-2 btn btn-cart">
                                                <i class="iconly-Buy icli text-white m-0"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick View Modal Box Start -->
                            <div class="modal fade theme-modal view-modal " id="viewDetail{{ $product->id }}"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                    <div class="modal-content">
                                        <div class="modal-header p-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-sm-4 g-2">
                                                <div class="col-lg-6">
                                                    <div class="slider-image">
                                                        <img src="{{ asset($image[0]) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="right-sidebar-modal">
                                                        <h4 class="title-name">{{ $product->name ?? '' }}</h4>
                                                        <h4 class="price">Rs. {{ $product->discount_price ?? '' }}
                                                            <del>Rs.
                                                                {{ $product->price ?? '' }}</del>
                                                        </h4>

                                                        <!--<div class="product-rating">-->
                                                        <!--    <ul class="rating">-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star" class="fill"></i>-->
                                                        <!--        </li>-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star" class="fill"></i>-->
                                                        <!--        </li>-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star" class="fill"></i>-->
                                                        <!--        </li>-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star" class="fill"></i>-->
                                                        <!--        </li>-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star"></i>-->
                                                        <!--        </li>-->
                                                        <!--    </ul>-->
                                                        <!--    <span class="ms-2">8 Reviews</span>-->
                                                        <!--    <span class="ms-2 text-danger">6 sold in last 16 hours</span>-->
                                                        <!--</div>-->

                                                        <div class="product-detail">
                                                            <h4>Product Details :</h4>
                                                            <p>{{ $product->info }}</p>
                                                        </div>

                                                        <ul class="brand-list">
                                                            <!--<li>-->
                                                            <!--    <div class="brand-box">-->
                                                            <!--        <h5>Brand Name:</h5>-->
                                                            <!--        <h6>Black Forest</h6>-->
                                                            <!--    </div>-->
                                                            <!--</li>-->

                                                            <li>
                                                                <div class="brand-box">
                                                                    <h5>Product Code:</h5>
                                                                    <h6>DM{{ $product->id }}</h6>
                                                                </div>
                                                            </li>

                                                            <!--<li>-->
                                                            <!--    <div class="brand-box">-->
                                                            <!--        <h5>Product Type:</h5>-->
                                                            <!--        <h6>White Cream Cake</h6>-->
                                                            <!--    </div>-->
                                                            <!--</li>-->
                                                        </ul>

                                                        <!--<div class="select-size">-->
                                                        <!--    <h4>Cake Size :</h4>-->
                                                        <!--    <select class="form-select select-form-size">-->
                                                        <!--        <option selected>Select Size</option>-->
                                                        <!--        <option value="1.2">1/2 KG</option>-->
                                                        <!--        <option value="0">1 KG</option>-->
                                                        <!--        <option value="1.5">1/5 KG</option>-->
                                                        <!--        <option value="red">Red Roses</option>-->
                                                        <!--        <option value="pink">With Pink Roses</option>-->
                                                        <!--    </select>-->
                                                        <!--</div>-->

                                                        <div class="modal-button">
                                                            <button
                                                                onclick="location.href = '{{ route('add.to.cart', $product->id) }}';"
                                                                class="btn btn-md add-cart-button icon">Add
                                                                To Cart</button>
                                                            <button
                                                                onclick="location.href = '{{ route('product.show', $product->id) }}';"
                                                                class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                                                View More Details</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Quick View Modal Box End -->

                            <!-- add to cart -->
                            {{-- <div class="modal fade theme-modal view-modal " id="addToCart{{ $product->id }}"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
                                    <div class="modal-content">
                                        <div class="modal-header p-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-sm-4 g-2">
                                                <form method="get" action="{{ route('add.to.cart', $product->id) }}">
                                                    <div class="mb-3">
                                                        <label for="profit" class="form-label">Enter Your Profit</label>
                                                        <input type="number" name="profit" class="form-control"
                                                            id="profit" aria-describedby="emailHelp">
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-primary theme-bg-color view-button icon text-white fw-bold btn-md">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- add to cart -->
                        @empty
                            No product found
                        @endforelse
                    </div>
                </div>
                @foreach ($tabCategories as $cateTab)
                    <div class="tab-pane fade" id="tab{{ $cateTab->id }}" role="tabpanel"
                        aria-labelledby="{{ $cateTab->id }}{{ $cateTab->id }}">
                        <div class="row g-8">
                            @foreach ($cateTab->products as $cateProduct)
                                @php
                                    $wishlists = session('wishlist');
                                    $search = false;
                                    if ($wishlists) {
                                        $search = array_key_exists($cateProduct->id, $wishlists);
                                    }
                                @endphp
                                <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                                    <div class="product-box-4">
                                        <div class="product-image">
                                            <div class="label-flex">
                                                <a href="{{ route('add.to.wishlist', $cateProduct->id) }}"
                                                    class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                                    <i
                                                        class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }} fa-heart"></i>

                                                </a>
                                            </div>
                                            @php
                                                $image = json_decode($cateProduct->images);
                                            @endphp
                                            <a href="{{ route('product.show', $cateProduct->id) }}">
                                                <img src="{{ asset($image[0]) }}" class="img-fluid" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-backdrop="false"
                                                        data-bs-target="#viewCateProduct{{ $cateProduct->id }}">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Buy Now">
                                                    <form action="{{ route('add.to.cart', $cateProduct->id) }}">
                                                        <input type="hidden" name="checkout" value="yes">
                                                        <button class="btn" type="submit">
                                                            <i class="iconly-Bag-2 icli"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                <!--<li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                                                <!--    <a href="{{ route('add.to.compare', $product->id) }}">-->
                                                <!--        <i class="iconly-Swap icli"></i>-->
                                                <!--    </a>-->
                                                <!--</li>-->
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <!--<ul class="rating">-->
                                            <!--    <li>-->
                                            <!--        <i data-feather="star" class="fill"></i>-->
                                            <!--    </li>-->
                                            <!--    <li>-->
                                            <!--        <i data-feather="star" class="fill"></i>-->
                                            <!--    </li>-->
                                            <!--    <li>-->
                                            <!--        <i data-feather="star"></i>-->
                                            <!--    </li>-->
                                            <!--    <li>-->
                                            <!--        <i data-feather="star"></i>-->
                                            <!--    </li>-->
                                            <!--    <li>-->
                                            <!--        <i data-feather="star"></i>-->
                                            <!--    </li>-->
                                            <!--</ul>-->
                                            <a href="{{ route('product.show', $cateProduct->id) }}">
                                                <h5 class="name">{{ $cateProduct->name ?? '' }}</h5>
                                            </a>
                                            <h5 class="price theme-color">Rs.
                                                {{ $cateProduct->discount_price ?? '' }}<del>Rs.
                                                    {{ $cateProduct->price ?? '' }}</del></h5>
                                            <form method="get" class="price-qty"
                                                action="{{ route('add.to.cart', $cateProduct->id) }}">
                                                <div class="counter-number">
                                                    <div class="counter">
                                                        <div class="qty-left-minus" data-type="minus" data-field="">
                                                            <i class="fa-solid fa-minus"></i>
                                                        </div>
                                                        <input class="form-control input-number qty-input" type="number"
                                                            name="quantity" value="0">
                                                        <div class="qty-right-plus" data-type="plus" data-field="">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </div>
                                                        <div data-href="{{ route('product.show', $cateProduct->id) }}"
                                                            class="qty-right-plus product_item" data-type="plus"
                                                            data-field="">
                                                            <i class="fas fa-share"></i>
                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- <!--data-bs-toggle="modal" data-bs-target="#addToCart{{$product->id}}"--> --}}

                                                <button type="submit" class="buy-button buy-button-2 btn btn-cart">
                                                    <i class="iconly-Buy icli text-white m-0"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Quick View Modal Box for category product Start -->
                                <div class="modal fade theme-modal view-modal "
                                    id="viewCateProduct{{ $cateProduct->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                        <div class="modal-content">
                                            <div class="modal-header p-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-sm-4 g-2">
                                                    <div class="col-lg-6">
                                                        <div class="slider-image">
                                                            <img src="{{ asset($image[0]) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="right-sidebar-modal">
                                                            <h4 class="title-name">{{ $product->name ?? '' }}</h4>
                                                            <h4 class="price">Rs. {{ $product->discount_price ?? '' }}
                                                                <del>Rs.
                                                                    {{ $product->price ?? '' }}</del>
                                                            </h4>

                                                            <!--<div class="product-rating">-->
                                                            <!--    <ul class="rating">-->
                                                            <!--        <li>-->
                                                            <!--            <i data-feather="star" class="fill"></i>-->
                                                            <!--        </li>-->
                                                            <!--        <li>-->
                                                            <!--            <i data-feather="star" class="fill"></i>-->
                                                            <!--        </li>-->
                                                            <!--        <li>-->
                                                            <!--            <i data-feather="star" class="fill"></i>-->
                                                            <!--        </li>-->
                                                            <!--        <li>-->
                                                            <!--            <i data-feather="star" class="fill"></i>-->
                                                            <!--        </li>-->
                                                            <!--        <li>-->
                                                            <!--            <i data-feather="star"></i>-->
                                                            <!--        </li>-->
                                                            <!--    </ul>-->
                                                            <!--    <span class="ms-2">8 Reviews</span>-->
                                                            <!--    <span class="ms-2 text-danger">6 sold in last 16 hours</span>-->
                                                            <!--</div>-->

                                                            <div class="product-detail">
                                                                <h4>Product Details :</h4>
                                                                <p>{{ $product->info }}</p>
                                                            </div>

                                                            <ul class="brand-list">
                                                                <!--<li>-->
                                                                <!--    <div class="brand-box">-->
                                                                <!--        <h5>Brand Name:</h5>-->
                                                                <!--        <h6>Black Forest</h6>-->
                                                                <!--    </div>-->
                                                                <!--</li>-->

                                                                <li>
                                                                    <div class="brand-box">
                                                                        <h5>Product Code:</h5>
                                                                        <h6>DM{{ $product->id }}</h6>
                                                                    </div>
                                                                </li>

                                                                <!--<li>-->
                                                                <!--    <div class="brand-box">-->
                                                                <!--        <h5>Product Type:</h5>-->
                                                                <!--        <h6>White Cream Cake</h6>-->
                                                                <!--    </div>-->
                                                                <!--</li>-->
                                                            </ul>

                                                            <!--<div class="select-size">-->
                                                            <!--    <h4>Cake Size :</h4>-->
                                                            <!--    <select class="form-select select-form-size">-->
                                                            <!--        <option selected>Select Size</option>-->
                                                            <!--        <option value="1.2">1/2 KG</option>-->
                                                            <!--        <option value="0">1 KG</option>-->
                                                            <!--        <option value="1.5">1/5 KG</option>-->
                                                            <!--        <option value="red">Red Roses</option>-->
                                                            <!--        <option value="pink">With Pink Roses</option>-->
                                                            <!--    </select>-->
                                                            <!--</div>-->

                                                            <div class="modal-button">
                                                                <button
                                                                    onclick="location.href = '{{ route('add.to.cart', $product->id) }}';"
                                                                    class="btn btn-md add-cart-button icon">Add
                                                                    To Cart</button>
                                                                <button
                                                                    onclick="location.href = '{{ route('product.show', $product->id) }}';"
                                                                    class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                                                    View More Details</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Quick View Modal Box for category Product End -->
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!--<div class="tab-pane fade" id="fruits" role="tabpanel" aria-labelledby="fruits-tab">-->
                <!--    <div class="row g-8">-->
                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="#">-->
                <!--                        <img src="{{ asset('assets/images/veg-3/cate1/8.png') }}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="#">-->
                <!--                                <i class="iconly-Swap icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->

                <!--                <div class="product-detail">-->
                <!--                    <ul class="rating">-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="#">-->
                <!--                        <h5 class="name">Apple</h5>-->
                <!--                    </a>-->
                <!--                    <h5 class="price theme-color">$70.21<del>$65.25</del></h5>-->
                <!--                    <div class="price-qty">-->
                <!--                        <div class="counter-number">-->
                <!--                            <div class="counter">-->
                <!--                                <div class="qty-left-minus" data-type="minus" data-field="">-->
                <!--                                    <i class="fa-solid fa-minus"></i>-->
                <!--                                </div>-->
                <!--                                <input class="form-control input-number qty-input" type="text"-->
                <!--                                    name="quantity" value="0">-->
                <!--                                <div class="qty-right-plus" data-type="plus" data-field="">-->
                <!--                                    <i class="fa-solid fa-plus"></i>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->

                <!--                        <button class="buy-button buy-button-2 btn btn-cart">-->
                <!--                            <i class="iconly-Buy icli text-white m-0"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="#">-->
                <!--                        <img src="{{ asset('assets/images/veg-3/cate1/14.png') }}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="#">-->
                <!--                                <i class="iconly-Swap icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->

                <!--                <div class="product-detail">-->
                <!--                    <ul class="rating">-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="#">-->
                <!--                        <h5 class="name">Passion</h5>-->
                <!--                    </a>-->
                <!--                    <h5 class="price theme-color">$70.21<del>$65.25</del></h5>-->
                <!--                    <div class="price-qty">-->
                <!--                        <div class="counter-number">-->
                <!--                            <div class="counter">-->
                <!--                                <div class="qty-left-minus" data-type="minus" data-field="">-->
                <!--                                    <i class="fa-solid fa-minus"></i>-->
                <!--                                </div>-->
                <!--                                <input class="form-control input-number qty-input" type="text"-->
                <!--                                    name="quantity" value="0">-->
                <!--                                <div class="qty-right-plus" data-type="plus" data-field="">-->
                <!--                                    <i class="fa-solid fa-plus"></i>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->

                <!--                        <button class="buy-button buy-button-2 btn btn-cart">-->
                <!--                            <i class="iconly-Buy icli text-white m-0"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="#">-->
                <!--                        <img src="{{ asset('assets/images/veg-3/cate1/16.png') }}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="#">-->
                <!--                                <i class="iconly-Swap icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->

                <!--                <div class="product-detail">-->
                <!--                    <ul class="rating">-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="#">-->
                <!--                        <h5 class="name">Blackberry</h5>-->
                <!--                    </a>-->
                <!--                    <h5 class="price theme-color">$70.21<del>$65.25</del></h5>-->
                <!--                    <div class="price-qty">-->
                <!--                        <div class="counter-number">-->
                <!--                            <div class="counter">-->
                <!--                                <div class="qty-left-minus" data-type="minus" data-field="">-->
                <!--                                    <i class="fa-solid fa-minus"></i>-->
                <!--                                </div>-->
                <!--                                <input class="form-control input-number qty-input" type="text"-->
                <!--                                    name="quantity" value="0">-->
                <!--                                <div class="qty-right-plus" data-type="plus" data-field="">-->
                <!--                                    <i class="fa-solid fa-plus"></i>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->

                <!--                        <button class="buy-button buy-button-2 btn btn-cart">-->
                <!--                            <i class="iconly-Buy icli text-white m-0"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="#">-->
                <!--                        <img src="{{ asset('assets/images/veg-3/cate1/7.png') }}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="#">-->
                <!--                                <i class="iconly-Swap icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->

                <!--                <div class="product-detail">-->
                <!--                    <ul class="rating">-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="#">-->
                <!--                        <h5 class="name">Peru</h5>-->
                <!--                    </a>-->
                <!--                    <h5 class="price theme-color">$70.21<del>$65.25</del></h5>-->
                <!--                    <div class="price-qty">-->
                <!--                        <div class="counter-number">-->
                <!--                            <div class="counter">-->
                <!--                                <div class="qty-left-minus" data-type="minus" data-field="">-->
                <!--                                    <i class="fa-solid fa-minus"></i>-->
                <!--                                </div>-->
                <!--                                <input class="form-control input-number qty-input" type="text"-->
                <!--                                    name="quantity" value="0">-->
                <!--                                <div class="qty-right-plus" data-type="plus" data-field="">-->
                <!--                                    <i class="fa-solid fa-plus"></i>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->

                <!--                        <button class="buy-button buy-button-2 btn btn-cart">-->
                <!--                            <i class="iconly-Buy icli text-white m-0"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="#">-->
                <!--                        <img src="{{ asset('assets/images/veg-3/cate1/9.png') }}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="#">-->
                <!--                                <i class="iconly-Swap icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->

                <!--                <div class="product-detail">-->
                <!--                    <ul class="rating">-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="#">-->
                <!--                        <h5 class="name">Apple</h5>-->
                <!--                    </a>-->
                <!--                    <h5 class="price theme-color">$70.21<del>$65.25</del></h5>-->
                <!--                    <div class="price-qty">-->
                <!--                        <div class="counter-number">-->
                <!--                            <div class="counter">-->
                <!--                                <div class="qty-left-minus" data-type="minus" data-field="">-->
                <!--                                    <i class="fa-solid fa-minus"></i>-->
                <!--                                </div>-->
                <!--                                <input class="form-control input-number qty-input" type="text"-->
                <!--                                    name="quantity" value="0">-->
                <!--                                <div class="qty-right-plus" data-type="plus" data-field="">-->
                <!--                                    <i class="fa-solid fa-plus"></i>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->

                <!--                        <button class="buy-button buy-button-2 btn btn-cart">-->
                <!--                            <i class="iconly-Buy icli text-white m-0"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="#">-->
                <!--                        <img src="{{ asset('assets/images/veg-3/cate1/13.png') }}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="#">-->
                <!--                                <i class="iconly-Swap icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->

                <!--                <div class="product-detail">-->
                <!--                    <ul class="rating">-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="#">-->
                <!--                        <h5 class="name">Strawberry</h5>-->
                <!--                    </a>-->
                <!--                    <h5 class="price theme-color">$70.21<del>$65.25</del></h5>-->
                <!--                    <div class="price-qty">-->
                <!--                        <div class="counter-number">-->
                <!--                            <div class="counter">-->
                <!--                                <div class="qty-left-minus" data-type="minus" data-field="">-->
                <!--                                    <i class="fa-solid fa-minus"></i>-->
                <!--                                </div>-->
                <!--                                <input class="form-control input-number qty-input" type="text"-->
                <!--                                    name="quantity" value="0">-->
                <!--                                <div class="qty-right-plus" data-type="plus" data-field="">-->
                <!--                                    <i class="fa-solid fa-plus"></i>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->

                <!--                        <button class="buy-button buy-button-2 btn btn-cart">-->
                <!--                            <i class="iconly-Buy icli text-white m-0"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="#">-->
                <!--                        <img src="{{ asset('assets/images/veg-3/cate1/12.png') }}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="#">-->
                <!--                                <i class="iconly-Swap icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->

                <!--                <div class="product-detail">-->
                <!--                    <ul class="rating">-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star" class="fill"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="#">-->
                <!--                        <h5 class="name">Bell pepper</h5>-->
                <!--                    </a>-->
                <!--                    <h5 class="price theme-color">$70.21<del>$65.25</del></h5>-->
                <!--                    <div class="price-qty">-->
                <!--                        <div class="counter-number">-->
                <!--                            <div class="counter">-->
                <!--                                <div class="qty-left-minus" data-type="minus" data-field="">-->
                <!--                                    <i class="fa-solid fa-minus"></i>-->
                <!--                                </div>-->
                <!--                                <input class="form-control input-number qty-input" type="text"-->
                <!--                                    name="quantity" value="0">-->
                <!--                                <div class="qty-right-plus" data-type="plus" data-field="">-->
                <!--                                    <i class="fa-solid fa-plus"></i>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->

                <!--                        <button class="buy-button buy-button-2 btn btn-cart">-->
                <!--                            <i class="iconly-Buy icli text-white m-0"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->


            </div>
        </div>
    </section>
    <!-- Product Sction End -->
    {{-- <!-- Category Section Start -->
    <section class="category-section-2">
        <div class="container-fluid-lg">
            <div class="title d-flex">
                <h2>Shop By Categories</h2>
                <div class="ms-auto mb-5 mt-0">
                    <button class="  btn theme-bg-color  btn-md  text-white fw-bold "
                      onclick=location.href="{{ route('category.index') }}">See More</button>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="category-slider arrow-slider">
                        @forelse($categories as $category)
                            <div>
                                <div class="shop-category-box border-0 wow fadeIn">
                                    <a href="{{ route('category.show', $category->id) }}" class="circle-1">
                                        <img src="{{asset($category->image) }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>{{ $category->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        @empty
                            Category not found
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Category Section End --> --}}

    <!-- Value Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Best Offer</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="three-slider arrow-slider ratio_65">
                        @foreach ($offerProducts as $offer)
                            <div class="">
                                @php
                                    $product = \App\Models\Product::where('offer', $offer)->first();
                                    $image = json_decode($product->images);
                                @endphp
                                <div class="offer-banner hover-effect shadow border">
                                    <img src="{{ asset($image[0]) }}" class="img-fluid bg-img blur-up lazyload"
                                        alt="">
                                    <div class="banner-detail">
                                        <h5 class="theme-color">{{ ucfirst($product->offer ?? '') }}</h5>
                                        <!--<h6>Fresh Accessories</h6>-->
                                    </div>
                                    <div class="offer-box">
                                        <button
                                            onclick="location.href = '{{ route('frontend.product.offer', $product->offer??'') }}';"
                                            class="btn-category btn theme-bg-color text-white">View more</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Value Section End -->

    <!--Deal Section Start -->
    <section class="deal-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Deal Of The Week</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="three-slider-1 arrow-slider">
                        @foreach ($dealProducts as $deal)
                            @php
                                $image = json_decode($deal->images);
                            @endphp
                            <div>
                                <div class="deal-box wow fadeInUp">
                                    <a href="{{ route('frontend.all_product') }}" class="category-image order-sm-2">
                                        <img src="{{ asset($image[0]) }}" class="img-fluid blur-up lazyload"
                                            alt="">
                                    </a>

                                    <div class="deal-detail order-sm-1">
                                        <button class="buy-box btn theme-bg-color text-white btn-cart">
                                            <i class="iconly-Buy icli m-0"></i>
                                        </button>
                                        <div class="hot-deal">
                                            <span>{{ $deal->deal ?? '' }}</span>
                                        </div>
                                        <ul class="rating">
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star"></i>
                                            </li>
                                        </ul>
                                        <a href="{{ route('frontend.all_product') }}" class="text-title">
                                            <h5>{{ $deal->name ?? '' }}</h5>
                                        </a>
                                        <h5 class="price">Rs. {{ $deal->price ?? '' }} <span> Rs.
                                                {{ $deal->discount_price ?? '' }}</span></h5>
                                        <div class="progress custom-progressbar">
                                            <div class="progress-bar" style="width: 50%" role="progressbar"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="item">Sold: <span>30 Items</span></h4>
                                        <h4 class="offer">Hurry up offer end in</h4>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                        <script>
                                          // Set the date we're counting down to
                                          var countDownDate{{ $deal->id }} = new Date("{{ $deal->updated_at->addDays(7) }}").getTime();
                                        
                                          // Update the countdown every 1 second
                                          var x{{ $deal->id }} = setInterval(function() {
                                            // Get the current date and time
                                            var now{{ $deal->id }} = new Date().getTime();
                                        
                                            // Find the distance between now and the countdown date
                                            var distance{{ $deal->id }} = countDownDate{{ $deal->id }} - now{{ $deal->id }};
                                        
                                            // Calculate time remaining in days, hours, minutes, and seconds
                                            var days{{ $deal->id }} = Math.floor(distance{{ $deal->id }} / (1000 * 60 * 60 * 24));
                                            var hours{{ $deal->id }} = Math.floor((distance{{ $deal->id }} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            var minutes{{ $deal->id }} = Math.floor((distance{{ $deal->id }} % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds{{ $deal->id }} = Math.floor((distance{{ $deal->id }} % (1000 * 60)) / 1000);
                                        
                                            // Update the HTML elements with the calculated values
                                            $("#days{{ $deal->id }}").text(days{{ $deal->id }});
                                            $("#hours{{ $deal->id }}").text(hours{{ $deal->id }});
                                            $("#minutes{{ $deal->id }}").text(minutes{{ $deal->id }});
                                            $("#seconds{{ $deal->id }}").text(seconds{{ $deal->id }});
                                        
                                            // If the countdown is over, display "EXPIRED"
                                            if (distance{{ $deal->id }} < 0) {
                                              clearInterval(x{{ $deal->id }});
                                              $("#days{{ $deal->id }}").text('-');
                                              $("#hours{{ $deal->id }}").text('-');
                                              $("#minutes{{ $deal->id }}").text('-');
                                              $("#seconds{{ $deal->id }}").text('-');
                                            }
                                          }, 1000);
                                        </script>
                                        
                                        <div class="timer" data-hours="1" data-minutes="2" data-seconds="3">
                                            <ul>
                                                <li>
                                                    <div class="counter">
                                                        <div class="days" id="days{{ $deal->id }}">
                                                            <h6>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="counter">
                                                        <div class="hours" id="hours{{ $deal->id }}">
                                                            <h6></h6>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="counter">
                                                        <div class="minutes" id="minutes{{ $deal->id }}">
                                                            <h6></h6>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="counter">
                                                        <div class="seconds" id="seconds{{ $deal->id }}">
                                                            <h6></h6>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Deal Section End -->



    {{-- <!-- Banner Section Start -->
    <section class="banner-section">
        <div class="container-fluid-lg">
            <div class="row gy-xl-0 gy-3">
                <div class="col-xl-6">
                    <div class="banner-contain-3 hover-effect">
                        <img src="{{ asset('assets/images/veg-3/banner/1.png') }}" class="bg-img img-fluid"
                            alt="">
                        <div
                            class="banner-detail banner-details-dark text-white p-center-left w-50 position-relative mend-auto">
                            <div>
                                <h6 class="ls-expanded text-uppercase">Premium</h6>
                                <h3 class="mb-sm-3 mb-1">Fresh Accessories & Daily Eating</h3>
                                <h4>Get Extra 50% Off</h4>
                                <button class="btn theme-color bg-white btn-md fw-bold mt-sm-3 mt-1 mend-auto"
                                    onclick="location.href = '{{ route('frontend.all_product') }}';">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="banner-contain-3 hover-effect">
                        <img src="{{ asset('assets/images/veg-3/banner/2.png') }}" class="bg-img img-fluid"
                            alt="">
                        <div class="banner-detail text-dark p-center-left w-50 position-relative mend-auto">
                            <div>
                                <h6 class=" ls-expanded text-uppercase">available</h6>
                                <h3 class="mb-sm-3 mb-1">100% Natural & Healthy Fruits</h3>
                                <h4 class="text-content">Weekend Special</h4>
                                <button class="btn theme-bg-color text-white btn-md fw-bold mt-sm-3 mt-1 mend-auto"
                                    onclick="location.href = '{{ route('frontend.all_product') }}';">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Banner Section End --> --}}

    <!-- Product Section Start -->
    <section class="product-section-2">
        <div class="container-fluid-lg">
            <div class="row gy-sm-5 gy-4">
                <div class="col-xxl-3 col-md-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title title-border d-block">
                                    <h3>NEW PRODUCTS</h3>
                                        <!-- <div>
                                            <a href="{{ route('product.newProduct') }}" class="btn bg-theme">View All</a>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('product.newProduct') }}" class="">View All</a>
                                </div>
                            </div>

                            <div class="product-category-1 arrow-slider-2">
                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        @foreach ($newProducts as $newProduct)
                                            @php
                                                $wishlists = session('wishlist');
                                                $search = false;
                                                if ($wishlists) {
                                                    $search = array_key_exists($newProduct->id, $wishlists);
                                                }
                                            @endphp
                                            <div class="col-12">
                                                <div class="product-box-4 wow fadeInUp">
                                                    @php $image=json_decode($newProduct->images)@endphp
                                                    <a href="shop-left-sidebar.html" class="product-image">
                                                        <img src="{{ asset($image[0]) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                    <div class="product-details">
                                                        {{-- <ul class="rating">
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul> --}}
                                                        <a href="product-left-thumbnail.html">
                                                            <h4 class="name">{{ $newProduct->name ?? '' }}</h4>
                                                        </a>
                                                        <h5 class="price">Rs. {{ $newProduct->price ?? '' }}<del>Rs.
                                                                {{ $newProduct->discount_price ?? '' }}</del></h5>
                                                        <ul class="option">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Add to Cart">
                                                                <a href="{{ route('add.to.cart', $newProduct->id) }}">
                                                                    <i class="iconly-Buy icli"></i>
                                                                </a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Quick View">
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#newProduct{{ $newProduct->id }}">
                                                                    <i class="iconly-Show icli"></i>
                                                                </a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Wishlist">
                                                                <a
                                                                    href="{{ route('add.to.wishlist', $newProduct->id) }}">
                                                                    <i
                                                                        class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }} fa-heart"></i>

                                                                </a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Buy Now">
                                                                <form
                                                                    action="{{ route('add.to.cart', $newProduct->id) }}">
                                                                    <input type="hidden" name="checkout" value="yes">
                                                                    <button class="btn" type="submit">
                                                                        <i class="iconly-Bag-2 icli"></i>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            {{-- <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/2.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
                                                    <ul class="rating">
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul>
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Red onion</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp pb-1" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/3.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
                                                    <ul class="rating">
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul>
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Carrot</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title title-border d-block">
                                        <h3>TOP SELLING PRODUCT</h3>
                                        <!-- <div>
                                            <a href="{{ route('product.topProduct') }}" class="btn bg-theme">View All</a>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('product.topProduct') }}" class="">View All</a>
                                </div>
                            </div>

                            <div class="product-category-1 arrow-slider-2">
                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        @foreach ($tops as $top)
                                            @php
                                                $wishlists = session('wishlist');
                                                $search = false;
                                                if ($wishlists) {
                                                    $search = array_key_exists($top->product_id, $wishlists);
                                                }
                                            @endphp
                                            <div class="col-12">
                                                <div class="product-box-4 wow fadeInUp">
                                                    @php $image=json_decode($top->product->images)@endphp
                                                    <a href="{{ route('product.show', $top->product_id) }}"
                                                        class="product-image">
                                                        <img src="{{ asset($image[0]) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                    <div class="product-details">
                                                        {{-- <ul class="rating">
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul> --}}
                                                        <a href="product-left-thumbnail.html">
                                                            <h4 class="name">{{ $top->product->name ?? '' }}</h4>
                                                        </a>
                                                        <h5 class="price">Rs. {{ $top->product->price ?? '' }}<del>Rs.
                                                                {{ $top->product->discount_price ?? '' }}</del></h5>
                                                        <ul class="option">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Add to Cart">
                                                                <a href="{{ route('add.to.cart', $top->product_id) }}">
                                                                    <i class="iconly-Buy icli"></i>
                                                                </a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Quick View">
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#viewTopProduct{{ $top->product_id }}">
                                                                    <i class="iconly-Show icli"></i>
                                                                </a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Wishlist">
                                                                <a
                                                                    href="{{ route('add.to.wishlist', $top->product_id) }}">
                                                                    <i
                                                                        class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }} fa-heart"></i>

                                                                </a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Buy Now">
                                                                <form
                                                                    action="{{ route('add.to.cart', $top->product->id) }}">
                                                                    <input type="hidden" name="checkout" value="yes">
                                                                    <button class="btn" type="submit">
                                                                        <i class="iconly-Bag-2 icli"></i>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            {{-- <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!--Banner Section Start -->
    <section class="banner-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain-3 section-b-space section-t-space hover-effect">
                        <img src="{{ asset('assets/images/veg-3/banner/3.png') }}" class="img-fluid bg-img"
                            alt="">
                        <div class="banner-detail p-center text-dark position-relative text-center p-0">
                            <div>
                                <h4 class="ls-expanded text-uppercase theme-color">Try Our New</h4>
                                <h2 class="my-3">100% Organic Best Quality Best Price</h2>
                                <h4 class="text-content fw-300">Best Damraaz Food Quality</h4>
                                <button class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold"
                                    onclick="location.href = '{{ route('frontend.all_product') }}';">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="title d-flex">
                <h2>Top Products</h2>
                <div class="ms-auto mb-1 mt-0">
                    <button class=" btn theme-bg-color  btn-md  text-white fw-bold "
                      onclick=location.href="{{ route('product.topProduct') }}">See More</button>

                </div>
            </div>

            <div class="slider-6 img-slider slick-slider-1 arrow-slider">
                @foreach ($topProducts as $pro)
                    @php
                        $wishlists = session('wishlist');
                        $search = false;
                        if ($wishlists) {
                            $search = array_key_exists($pro->product->id, $wishlists);
                        }
                    @endphp
                    <div>
                        <div class="product-box-4 wow fadeInUp">
                            <div class="product-image">
                                <div class="label-flex">
                                    <a href="{{ route('add.to.wishlist', $pro->product_id) }}"
                                        class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i
                                            class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }} fa-heart"></i>

                                    </a>
                                </div>
                                @php
                                    $image = json_decode($pro->product->images);
                                @endphp
                                <a href="{{route("product.show",$pro->product_id)}}">
                                    <img src="{{ asset($image[0]) }}" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Buy Now">
                                        <form action="{{ route('add.to.cart', $pro->product->id) }}">
                                            <input type="hidden" name="checkout" value="yes">
                                            <button class="btn" type="submit">
                                                <i class="iconly-Bag-2 icli"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <!--<li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                                    <!--    <a href="#">-->
                                    <!--        <i class="iconly-Swap icli"></i>-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                </ul>
                            </div>

                            <div class="product-detail">
                                <!--<ul class="rating">-->
                                <!--    <li>-->
                                <!--        <i data-feather="star" class="fill"></i>-->
                                <!--    </li>-->
                                <!--    <li>-->
                                <!--        <i data-feather="star" class="fill"></i>-->
                                <!--    </li>-->
                                <!--    <li>-->
                                <!--        <i data-feather="star" class="fill"></i>-->
                                <!--    </li>-->
                                <!--    <li>-->
                                <!--        <i data-feather="star" class="fill"></i>-->
                                <!--    </li>-->
                                <!--    <li>-->
                                <!--        <i data-feather="star"></i>-->
                                <!--    </li>-->
                                <!--</ul>-->
                                <a href="{{route("product.show",$pro->product_id)}}">
                                    <h5 class="name">{{ $pro->product->name ?? '' }}</h5>
                                </a>
                                <h5 class="price theme-color">
                                    Rs.{{ $pro->product->discount_price }}<del>Rs.{{ $pro->product->price }}</del></h5>
                                <form method="get" class="price-qty"
                                    action="{{ route('add.to.cart', $pro->product_id) }}">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="number"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                            <div data-href="{{ route('product.show', $pro->product_id) }}"
                                                class="qty-right-plus product_item" data-type="plus" data-field="">
                                                <i class="fas fa-share"></i>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- <!--data-bs-toggle="modal" data-bs-target="#addToCart{{$product->id}}"--> --}}

                                    <button type="submit" class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Sction End -->

    <!-- Blog Section Start -->
    <!--<section class="blog-section">-->
    <!--    <div class="container-fluid-lg">-->
    <!--        <div class="title">-->
    <!--            <h2>Blog</h2>-->
    <!--        </div>-->

    <!--        <div class="slider-3 arrow-slider">-->
    <!--            <div>-->
    <!--                <div class="blog-box ratio_50">-->
    <!--                    <div class="blog-box-image">-->
    <!--                        <a href="#">-->
    <!--                            <img src="{{ asset('assets/images/veg-3/blog/1.jpg') }}" class="img-fluid bg-img" alt="">-->
    <!--                        </a>-->
    <!--                    </div>-->

    <!--                    <div class="blog-detail">-->
    <!--                        <label>Conversion rate optimization</label>-->
    <!--                        <a href="#">-->
    <!--                            <h2>A Fresh Accessories online market place a fresh...</h2>-->
    <!--                        </a>-->
    <!--                        <div class="blog-list">-->
    <!--                            <span>March 9, 2021</span>-->
    <!--                            <span>By Emil Kristensen</span>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--            <div>-->
    <!--                <div class="blog-box ratio_50">-->
    <!--                    <div class="blog-box-image">-->
    <!--                        <a href="#">-->
    <!--                            <img src="{{ asset('assets/images/veg-3/blog/2.jpg') }}" class="img-fluid bg-img" alt="">-->
    <!--                        </a>-->
    <!--                    </div>-->

    <!--                    <div class="blog-detail">-->
    <!--                        <label>Email Marketing</label>-->
    <!--                        <a href="#">-->
    <!--                            <h2>A Fresh Accessories online market place a fresh...</h2>-->
    <!--                        </a>-->
    <!--                        <div class="blog-list">-->
    <!--                            <span>March 9, 2021</span>-->
    <!--                            <span>By Emil Kristensen</span>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--            <div>-->
    <!--                <div class="blog-box ratio_50">-->
    <!--                    <div class="blog-box-image">-->
    <!--                        <a href="#">-->
    <!--                            <img src="{{ asset('assets/images/veg-3/blog/3.jpg') }}" class="img-fluid bg-img" alt="">-->
    <!--                        </a>-->
    <!--                    </div>-->

    <!--                    <div class="blog-detail">-->
    <!--                        <label>Conversion rate optimization</label>-->
    <!--                        <a href="#">-->
    <!--                            <h2>A Fresh Accessories online market place a fresh...</h2>-->
    <!--                        </a>-->
    <!--                        <div class="blog-list">-->
    <!--                            <span>March 9, 2021</span>-->
    <!--                            <span>By Emil Kristensen</span>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--            <div>-->
    <!--                <div class="blog-box ratio_50">-->
    <!--                    <div class="blog-box-image">-->
    <!--                        <a href="#">-->
    <!--                            <img src="{{ asset('assets/images/veg-3/blog/1.jpg') }}" class="img-fluid bg-img" alt="">-->
    <!--                        </a>-->
    <!--                    </div>-->

    <!--                    <div class="blog-detail">-->
    <!--                        <label>Conversion rate optimization</label>-->
    <!--                        <a href="#">-->
    <!--                            <h2>A Fresh Accessories online market place a fresh...</h2>-->
    <!--                        </a>-->
    <!--                        <div class="blog-list">-->
    <!--                            <span>March 9, 2021</span>-->
    <!--                            <span>By Emil Kristensen</span>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- Blog Section End -->

    <!-- Newsletter Section Start -->
    <!--<section class="newsletter-section-2 section-b-space">-->
    <!--    <div class="container-fluid-lg">-->
    <!--        <div class="row">-->
    <!--            <div class="col-12">-->
    <!--                <div class="newsletter-box hover-effect">-->
    <!--                    <img src="{{ asset('assets/images/veg-3/shape/background.png') }}" class="img-fluid bg-img" alt="">-->

    <!--                    <div class="row">-->
    <!--                        <div class="col-xxl-8 col-xl-7">-->
    <!--                            <div class="newsletter-detail p-center-left text-white">-->
    <!--                                <div>-->
    <!--                                    <h2>Subscribe to the newsletter</h2>-->
    <!--                                    <h4>Join our subscribers list to get the latest news, updates and special offers-->
    <!--                                        delivered directly in your inbox.</h4>-->
    <!--                                    <form class="row g-2">-->
    <!--                                        <div class="col-sm-10 col-12">-->
    <!--                                            <div class="newsletter-form">-->
    <!--                                                <input type="email" class="form-control" id="email"-->
    <!--                                                    placeholder="Enter your email">-->
    <!--                                                <button type="submit" class="btn bg-white theme-color btn-md fw-500-->
    <!--                                                    submit-button">Subscribe</button>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </form>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->

    <!--                        <div class="col-xxl-4 col-xl-5 d-xl-block d-none">-->
    <!--                            <div class="shape-box">-->
    <!--                                <img src="{{ asset('assets/images/veg-3/shape/basket.png') }}" alt="" class="img-fluid image-1">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- Newsletter Section End -->


    {{-- modal for top selling products --}}

    @foreach ($tops as $top)
        <!-- Quick View Modal Box for top product Start -->
        <div class="modal fade theme-modal view-modal " id="viewTopProduct{{ $top->product_id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                <div class="modal-content">
                    <div class="modal-header p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-sm-4 g-2">
                            <div class="col-lg-6">
                                <div class="slider-image">
                                    @php
                                        $image = json_decode($top->product->images);
                                    @endphp
                                    <img src="{{ asset($image[0]) }}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="right-sidebar-modal">
                                    <h4 class="title-name">{{ $top->product->name ?? '' }}</h4>
                                    <h4 class="price">Rs. {{ $top->product->discount_price ?? '' }}
                                        <del>Rs.
                                            {{ $top->product->price ?? '' }}</del>
                                    </h4>

                                    <!--<div class="product-rating">-->
                                    <!--    <ul class="rating">-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star" class="fill"></i>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star" class="fill"></i>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star" class="fill"></i>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star" class="fill"></i>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star"></i>-->
                                    <!--        </li>-->
                                    <!--    </ul>-->
                                    <!--    <span class="ms-2">8 Reviews</span>-->
                                    <!--    <span class="ms-2 text-danger">6 sold in last 16 hours</span>-->
                                    <!--</div>-->

                                    <div class="product-detail">
                                        <h4>Product Details :</h4>
                                        <p>{{ $top->product->info }}</p>
                                    </div>

                                    <ul class="brand-list">
                                        <!--<li>-->
                                        <!--    <div class="brand-box">-->
                                        <!--        <h5>Brand Name:</h5>-->
                                        <!--        <h6>Black Forest</h6>-->
                                        <!--    </div>-->
                                        <!--</li>-->

                                        <li>
                                            <div class="brand-box">
                                                <h5>Product Code:</h5>
                                                <h6>DM{{ $top->product->id }}</h6>
                                            </div>
                                        </li>

                                        <!--<li>-->
                                        <!--    <div class="brand-box">-->
                                        <!--        <h5>Product Type:</h5>-->
                                        <!--        <h6>White Cream Cake</h6>-->
                                        <!--    </div>-->
                                        <!--</li>-->
                                    </ul>

                                    <!--<div class="select-size">-->
                                    <!--    <h4>Cake Size :</h4>-->
                                    <!--    <select class="form-select select-form-size">-->
                                    <!--        <option selected>Select Size</option>-->
                                    <!--        <option value="1.2">1/2 KG</option>-->
                                    <!--        <option value="0">1 KG</option>-->
                                    <!--        <option value="1.5">1/5 KG</option>-->
                                    <!--        <option value="red">Red Roses</option>-->
                                    <!--        <option value="pink">With Pink Roses</option>-->
                                    <!--    </select>-->
                                    <!--</div>-->

                                    <div class="modal-button">
                                        <button
                                            onclick="location.href = '{{ route('add.to.cart', $top->product->id) }}';"
                                            class="btn btn-md add-cart-button icon">Add
                                            To Cart</button>
                                        <button
                                            onclick="location.href = '{{ route('product.show', $top->product->id) }}';"
                                            class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                            View More Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View Modal Box for top product End -->
    @endforeach

    <!-- Quick View Modal Box new products Start -->
    @foreach ($newProducts as $newProduct)
        <div class="modal fade theme-modal view-modal " id="newProduct{{ $newProduct->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                <div class="modal-content">
                    <div class="modal-header p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-sm-4 g-2">
                            <div class="col-lg-6">
                                <div class="slider-image">
                                    @php
                                        $image = json_decode($newProduct->images);
                                    @endphp
                                    <img src="{{ asset($image[0]) }}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="right-sidebar-modal">
                                    <h4 class="title-name">{{ $newProduct->name ?? '' }}</h4>
                                    <h4 class="price">Rs. {{ $newProduct->discount_price ?? '' }}
                                        <del>Rs.
                                            {{ $newProduct->price ?? '' }}</del>
                                    </h4>

                                    <!--<div class="product-rating">-->
                                    <!--    <ul class="rating">-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star" class="fill"></i>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star" class="fill"></i>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star" class="fill"></i>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star" class="fill"></i>-->
                                    <!--        </li>-->
                                    <!--        <li>-->
                                    <!--            <i data-feather="star"></i>-->
                                    <!--        </li>-->
                                    <!--    </ul>-->
                                    <!--    <span class="ms-2">8 Reviews</span>-->
                                    <!--    <span class="ms-2 text-danger">6 sold in last 16 hours</span>-->
                                    <!--</div>-->

                                    <div class="product-detail">
                                        <h4>Product Details :</h4>
                                        <p>{{ $newProduct->info }}</p>
                                    </div>

                                    <ul class="brand-list">
                                        <!--<li>-->
                                        <!--    <div class="brand-box">-->
                                        <!--        <h5>Brand Name:</h5>-->
                                        <!--        <h6>Black Forest</h6>-->
                                        <!--    </div>-->
                                        <!--</li>-->

                                        <li>
                                            <div class="brand-box">
                                                <h5>Product Code:</h5>
                                                <h6>DM{{ $newProduct->id }}</h6>
                                            </div>
                                        </li>

                                        <!--<li>-->
                                        <!--    <div class="brand-box">-->
                                        <!--        <h5>Product Type:</h5>-->
                                        <!--        <h6>White Cream Cake</h6>-->
                                        <!--    </div>-->
                                        <!--</li>-->
                                    </ul>

                                    <!--<div class="select-size">-->
                                    <!--    <h4>Cake Size :</h4>-->
                                    <!--    <select class="form-select select-form-size">-->
                                    <!--        <option selected>Select Size</option>-->
                                    <!--        <option value="1.2">1/2 KG</option>-->
                                    <!--        <option value="0">1 KG</option>-->
                                    <!--        <option value="1.5">1/5 KG</option>-->
                                    <!--        <option value="red">Red Roses</option>-->
                                    <!--        <option value="pink">With Pink Roses</option>-->
                                    <!--    </select>-->
                                    <!--</div>-->

                                    <div class="modal-button">
                                        <button onclick="location.href = '{{ route('add.to.cart', $newProduct->id) }}';"
                                            class="btn btn-md add-cart-button icon">Add
                                            To Cart</button>
                                        <button
                                            onclick="location.href = '{{ route('product.show', $newProduct->id) }}';"
                                            class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                            View More Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View Modal Box End new producs -->
    @endforeach
@endsection

@section('scripts')
<script>
    const pct = document.querySelector('.pct');
    const pctIndicator = document.querySelector('#pct-ind');

    // Define the initial progress value
    let progressValue = {{($countCompletedOrders<10)?$countCompletedOrders:10}}0;

    // Function to update the circle's progress
    const updateProgress = () => {
        // pct.textContent = `${progressValue}%`;

        // Calculate the new dashoffset value
        const p = (1 - progressValue / 100) * (2 * (22 / 7) * 40);
        pctIndicator.style = `stroke-dashoffset: ${p};`;
    };

    // Call the updateProgress function initially
    updateProgress();
</script>

{{-- <script>
    // Set the date we're counting down to
    var countDownDate{{ $deal->id }} = new Date("{{ $deal->updated_at->addDays(7) }}").getTime();
    // Update the countdown every 1 second
    var x = setInterval(function() {
        // Get the current date and time
        var now{{ $deal->id }} = new Date().getTime();

        // Find the distance between now{{ $deal->id }} and the countdown date
        var distance{{ $deal->id }} = countDownDate{{ $deal->id }} - now{{ $deal->id }};

        // Calculate time remaining in days, hours, minutes, and seconds
        var days = Math.floor(distance{{ $deal->id }} / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance{{ $deal->id }} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance{{ $deal->id }} % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance{{ $deal->id }} % (1000 * 60)) / 1000);
        // console.log(days);
        // Display the result in the "timer" div
        document.getElementById("days{{ $deal->id }}").innerHTML = days;
        document.getElementById("hours{{ $deal->id }}").innerHTML = hours;
        document.getElementById("minutes{{ $deal->id }}").innerHTML = minutes;
        document.getElementById("seconds{{ $deal->id }}").innerHTML = seconds;

        // If the countdown is over, display "EXPIRED"
        if (distance{{ $deal->id }} < 0) {
            clearInterval(distance{{ $deal->id }});
            document.getElementById("days{{ $deal->id }}").innerHTML = '-';
            document.getElementById("hours{{ $deal->id }}").innerHTML = '-';
            document.getElementById("minutes{{ $deal->id }}").innerHTML = "-";
            document.getElementById("seconds{{ $deal->id }}").innerHTML = "-";
        }
    }, 1000);
    
</script> --}}
@endsection
