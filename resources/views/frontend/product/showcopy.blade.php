@extends('layouts.app')
@section('metaTags')
    <meta property="og:url" content="{{ route('product.show', $product->id) }}" />
    <meta property="og:type" content="product" />
    <meta property="og:title" content="{{ $product->name ?? '' }}" />
    <meta property="og:description" content="{{ $product->info ?? '' }}" />
    @php
        $metaImage = json_decode($product->images);
    @endphp
    <meta property="og:image" content="{{ asset($metaImage[0]) }}" />
@endsection
@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>{{ $product->name ?? '' }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{ $product->name ?? '' }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <!--xxl-9 col-xl-8 col-lg-7-->
                <div class="col-12 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main-2 no-arrow">
                                            @foreach (json_decode($product->images) as $key => $image)
                                                <div>
                                                    <div class="slider-image ">
                                                        {{-- https://{{ $product->user_id ? '' : 'admin.' }}damraaz.com/{{ $image }} --}}
                                                        <img src="{{ asset($image) }}" id="img-{{ $loop->iteration }}"
                                                            data-zoom-image="{{ asset($image) }}"
                                                            class="img-fluid image_zoom_cls-{{ $key }} blur-up lazyload "
                                                            alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                            @foreach (json_decode($product->images) as $image)
                                                <div>
                                                    {{--  --}}
                                                    <div class="slider-image">
                                                        <img src="{{ asset($image) }}" class="img-fluid blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                <!--<h6 class="offer-top">30% Off</h6>-->
                                <h2 class="name">{{ $product->name ?? '' }}</h2>



                                <div class="price-rating">
                                    <h3 class="theme-color price">Rs. {{ $product->discount_price ?? '' }} <del
                                            class="text-content">Rs. {{ $product->price ?? '' }}</del>
                                        @php
                                            $new_price = $product->price - $product->discount_price;
                                            
                                        @endphp
                                        <span
                                            class="offer theme-color">({{ number_format(($new_price / $product->price) * 100, 2, '.', '') }}%
                                            off)</span>
                                    </h3>
                                    <div class="product-rating custom-rate">
                                        @php
                                            $count_total = $product->ratings->count();
                                            if ($count_total) {
                                                $price_rating = $product->ratings->sum('price_rating');
                                                $quality_rating = $product->ratings->sum('quality_rating');
                                                $addTwo = $count_total + 2;
                                                $PPlusQ = $price_rating + $quality_rating;
                                                $total_rating = $PPlusQ / $addTwo;
                                            } else {
                                                $total_rating = 0;
                                            }
                                        @endphp
                                        @if ($total_rating)
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li>
                                                        <i data-feather="star"
                                                            class="{{ $i <= $total_rating ? 'fill' : '' }}"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <span class="review">{{ $count_total }} Customers Review</span>
                                        @endif
                                    </div>
                                    <div>

                                        {{-- <label for="input-1" class="control-label">Give a rating for Skill:</label>
                                        <input id="input-1" name="input-1" class="rating rating-loading"  value="2"> --}}
                                    </div>
                                </div>


                                <div class="procuct-contain">
                                    <p>{{ $product->info ?? '' }}</p>
                                    <p> Delivery Charges Rs.{{ $product->delivery_charges ?? 0 }}</p>
                                    <p> Delivery Days {{ $product->delivery_days ?? 0 }}</p>
                                </div>
                                {{-- <div class="procuct-contain">
                                </div> --}}

                                <!--<div class="product-packege">-->
                                <!--    <div class="product-title">-->
                                <!--        <h4>Weight</h4>-->
                                <!--    </div>-->
                                <!--    <ul class="select-packege">-->
                                <!--        <li>-->
                                <!--            <a href="javascript:void(0)" class="active">1/2 KG</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a href="javascript:void(0)">1 KG</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a href="javascript:void(0)">1.5 KG</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a href="javascript:void(0)">Red Roses</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a href="javascript:void(0)">With Pink Roses</a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</div>-->

                                <!--<div class="time deal-timer product-deal-timer mx-md-0 mx-auto" id="clockdiv-1"-->
                                <!--    data-hours="1" data-minutes="2" data-seconds="3">-->
                                <!--    <div class="product-title">-->
                                <!--        <h4>Hurry up! Sales Ends In</h4>-->
                                <!--    </div>-->
                                <!--    <ul>-->
                                <!--        <li>-->
                                <!--            <div class="counter d-block">-->
                                <!--                <div class="days d-block">-->
                                <!--                    <h5></h5>-->
                                <!--                </div>-->
                                <!--                <h6>Days</h6>-->
                                <!--            </div>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <div class="counter d-block">-->
                                <!--                <div class="hours d-block">-->
                                <!--                    <h5></h5>-->
                                <!--                </div>-->
                                <!--                <h6>Hours</h6>-->
                                <!--            </div>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <div class="counter d-block">-->
                                <!--                <div class="minutes d-block">-->
                                <!--                    <h5></h5>-->
                                <!--                </div>-->
                                <!--                <h6>Min</h6>-->
                                <!--            </div>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <div class="counter d-block">-->
                                <!--                <div class="seconds d-block">-->
                                <!--                    <h5></h5>-->
                                <!--                </div>-->
                                <!--                <h6>Sec</h6>-->
                                <!--            </div>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</div>-->


                                {{-- @if (session('cart')) --}}
                                {{-- @foreach (session('cart') as $id => $details) --}}
                                {{-- @if ($id == $product->id) --}}
                                <div class="note-box product-packege">
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <button type="button" class="qty-right-plus updater" data-type="plus"
                                                data-field="">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                            <input class="form-control input-number qty-input quantity_update"
                                                type="number" name="quantity" value="0">
                                            <button type="button" class="qty-left-minus updater" data-type="minus"
                                                data-field="">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <button onclick="location.href = '{{ route('add.to.cart', $product->id) }}';"
                                        class="btn btn-md bg-dark cart-button text-white w-100">Add To
                                        Cart</button>
                                </div>
                                {{-- @endif --}}
                                {{-- @endforeach --}}
                                {{-- @endif --}}
                                @php
                                    $wishlists = session('wishlist');
                                    $search = false;
                                    if ($wishlists) {
                                        $search = array_key_exists($product->id, $wishlists);
                                    }
                                @endphp
                                <div class="buy-box">
                                    <a href="{{ route('add.to.wishlist', $product->id) }}">
                                        {{-- <i class="" data-feather="heart"></i>
                                        <i class=" fa-heart"></i> --}}
                                        <i
                                            class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }}  fa-heart"></i>
                                        <span>Add To Wishlist </span>
                                    </a>

                                    <!--<a href="compare.html">-->
                                    <!--    <i data-feather="shuffle"></i>-->
                                    <!--    <span>Add To Compare</span>-->
                                    <!--</a>-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6 my-2">
                                        <a href="{{ asset($metaImage[0]) }}" download="{{ $product->name . time() }}"
                                            onclick="shareOnWhatsApp()"
                                            class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold">
                                            Share on WhatsApp
                                        </a>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <form action="{{ route('add.to.cart', $product->id) }}">
                                            <input type="hidden" name="checkout" value="yes">
                                            <button class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold"
                                                type="submit">
                                                <i class="iconly-Bag-2 icli f1"></i>&nbsp; Buy Now
                                            </button>
                                        </form>
                                    </div>

                                </div>


                                <div class="pickup-box">
                                    <div class="product-title">
                                        <h4>Shop Information</h4>
                                    </div>

                                    <div class="pickup-detail">
                                        <h4 class="text-content">
                                            {{ $product->user_id ? $product->user->business ?? '' : env('APP_NAME') }}
                                        </h4>
                                        <a title="Visit Shop"
                                            href="{{ route('user.product.shop', $product->user_id) }}">Visit Shop</a>

                                        @auth
                                            <br>
                                            @if ($product->user_id)
                                                @php
                                                    $follower = App\Models\Follower::where('shop_id', $product->user_id)
                                                        ->where('user_id', Auth()->id())
                                                        ->where('active', true)
                                                        ->first();
                                                @endphp
                                                <a title="{{ $follower ? 'Unfollow' : 'Follow' }} Shop"
                                                    href="{{ route('shop.follow', $product->user_id) }}">{{ $follower ? 'Following' : 'Follow' }}
                                                    Shop</a>
                                            @else
                                                @php
                                                    $follow = App\Models\Follower::where('shop_id', 1)
                                                        ->where('user_id', Auth()->id())
                                                        ->where('active', true)
                                                        ->first();
                                                @endphp
                                                <a title="{{ $follow ? 'Unfollow' : 'Follow' }} Shop"
                                                    href="{{ route('shop.follow', 1) }}">{{ $follow ? 'Following' : 'Follow' }}
                                                    Shop</a>
                                            @endif
                                        @endauth
                                    </div>
                                    <div class="pickup-detail">
                                        @if ($total_rating)
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li>
                                                        <i data-feather="star"
                                                            class="{{ $i <= $price_rating / $count_total ? 'fill' : '' }}"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <span class="review">{{ $price_rating / $count_total }} Price</span>
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li>
                                                        <i data-feather="star"
                                                            class="{{ $i <= $quality_rating / $count_total ? 'fill' : '' }}"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <span class="review">{{ $quality_rating / $count_total }}
                                                Quality</span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="pickup-box">
                                    <div class="product-title">
                                        <h4>Store Information</h4>
                                    </div>

                                    <div class="pickup-detail">
                                        <h4 class="text-content">Lollipop cake chocolate chocolate cake dessert jujubes.
                                            Shortbread sugar plum dessert powder cookie sweet brownie.</h4>
                                    </div>

                                    <div class="product-info">
                                        <ul class="product-info-list product-info-list-2">
                                            <li>Type : <a href="javascript:void(0)">Black Forest</a></li>
                                            <li>SKU : <a href="javascript:void(0)">SDFVW65467</a></li>
                                            <li>MFG : <a href="javascript:void(0)">Jun 4, 2022</a></li>
                                            <li>Stock : <a href="javascript:void(0)">2 Items Left</a></li>
                                            <li>Tags : <a href="javascript:void(0)">Cake,</a> <a
                                                    href="javascript:void(0)">Backery</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="paymnet-option">
                                    <div class="product-title">
                                        <h4>Guaranteed Safe Checkout</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab"
                                            aria-controls="description" aria-selected="true">Details</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" id="copy-button">Copy Details</button>
                                    </li>

                                    <!--<li class="nav-item" role="presentation">-->
                                    <!--    <button class="nav-link" id="review-tab" data-bs-toggle="tab"-->
                                    <!--        data-bs-target="#review" type="button" role="tab" aria-controls="review"-->
                                    <!--        aria-selected="false">Review</button>-->
                                    <!--</li>-->
                                </ul>

                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="product-description">
                                            <div class="nav-desh">
                                                <p id="copy_detail">{{ $product->detail ?? '' }} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">-->
                                    <!--    <div class="table-responsive">-->
                                    <!--        <table class="table info-table">-->
                                    <!--            <tbody>-->
                                    <!--                <tr>-->
                                    <!--                    <td>Specialty</td>-->
                                    <!--                    <td>Vegetarian</td>-->
                                    <!--                </tr>-->
                                    <!--                <tr>-->
                                    <!--                    <td>Ingredient Type</td>-->
                                    <!--                    <td>Vegetarian</td>-->
                                    <!--                </tr>-->
                                    <!--                <tr>-->
                                    <!--                    <td>Brand</td>-->
                                    <!--                    <td>Lavian Exotique</td>-->
                                    <!--                </tr>-->
                                    <!--                <tr>-->
                                    <!--                    <td>Form</td>-->
                                    <!--                    <td>Bar Brownie</td>-->
                                    <!--                </tr>-->
                                    <!--                <tr>-->
                                    <!--                    <td>Package Information</td>-->
                                    <!--                    <td>Box</td>-->
                                    <!--                </tr>-->
                                    <!--                <tr>-->
                                    <!--                    <td>Manufacturer</td>-->
                                    <!--                    <td>Prayagh Nutri Product Pvt Ltd</td>-->
                                    <!--                </tr>-->
                                    <!--                <tr>-->
                                    <!--                    <td>Item part number</td>-->
                                    <!--                    <td>LE 014 - 20pcs Crème Bakes (Pack of 2)</td>-->
                                    <!--                </tr>-->
                                    <!--                <tr>-->
                                    <!--                    <td>Net Quantity</td>-->
                                    <!--                    <td>40.00 count</td>-->
                                    <!--                </tr>-->
                                    <!--            </tbody>-->
                                    <!--        </table>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">-->
                                    <!--    <div class="review-box">-->
                                    <!--        <div class="row g-4">-->
                                    <!--            <div class="col-xl-6">-->
                                    <!--                <div class="review-title">-->
                                    <!--                    <h4 class="fw-500">Customer reviews</h4>-->
                                    <!--                </div>-->

                                    <!--                <div class="d-flex">-->
                                    <!--                    <div class="product-rating">-->
                                    <!--                        <ul class="rating">-->
                                    <!--                            <li>-->
                                    <!--                                <i data-feather="star" class="fill"></i>-->
                                    <!--                            </li>-->
                                    <!--                            <li>-->
                                    <!--                                <i data-feather="star" class="fill"></i>-->
                                    <!--                            </li>-->
                                    <!--                            <li>-->
                                    <!--                                <i data-feather="star" class="fill"></i>-->
                                    <!--                            </li>-->
                                    <!--                            <li>-->
                                    <!--                                <i data-feather="star"></i>-->
                                    <!--                            </li>-->
                                    <!--                            <li>-->
                                    <!--                                <i data-feather="star"></i>-->
                                    <!--                            </li>-->
                                    <!--                        </ul>-->
                                    <!--                    </div>-->
                                    <!--                    <h6 class="ms-3">4.2 Out Of 5</h6>-->
                                    <!--                </div>-->

                                    <!--                <div class="rating-box">-->
                                    <!--                    <ul>-->
                                    <!--                        <li>-->
                                    <!--                            <div class="rating-list">-->
                                    <!--                                <h5>5 Star</h5>-->
                                    <!--                                <div class="progress">-->
                                    <!--                                    <div class="progress-bar" role="progressbar"-->
                                    <!--                                        style="width: 68%" aria-valuenow="100"-->
                                    <!--                                        aria-valuemin="0" aria-valuemax="100">-->
                                    <!--                                        68%-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </li>-->

                                    <!--                        <li>-->
                                    <!--                            <div class="rating-list">-->
                                    <!--                                <h5>4 Star</h5>-->
                                    <!--                                <div class="progress">-->
                                    <!--                                    <div class="progress-bar" role="progressbar"-->
                                    <!--                                        style="width: 67%" aria-valuenow="100"-->
                                    <!--                                        aria-valuemin="0" aria-valuemax="100">-->
                                    <!--                                        67%-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </li>-->

                                    <!--                        <li>-->
                                    <!--                            <div class="rating-list">-->
                                    <!--                                <h5>3 Star</h5>-->
                                    <!--                                <div class="progress">-->
                                    <!--                                    <div class="progress-bar" role="progressbar"-->
                                    <!--                                        style="width: 42%" aria-valuenow="100"-->
                                    <!--                                        aria-valuemin="0" aria-valuemax="100">-->
                                    <!--                                        42%-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </li>-->

                                    <!--                        <li>-->
                                    <!--                            <div class="rating-list">-->
                                    <!--                                <h5>2 Star</h5>-->
                                    <!--                                <div class="progress">-->
                                    <!--                                    <div class="progress-bar" role="progressbar"-->
                                    <!--                                        style="width: 30%" aria-valuenow="100"-->
                                    <!--                                        aria-valuemin="0" aria-valuemax="100">-->
                                    <!--                                        30%-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </li>-->

                                    <!--                        <li>-->
                                    <!--                            <div class="rating-list">-->
                                    <!--                                <h5>1 Star</h5>-->
                                    <!--                                <div class="progress">-->
                                    <!--                                    <div class="progress-bar" role="progressbar"-->
                                    <!--                                        style="width: 24%" aria-valuenow="100"-->
                                    <!--                                        aria-valuemin="0" aria-valuemax="100">-->
                                    <!--                                        24%-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </li>-->
                                    <!--                    </ul>-->
                                    <!--                </div>-->
                                    <!--            </div>-->

                                    <!--            <div class="col-xl-6">-->
                                    <!--                <div class="review-title">-->
                                    <!--                    <h4 class="fw-500">Add a review</h4>-->
                                    <!--                </div>-->

                                    <!--                <div class="row g-4">-->
                                    <!--                    <div class="col-md-6">-->
                                    <!--                        <div class="form-floating theme-form-floating">-->
                                    <!--                            <input type="text" class="form-control" id="name"-->
                                    <!--                                placeholder="Name">-->
                                    <!--                            <label for="name">Your Name</label>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->

                                    <!--                    <div class="col-md-6">-->
                                    <!--                        <div class="form-floating theme-form-floating">-->
                                    <!--                            <input type="email" class="form-control" id="email"-->
                                    <!--                                placeholder="Email Address">-->
                                    <!--                            <label for="email">Email Address</label>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->

                                    <!--                    <div class="col-md-6">-->
                                    <!--                        <div class="form-floating theme-form-floating">-->
                                    <!--                            <input type="url" class="form-control" id="website"-->
                                    <!--                                placeholder="Website">-->
                                    <!--                            <label for="website">Website</label>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->

                                    <!--                    <div class="col-md-6">-->
                                    <!--                        <div class="form-floating theme-form-floating">-->
                                    <!--                            <input type="url" class="form-control" id="review1"-->
                                    <!--                                placeholder="Give your review a title">-->
                                    <!--                            <label for="review1">Review Title</label>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->

                                    <!--                    <div class="col-12">-->
                                    <!--                        <div class="form-floating theme-form-floating">-->
                                    <!--                            <textarea class="form-control"-->
                                    <!--                                placeholder="Leave a comment here"-->
                                    <!--                                id="floatingTextarea2"-->
                                    <!--                                style="height: 150px"></textarea>-->
                                    <!--                            <label for="floatingTextarea2">Write Your-->
                                    <!--                                Comment</label>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->

                                    <!--            <div class="col-12">-->
                                    <!--                <div class="review-title">-->
                                    <!--                    <h4 class="fw-500">Customer questions & answers</h4>-->
                                    <!--                </div>-->

                                    <!--                <div class="review-people">-->
                                    <!--                    <ul class="review-list">-->
                                    <!--                        <li>-->
                                    <!--                            <div class="people-box">-->
                                    <!--                                <div>-->
                                    <!--                                    <div class="people-image">-->
                                    <!--                                        <img src="../assets/images/review/1.jpg"-->
                                    <!--                                            class="img-fluid blur-up lazyload"-->
                                    <!--                                            alt="">-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->

                                    <!--                                <div class="people-comment">-->
                                    <!--                                    <a class="name"-->
                                    <!--                                        href="javascript:void(0)">Tracey</a>-->
                                    <!--                                    <div class="date-time">-->
                                    <!--                                        <h6 class="text-content">14 Jan, 2022 at-->
                                    <!--                                            12.58 AM</h6>-->

                                    <!--                                        <div class="product-rating">-->
                                    <!--                                            <ul class="rating">-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                            </ul>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->

                                    <!--                                    <div class="reply">-->
                                    <!--                                        <p>Icing cookie carrot cake chocolate cake-->
                                    <!--                                            sugar plum jelly-o danish. Dragée dragée-->
                                    <!--                                            shortbread tootsie roll croissant muffin-->
                                    <!--                                            cake I love gummi bears. Candy canes ice-->
                                    <!--                                            cream caramels tiramisu marshmallow cake-->
                                    <!--                                            shortbread candy canes cookie.<a-->
                                    <!--                                                href="javascript:void(0)">Reply</a>-->
                                    <!--                                        </p>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </li>-->

                                    <!--                        <li>-->
                                    <!--                            <div class="people-box">-->
                                    <!--                                <div>-->
                                    <!--                                    <div class="people-image">-->
                                    <!--                                        <img src="../assets/images/review/2.jpg"-->
                                    <!--                                            class="img-fluid blur-up lazyload"-->
                                    <!--                                            alt="">-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->

                                    <!--                                <div class="people-comment">-->
                                    <!--                                    <a class="name"-->
                                    <!--                                        href="javascript:void(0)">Olivia</a>-->
                                    <!--                                    <div class="date-time">-->
                                    <!--                                        <h6 class="text-content">01 May, 2022 at-->
                                    <!--                                            08.31 AM</h6>-->
                                    <!--                                        <div class="product-rating">-->
                                    <!--                                            <ul class="rating">-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                            </ul>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->

                                    <!--                                    <div class="reply">-->
                                    <!--                                        <p>Tootsie roll cake danish halvah powder-->
                                    <!--                                            Tootsie roll candy marshmallow cookie-->
                                    <!--                                            brownie apple pie pudding brownie-->
                                    <!--                                            chocolate bar. Jujubes gummi bears I-->
                                    <!--                                            love powder danish oat cake tart-->
                                    <!--                                            croissant.<a-->
                                    <!--                                                href="javascript:void(0)">Reply</a>-->
                                    <!--                                        </p>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </li>-->

                                    <!--                        <li>-->
                                    <!--                            <div class="people-box">-->
                                    <!--                                <div>-->
                                    <!--                                    <div class="people-image">-->
                                    <!--                                        <img src="../assets/images/review/3.jpg"-->
                                    <!--                                            class="img-fluid blur-up lazyload"-->
                                    <!--                                            alt="">-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->

                                    <!--                                <div class="people-comment">-->
                                    <!--                                    <a class="name"-->
                                    <!--                                        href="javascript:void(0)">Gabrielle</a>-->
                                    <!--                                    <div class="date-time">-->
                                    <!--                                        <h6 class="text-content">21 May, 2022 at-->
                                    <!--                                            05.52 PM</h6>-->

                                    <!--                                        <div class="product-rating">-->
                                    <!--                                            <ul class="rating">-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"-->
                                    <!--                                                        class="fill"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li>-->
                                    <!--                                                    <i data-feather="star"></i>-->
                                    <!--                                                </li>-->
                                    <!--                                            </ul>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->

                                    <!--                                    <div class="reply">-->
                                    <!--                                        <p>Biscuit chupa chups gummies powder I love-->
                                    <!--                                            sweet pudding jelly beans. Lemon drops-->
                                    <!--                                            marzipan apple pie gingerbread macaroon-->
                                    <!--                                            croissant cotton candy pastry wafer.-->
                                    <!--                                            Carrot cake halvah I love tart caramels-->
                                    <!--                                            pudding icing chocolate gummi bears.-->
                                    <!--                                            Gummi bears danish cotton candy muffin-->
                                    <!--                                            marzipan caramels awesome feel. <a-->
                                    <!--                                                href="javascript:void(0)">Reply</a>-->
                                    <!--                                        </p>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </li>-->
                                    <!--                    </ul>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">-->
                <!--    <div class="right-sidebar-box">-->
                <!--        <div class="vendor-box">-->
                <!--            <div class="verndor-contain">-->
                <!--                <div class="vendor-image">-->
                <!--                    <img src="../assets/images/product/vendor.png" class="blur-up lazyload" alt="">-->
                <!--                </div>-->

                <!--                <div class="vendor-name">-->
                <!--                    <h5 class="fw-500">Noodles Co.</h5>-->

                <!--                    <div class="product-rating mt-1">-->
                <!--                        <ul class="rating">-->
                <!--                            <li>-->
                <!--                                <i data-feather="star" class="fill"></i>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <i data-feather="star" class="fill"></i>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <i data-feather="star" class="fill"></i>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <i data-feather="star" class="fill"></i>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <i data-feather="star"></i>-->
                <!--                            </li>-->
                <!--                        </ul>-->
                <!--                        <span>(36 Reviews)</span>-->
                <!--                    </div>-->

                <!--                </div>-->
                <!--            </div>-->

                <!--            <p class="vendor-detail">Noodles & Company is an American fast-casual-->
                <!--                restaurant that offers international and American noodle dishes and pasta.</p>-->

                <!--            <div class="vendor-list">-->
                <!--                <ul>-->
                <!--                    <li>-->
                <!--                        <div class="address-contact">-->
                <!--                            <i data-feather="map-pin"></i>-->
                <!--                            <h5>Address: <span class="text-content">1288 Franklin Avenue</span></h5>-->
                <!--                        </div>-->
                <!--                    </li>-->

                <!--                    <li>-->
                <!--                        <div class="address-contact">-->
                <!--                            <i data-feather="headphones"></i>-->
                <!--                            <h5>Contact Seller: <span class="text-content">(+1)-123-456-789</span></h5>-->
                <!--                        </div>-->
                <!--                    </li>-->
                <!--                </ul>-->
                <!--            </div>-->
                <!--        </div>-->

                <!-- Trending Product -->
                <!--        <div class="pt-25">-->
                <!--            <div class="category-menu">-->
                <!--                <h3>Trending Products</h3>-->

                <!--                <ul class="product-list product-right-sidebar border-0 p-0">-->
                <!--                    <li>-->
                <!--                        <div class="offer-product">-->
                <!--                            <a href="product-left-thumbnail.html" class="offer-image">-->
                <!--                                <img src="../assets/images/vegetable/product/23.png"-->
                <!--                                    class="img-fluid blur-up lazyload" alt="">-->
                <!--                            </a>-->

                <!--                            <div class="offer-detail">-->
                <!--                                <div>-->
                <!--                                    <a href="product-left-thumbnail.html">-->
                <!--                                        <h6 class="name">Meatigo Premium Goat Curry</h6>-->
                <!--                                    </a>-->
                <!--                                    <span>450 G</span>-->
                <!--                                    <h6 class="price theme-color">$ 70.00</h6>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </li>-->

                <!--                    <li>-->
                <!--                        <div class="offer-product">-->
                <!--                            <a href="product-left-thumbnail.html" class="offer-image">-->
                <!--                                <img src="../assets/images/vegetable/product/24.png"-->
                <!--                                    class="blur-up lazyload" alt="">-->
                <!--                            </a>-->

                <!--                            <div class="offer-detail">-->
                <!--                                <div>-->
                <!--                                    <a href="product-left-thumbnail.html">-->
                <!--                                        <h6 class="name">Dates Medjoul Premium Imported</h6>-->
                <!--                                    </a>-->
                <!--                                    <span>450 G</span>-->
                <!--                                    <h6 class="price theme-color">$ 40.00</h6>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </li>-->

                <!--                    <li>-->
                <!--                        <div class="offer-product">-->
                <!--                            <a href="product-left-thumbnail.html" class="offer-image">-->
                <!--                                <img src="../assets/images/vegetable/product/25.png"-->
                <!--                                    class="blur-up lazyload" alt="">-->
                <!--                            </a>-->

                <!--                            <div class="offer-detail">-->
                <!--                                <div>-->
                <!--                                    <a href="product-left-thumbnail.html">-->
                <!--                                        <h6 class="name">Good Life Walnut Kernels</h6>-->
                <!--                                    </a>-->
                <!--                                    <span>200 G</span>-->
                <!--                                    <h6 class="price theme-color">$ 52.00</h6>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </li>-->

                <!--                    <li class="mb-0">-->
                <!--                        <div class="offer-product">-->
                <!--                            <a href="product-left-thumbnail.html" class="offer-image">-->
                <!--                                <img src="../assets/images/vegetable/product/26.png"-->
                <!--                                    class="blur-up lazyload" alt="">-->
                <!--                            </a>-->

                <!--                            <div class="offer-detail">-->
                <!--                                <div>-->
                <!--                                    <a href="product-left-thumbnail.html">-->
                <!--                                        <h6 class="name">Apple Red Premium Imported</h6>-->
                <!--                                    </a>-->
                <!--                                    <span>1 KG</span>-->
                <!--                                    <h6 class="price theme-color">$ 80.00</h6>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </li>-->
                <!--                </ul>-->
                <!--            </div>-->
                <!--        </div>-->

                <!-- Banner Section -->
                <!--        <div class="ratio_156 pt-25">-->
                <!--            <div class="home-contain">-->
                <!--                <img src="../assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload"-->
                <!--                    alt="">-->
                <!--                <div class="home-detail p-top-left home-p-medium">-->
                <!--                    <div>-->
                <!--                        <h6 class="text-yellow home-banner">Seafood</h6>-->
                <!--                        <h3 class="text-uppercase fw-normal"><span-->
                <!--                                class="theme-color fw-bold">Freshes</span> Products</h3>-->
                <!--                        <h3 class="fw-light">every hour</h3>-->
                <!--                        <button onclick="location.href = 'shop-left-sidebar.html';"-->
                <!--                            class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i-->
                <!--                                class="fa-solid fa-arrow-right icon"></i></button>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </section>
    <!-- Product Left Sidebar End -->

    <!-- Releted Product Section Start -->
    <section class="product-list-section section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Related Products</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                    </svg>
                </span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-6_1 product-wrapper">
                        @forelse($relatedProducts as $related)
                            @php
                                $wishlists = session('wishlist');
                                $search = false;
                                if ($wishlists) {
                                    $search = array_key_exists($related->id, $wishlists);
                                }
                            @endphp
                            <div>
                                <div class="product-box-3 wow fadeInUp">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href='{{ route('product.show', $related->id) }}'>
                                                @php
                                                    $image = json_decode($related->images);
                                                @endphp
                                                <img src="{{ asset($image[0]) }}" class="img-fluid blur-up lazyload"
                                                    alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#viewRelated{{ $related->id }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>



                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="{{ route('add.to.wishlist', $related->id) }}"
                                                        class="notifi-wishlist">
                                                        {{-- <i data-feather="heart"></i> --}}
                                                        <i
                                                            class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }}  fa-heart"></i>

                                                    </a>
                                                </li>
                                                <!--<li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                                                <!--    <a href="compare.html">-->
                                                <!--        <i data-feather="refresh-cw"></i>-->
                                                <!--    </a>-->
                                                <!--</li>-->

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Buy Now">
                                                    <form action="{{ route('add.to.cart', $related->id) }}">
                                                        <input type="hidden" name="checkout" value="yes">
                                                        <button class="btn" type="submit">
                                                            <i class="iconly-Bag-2 icli"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">{{ $related->category->name }}</span>
                                            <a href='{{ route('product.show', $related->id) }}'>
                                                <h5 class="name">{{ $related->name }}</h5>
                                            </a>
                                            <!--<div class="product-rating mt-2">-->
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
                                            <!--            <i data-feather="star" class="fill"></i>-->
                                            <!--        </li>-->
                                            <!--    </ul>-->
                                            <!--    <span>(5.0)</span>-->
                                            <!--</div>-->
                                            <!--<h6 class="unit">500 G</h6>-->
                                            <h5 class="price"><span class="theme-color">Rs.
                                                    {{ $related->discount_price }}</span> <del>Rs.
                                                    {{ $related->price }}</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <a href="{{ route('add.to.cart', $related->id) }}"
                                                    class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </a>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @empty
                            No Product Found
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Releted Product Section End -->
    @foreach ($relatedProducts as $related)
        <!-- Quick View Modal Box Start -->
        <div class="modal fade theme-modal view-modal " id="viewRelated{{ $related->id }}" tabindex="-1"
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
                                        $image = json_decode($related->images);
                                    @endphp
                                    <img src="{{ asset($image[0]) }}" class="img-fluid blur-up lazyload" alt="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="right-sidebar-modal">
                                    <h4 class="title-name">{{ $related->name ?? '' }}</h4>
                                    <h4 class="price">Rs. {{ $related->discount_price ?? '' }} <del>Rs.
                                            {{ $related->price ?? '' }}</del></h4>

                                    <div class="product-rating">
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
                                        <span class="ms-2">8 Reviews</span>
                                        <span class="ms-2 text-danger">6 sold in last 16 hours</span>
                                    </div>

                                    <div class="product-detail">
                                        <h4>Product Details :</h4>
                                        <p>{{ $related->info }}</p>
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
                                                <h6>DM{{ $related->id }}</h6>
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
                                        <button onclick="location.href = '{{ route('add.to.cart', $related->id) }}';"
                                            class="btn btn-md add-cart-button icon">Add
                                            To Cart</button>
                                        <button onclick="location.href = '{{ route('product.show', $related->id) }}';"
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
    @endforeach
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#copy-button').click(function() {
                var textToCopy = $('#copy_detail').text(); // Get the value of the input field

                // Create a temporary textarea element
                var $tempTextArea = $('<textarea>').val(textToCopy).appendTo('body');

                // Select the contents of the temporary textarea
                $tempTextArea[0].select();

                try {
                    // Execute the copy command
                    document.execCommand('copy');
                    alert('Text copied to clipboard: ', textToCopy);
                    // You can display a success message or perform any other action here
                } catch (err) {
                    alert('Unable to copy text to clipboard: ', err);
                    // You can display an error message or perform any other action here
                } finally {
                    // Remove the temporary textarea from the body
                    $tempTextArea.remove();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(".updater").click(function(e) {
            e.preventDefault();

            var ele = $(this);
            // alert(ele);
            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity_update").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    </script>

    <script>
        function shareOnWhatsApp() {

            var productName = "{{ $product->name }}";
            var productInfo = " {{ $product->info }}";
            var productDescription = " {{ $product->detail }}";
            var productPrice = " {{ $product->price }}";
            var productDiscountPrice = " {{ $product->discount_price }}";



            var message = "Product Name: " + productName + '\nPrice: ' + productPrice + '\nDiscount Price: ' +
                productDiscountPrice + "\nInfo : " + productInfo + "\nDescription: " +
                productDescription; // Generate the WhatsApp sharing URL
            var whatsappURL = "https://api.whatsapp.com/send?text=" + encodeURIComponent(message);
            window.open(whatsappURL);

            window.location.href = "{{ route('user.product.share', $product->id) }}";
        }
    </script>
@endsection
