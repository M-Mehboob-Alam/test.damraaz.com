@extends('layouts.app')
@section('title')
{{ $product->name ?? '' }}
@endsection
 <!-- Swiper Slider Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('newtheme/assets/css/vendors/swiper-bundle.min.css')}}" />
@section('metaTags')
    <meta property="og:url" content="{{ route('product.show', $product->id) }}" />
    <meta property="og:type" content="product" />
    <meta property="og:title" content="{{ $product->name ?? '' }}" />
    <meta property="og:description" content="{{ $product->info ?? '' }}" />
    @php
        $metaImage =$product->image;
    @endphp
    <meta property="og:image" content="{{ asset($metaImage) }}" />
@endsection

@section('content')
<!-- Breadcrumb Start -->

<div class="breadcrumb-wrap">
    <div class="banner b-top bg-size" style="
    background-image: url("{{asset('newtheme/assets/images/inner-page/banner-p.jpg')}})";
    background-size:cover;
    background-position: center;
    background-repeat: no-repeat;
    display: block;
    ">
      <img class="bg-img bg-top" src="{{asset('newtheme/assets/images/inner-page/banner-p.jpg')}}" alt="banner" style="display: none;">

      <div class="container-lg">
        <div class="breadcrumb-box">
          <div class="heading-box">
            <h1>Product</h1>
          </div>
          <ol class="breadcrumb">
            <li><a href="{{route('/')}}">Home</a></li>
            <li>
              <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a>
            </li>
            <li class="current"><a href="{{route('frontend.all_product')}}">Product</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb End -->

  <!-- Product Section Start -->
  <section class="product-page">
    <div class="container-lg">
      <div class="row g-3 g-xl-4 view-product">
        <div class="col-md-7">
          <div class="slider-box sticky off-50 position-sticky">
            <div class="row g-2">
              <div class="col-2">
                <div class="thumbnail-box">
                  <div class="swiper thumbnail-img-box thumbnailSlider2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset($product->image) }}" alt="img" />
                          </div>
                        @foreach (json_decode($product->images) as $key => $image)

                        <div class="swiper-slide">
                            <img src="{{ asset($image) }}" alt="img" />
                          </div>
                    @endforeach


                    </div>
                  </div>
                </div>
              </div>

              <div class="col-10 ratio_square">
                <div class="swiper mainslider2">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img class="bg-img" src="{{ asset($product->image) }}" alt="img" />
                      </div>
                    @foreach (json_decode($product->images) as $key => $image)
                    <div class="swiper-slide">
                        <img class="bg-img" src="{{ asset($image) }}" alt="img" />
                      </div>

                @endforeach

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="product-detail-box">
            <div class="product-option">
              <h2>{{$product->name}}
                @if ($product->isMegaSale)
                <span class="badge badge-danger text-danger">Mega Sale</span>            
                    
                @endif
            </h2>
              <div class="option rating-option">
                <ul class="rating p-0">
                  <li>
                    <i class="fill" data-feather="star"></i>
                  </li>
                  <li>
                    <i class="fill" data-feather="star"></i>
                  </li>
                  <li>
                    <i class="fill" data-feather="star"></i>
                  </li>
                  <li>
                    <i class="fill" data-feather="star"></i>
                  </li>
                  <li>
                    <i data-feather="star"></i>
                  </li>
                </ul>
                <span>120 Rating</span>
              </div>

              <div class="option price">
                @if (is_null($product->discount_price) && $product->price > $product->discount_price)
                <span>Rs.{{$product->price}} </span>
                @else

                <span>Rs.{{$product->discount_price}} </span> <del>Rs.{{$product->price}}</del>
                @endif
              </div>

              <div class="option">
                <p class="content-color">
                    {{$product->info}}
                </p>
              </div>

              <div class="option-side">
                {{-- <div class="option">

                </div> --}}
                <div class="option">
                  <div class="title-box4">
                    <h4 class="heading">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                        <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                      </svg> Delivery Charges: {{$product->delivery_charges}}<span class="bg-theme-blue"></span></h4>
                  </div>
                  <div class="title-box4">
                    <h4 class="heading">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                          </svg> Delivery Days: {{$product->delivery_days}}<span class="bg-theme-blue"></span></h4>
                  </div>
                  @if (!is_null($product->deal))
                  <div class="title-box4">
                    <h4 class="heading">
                         Deal: {{$product->deal}}<span class="bg-theme-blue"></span></h4>
                  </div>

                  @endif
                  @if (!is_null($product->offer))
                  <div class="title-box4">
                    <h4 class="heading">
                         Deal: {{$product->offer}}<span class="bg-theme-blue"></span></h4>
                  </div>

                  @endif

                  <div class="title-box4">
                    <h4 class="heading">Quantity: {{$product->quantity}}<span class="bg-theme-blue"></span></h4>
                  </div>
                  <form action="{{ route('add.to.cart', $product->slug) }}" id="form-id" method="GET">
                  <div class="plus-minus">
                    <i class="sub" onclick="decrementValue()" data-feather="minus"></i>
                    <input type="number" name="quantity" id="number" value="1" min="1" max="10" />
                    <i class="add" onclick="incrementValue()" data-feather="plus"></i>
                  </div>

                </div>
              </div>
              <div class="btn-group">
                {{-- <a onclick="location.href = '{{ route('add.to.cart', $product->slug) }}';" class="btn-solid btn-sm addtocart-btn">Add To Cart </a> --}}
                <a href="#" onclick="document.getElementById('form-id').submit();"  class="btn-solid btn-sm addtocart-btn">Add To Cart </a>
                @php
                $wishlists = session('wishlist');
                $search = false;
                if ($wishlists) {
                    $search = array_key_exists($product->id, $wishlists);
                }
            @endphp
                <a href="{{ route('add.to.wishlist', $product->slug) }}" class="btn-outline btn-sm wishlist-btn">
                    <i
                    class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }}  fa-heart"></i>
                    Add To Wishlist</a>

            </form>

            </div>
            <div class="row">
                <div class="col-md-6 my-2">
                    <a href="{{ asset($metaImage) }}" download="{{ $product->name . time() }}"
                        onclick="shareOnWhatsApp()"
                        class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold">
                        Share on WhatsApp
                    </a>
                </div>
                <div class="col-md-6 my-2">
                    <!-- Button trigger modal -->
                    @auth

                    @endauth
                    <button type="button" class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Buy Now
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$product->name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('directPlaceOrder')}}" method="POST">
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    @csrf

                                <div class="img_container text-center">
                                    <img src="{{asset($product->image)}}" class="img-fluid rounded" alt="">
                                </div>
                                <br>
                                <div class="w-75  " style="margin: 0px auto !important">


                                <div class="plus-minus">
                                    <i class="sub" onclick="decrementValueModal()" data-feather="minus"></i>
                                    <input type="number" name="quantity" id="number_modal" required value="1" min="1" max="10" />
                                    <i class="add" onclick="incrementValueModal()" data-feather="plus"></i>
                                </div>
                                <br>
                                <br>
                                <div class="form-group">
                                    <label for="">Enter Your Profit</label>
                                    <input type="number" min="0" required class="form-control" name="profit" value="0" placeholder="Enter Your Profit">
                                </div>
                                <button type="submit" class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold">Place Order</button>

                                <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">Close</button>
                            </div>
                            </form>
                            </div>
                            <div class="modal-footer">



                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- <form action="{{ route('add.to.cart', $product->slug) }}">
                        <input type="hidden" name="quantity"  value="1" min="1" max="10" />
                        <input type="hidden" name="checkout" value="yes">
                        <button class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold"
                            type="submit">
                            <i class="iconly-Bag-2 icli f1"></i>&nbsp; Buy Now
                        </button>
                    </form> --}}
                </div>

            </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabs Start -->
      <div class="description-box">
        <div class="row gy-4">
          <div class="col-12">
            <!-- Tabs Filter Start -->
            <ul class="nav nav-pills nav-tabs2 row-tab" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                  Description
                </button>
              </li>

              {{-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="specification-tab" data-bs-toggle="pill" data-bs-target="#specification" type="button" role="tab" aria-controls="specification" aria-selected="false">
                  Specification
                </button>
              </li> --}}

              <li class="nav-item" role="presentation">
                <button class="nav-link" id="seller-tab" data-bs-toggle="pill" data-bs-target="#seller" type="button" role="tab" aria-controls="seller" aria-selected="false">Seller</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="copy-button">Copy Details</button>
                {{-- <button class="nav-link" id="seller-tab" data-bs-toggle="pill" data-bs-target="#seller" type="button" role="tab" aria-controls="seller" aria-selected="false">Seller</button> --}}
              </li>

              {{-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="review-tab" data-bs-toggle="pill" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">
                  Review <span>3</span>
                </button>
              </li> --}}
            </ul>
            <!-- Tabs Filter End -->
          </div>

          <div class="col-12">
            <!-- Tab Content Start -->
            <div class="tab-content" id="pills-tabContent">
              <!-- Description Tab Content Start -->
              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <input type="hidden" name=""  value="{{$product->detail}}">
                <div class="details-product" id="copy_detail" >
                  {{$product->detail}}
                </div>
              </div>
              <!-- Description Tab Content End -->

              <!-- Specification Tab Content Start -->
              <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                <div class="specification-wrap">
                  <p class="font-md content-color">
                    The Model is wearing a white blouse from our stylist's collection, see the image for a mock-up of what the actual blouse would look like.it has text written on it in a black
                    cursive language which looks great on a white color.
                  </p>
                  <div class="table-responsive">
                    <table class="specification-table table striped">
                      <tr>
                        <th>Product Dimensions</th>
                        <td>15 x 15 x 3 cm; 250 Grams</td>
                      </tr>
                      <tr>
                        <th>Date First Available</th>
                        <td>5 April 2021</td>
                      </tr>
                      <tr>
                        <th>Manufacturer‏</th>
                        <td>Aditya Birla Fashion and Retail Limited</td>
                      </tr>
                      <tr>
                        <th>ASIN</th>
                        <td>B06Y28LCDN</td>
                      </tr>
                      <tr>
                        <th>Item model number</th>
                        <td>AMKP317G04244</td>
                      </tr>
                      <tr>
                        <th>Department</th>
                        <td>Men</td>
                      </tr>
                      <tr>
                        <th>Item Weight</th>
                        <td>250 G</td>
                      </tr>
                      <tr>
                        <th>Item Dimensions LxWxH</th>
                        <td>15 x 15 x 3 Centimeters</td>
                      </tr>
                      <tr>
                        <th>Net Quantity</th>
                        <td>1 U</td>
                      </tr>
                      <tr>
                        <th>Included Components‏</th>
                        <td>1-T-shirt</td>
                      </tr>
                      <tr>
                        <th>Generic Name</th>
                        <td>T-shirt</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Specification Tab Content End -->

              <!-- Seller Tab Content Start -->
              <div class="tab-pane fade" id="seller" role="tabpanel" aria-labelledby="seller-tab">
                <div class="seller-info">
                  <div class="seller-details">
                    <div class="seller-logo-wrap">
                      <div class="img-box">
                        @if (is_null($product->branding_id))
                        <a href="{{asset($shop->image)}}" target="_blank">
                            <img src="{{asset($shop->image)}}" alt="seller" />
                        </a>
                        @else
                        <a href="{{asset($product->branding->image)}}" target="_blank">
                            <img src="{{asset($product->branding->image)}}" alt="seller" />
                        </a>
                        @endif

                    </div>
                      <div class="seller-content">
                        @if (is_null($product->branding_id))
                        <h5>{{$shop->name}}</h5>
                        @else
                        <h5>Branding: {{$product->branding->name}}</h5>
                        @endif

                        <div class="rating-box">
                          <ul class="rating p-0 mb">
                            <li>
                              <i class="fill" data-feather="star"></i>
                            </li>
                            <li>
                              <i class="fill" data-feather="star"></i>
                            </li>
                            <li>
                              <i class="fill" data-feather="star"></i>
                            </li>
                            <li>
                              <i class="fill" data-feather="star"></i>
                            </li>
                            <li>
                              <i class="fill" data-feather="star"></i>
                            </li>
                          </ul>
                          <span>(105 Rating)</span>
                        </div>
                      </div>
                    </div>

                    <ul class="review-rated">
                      <li>
                        <span>Delivery Time</span>
                        <span>100%</span>
                      </li>
                      <li>
                        <span>Response</span>
                        <span>90%</span>
                      </li>
                      <li>
                        <span>Rating</span>
                        <span>95%</span>
                      </li>
                    </ul>
                  </div>

                  <div class="addres-box">
                    @if (is_null($product->branding_id))
                      <p>
                        <span class="contact"><i data-feather="map-pin"></i>Address :</span> <span class="contact-info">{{$shop->address}}, {{$shop->city}},{{$shop->province}} </span>
                      </p>
                      <p>
                        <span class="contact"><i data-feather="phone"></i>Contact Number :</span> <span class="contact-info"> {{$shop->mobile}} </span>
                      </p>
                        @else

                    @endif


                    {{-- <p class="info">
                      Supreme Seller is the world famous seller for quality and service classified by and how they are connected residences and land. Connected residences owned by a single entity
                      leased out, or owned separately with an agreement covering the either a single family or multifamily structure that is available for occupation or for non-business purposes.
                      relationship between units and common areas. Different types of housing tenure can be used for the same physical type.
                    </p> --}}
                  </div>
                </div>
              </div>
              <!-- Seller Tab Content End -->

              <!-- Review Tab Content Start -->
              <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="review-section">
                  <div class="row gy-4 gy-md-5 g-4 g-xxl-5">
                    <div class="col-md-8 col-xxl-7 order-2 order-md-1">
                      <div class="review-left">
                        <div class="title-box4">
                          <h4 class="heading">Customers Q & A <span class="bg-theme-blue"></span></h4>
                        </div>
                        <div class="question-wrap">
                          <div class="comment-box">
                            <div class="img-box">
                              <img src="../assets/images/avatar/avatar.jpg" alt="avatar" />
                            </div>
                            <div class="avatar-content">
                              <div class="name-box">
                                <div class="user-info">
                                  <h5><i data-feather="user"></i> Anne R. Allen</h5>
                                  <span> <i data-feather="clock"></i> Aug 29, 2022</span>
                                </div>
                                <div class="action-box ms-auto">
                                  <ul class="rating p-0 mb d-none d-xl-flex">
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                  </ul>
                                  <a href="#replaySection" class="replay-btn"><i data-feather="corner-up-left"></i> Replay</a>
                                </div>
                              </div>
                              <p>
                                Khaki cotton blend military jacket flattering fit mock horn buttons and patch pockets showerproof black lightgrey. Printed lining patch pockets jersey blazer built
                                in pocket square wool casual quilted jacket without hood azure.
                              </p>
                            </div>
                          </div>

                          <div class="comment-box replay-comment">
                            <div class="img-box">
                              <img src="../assets/images/avatar/avatar2.jpg" alt="avatar" />
                            </div>
                            <div class="avatar-content">
                              <div class="name-box">
                                <div class="user-info">
                                  <h5><i data-feather="user"></i> Francisco M. Clifton</h5>
                                  <span> <i data-feather="clock"></i> July 15, 2022</span>
                                </div>
                                <div class="action-box ms-auto">
                                  <ul class="rating p-0 mb d-none d-xl-flex">
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i data-feather="star"></i>
                                    </li>
                                  </ul>
                                  <a href="#replaySection" class="replay-btn"><i data-feather="corner-up-left"></i> Replay</a>
                                </div>
                              </div>
                              <p>
                                Iconic style heritage brand outerwear collection lightweight showerproof material full zip fastening adjustable sleeves. Khaki cotton blend military jacket
                                flattering fit mock horn buttons and patch pockets showerproof black lightgrey.
                              </p>
                            </div>
                          </div>

                          <div class="comment-box">
                            <div class="img-box">
                              <img src="../assets/images/avatar/avatar4.jpg" alt="avatar" />
                            </div>
                            <div class="avatar-content">
                              <div class="name-box">
                                <div class="user-info">
                                  <h5><i data-feather="user"></i> Jacquelyn R. Planet</h5>
                                  <span> <i data-feather="clock"></i> August 20, 2022</span>
                                </div>
                                <div class="action-box ms-auto">
                                  <ul class="rating p-0 mb d-none d-xl-flex">
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i class="fill" data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i data-feather="star"></i>
                                    </li>
                                    <li>
                                      <i data-feather="star"></i>
                                    </li>
                                  </ul>
                                  <a href="#replaySection" class="replay-btn"><i data-feather="corner-up-left"></i> Replay</a>
                                </div>
                              </div>
                              <p>Capsule wardrobe double breasted jacket chic lightweight contemporary luxury cotton-and-linen blend tucks at the back.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Reply From Section Start -->
                      <div class="replay-form round-wrap-content top-space" id="replaySection">
                        <div class="title-box4">
                          <h4 class="heading">Leave a Comment<span class="bg-theme-blue"></span></h4>
                        </div>

                        <form action="javascript:void(0)" class="custom-form form-pill">
                          <div class="row g-3 g-sm-4">
                            <div class="col-sm-6">
                              <div class="input-box">
                                <label for="name">Full Name</label>
                                <input name="name" id="name" type="text" class="form-control" />
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="input-box">
                                <label for="email">Email Address</label>
                                <input name="email" id="email" type="email" class="form-control" />
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="input-box">
                                <label for="comment">Comments</label>
                                <textarea class="form-control" id="comment" cols="30" rows="5"></textarea>
                              </div>
                            </div>

                            <div class="col-12 text-end">
                              <button class="post-button btn btn-solid btn-sm mb-line">Post Comment <i class="arrow"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- Reply From Section End -->
                    </div>

                    <div class="col-md-4 col-xxl-5 order-1 order-md-2">
                      <div class="review-right sticky">
                        <div class="customer-rating">
                          <div class="title-box4">
                            <h4 class="heading">Customers Review<span class="bg-theme-blue"></span></h4>
                          </div>

                          <div class="global-rating">
                            <div>
                              <h5>4.5</h5>
                            </div>

                            <div>
                              <h6>Average Ratings</h6>
                              <ul class="rating p-0 mb">
                                <li>
                                  <i class="fill" data-feather="star"></i>
                                </li>
                                <li>
                                  <i class="fill" data-feather="star"></i>
                                </li>
                                <li>
                                  <i class="fill" data-feather="star"></i>
                                </li>
                                <li>
                                  <i class="fill" data-feather="star"></i>
                                </li>
                                <li>
                                  <i data-feather="star"></i>
                                </li>
                                <li>
                                  <span>(12)</span>
                                </li>
                              </ul>
                            </div>
                          </div>

                          <ul class="rating-progess">
                            <li>
                              <h5>5 Star</h5>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 78%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <h5>78%</h5>
                            </li>
                            <li>
                              <h5>4 Star</h5>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <h5>62%</h5>
                            </li>
                            <li>
                              <h5>3 Star</h5>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 44%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <h5>44%</h5>
                            </li>
                            <li>
                              <h5>2 Star</h5>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <h5>30%</h5>
                            </li>
                            <li>
                              <h5>1 Star</h5>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 18%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <h5>18%</h5>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Review Tab Content End -->
            </div>
            <!-- Tab Content End -->
          </div>
        </div>
      </div>
      <!-- Tabs End -->
    </div>

  </section>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- Product Section End -->
  {{-- <script src="{{asset('newtheme/assets/js/feather/feather.min.js')}}"></script> --}}
    <!-- Swiper Slider Js -->
    <script src="{{asset('newtheme/assets/js/swiper-slider/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('newtheme/assets/js/swiper-slider/swiper-custom.min.js')}}"></script>
  <script type="text/javascript">
    function incrementValue()
    {

        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<10){
            value++;
            console.log(value);
                document.getElementById('number').value = value;
        }
    }
    function decrementValue()
    {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
                document.getElementById('number').value = value;
        }

    }
    function incrementValueModal()
    {

        var value = parseInt(document.getElementById('number_modal').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<10){
            value++;
            console.log(value);
                document.getElementById('number_modal').value = value;
        }
    }
    function decrementValueModal()
    {
        var value = parseInt(document.getElementById('number_modal').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
                document.getElementById('number_modal').value = value;
        }

    }
    </script>
   <script>
    $(document).ready(function() {


        $('#copy-button').click(function() {
            console.log('working');
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





<style>
    img.img-fluid.bg-img {
    width: 256px !important;
    height: 170.8px !important;
    object-fit: cover !important;
}
  </style>
