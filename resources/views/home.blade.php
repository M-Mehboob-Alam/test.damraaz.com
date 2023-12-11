@extends('layouts.app')
@section('title')
    User Dashboard
@endsection

@php
    use Illuminate\Support\Facades\Crypt;
@endphp
@section('content')
    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick-theme.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bulk-style.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <style>
        .nav-link2 {
            font-size: calc(17px + (18 - 17) * ((100vw - 320px) / (1920 - 320)));
            position: relative;
            color: #4a5568;
            width: 100%;
            text-align: left;
            padding: calc(10px + (13 - 10) * ((100vw - 320px) / (1920 - 320))) calc(10px + (13 - 10) * ((100vw - 320px) / (1920 - 320))) calc(10px + (13 - 10) * ((100vw - 320px) / (1920 - 320))) calc(19px + (23 - 19) * ((100vw - 320px) / (1920 - 320)));
            font-weight: 500;
            z-index: 0;
            overflow: hidden;
            border-radius: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;

            background: none;
            border: 0;

        }

        .nav-link2 .feather {
            width: calc(18px + (19 - 18) * ((100vw - 320px) / (1920 - 320)));
            height: auto;
            margin-right: 10px;
        }

        /* .dropdown:hover .dropdown-menu {
                            display: block;
                        } */

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: var(--theme-color);
        }
    </style>
    <style>
        .rating {
            direction: rtl;
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            float: right;
            cursor: pointer;
            color: #ccc;
        }

        .rating label:before {
            content: '\2605';
            font-size: 5em;
        }

        .rating input:checked~label {
            color: #ffca08;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: #ffca08;
        }

        .rating2 {
            direction: rtl;
            display: inline-block;
        }

        .rating2 input {
            display: none;
        }

        .rating2 label {
            float: right;
            cursor: pointer;
            color: #ccc;
        }

        .rating2 label:before {
            content: '\2605';
            font-size: 5em;
        }

        .rating2 input:checked~label {
            color: #ffca08;
        }

        .rating2 label:hover,
        .rating2 label:hover~label {
            color: #ffca08;
        }
    </style>
    @php
        $user = Auth()->user();
    @endphp


    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="col-xxl-3 col-lg-3">
                    <div class="dashboard-left-sidebar" id="shower">
                        <div class="close-button d-flex d-lg-none" id="closer_hider">
                            <button class="close-sidebar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="profile-box">
                            <div class="cover-image">
                                <img src="{{ asset('assets/images/inner-page/cover-img.jpg') }}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        <img src="{{ asset('assets/images/vendor-page/logo.png') }}"
                                            class="blur-up lazyload update_img" alt="">
                                    </div>
                                </div>

                                <div class="profile-name">
                                    <h3>{{ $user->name ?? '-' }}</h3>
                                    <h6 class="text-content">{{ $user->email ?? '-' }}</h6>
                                    <a class="" href='#' data-bs-toggle="modal"
                                        data-bs-target="#change-password">Change Password</a>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false"><i data-feather="user"></i>
                                    Profile</button>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <a href="#pills-tabContent" class="nav-link" id="pills-dashboard-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-dashboard" role="tab"
                                    aria-controls="pills-dashboard" aria-selected="true"><i data-feather="home"></i>
                                    DashBoard</a>
                            </li> --}}


                            <!--<li class="nav-item" role="presentation">-->
                            <!--    <button class="nav-link" id="pills-product-tab" data-bs-toggle="pill"-->
                            <!--        data-bs-target="#pills-product" type="button" role="tab"-->
                            <!--        aria-controls="pills-product" aria-selected="false"><i-->
                            <!--            data-feather="shopping-bag"></i>Products</button>-->
                            <!--</li>-->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-payment-method-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-payment-method" type="button" role="tab"
                                    aria-controls="pills-payment-method" aria-selected="false"><i
                                        data-feather="credit-card"></i>
                                    Payment Method </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-withdrawHistory-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-withdrawHistory" type="button" role="tab"
                                    aria-controls="pills-order" aria-selected="false"><i
                                        data-feather="shopping-bag"></i>Withdraw History</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link"aria-selected="false"><i data-feather="dollar-sign"></i>
                                    Withdraw Commission</a>
                            </li>

                            {{-- <li class="nav-item d-lg-block d-none" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button" role="tab"
                                    aria-controls="pills-order" aria-selected="false"><i
                                        data-feather="shopping-bag"></i>Order</button>
                            </li> --}}



                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-partner-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-partner"
                                    onclick=location.href="{{ route('order.inProgress') }}" type="button"
                                    role="tab" aria-controls="pills-partner" aria-selected="false"><i
                                        data-feather="shopping-bag"></i>
                                    Orders</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-partner-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-partner" type="button" role="tab"
                                    aria-controls="pills-partner" aria-selected="false"><i data-feather="users"></i>
                                    Partners</button>
                            </li>


                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profit-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profit" type="button" role="tab"
                                    aria-controls="pills-profit" aria-selected="false"><i data-feather="dollar-sign"></i>
                                    Our Profit</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-followed-shops-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-followed-shops" type="button" role="tab"
                                    aria-controls="pills-profit" aria-selected="false"><i data-feather="user-check"></i>
                                    Followed Shops</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-favourite-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-favourite" type="button" role="tab"
                                    aria-controls="pills-profit" aria-selected="false"><i data-feather="heart"></i>
                                    Favourite </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-share-items-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-share-items" type="button" role="tab"
                                    aria-controls="pills-share-items" aria-selected="false"><i
                                        data-feather="share-2"></i>
                                    Shared Items </button>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-xxl-9 col-lg-9">
                    <div class="row g-2 rounded theme-bg-color text-white">
                        <div class="col-12 py-1">
                            <p class="text-center">{{ $total_sales->sum('orders_detail_sum_amount') }}</p>
                            <p class="text-center small">Total Sales</p>
                        </div>
                        
                        {{-- <div class="col-3 py-1">
                            <p class="text-center">{{ $orders->total() }}</p>
                            <p class="text-center small">Total Orders</p>
                        </div> --}}
                        <div class="col-4 py-1">
                            <p class="text-center">{{ $countCompletedOrders }}</p>
                            <p class="text-center small">Completed Orders</p>
                        </div>
                        {{-- <div class="col-3 py-1">
                            <p class="text-center">{{ $withdraws->sum('amount') }}</p>
                            <p class="text-center small">Total Withdraw</p>
                        </div>
                        <div class="col-3 py-1">
                            <p class="text-center">{{ $amount - $withdraws->sum('amount') }}</p>
                            <p class="text-center small">Balance remaining</p>
                        </div> --}}

                        <div class="col-4 py-1">
                            <p class="text-center">{{ $myPaidProfits->sum('amount') }}
                            </p>
                            <p class="text-center small">Total Profit</p>
                        </div>

                        <div class="col-4 py-1">
                            <p class="text-center">{{ $sale_commission ?? 0 }}</p>
                            <p class="text-center small">Total Bonus</p>
                        </div>
                    </div>
                    <button id="outsideButton"
                        class=" mt-1 btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Profile</button>

                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            {{-- <div class="tab-pane fade" id="pills-dashboard" role="tabpanel"
                                aria-labelledby="pills-dashboard-tab">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>My Dashboard</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg') }}#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{ asset('assets/images/svg/order.svg') }}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{ asset('assets/images/svg/order.svg') }}"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Withdraw</h5>
                                                        <h3>{{ $withdraws->sum('amount') }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{ asset('assets/images/svg/pending.svg') }}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{ asset('assets/images/svg/pending.svg') }}"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Commission</h5>
                                                        <h3>{{ $amount }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{ asset('assets/images/svg/pending.svg') }}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{ asset('assets/images/svg/pending.svg') }}"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Balance Remaining</h5>
                                                        <h3>{{ $amount - $withdraws->sum('amount') }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{ asset('assets/images/svg/wishlist.svg') }}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{ asset('assets/images/svg/wishlist.svg') }}"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Orders</h5>
                                                        <h3>{{ $orders->total() }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{ asset('assets/images/svg/wishlist.svg') }}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{ asset('assets/images/svg/wishlist.svg') }}"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Completed Orders</h5>
                                                        <h3>{{ $countCompletedOrders }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-xxl-6">
                                            <div class="dashboard-bg-box">
                                                <div id="chart"></div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6">
                                            <div class="dashboard-bg-box">
                                                <div id="sale"></div>
                                            </div>
                                        </div>

                                        <!--<div class="col-xxl-6">-->
                                        <!--    <div class="table-responsive dashboard-bg-box">-->
                                        <!--        <div class="dashboard-title mb-4">-->
                                        <!--            <h3>Trending Products</h3>-->
                                        <!--        </div>-->

                                        <!--        <table class="table product-table">-->
                                        <!--            <thead>-->
                                        <!--                <tr>-->
                                        <!--                    <th scope="col">Images</th>-->
                                        <!--                    <th scope="col">Product Name</th>-->
                                        <!--                    <th scope="col">Price</th>-->
                                        <!--                    <th scope="col">Sales</th>-->
                                        <!--                </tr>-->
                                        <!--            </thead>-->
                                        <!--            <tbody>-->
                                        <!--                <tr>-->
                                        <!--                    <td class="product-image">-->
                                        <!--                        <img src="{{ asset('assets/images/vegetable/product/1.png') }}"-->
                                        <!--                            class="img-fluid" alt="">-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>Fantasy Crunchy Choco Chip Cookies</h6>-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>$25.69</h6>-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>152</h6>-->
                                        <!--                    </td>-->
                                        <!--                </tr>-->

                                        <!--                <tr>-->
                                        <!--                    <td class="product-image">-->
                                        <!--                        <img src="{{ asset('assets/images/vegetable/product/2.png') }}"-->
                                        <!--                            class="img-fluid" alt="">-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>Peanut Butter Bite Premium Butter Cookies 600 g</h6>-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>$35.36</h6>-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>34</h6>-->
                                        <!--                    </td>-->
                                        <!--                </tr>-->

                                        <!--                <tr>-->
                                        <!--                    <td class="product-image">-->
                                        <!--                        <img src="{{ asset('assets/images/vegetable/product/3.png') }}"-->
                                        <!--                            class="img-fluid" alt="">-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>Yumitos Chilli Sprinkled Potato Chips 100 g</h6>-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>$78.55</h6>-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>78</h6>-->
                                        <!--                    </td>-->
                                        <!--                </tr>-->

                                        <!--                <tr>-->
                                        <!--                    <td class="product-image">-->
                                        <!--                        <img src="{{ asset('assets/images/vegetable/product/4.png') }}"-->
                                        <!--                            class="img-fluid" alt="">-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>healthy Long Life Toned Milk 1 L</h6>-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>$32.98</h6>-->
                                        <!--                    </td>-->
                                        <!--                    <td>-->
                                        <!--                        <h6>135</h6>-->
                                        <!--                    </td>-->
                                        <!--                </tr>-->
                                        <!--            </tbody>-->
                                        <!--        </table>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <!--<div class="col-xxl-6">-->
                                        <!--    <div class="order-tab dashboard-bg-box">-->
                                        <!--        <div class="dashboard-title mb-4">-->
                                        <!--            <h3>Recent Order</h3>-->
                                        <!--        </div>-->

                                        <!--        <div class="table-responsive">-->
                                        <!--            <table class="table order-table">-->
                                        <!--                <thead>-->
                                        <!--                    <tr>-->
                                        <!--                        <th scope="col">Order ID</th>-->
                                        <!--                        <th scope="col">Product Name</th>-->
                                        <!--                        <th scope="col">Status</th>-->
                                        <!--                    </tr>-->
                                        <!--                </thead>-->
                                        <!--                <tbody>-->
                                        <!--                    <tr>-->
                                        <!--                        <td class="product-image">#254834</td>-->
                                        <!--                        <td>-->
                                        <!--                            <h6>Choco Chip Cookies</h6>-->
                                        <!--                        </td>-->
                                        <!--                        <td>-->
                                        <!--                            <label class="success">Shipped</label>-->
                                        <!--                        </td>-->
                                        <!--                    </tr>-->

                                        <!--                    <tr>-->
                                        <!--                        <td class="product-image">#355678</td>-->
                                        <!--                        <td>-->
                                        <!--                            <h6>Premium Butter Cookies</h6>-->
                                        <!--                        </td>-->
                                        <!--                        <td>-->
                                        <!--                            <label class="danger">Pending</label>-->
                                        <!--                        </td>-->
                                        <!--                    </tr>-->

                                        <!--                    <tr>-->
                                        <!--                        <td class="product-image">#647536</td>-->
                                        <!--                        <td>-->
                                        <!--                            <h6>Sprinkled Potato Chips</h6>-->
                                        <!--                        </td>-->
                                        <!--                        <td>-->
                                        <!--                            <label class="success">Shipped</label>-->
                                        <!--                        </td>-->
                                        <!--                    </tr>-->

                                        <!--                    <tr>-->
                                        <!--                        <td class="product-image">#125689</td>-->
                                        <!--                        <td>-->
                                        <!--                            <h6>Milk 1 L</h6>-->
                                        <!--                        </td>-->
                                        <!--                        <td>-->
                                        <!--                            <label class="danger">Pending</label>-->
                                        <!--                        </td>-->
                                        <!--                    </tr>-->

                                        <!--                    <tr>-->
                                        <!--                        <td class="product-image">#215487</td>-->
                                        <!--                        <td>-->
                                        <!--                            <h6>Raw Mutton Leg</h6>-->
                                        <!--                        </td>-->
                                        <!--                        <td>-->
                                        <!--                            <label class="danger">Pending</label>-->
                                        <!--                        </td>-->
                                        <!--                    </tr>-->

                                        <!--                    <tr>-->
                                        <!--                        <td class="product-image">#365474</td>-->
                                        <!--                        <td>-->
                                        <!--                            <h6>Instant Coffee</h6>-->
                                        <!--                        </td>-->
                                        <!--                        <td>-->
                                        <!--                            <label class="success">Shipped</label>-->
                                        <!--                        </td>-->
                                        <!--                    </tr>-->

                                        <!--                    <tr>-->
                                        <!--                        <td class="product-image">#368415</td>-->
                                        <!--                        <td>-->
                                        <!--                            <h6>Jowar Stick and Jowar Chips</h6>-->
                                        <!--                        </td>-->
                                        <!--                        <td>-->
                                        <!--                            <label class="danger">Pending</label>-->
                                        <!--                        </td>-->
                                        <!--                    </tr>-->
                                        <!--                </tbody>-->
                                        <!--            </table>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div> --}}

                            <div class="tab-pane fade" id="pills-order" role="tabpanel"
                                aria-labelledby="pills-order-tab">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>Orders</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg') }}#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="order-tab dashboard-bg-box">
                                        <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-in-progress-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-in-progress"
                                                    role="tab" aria-controls="pills-in-progress"
                                                    aria-selected="true">In-Progress <span
                                                        class="badge  bg-info ">{{ $inProgressOrders->count() }}</span></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-delivered-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-delivered" role="tab"
                                                    aria-controls="pills-delivered" aria-selected="false">Delivered <span
                                                        class="badge  bg-info ">{{ $deliveredOrders->count() }}</span></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-returned-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-returned" type="button" role="tab"
                                                    aria-controls="pills-returned" aria-selected="false">Returned <span
                                                        class="badge  bg-info ">{{ $returnedOrders->count() }}</span></button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-in-progress" role="tabpanel"
                                                aria-labelledby="pills-in-progress-tab" tabindex="0">
                                                <div class="table-responsive" id="contentToPrint">
                                                    <table class="table order-table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Order ID</th>
                                                                <th scope="col">Total Amount</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Profit</th>
                                                                <th scope="col">Order date</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($inProgressOrders as $inProgress)
                                                                <tr>
                                                                    <td class="product-image">
                                                                        {{ $inProgress->orderId }}</td>
                                                                    <td>{{ $inProgress->total_amount }}</td>
                                                                    <td>
                                                                        <!--<label class="success">Shipped</label>-->
                                                                        {{ $inProgress->status }}
                                                                    </td>
                                                                    <td>
                                                                        <h6>{{ $inProgress->user_profit }}</h6>
                                                                    </td>
                                                                    <td>{{ $inProgress->created_at->format('d-m-Y H:i:s') }}
                                                                    </td>
                                                                    <td class="d-flex">
                                                                        <a class="px-1"
                                                                            href="{{ route('user.order.detail', $inProgress->id) }}"><i
                                                                                data-feather="eye" class="edit"></i></a>
                                                                        <a href="#"
                                                                            title="Track Your Order">Track</a>

                                                                    </td>
                                                                </tr>


                                                            @empty
                                                                <tr>
                                                                    <td>No Orders Found</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="pills-delivered" role="tabpanel"
                                                aria-labelledby="pills-delivered-tab" tabindex="0">
                                                <div class="table-responsive" id="contentToPrint">
                                                    <table class="table order-table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Order ID</th>
                                                                <th scope="col">Total Amount</th>
                                                                <th scope="col">Return Date</th>
                                                                <th scope="col">Profit</th>
                                                                <th scope="col">Order date</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($deliveredOrders as $delivered)
                                                                <tr>
                                                                    <td class="product-image">
                                                                        {{ $delivered->orderId }}</td>
                                                                    <td>{{ $delivered->total_amount }}</td>
                                                                    @php
                                                                        $returnDate = $delivered->updated_at->addDays(5);
                                                                    @endphp
                                                                    <td class="countdown success"
                                                                        data-date="{{ $returnDate }}"> </td>
                                                                    <td>
                                                                        <h6>{{ $delivered->user_profit }}</h6>
                                                                    </td>
                                                                    <td>{{ $delivered->created_at->format('d-m-Y H:i:s') }}
                                                                    </td>
                                                                    <td class="d-flex">
                                                                        <a class="px-1"
                                                                            href="{{ route('user.order.detail', $delivered->id) }}"><i
                                                                                data-feather="eye" class="edit"></i></a>
                                                                        <a href="#"
                                                                            title="Track Your Order">Track</a>


                                                                        <a class="px-1" href="javascript:void(0)"
                                                                            data-bs-toggle="modal" title="Rating Modal"
                                                                            data-bs-target="#rating{{ $delivered->id }}">Rating</a>
                                                                        @php
                                                                            $daysPlus5 = $delivered->updated_at->addDays(5);
                                                                            $now = Carbon\Carbon::now();
                                                                        @endphp
                                                                        @if ($daysPlus5 > $now)
                                                                            <a href="javascript:void(0)"
                                                                                data-bs-toggle="modal"
                                                                                title="Return Order back"
                                                                                data-bs-target="#return{{ $delivered->id }}"><i
                                                                                    data-feather="x-square"
                                                                                    class="edit"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                @if ($daysPlus5 > $now)
                                                                    <!-- order return -->
                                                                    <div class="modal fade theme-modal view-modal "
                                                                        id="return{{ $delivered->id }}" tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div
                                                                            class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Return Order
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <i class="fa-solid fa-xmark"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row g-sm-4 g-2">
                                                                                        <form method="post"
                                                                                            enctype="multipart/form-data"
                                                                                            action="{{ route('user.order.return', $delivered->id) }}">
                                                                                            @csrf
                                                                                            <div class="col-md-6 my-1">
                                                                                                <label
                                                                                                    for="name">Name</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    required name="name"
                                                                                                    id="name">
                                                                                            </div>
                                                                                            <div class="col-md-6 my-1">
                                                                                                <label
                                                                                                    for="whatsapp">WhatsApp
                                                                                                    #</label>
                                                                                                <input type="tel"
                                                                                                    class="form-control"
                                                                                                    required
                                                                                                    name="whatsapp"
                                                                                                    id="whatsapp">
                                                                                            </div>
                                                                                            <div class="col-md-6 my-1">
                                                                                                <label
                                                                                                    for="reason">Reason</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    required name="reason"
                                                                                                    id="reason">
                                                                                            </div>
                                                                                            <div class="col-md-6 my-1">
                                                                                                <label
                                                                                                    for="images">Images</label>
                                                                                                <input type="file"
                                                                                                    multiple
                                                                                                    accept="images/*"
                                                                                                    class="form-control"
                                                                                                    required
                                                                                                    name="images[]"
                                                                                                    id="images">
                                                                                            </div>
                                                                                            <div class="col-md-12 ">
                                                                                                <button
                                                                                                    class="btn bg-danger view-button icon text-white fw-bold btn-md ms-auto">Submit</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--/order return -->
                                                                @endif
                                                                <!-- order Rating -->
                                                                <div class="modal fade theme-modal view-modal "
                                                                    id="rating{{ $delivered->id }}" tabindex="-1"
                                                                    aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div
                                                                        class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Ratings</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="fa-solid fa-xmark"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row g-sm-4 g-2">
                                                                                    <form method="post"
                                                                                        enctype="multipart/form-data"
                                                                                        action="{{ route('user.rating.store', $delivered->id) }}">
                                                                                        @csrf
                                                                                        <div class="col-md-6">
                                                                                            <h6>Rating for Price</h6>
                                                                                            <div class="rating">
                                                                                                <input type="radio"
                                                                                                    id="star5{{ $delivered->id }}"
                                                                                                    name="price_rating"
                                                                                                    value="5" />
                                                                                                <label
                                                                                                    for="star5{{ $delivered->id }}"></label>
                                                                                                <input type="radio"
                                                                                                    id="star4{{ $delivered->id }}"
                                                                                                    name="price_rating"
                                                                                                    value="4" />
                                                                                                <label
                                                                                                    for="star4{{ $delivered->id }}"></label>
                                                                                                <input type="radio"
                                                                                                    id="star3{{ $delivered->id }}"
                                                                                                    name="price_rating"
                                                                                                    value="3" />
                                                                                                <label
                                                                                                    for="star3{{ $delivered->id }}"></label>
                                                                                                <input type="radio"
                                                                                                    id="star2{{ $delivered->id }}"
                                                                                                    name="price_rating"
                                                                                                    value="2" />
                                                                                                <label
                                                                                                    for="star2{{ $delivered->id }}"></label>
                                                                                                <input type="radio"
                                                                                                    id="star1{{ $delivered->id }}"
                                                                                                    required
                                                                                                    name="price_rating"
                                                                                                    value="1" />
                                                                                                <label
                                                                                                    for="star1{{ $delivered->id }}"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <h6>Rating for Quality</h6>
                                                                                            <div class="rating2">
                                                                                                <input type="radio"
                                                                                                    id="qulaity5{{ $delivered->id }}"
                                                                                                    name="quality_rating"
                                                                                                    value="5" />
                                                                                                <label
                                                                                                    for="qulaity5{{ $delivered->id }}"></label>
                                                                                                <input type="radio"
                                                                                                    id="qulaity4{{ $delivered->id }}"
                                                                                                    name="quality_rating"
                                                                                                    value="4" />
                                                                                                <label
                                                                                                    for="qulaity4{{ $delivered->id }}"></label>
                                                                                                <input type="radio"
                                                                                                    id="qulaity3{{ $delivered->id }}"
                                                                                                    name="quality_rating"
                                                                                                    value="3" />
                                                                                                <label
                                                                                                    for="qulaity3{{ $delivered->id }}"></label>
                                                                                                <input type="radio"
                                                                                                    id="qulaity2{{ $delivered->id }}"
                                                                                                    name="quality_rating"
                                                                                                    value="2" />
                                                                                                <label
                                                                                                    for="qulaity2{{ $delivered->id }}"></label>
                                                                                                <input type="radio"
                                                                                                    id="qulaity1{{ $delivered->id }}"
                                                                                                    required
                                                                                                    name="quality_rating"
                                                                                                    disabled
                                                                                                    value="1" />
                                                                                                <label
                                                                                                    for="qulaity1{{ $delivered->id }}"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-12 ">
                                                                                            <button
                                                                                                class="btn bg-danger view-button icon text-white fw-bold btn-md ms-auto">Submit</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/order Rating -->
                                                            @empty
                                                                <tr>
                                                                    <td>No Orders Found</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-returned" role="tabpanel"
                                                aria-labelledby="pills-returned-tab" tabindex="0">
                                                <div class="table-responsive" id="contentToPrint">
                                                    <table class="table order-table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Order ID</th>
                                                                <th scope="col">Total Amount</th>
                                                                {{-- <th scope="col">Status</th> --}}
                                                                <th scope="col">Profit</th>
                                                                <th scope="col">Order date</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($returnedOrders as $returned)
                                                                <tr>
                                                                    <td class="product-image">
                                                                        {{ $returned->orderId }}</td>
                                                                    <td>{{ $returned->total_amount }}</td>
                                                                    {{-- <td>
                                                                        <!--<label class="success">Shipped</label>-->
                                                                        {{ $returned->status }}
                                                                    </td> --}}
                                                                    <td>
                                                                        <h6>{{ $returned->user_profit }}</h6>
                                                                    </td>
                                                                    <td>{{ $returned->created_at->format('d-m-Y H:i:s') }}
                                                                    </td>
                                                                    <td class="d-flex">
                                                                        <a class="px-1"
                                                                            href="{{ route('user.order.detail', $returned->id) }}"><i
                                                                                data-feather="eye" class="edit"></i></a>

                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td>No Orders Found</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-product" role="tabpanel"
                                aria-labelledby="pills-product-tab">
                                <div>
                                    <button onclick=location.href="{{ route('user.product.create') }}"
                                        class="btn btn-sm theme-bg-color text-white ms-auto ">Add Product</button>
                                </div>
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>Products</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg') }}#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="order-tab dashboard-bg-box">
                                        <div class="table-responsive">
                                            <table class="table order-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Price/Discount price</th>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Status</th>
                                                        <th>View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($products as $product)
                                                        <tr>
                                                            @php $image=json_decode($product->images)@endphp
                                                            <td>{{ $product->name ?? '-' }}</td>
                                                            <td>{{ $product->category->name ?? '-' }}</td>
                                                            <td>{{ $product->price ?? '-' }}/{{ $product->discount_price ?? '-' }}
                                                            </td>
                                                            <td class="product-image"><img
                                                                    src="{{ asset($product->image) }}" class="img-fluid">
                                                            </td>
                                                            <td>{{ $product->status ?? '-' }} </td>
                                                            <td>
                                                                <a class="nav-link"
                                                                    href="{{ route('user.product.detail', $product->id) }}"><i
                                                                        data-feather="eye" class="edit"></i></a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>No Product Found</tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <nav class="custome-pagination">
                                            <ul class="pagination justify-content-center">

                                                <li class="page-item">
                                                    {!! $products->links() !!}
                                                </li>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-partner" role="tabpanel"
                                aria-labelledby="pills-partner-tab">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>Partners</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="order-tab dashboard-bg-box">
                                        <div class="table-responsive">
                                            <table class="table order-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Username</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Commission</th>
                                                        <th scope="col">Business</th>
                                                        <th scope="col">Join Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($referrals as $refer)
                                                        <tr>
                                                            <td>{{ $refer->name ?? '-' }}</td>
                                                            <td>{{ $refer->username ?? '-' }}</td>
                                                            <td>{{ $refer->email ?? '-' }}</td>
                                                            <td>2</td>
                                                            <td>{{ $refer->business ?? '-' }} </td>
                                                            <td>{{ $refer->created_at ?? '-' }} </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>No Referral Found</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- <nav class="custome-pagination">
                                            <ul class="pagination justify-content-center">

                                                <li class="page-item">
                                                    {!! $products->links() !!}
                                                </li>
                                        </nav> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-withdrawHistory" role="tabpanel"
                                aria-labelledby="pills-withdrawHistory-tab">
                                <div class="dashboard-profile">
                                    <div class="title">
                                        <h2>Withdraw History</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg') }}#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="profile-tab dashboard-bg-box">
                                        <div class="dashboard-title dashboard-flex">
                                            <!--<h3>Withdraw History</h3>-->
                                            <!--<button class="btn btn-sm theme-bg-color text-white" data-bs-toggle="modal"-->
                                            <!--    data-bs-target="#edit-profile">Edit Profile</button>-->

                                            <div class="table-responsive">
                                                <table class="table order-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Account name</th>
                                                            <th scope="col">Account #</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Payment Type</th>
                                                            <th scope="col">Withdraw Of</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Message</th>
                                                            <th scope="col">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($withdraws as $w)
                                                            <tr>
                                                                <td>
                                                                    <h6>{{ $w->account_title ?? '-' }}</h6>
                                                                </td>
                                                                <td>{{ $w->account_no ?? '-' }}</td>
                                                                <td>{{ $w->amount ?? '-' }}</td>
                                                                <td>{{ $w->payment_type ?? '-' }},
                                                                    {{ $w->bank_name ?? '' }}
                                                                </td>
                                                                <td>{{ $w->withdrawOf ?? '-' }}</td>
                                                                <td>{{ $w->status ?? '-' }}</td>
                                                                <td>{{ $w->message ?? '-' }}</td>
                                                                <td class="product-image">
                                                                    {{ $w->created_at->diffForHumans() ?? '-' }}</td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="dashboard-profile">
                                    <div class="title">
                                        <h2>My Profile</h2>
                                        <div class="col-12 py-1">
                                            <p class="text-center">
                                                <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                href="{{ route('logout') }}" class="btn btn-primary" style="background: red;display: inline;color:white;">Logout</a>
                                            </p>
                                            
                                        </div>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg') }}#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="profile-tab dashboard-bg-box">
                                        <div class="dashboard-title dashboard-flex">
                                            <h3>Profile</h3>
                                            <div class="ms-auto">
                                                <h6 class="mb-1">Affiliate Link</h6>
                                                <div class="input-group mb-3">
                                                    <input id="referralLink" type="text"
                                                        value="{{ route('referralRegister', $user->username ?? '') }}"
                                                        class="form-control" readonly aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2">
                                                    <button class="input-group-text" id="copyLink"><i
                                                            class="fa fa-copy"></i></button>

                                                </div>
                                                @if (!$isJoinedDreamerWebsite)
                                                    @if ($isPurchasedMembershipCard)
                                                        @if (!$isUsedPurchasedMembershipCard)
                                                            <div class="input-group mb-3">
                                                                <a href="https://test.dreamervip.com/damraaz/use/membership/card/{{ $user->username }}" class="btn btn-warning" style="background-color: red;color:white;">Membership Card Used Now</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif

                                            </div>


                                        </div>

                                        <ul>

                                            <li>
                                                <h5>Name :</h5>
                                                <h5>{{ $user->name ?? '-' }}</h5>
                                            </li>
                                            <li>
                                                <h5>Username :</h5>
                                                <h5>{{ $user->username ?? '-' }}</h5>
                                            </li>
                                            <li>
                                                <h5>Refer by :</h5>
                                                <h5>{{ $user->refer_by ?? '-' }}</h5>
                                            </li>
                                            <li>
                                                <h5>Business Name :</h5>
                                                <div class="d-flex mt-3">
                                                    <h5><a href="#"
                                                            title="Visit Your Shop">{{ $user->business ?? '-' }}</a>
                                                    </h5>
                                                    {{-- <button data-bs-toggle="modal" data-bs-target="#edit-business"
                                                        class="btn theme-bg-color btn-md text-white">{{ $user->business ? 'Edit' : 'Create' }}
                                                        Shop</button> --}}
                                                    @if ($isShop)
                                                        <a class="btn theme-bg-color btn-md text-white"
                                                            href="{{ route('shopDetails') }}">Go To Shop</a>
                                                    @else
                                                        <a class="btn theme-bg-color btn-md text-white"
                                                            href="{{ route('newShopRequest') }}">Open Your
                                                            Shop</a>
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <h5>Email :</h5>
                                                <h5>{{ $user->email ?? '-' }}</h5>
                                            </li>
                                            <li>
                                                <h5>Shop Sales :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $shop_com }}</h5>
                                                <h5><a href="{{ route('allShopSAlesCommission') }}" class="m-3">View
                                                    All</a></h5>
                                                @if ($checkNextWithdraw && ($shop_com >=1500))
                                                &nbsp; &nbsp;
                                                <a href="#"
                                                    class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#SavingCommission">Withdraw</a>

                                                <div class="modal fade theme-modal view-modal " id="SavingCommission"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                        <div class="modal-content">
                                                            <div class="modal-header p-0">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row g-sm-4 g-2">
                                                                    @if (!blank($paymentType))
                                                                        <form class="row"
                                                                            action="{{ route('user.withdraw.store') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="withdrawOf"
                                                                                value="Shop">
                                                                            <input type="hidden" name="payment_type"
                                                                                id=""
                                                                                value="{{ $paymentType->payment_type }}">
                                                                            <div class="form-group col-md-6 my-3">
                                                                                <label for="title">Account
                                                                                    Title</label>
                                                                                <input type="text" required
                                                                                    class="form-control"id="title"
                                                                                    placeholder="Account name" readonly
                                                                                    value="{{ $paymentType->account_title }}"
                                                                                    name="account_title">
                                                                            </div>
                                                                            <div class="form-group col-md-6  my-3">
                                                                                <label for="account">Account
                                                                                    Number</label>
                                                                                <input type="text" required
                                                                                    class="form-control"id="account"
                                                                                    placeholder="eg: 2323*****"
                                                                                    readonly
                                                                                    value="{{ $paymentType->account_no }}"
                                                                                    name="account_no">
                                                                            </div>
                                                                            @if ($paymentType->payment_type == 'bank')
                                                                                <div class="form-group col-md-6  my-3">
                                                                                    <label for="">Bank
                                                                                        Name</label>
                                                                                    <input type="text" required
                                                                                        class="form-control" readonly
                                                                                        value="{{ $paymentType->bank_name }}"
                                                                                        name="bank_name"
                                                                                        id=""
                                                                                        placeholder="Enter Your Bank Name">
                                                                                </div>
                                                                            @endif
                                                                            <h6 class="text-danger">Note: 10% Tax Will Apply On Withdraw Shop Commission</h6>

                                                                            <div class="form-group col-md-6  my-3">
                                                                                <label for="amount">Enter Amount
                                                                                    <span class="text-danger">
                                                                                        &#40;Withdraw
                                                                                        Limit
                                                                                        min:1500 &#41;</span></label>
                                                                                <input type="number" required
                                                                                    class="form-control"
                                                                                    id="amount"
                                                                                    placeholder="Enter Amount eg: 1500"
                                                                                    name="amount">
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <button type="submit"
                                                                                    class="ms-auto btn bg-danger view-button icon text-white fw-bold btn-md">Confirm</button>

                                                                            </div>
                                                                        </form>
                                                                    @else
                                                                        <button
                                                                            class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#paymentMethod">Add Payment
                                                                            Method</button>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            </li>
                                            <li>
                                                <h5>Shop Charges 12%  :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $getShopCharges }}</h5>

                                            </li>
                                            <li>
                                                <h5>Total Commission :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $total_com }}</h5>
                                            </li>
                                            <li>
                                                <h5>Saving Commission :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $saving_com }}</h5>
                                                @if ($saving_com >= 10000)
                                                &nbsp; &nbsp;
                                                <a href="#"
                                                    class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#SavingCommission">Withdraw</a>

                                                <div class="modal fade theme-modal view-modal " id="SavingCommission"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                        <div class="modal-content">
                                                            <div class="modal-header p-0">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row g-sm-4 g-2">
                                                                    @if (!blank($paymentType))
                                                                        <form class="row"
                                                                            action="{{ route('user.withdraw.store') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="withdrawOf"
                                                                                value="Saving">
                                                                            <input type="hidden" name="payment_type"
                                                                                id=""
                                                                                value="{{ $paymentType->payment_type }}">
                                                                            <div class="form-group col-md-6 my-3">
                                                                                <label for="title">Account
                                                                                    Title</label>
                                                                                <input type="text" required
                                                                                    class="form-control"id="title"
                                                                                    placeholder="Account name" readonly
                                                                                    value="{{ $paymentType->account_title }}"
                                                                                    name="account_title">
                                                                            </div>
                                                                            <div class="form-group col-md-6  my-3">
                                                                                <label for="account">Account
                                                                                    Number</label>
                                                                                <input type="text" required
                                                                                    class="form-control"id="account"
                                                                                    placeholder="eg: 2323*****"
                                                                                    readonly
                                                                                    value="{{ $paymentType->account_no }}"
                                                                                    name="account_no">
                                                                            </div>
                                                                            @if ($paymentType->payment_type == 'bank')
                                                                                <div class="form-group col-md-6  my-3">
                                                                                    <label for="">Bank
                                                                                        Name</label>
                                                                                    <input type="text" required
                                                                                        class="form-control" readonly
                                                                                        value="{{ $paymentType->bank_name }}"
                                                                                        name="bank_name"
                                                                                        id=""
                                                                                        placeholder="Enter Your Bank Name">
                                                                                </div>
                                                                            @endif
                                                                            <h6 class="text-danger">Note: 25% Tax Will Apply On Withdraw Saving Commission</h6>

                                                                            <div class="form-group col-md-6  my-3">
                                                                                <label for="amount">Enter Amount
                                                                                    <span class="text-danger">
                                                                                        &#40;Withdraw
                                                                                        Limit
                                                                                        min:1000 &#41;</span></label>
                                                                                <input type="number" required
                                                                                    class="form-control"
                                                                                    id="amount"
                                                                                    placeholder="Enter Amount eg: 1000"
                                                                                    name="amount">
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <button type="submit"
                                                                                    class="ms-auto btn bg-danger view-button icon text-white fw-bold btn-md">Confirm</button>

                                                                            </div>
                                                                        </form>
                                                                    @else
                                                                        <button
                                                                            class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#paymentMethod">Add Payment
                                                                            Method</button>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            </li>

                                            <li>
                                                <h5>Current Commission :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $current_com }}</h5>
                                            </li>
                                            <li>
                                                <h5>Pending Commission :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $pending_com }}</h5>
                                                <h5><a href="{{ route('allPendingCommission') }}" class="m-3">View
                                                    All</a></h5>
                                            </li>
                                            <li>
                                                <h5>Sale Commission :</h5>
                                                @php
                                                    $sale_com = $sale_com * (80 / 100);
                                                @endphp
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $sale_com }}</h5>
                                                <h5><a href="{{ route('allSaleCommission') }}" class="m-3">View
                                                        All</a></h5>
                                                @if ($sale_com >= 1000)
                                                    <a href="#"
                                                        class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#SaleCommission">Withdraw</a>

                                                    <div class="modal fade theme-modal view-modal " id="SaleCommission"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div
                                                            class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                            <div class="modal-content">
                                                                <div class="modal-header p-0">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row g-sm-4 g-2">
                                                                        @if (!blank($paymentType))
                                                                            <form class="row"
                                                                                action="{{ route('user.withdraw.store') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="withdrawOf"
                                                                                    value="Sale">
                                                                                <input type="hidden" name="payment_type"
                                                                                    id=""
                                                                                    value="{{ $paymentType->payment_type }}">


                                                                                <div class="form-group col-md-6 my-3">
                                                                                    <label for="title">Account
                                                                                        Title</label>
                                                                                    <input type="text" required
                                                                                        class="form-control"id="title"
                                                                                        placeholder="Account name" readonly
                                                                                        value="{{ $paymentType->account_title }}"
                                                                                        name="account_title">
                                                                                </div>
                                                                                <div class="form-group col-md-6  my-3">
                                                                                    <label for="account">Account
                                                                                        Number</label>
                                                                                    <input type="text" required
                                                                                        class="form-control"id="account"
                                                                                        placeholder="eg: 2323*****"
                                                                                        readonly
                                                                                        value="{{ $paymentType->account_no }}"
                                                                                        name="account_no">
                                                                                </div>
                                                                                @if ($paymentType->payment_type == 'bank')
                                                                                    <div class="form-group col-md-6  my-3">
                                                                                        <label for="">Bank
                                                                                            Name</label>
                                                                                        <input type="text" required
                                                                                            class="form-control" readonly
                                                                                            value="{{ $paymentType->bank_name }}"
                                                                                            name="bank_name"
                                                                                            id=""
                                                                                            placeholder="Enter Your Bank Name">
                                                                                    </div>
                                                                                @endif
                                                                                <h6 class="text-danger">Note: 10% Tax Will Apply On Withdraw Sale Commission</h6>

                                                                                <div class="form-group col-md-6  my-3">
                                                                                    <label for="amount">Enter Amount
                                                                                        <span class="text-danger">
                                                                                            &#40;Withdraw
                                                                                            Limit
                                                                                            min:1000 &#41;</span></label>
                                                                                    <input type="number" required
                                                                                        class="form-control"
                                                                                        id="amount"
                                                                                        placeholder="Enter Amount eg: 1000"
                                                                                        name="amount">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit"
                                                                                        class="ms-auto btn bg-danger view-button icon text-white fw-bold btn-md">Confirm</button>

                                                                                </div>
                                                                            </form>
                                                                        @else
                                                                            <button
                                                                                class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#paymentMethod">Add Payment
                                                                                Method</button>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (($sale_com >= 1000) && (! $isPurchasedMembershipCard) && (!$isJoinedDreamerWebsite))
                                                @php
                                                $sale_com_amount = Crypt::encrypt($sale_com);
                                             @endphp
                                                <a href="{{ route('purchase.membership.cards', ['purchasedWith'=>'Sale','amount'=>$sale_com_amount]) }}"
                                                    class="btn bg-warning btn-md  p-2 m-2 " style="font-style: underline;">Purchased Membership Card</a>
                                                @endif
                                            </li>
                                            <li>
                                                <h5>Circle Commission :</h5>
                                                @php
                                                    $circle_com = $circle_com * (80 / 100);
                                                @endphp
                                                <h5 class="badge theme-bg-color text-white">Rs.
                                                    {{ $circle_com  }}</h5>
                                                <h5><a href="{{ route('allCircleCommission') }}" class="m-3">View
                                                        All</a></h5>
                                                        @if ($circle_com >= 1000)
                                                        <a href="#"
                                                            class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#CircleCommission">Withdraw</a>

                                                        <div class="modal fade theme-modal view-modal " id="CircleCommission"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div
                                                                class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                                <div class="modal-content">
                                                                    <div class="modal-header p-0">
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row g-sm-4 g-2">
                                                                            @if (!blank($paymentType))
                                                                                <form class="row"
                                                                                    action="{{ route('user.withdraw.store') }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="withdrawOf"
                                                                                        value="Circle">
                                                                                    <input type="hidden" name="payment_type"
                                                                                        id=""
                                                                                        value="{{ $paymentType->payment_type }}">


                                                                                    <div class="form-group col-md-6 my-3">
                                                                                        <label for="title">Account
                                                                                            Title</label>
                                                                                        <input type="text" required
                                                                                            class="form-control"id="title"
                                                                                            placeholder="Account name" readonly
                                                                                            value="{{ $paymentType->account_title }}"
                                                                                            name="account_title">
                                                                                    </div>
                                                                                    <div class="form-group col-md-6  my-3">
                                                                                        <label for="account">Account
                                                                                            Number</label>
                                                                                        <input type="text" required
                                                                                            class="form-control"id="account"
                                                                                            placeholder="eg: 2323*****"
                                                                                            readonly
                                                                                            value="{{ $paymentType->account_no }}"
                                                                                            name="account_no">
                                                                                    </div>
                                                                                    @if ($paymentType->payment_type == 'bank')
                                                                                        <div class="form-group col-md-6  my-3">
                                                                                            <label for="">Bank
                                                                                                Name</label>
                                                                                            <input type="text" required
                                                                                                class="form-control" readonly
                                                                                                value="{{ $paymentType->bank_name }}"
                                                                                                name="bank_name"
                                                                                                id=""
                                                                                                placeholder="Enter Your Bank Name">
                                                                                        </div>
                                                                                    @endif
                                                                                    <h6 class="text-danger">Note: 10% Tax Will Apply On Withdraw Cirlce Commission</h6>

                                                                                    <div class="form-group col-md-6  my-3">
                                                                                        <label for="amount">Enter Amount
                                                                                            <span class="text-danger">
                                                                                                &#40;Withdraw
                                                                                                Limit
                                                                                                min:1000 &#41;</span></label>
                                                                                        <input type="number" required
                                                                                            class="form-control"
                                                                                            id="amount"
                                                                                            placeholder="Enter Amount eg: 1000"
                                                                                            name="amount">
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <button type="submit"
                                                                                            class="ms-auto btn bg-danger view-button icon text-white fw-bold btn-md">Confirm</button>

                                                                                    </div>
                                                                                </form>
                                                                            @else
                                                                                <button
                                                                                    class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#paymentMethod">Add Payment
                                                                                    Method</button>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (($circle_com >= 1000) && (! $isPurchasedMembershipCard) && (!$isJoinedDreamerWebsite))
                                                    @php
                                                    $circle_com_amount = Crypt::encrypt($circle_com);
                                                 @endphp
                                                    <a href="{{ route('purchase.membership.cards', ['purchasedWith'=>'Circle', 'amount'=>$circle_com_amount]) }}"
                                                        class="btn bg-warning btn-md  p-2 m-2 " style="font-style: underline;">Purchased Membership Card</a>
                                                    @endif
                                            </li>
                                            <li>
                                                <h5>Marketing Commission :</h5>
                                                @php
                                                    $marketing_com= $marketing_com  * (80 / 100)
                                                @endphp
                                                <h5 class="badge theme-bg-color text-white">Rs.
                                                    {{ $marketing_com  }}</h5>
                                                <h5><a href="{{ route('allMarketingCommission') }}" class="m-3">View
                                                        All</a></h5>
                                                        @if ($marketing_com >= 1000)
                                                        <a href="#"
                                                            class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#MarketingCommission">Withdraw</a>

                                                        <div class="modal fade theme-modal view-modal " id="MarketingCommission"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div
                                                                class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                                <div class="modal-content">
                                                                    <div class="modal-header p-0">
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row g-sm-4 g-2">
                                                                            @if (!blank($paymentType))
                                                                                <form class="row"
                                                                                    action="{{ route('user.withdraw.store') }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="withdrawOf"
                                                                                        value="Marketing">
                                                                                    <input type="hidden" name="payment_type"
                                                                                        id=""
                                                                                        value="{{ $paymentType->payment_type }}">


                                                                                    <div class="form-group col-md-6 my-3">
                                                                                        <label for="title">Account
                                                                                            Title</label>
                                                                                        <input type="text" required
                                                                                            class="form-control"id="title"
                                                                                            placeholder="Account name" readonly
                                                                                            value="{{ $paymentType->account_title }}"
                                                                                            name="account_title">
                                                                                    </div>
                                                                                    <div class="form-group col-md-6  my-3">
                                                                                        <label for="account">Account
                                                                                            Number</label>
                                                                                        <input type="text" required
                                                                                            class="form-control"id="account"
                                                                                            placeholder="eg: 2323*****"
                                                                                            readonly
                                                                                            value="{{ $paymentType->account_no }}"
                                                                                            name="account_no">
                                                                                    </div>
                                                                                    @if ($paymentType->payment_type == 'bank')
                                                                                        <div class="form-group col-md-6  my-3">
                                                                                            <label for="">Bank
                                                                                                Name</label>
                                                                                            <input type="text" required
                                                                                                class="form-control" readonly
                                                                                                value="{{ $paymentType->bank_name }}"
                                                                                                name="bank_name"
                                                                                                id=""
                                                                                                placeholder="Enter Your Bank Name">
                                                                                        </div>
                                                                                    @endif
                                                                                    <h6 class="text-danger">Note: 10% Tax Will Apply On Withdraw Marketing Commission</h6>

                                                                                    <div class="form-group col-md-6  my-3">
                                                                                        <label for="amount">Enter Amount
                                                                                            <span class="text-danger">
                                                                                                &#40;Withdraw
                                                                                                Limit
                                                                                                min:1000 &#41;</span></label>
                                                                                        <input type="number" required
                                                                                            class="form-control"
                                                                                            id="amount"
                                                                                            placeholder="Enter Amount eg: 1000"
                                                                                            name="amount">
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <button type="submit"
                                                                                            class="ms-auto btn bg-danger view-button icon text-white fw-bold btn-md">Confirm</button>

                                                                                    </div>
                                                                                </form>
                                                                            @else
                                                                                <button
                                                                                    class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#paymentMethod">Add Payment
                                                                                    Method</button>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (($marketing_com >= 1000) && (! $isPurchasedMembershipCard) && (!$isJoinedDreamerWebsite))
                                                        @php
                                                           $marketing_com_amount = Crypt::encrypt($marketing_com);
                                                        @endphp
                                                    <a href="{{ route('purchase.membership.cards', ['purchasedWith'=>'Marketing' , 'amount'=>$marketing_com_amount]) }}"
                                                        class="btn bg-warning btn-md  p-2 m-2 " style="font-style: underline;">Purchased Membership Card</a>
                                                    @endif
                                            </li>
                                            <li>
                                                <h5>Completed Withdraw Commission:</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs.
                                                    {{ $all_withdraw - $pending_withdraw }}</h5>
                                                    <h5><a href="{{ route('allWithdrawDetail', ['status'=>'completed']) }}" class="m-3">View
                                                        All</a></h5>
                                            </li>
                                            <li>
                                                <h5>Pend Withdraw Commission:</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $pending_withdraw }}
                                                </h5>
                                                <h5><a href="{{ route('allWithdrawDetail', ['status'=>'pending']) }}" class="m-3">View
                                                    All</a></h5>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="pills-profit" role="tabpanel"
                                aria-labelledby="pills-profit-tab">
                                <div class="dashboard-privacy">
                                    <div class="title">
                                        <h2>My Profit</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            <h3>Profits</h3>
                                        </div>

                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-pending-profit-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-pending-profit"
                                                    type="button" role="tab" aria-controls="pills-pending-profit"
                                                    aria-selected="true">Pending</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-paid-profit-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-paid-profit" type="button" role="tab"
                                                    aria-controls="pills-paid-profit" aria-selected="false">Paid</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-pending-profit"
                                                role="tabpanel" aria-labelledby="pills-pending-profit-tab">
                                                <div class="order-tab dashboard-bg-box">
                                                    <div class="table-responsive">
                                                        <table class="table order-table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Order ID</th>
                                                                    <th scope="col">Profit</th>
                                                                    <th scope="col">Order Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($myPendingProfits as $pendingProfit)
                                                                    <tr>
                                                                        <td>{{ $pendingProfit->order->orderId ?? '-' }}
                                                                        </td>
                                                                        <td>{{ $pendingProfit->amount ?? '-' }}</td>
                                                                        <td>{{ $pendingProfit->created_at->format('d-M-Y h:i:sa') ?? '-' }}
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>Profit Not Found</tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-paid-profit" role="tabpanel"
                                                aria-labelledby="pills-paid-profit-tab">
                                                <div class="order-tab dashboard-bg-box">
                                                    <div class="table-responsive">
                                                        <table class="table order-table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Order ID</th>
                                                                    <th scope="col">Profit</th>
                                                                    <th scope="col">Order Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($myPaidProfits as $paidProfit)
                                                                    <tr>
                                                                        <td>{{ $paidProfit->order->orderId ?? '-' }}</td>
                                                                        <td>{{ $paidProfit->amount ?? '-' }}</td>
                                                                        <td>{{ $paidProfit->created_at->format('d-M-Y h:i:sa') ?? '-' }}
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>Profit Not Found</tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-followed-shops" role="tabpanel"
                                aria-labelledby="pills-followed-shops-tab">
                                <div class="dashboard-privacy">
                                    <div class="title">
                                        <h2>Followed Shops</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            <h3>Shops</h3>
                                        </div>
                                        <div class="order-tab dashboard-bg-box">
                                            <div class="table-responsive">
                                                <table class="table order-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Shop</th>
                                                            <th scope="col">Follow Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($followeds as $followed)
                                                            <tr>
                                                                @php
                                                                    if ($followed->shop_id == 1) {
                                                                        $shop_id = '';
                                                                    } else {
                                                                        $shop_id = $followed->shop_id;
                                                                    }
                                                                @endphp
                                                                <td><a title="Visit Shop"
                                                                        href="{{ route('user.product.shop', $shop_id) }}">{{ $followed->shop->business ?? '-' }}</a>
                                                                </td>
                                                                <td>{{ $followed->updated_at->format('d-M-Y h:i:sa') ?? '-' }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>Follow Shops</tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-favourite" role="tabpanel"
                                aria-labelledby="pills-favourite-tab">
                                <div class="dashboard-privacy">
                                    <div class="title">
                                        <h2>Favourites</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            {{-- <h3>Shops</h3> --}}
                                        </div>
                                        <div class="row g-sm-3 g-2">
                                            @if (session('wishlist'))
                                                @foreach (session('wishlist') as $id => $wishlist)
                                                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain"
                                                        data-id="{{ $id }}">
                                                        <div class="product-box-3 h-100">
                                                            <div class="product-header">
                                                                <div class="product-image">

                                                                    <a href="{{ route('product.show', $id) }}">
                                                                        <img src="{{ asset($wishlist['images']) }}"
                                                                            class="img-fluid blur-up lazyload"
                                                                            alt="">
                                                                    </a>

                                                                    <div class="product-header-top">
                                                                        <button
                                                                            class="btn wishlist-button close_button remove-from-wishlist">
                                                                            <i data-feather="x"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-footer">
                                                                <div class="product-detail">
                                                                    <!--this is category name commented-->
                                                                    <!--<span class="span-name">vegetable</span>-->
                                                                    <a href="{{ route('product.show', $id) }}">
                                                                        <h5 class="name">{{ $wishlist['name'] }}</h5>
                                                                    </a>
                                                                    <!--<h6 class="unit mt-1">250 ml</h6>-->
                                                                    <h5 class="price">
                                                                        <span class="theme-color">Rs.
                                                                            {{ $wishlist['price'] }}</span>
                                                                        <del>Rs. {{ $wishlist['discount_price'] }}</del>
                                                                    </h5>

                                                                    <div class="add-to-cart-box bg-white mt-2">
                                                                        <a href="{{ route('add.to.cart', $id) }}"
                                                                            class="btn btn-add-cart addcart-button">Add to
                                                                            cart </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                Favourite Not Found
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-share-items" role="tabpanel"
                                aria-labelledby="pills-share-items-tab">
                                <div class="dashboard-privacy">
                                    <div class="title">
                                        <h2>Shared Items</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            {{-- <h3>Shops</h3> --}}
                                        </div>
                                        <div class="row g-sm-3 g-2">
                                            @forelse ($shares as $share)
                                                <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">
                                                    <div class="product-box-3 h-100">
                                                        <div class="product-header">
                                                            <div class="product-image">
                                                                @php $image=json_decode($share->product->images);@endphp
                                                                <a
                                                                    href="{{ route('product.show', $share->product->slug) }}">
                                                                    <img src="{{ asset($share->product->image) }}"
                                                                        class="img-fluid blur-up lazyload" alt="">
                                                                </a>

                                                                {{-- <div class="product-header-top">
                                                                    <button
                                                                        class="btn wishlist-button close_button remove-from-wishlist">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                        <div class="product-footer">
                                                            <div class="product-detail">
                                                                <!--this is category name commented-->
                                                                <!--<span class="span-name">vegetable</span>-->
                                                                <a
                                                                    href="{{ route('product.show', $share->product_id) }}">
                                                                    <h5 class="name">{{ $share->product->name }}</h5>
                                                                </a>
                                                                <!--<h6 class="unit mt-1">250 ml</h6>-->
                                                                <h5 class="price">
                                                                    <span class="theme-color">Rs.
                                                                        {{ $share->product->price }}</span>
                                                                    <del>Rs. {{ $share->product->discount_price }}</del>
                                                                </h5>

                                                                <div class="add-to-cart-box bg-white mt-2">
                                                                    <a href="{{ route('add.to.cart', $share->product_id) }}"
                                                                        class="btn btn-add-cart addcart-button">Add to
                                                                        cart </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                No Shared Items Found
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-payment-method" role="tabpanel"
                                aria-labelledby="pills-payment-method-tab">
                                <div class="dashboard-privacy">
                                    <div class="title">
                                        <h2>Your Payment Method</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            {{-- <h3>Shops</h3> --}}
                                        </div>
                                        <div class="row g-sm-3 g-2">
                                            @if (!blank($paymentType))
                                                <div class="col-md-6">Payment Method</div>
                                                <div class="col-md-6">{{ $paymentType->payment_type }} ,
                                                    {{ $paymentType->bank_name }}</div>
                                                <div class="col-md-6">Account Title</div>
                                                <div class="col-md-6">{{ $paymentType->account_title }}</div>
                                                <div class="col-md-6">Account #</div>
                                                <div class="col-md-6">{{ $paymentType->account_no }}</div>
                                            @else
                                                <button
                                                    class="btn-block btn bg-danger view-button icon text-white fw-bold btn-md"
                                                    data-bs-toggle="modal" data-bs-target="#paymentMethod">Add Payment
                                                    Method</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->


    <!-- change password modal box start -->
    <div class="modal fade theme-modal" id="change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('user.password.change') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="password" class="form-control" name="old_password" id="OldPass"
                                placeholder="Old Password" autocomplete="false">
                            <label for="OldPass">Old Password</label>
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="password" class="form-control" autocomplete="true" name="password"
                                id="newPass" placeholder="New Password">
                            <label for="newPass">New Password</label>
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="password" class="form-control" autocomplete="true" name="password_confirmation"
                                id="fname" placeholder="Confirm Password">
                            <label for="fname">Confirm Password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn theme-bg-color btn-md text-white"
                            data-bs-dismiss="modal">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- change password modal box end -->
    <!-- Edit Business modal box start -->
    <div class="modal fade theme-modal" id="edit-business" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">{{ $user->business ? 'Edit' : 'Create' }} Shop
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('user.update.business') }}" method="Post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" required name="business" id="business"
                                value="{{ $user->business ?? '' }}" placeholder="Enter Your Business Name">
                            <label for="business">Shop Name</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn theme-bg-color btn-md text-white"
                            data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Business modal box end -->


    <!-- payement method Modal -->
    <div class="modal fade theme-modal view-modal " id="paymentMethod" tabindex="-1"
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
                        <form class="row" action="{{ route('user.paymentType.store') }}" method="POST">
                            @csrf
                            <div class="form-group col-md-6  my-3">
                                <label for="">Withdraw Method</label>
                                <select name="payment_type" id="payment_type" class="form-control" required>
                                    <option value="" selected disabled>Select Payement Method</option>
                                    <option value="jazzcash">JazzCash</option>
                                    <option value="easypaisa">EasyPaisa</option>
                                    <option value="bank">Bank</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6  my-3 bank_name">
                                <label for="bank_name">Bank Name </label>
                                <input type="text" class="form-control" id="bank_name"
                                    placeholder="Enter your bank name" name="bank_name">
                            </div>
                            <div class="form-group col-md-6 my-3">
                                <label for="title">Account Title</label>
                                <input type="text" required class="form-control" value="" id="title"
                                    placeholder="Account name" name="account_title">
                            </div>
                            <div class="form-group col-md-6  my-3">
                                <label for="account">Account Number</label>
                                <input type="text" required class="form-control" value="" id="account"
                                    placeholder="eg: 2323*****" name="account_no">
                            </div>

                            <div class="col-12">
                                <button type="submit"
                                    class="ms-auto btn bg-danger view-button icon text-white fw-bold btn-md">Confirm</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / end payment method Modal -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="{{ asset('newtheme/assets/js/user-dashboard-tab.js') }}"></script>
    <!-- Nav & tab upside js -->
    <script src="{{ asset('assets/js/nav-tab.js') }}"></script>

    <script>
        // alert(' working ');
        $(document).ready(function() {
            // alert(' working ');

            $('#outsideButton').on('click', function() {
                $('#shower').addClass("show");
            });
            $('#closer_hider').on('click', function() {
                $('#shower').removeClass("show");
            });
            $('#shower').on('click', function() {
                $('#shower').removeClass("show");
            });


            $('#copyLink').click(function() {
                var input = $('#referralLink');
                input.select();
                document.execCommand('copy');
                alert('Copied!');
            });
            var hash = window.location.hash;
            if (hash) {
                // Show the tab content
                $('#pills-order-tab').tab('show');
                $('#pills-order').addClass('show active');
                $(hash).tab('show');
                $(hash).addClass('show active');
            }

            $('.bank_name').hide();
            $("#payment_type").change(function() {
                var payment = $(this).val();
                if (payment == 'bank') {
                    $('.bank_name').show();
                } else {
                    $('.bank_name').hide();
                }
            });
            // countdown

            // Select all elements with class "countdown"
            var countdownElements = $(".countdown");
            $(".navbar-toggler").append('Menus');
            $(".navbar-toggler").on('click',function(){
                $(".show").removeClass('modal-backdrop');
            });

        });
    </script>
<style>
    .navbar-light .navbar-toggler-icon {
    background-image:none !important;
}
.navbar.navbar-expand-xl.navbar-light.navbar-sticky.p-0 {
    display: flex;
    justify-content: space-around;
}
</style>

@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick-theme.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bulk-style.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
