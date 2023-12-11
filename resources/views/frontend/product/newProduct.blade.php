@extends('layouts.app')
@section('content')
<!-- Search Bar Section Start -->
    <section class="search-section ">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-6 col-xl-8 mx-auto">
                    <div class="title d-block text-center">
                        <h2>Search for products</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                    </div>

                    <div class="search-box">
                        <form method="get"  class="input-group">
                            <input type="text" name="name" value="{{request()->name}}" class="form-control" placeholder="Search by name" aria-label="Example text with button addon">
                            <input type="number" name="min_price" value="{{request()->min_price}}" class="form-control" placeholder="min price" aria-label="Example text with button addon">
                            <input type="number" name="max_price" value="{{request()->max_price}}" class="form-control" placeholder="max price" aria-label="Example text with button addon">
                            <select class="form-control" name="sort" aria-label="Default select example">
                              <option selected disabled>Sort By</option>
                              <option value="lowToHigh" {{(request()->sort=='lowToHigh')? 'selected':''}}>Low To High</option>
                              <option value="highToLow" {{(request()->sort=='highToLow')? 'selected':''}}>High To Low</option>
                            </select>
                            <button class="btn theme-bg-color text-white m-0" type="submit"  id="button-addon1">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Bar Section End -->
<section class="product-section">
        <div class="container-fluid-lg">
            <div class="title title-flex-2">
                <h2>Our Products</h2>
                <ul class="nav nav-tabs tab-style-color-2 tab-style-color" id="myTab">
                    <!--<li class="nav-item">-->
                    <!--    <button class="nav-link btn active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"-->
                    <!--        type="button">All</button>-->
                    <!--</li>-->
                    <!--<li class="nav-item w-50">-->
                    <!--     <form method="get" class="input-group">-->
                    <!--        <input type="number" name="min_price" value="{{request()->min_price}}" class="form-control form-control-sm" placeholder="min value"-->
                    <!--            aria-label="Example text with button addon">-->
                    <!--        <input type="number" name="max_price" value="{{request()->max_price}}" class="form-control form-control-sm" placeholder="max value"-->
                    <!--            aria-label="Example text with button addon">-->
                    <!--        <button class="btn theme-bg-color text-white m-0 btn-sm" type="submit"-->
                    <!--            id="button-addon1">Search</button>-->
                    <!--    </form>-->
                    <!--</li>-->

                    <!--<li class="nav-item">-->
                    <!--    <button class="nav-link btn" id="cooking-tab" data-bs-toggle="tab" data-bs-target="#cooking"-->
                    <!--        type="button"> Cooking</button>-->
                    <!--</li>-->

                    <!--<li class="nav-item">-->
                    <!--    <button class="nav-link btn" id="fruits-tab" data-bs-toggle="tab" data-bs-target="#fruits"-->
                    <!--        type="button">Fruits & Vegetables</button>-->
                    <!--</li>-->

                    <!--<li class="nav-item">-->
                    <!--    <button class="nav-link btn" id="beverage-tab" data-bs-toggle="tab" data-bs-target="#beverage"-->
                    <!--        type="button">Beverage</button>-->
                    <!--</li>-->

                    <!--<li class="nav-item">-->
                    <!--    <button class="nav-link btn" id="dairy-tab" data-bs-toggle="tab" data-bs-target="#dairy"-->
                    <!--        type="button">Dairy</button>-->
                    <!--</li>-->
                </ul>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row g-8">
                        @forelse($newProducts as $product)
                        @php
                                $wishlists = session('wishlist');
                                $search = false;
                                if ($wishlists) 
                                {
                                    $search = array_key_exists($product->id, $wishlists);
                                }
                            @endphp

                        <div class="col-xxl-2 col-lg-3 col-md-4 col-6 wow fadeInUp">
                            <div class="product-box-4">
                                <div class="product-image">
                                    <div class="label-flex">
                                        <a href="{{route('add.to.wishlist',$product->id)}}" class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                            {{-- <i class="iconly-Heart icli"></i> --}}
                                            <i class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }} fa-heart"></i>

                                        </a>
                                    </div>
                                        @php
                                            $image=json_decode($product->images);
                                        @endphp 
                                    <a href="{{route('product.show',$product->id)}}">
                                        <img src="{{ asset($image[0]) }}" class="img-fluid" alt="">
                                    </a>

                                    <ul class="option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#viewDetail{{$product->id}}">
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
                                        <!--<li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                                        <!--    <a href="{{route('add.to.compare',$product->id)}}">-->
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
                                    <a href="{{route('product.show',$product->id)}}">
                                        <h5 class="name">{{$product->name?? ''}}</h5>
                                    </a>
                                    <h5 class="price theme-color">Rs. {{$product->discount_price?? ''}}<del>Rs. {{$product->price??""}}</del></h5>
                                    <!--<div class="price-qty">-->
                                    <!--    <div class="counter-number">-->
                                    <!--        <div class="counter">-->
                                    <!--            <div class="qty-left-minus" data-type="minus" data-field="">-->
                                    <!--                <i class="fa-solid fa-minus"></i>-->
                                    <!--            </div>-->
                                    <!--            <input class="form-control input-number qty-input" type="text"-->
                                    <!--                name="quantity" value="0">-->
                                    <!--            <div class="qty-right-plus" data-type="plus" data-field="">-->
                                    <!--                <i class="fa-solid fa-plus"></i>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--            {{--<!--data-bs-toggle="modal" data-bs-target="#addToCart{{$product->id}}"-->--}}-->
                                    <!--    <a href="{{route('add.to.cart',$product->id)}}"  class="buy-button buy-button-2 btn btn-cart">-->
                                    <!--        <i class="iconly-Buy icli text-white m-0"></i>-->
                                    <!--    </a>-->
                                    <!--</div>-->
                                    <form method="get" class="price-qty" action="{{route('add.to.cart',$product->id)}}">
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
                                                <div  data-href="{{route('product.show',$product->id)}}" class="qty-right-plus product_item" data-type="plus" data-field="">
                                                        <i class="fas fa-share"></i>
                                                </div>
                                            </div>
                                            
                                        </div>
                                                {{--<!--data-bs-toggle="modal" data-bs-target="#addToCart{{$product->id}}"-->--}}
                                        
                                        <button type="submit" class="buy-button buy-button-2 btn btn-cart">
                                            <i class="iconly-Buy icli text-white m-0"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                         <!-- Quick View Modal Box Start -->
                        <div class="modal fade theme-modal view-modal "  id="viewDetail{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
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
                                                    <img src="{{asset($image[0])}}" class="img-fluid blur-up lazyload"
                                                        alt="">
                                                </div>
                                            </div>
                    
                                            <div class="col-lg-6">
                                                <div class="right-sidebar-modal">
                                                    <h4 class="title-name">{{$product->name??''}}</h4>
                                                    <h4 class="price">Rs. {{$product->discount_price??''}}  <del>Rs. {{$product->price??''}}</del></h4>
                                                    
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
                                                        <p>{{$product->info}}</p>
                                                    </div>
                    
                                                    <ul class="brand-list">
                    
                                                        <li>
                                                            <div class="brand-box">
                                                                <h5>Product Code:</h5>
                                                                <h6>DM{{$product->id}}</h6>
                                                            </div>
                                                        </li>
                    
                                                      
                                                    </ul>
                    
                                                    <div class="modal-button">
                                                        <button onclick="location.href = '{{ route('add.to.cart', $product->id) }}';"
                                                            class="btn btn-md add-cart-button icon">Add
                                                            To Cart</button>
                                                        <button onclick="location.href = '{{route('product.show',$product->id)}}';"
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
                        <div class="modal fade theme-modal view-modal "  id="addToCart{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
                                <div class="modal-content">
                                    <div class="modal-header p-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-sm-4 g-2">
                                            <form method="get" action="{{route('add.to.cart',$product->id)}}">
                                                  <div class="mb-3">
                                                    <label for="profit" class="form-label">Enter Your Profit</label>
                                                    <input type="number" name="profit" class="form-control" id="profit" aria-describedby="emailHelp">
                                                  </div>
                                                  <button  type="submit" class="btn btn-primary theme-bg-color view-button icon text-white fw-bold btn-md">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- add to cart -->
                        @empty
                        <div class="col-xxl-2 mb-2 col-lg-3 col-md-4 col-6 wow fadeInUp">
                        No product found
                            
                        </div>
                        @endforelse
                    </div>
                </div>

                <!--<div class="tab-pane fade" id="cooking" role="tabpanel" aria-labelledby="cooking-tab">-->
                <!--    <div class="row g-8">-->
                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/1.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Eggplant</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/2.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Eggplant</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/3.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Onion</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/4.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Potato</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/5.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Baby Chili</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/6.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Broccoli</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/10.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Pea</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/11.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Cucumber</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/17.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Cabbage</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/18.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Ginger</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/8.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/14.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/16.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/7.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/9.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/13.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/12.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
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

                <!--<div class="tab-pane fade" id="beverage" role="tabpanel" aria-labelledby="beverage-tab">-->
                <!--    <div class="row g-8">-->
                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/1.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Eggplant</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/2.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Eggplant</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/3.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Onion</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/4.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Potato</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/5.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Baby Chili</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/6.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Broccoli</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/10.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Pea</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/11.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Cucumber</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/17.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Cabbage</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/18.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Ginger</h5>-->
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

                <!--<div class="tab-pane fade" id="dairy" role="tabpanel" aria-labelledby="dairy-tab">-->
                <!--    <div class="row g-8">-->
                <!--        <div class="col-xxl-2 col-lg-3 col-md-4 col-6">-->
                <!--            <div class="product-box-4">-->
                <!--                <div class="product-image">-->
                <!--                    <div class="label-flex">-->
                <!--                        <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">-->
                <!--                            <i class="iconly-Heart icli"></i>-->
                <!--                        </button>-->
                <!--                    </div>-->

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/1.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Eggplant</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/2.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Eggplant</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/3.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Onion</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/4.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Potato</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/5.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Baby Chili</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/6.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Broccoli</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/10.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                            <i data-feather="star"></i>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Pea</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/11.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Cucumber</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/17.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Cabbage</h5>-->
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

                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <img src="{{asset('assets/images/veg-3/cate1/18.png')}}" class="img-fluid" alt="">-->
                <!--                    </a>-->

                <!--                    <ul class="option">-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">-->
                <!--                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">-->
                <!--                                <i class="iconly-Show icli"></i>-->
                <!--                            </a>-->
                <!--                        </li>-->
                <!--                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                <!--                            <a href="compare.html">-->
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
                <!--                    <a href="product-left-thumbnail.html">-->
                <!--                        <h5 class="name">Ginger</h5>-->
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
@endsection