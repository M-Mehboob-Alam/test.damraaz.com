@extends('layouts.app')
@section('title')
    User Dashboard
@endsection

@php
    use Illuminate\Support\Facades\Crypt;
@endphp
@section('content')
    <!-- slick css -->
    @if (!blank($getPaidOrders))
        <div class="container my-4" id="getPaidOrderContainer">
            <div class="row">
                <div class="col-12"> <a href="#" id="paidOrderToDashboard" class="btn btn-success">Go To Dashboard</a>
                </div>
                <div class="col-12">
                    <h4 class="text-danger">Your Payment is Confirmed Please Order Now within 10 Days otherwise you will loss
                        this item? </h4>
                </div>
            </div>


            <table class="table">
                <thead>
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Bundle Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getPaidOrders as $gpo)
                        <tr>
                            <th scope="row">{{ $gpo->product_bundle->name }}</th>

                            <td> <a href="{{ route('orderNowProductBundle', $gpo->id) }}" class="btn btn-danger">Order
                                    Now</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <style>
            section.user-dashboard-section.section-b-space {
                display: none;
            }
        </style>
    @endif
    @if (!blank($getStoppedReferralEarning))
        <div class="container my-4" id="getStoppedContainer">
            <div class="row">
                <div class="col-12"> <a href="#" id="stoppedToDashboard" class="btn btn-success">Go To Dashboard</a>
                </div>
                <div class="col-12">
                    <h4 class="text-danger">Your Indirect Referral Earning is Stopped on every Rs.50000 pay Rs.2500 to restart In-Direct Referral Earning</h4>
                </div>
            </div>


            <table class="table">
                <thead>
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Stopped On Amount </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getStoppedReferralEarning as $gsre)
                        <tr>
                            <th scope="row">Rs.{{ $gsre->onStop }}</th>

                            <td> <a href="{{ route('stopReferralPayment', $gsre->id) }}" class="btn btn-danger">Pay Now Rs.2500</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <style>
            section.user-dashboard-section.section-b-space {
                display: none;
            }
        </style>
    @endif
    @if (!blank($getCancelledOrders))
        {{-- <h1 class="text-danger">Your Payment Slip is Cancelled Please Re-Submit Now Payment Slip</h1> --}}
        <div class="container my-4" id="getCancelledOrderContainer">
            <div class="row">
                <div class="col-12"> <a href="#" id="cancelledOrderToDashboard" class="btn btn-success">Go To
                        Dashboard</a></div>
                <div class="col-12">
                    <h4 class="text-danger">Your Payment Slip is Cancelled Please Re-Submit Now Payment Slip </h4>
                </div>

            </div>


            <table class="table">
                <thead>
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Bundle Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getCancelledOrders as $gco)
                        <tr>
                            <th scope="row">{{ $gco->product_bundle->name }}</th>

                            <td> <a href="{{ route('repaymentProductBundle', $gco->id) }}" class="btn btn-danger">Re-Pyament
                                    Now</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <style>
            section.user-dashboard-section.section-b-space {
                display: none;
            }
        </style>
    @endif
    @if (!blank($getCancelledDeliveryBundles))
        {{-- <h1 class="text-danger">Your Payment Slip is Cancelled Please Re-Submit Now Payment Slip</h1> --}}
        <div class="container my-4" id="getCancelledDeliveryContainer">
            <div class="row">
                <div class="col-12"> <a href="#" id="getCancelledDeliveryToDashboard" class="btn btn-success">Go To
                        Dashboard</a></div>
                <div class="col-12">
                    <h4 class="text-danger">Your Delivery Charges Slip is Cancelled Please Re-Submit Now Payment or Slip
                    </h4>
                </div>

            </div>


            <table class="table">
                <thead>
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Bundle Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getCancelledDeliveryBundles as $gcdb)
                        <tr>
                            <th scope="row">{{ $gcdb->product_bundle->name }}</th>

                            <td> <a href="{{ route('repaymentDeliveryChargesProductBundle', $gcdb->id) }}"
                                    class="btn btn-danger">Re-Pyament Now</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <style>
            section.user-dashboard-section.section-b-space {
                display: none;
            }
        </style>
    @endif

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
                                <a href="#" class="nav-link"aria-selected="false"><i
                                        data-feather="dollar-sign"></i>
                                    Withdraw Commission</a>
                            </li>

                            {{-- <li class="nav-item d-lg-block d-none" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button" role="tab"
                                    aria-controls="pills-order" aria-selected="false"><i
                                        data-feather="shopping-bag"></i>Order</button>
                            </li> --}}



                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-orders-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-orders" data-bs-target="#pills-orders" type="button"
                                    role="tab" aria-controls="pills-orders" aria-selected="false"><i
                                        data-feather="shopping-bag"></i>
                                    Orders</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-partner-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-partner" type="button" role="tab"
                                    aria-controls="pills-partner" aria-selected="false"><i data-feather="users"></i>
                                    Partners</button>
                            </li>




                        </ul>
                    </div>
                </div>

                <div class="col-xxl-9 col-lg-9">
                    <div class="row g-2 rounded theme-bg-color text-white">
                        <div class="col-12 py-1">
                            <p class="text-center">{{ $bundleOrders->where('status', 'approved')->sum('amount') }}</p>
                            <p class="text-center small">Total Sales</p>
                        </div>
                        {{-- <div class="col-3 py-1">
                            <p class="text-center">{{ $orders->total() }}</p>
                            <p class="text-center small">Total Orders</p>
                        </div> --}}
                        <div class="col-4 py-1">
                            <p class="text-center">{{ $bundleOrders->count() }}</p>
                            <p class="text-center small">Total Orders</p>
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
                            <p class="text-center">{{ $totalCommission }}
                            </p>
                            <p class="text-center small">Total Profit</p>
                        </div>
                        <div class="col-4 py-1">
                            <p class="text-center">
                                <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                    href="{{ route('logout') }} " class="btn btn-danger">Logout</a>
                            </p>

                        </div>


                    </div>
                    <button id="outsideButton"
                        class=" mt-1 btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Profile</button>

                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">


                            <div class="tab-pane fade" id="pills-payment-method" role="tabpanel"
                                aria-labelledby="pills-payment-method-tab">
                                <div class="dashboard-privacy">
                                    <div class="title">
                                        <h2>Your Payment Method</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}">
                                                </use>
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
                                                <div class="col-md-6">{{ $paymentType->account_title }}
                                                </div>
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
                            <div class="tab-pane fade" id="pills-orders" role="tabpanel"
                                aria-labelledby="pills-orders-tab">
                                <div class="dashboard-orders">
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
                                                    aria-selected="true">New Orders <span
                                                        class="badge  bg-info ">{{ $bundleOrders->where('status', 'pending')->count() }}</span></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-delivered-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-delivered" role="tab"
                                                    aria-controls="pills-delivered" aria-selected="false">Payment Accepted
                                                    <span
                                                        class="badge  bg-info ">{{ $bundleOrders->where('status', 'approved')->count() }}</span></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-delivery-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-delivery" role="tab"
                                                    aria-controls="pills-delivery" aria-selected="false">Get Delivery
                                                    <span
                                                        class="badge  bg-info ">{{ $getDeliveryBundles->count() }}</span></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-returned-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-returned" type="button" role="tab"
                                                    aria-controls="pills-returned" aria-selected="false">Cancelled <span
                                                        class="badge  bg-info ">{{ $bundleOrders->where('status', 'cancelled')->count() }}</span></button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-in-progress" role="tabpanel"
                                                aria-labelledby="pills-in-progress-tab" tabindex="0">
                                                <div class="table-responsive" id="contentToPrint">
                                                    <table class="table order-table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Bundle Name</th>
                                                                <th scope="col">Total Amount</th>
                                                                <th scope="col">Message</th>
                                                                {{-- <th scope="col">Profit</th> --}}
                                                                <th scope="col">Order date</th>
                                                                {{-- <th scope="col">Action</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($bundleOrders->where('status','pending') as $inProgress)
                                                                <tr>
                                                                    <td class="product-image">
                                                                        {{ $inProgress->product_bundle->name }}</td>
                                                                    <td>{{ $inProgress->amount }}</td>
                                                                    <td>
                                                                        <!--<label class="success">Shipped</label>-->
                                                                        {{ $inProgress->message }}
                                                                    </td>
                                                                    {{-- <td>
                                                                        <h6>{{ $inProgress->commission }}</h6>
                                                                    </td> --}}
                                                                    <td>{{ $inProgress->created_at->format('d-m-Y H:i:s') }}
                                                                    </td>
                                                                    {{-- <td class="d-flex">
                                                                        <a class="px-1"
                                                                            href="{{ route('user.order.detail', $inProgress->id) }}"><i
                                                                                data-feather="eye" class="edit"></i></a>
                                                                        <a href="#"
                                                                            title="Track Your Order">Track</a>

                                                                    </td> --}}
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
                                                                <th scope="col">Bundle Name</th>
                                                                <th scope="col">Total Amount</th>

                                                                {{-- <th scope="col">Profit</th> --}}
                                                                <th scope="col">Message</th>
                                                                <th scope="col">Order date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($bundleOrders->where('status','approved') as $delivered)
                                                                <tr>
                                                                    <td class="product-image">
                                                                        {{ $delivered->product_bundle->name }}</td>
                                                                    <td>{{ $delivered->amount }}</td>


                                                                    <td>
                                                                        <h6>{{ $delivered->message }}</h6>
                                                                    </td>
                                                                    <td>{{ $delivered->created_at->format('d-m-Y H:i:s') }}
                                                                    </td>
                                                                </tr>


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
                                                                <th scope="col">Bundle Name</th>
                                                                <th scope="col">Total Amount</th>
                                                                <th scope="col">Reason</th>
                                                                {{-- <th scope="col">Profit</th> --}}
                                                                <th scope="col">Order date</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($bundleOrders->where('status','cancelled') as $returned)
                                                                <tr>
                                                                    <td class="product-image">
                                                                        {{ $returned->product_bundle->name }}</td>
                                                                    <td>{{ $returned->amount }}</td>
                                                                    <td>
                                                                        <!--<label class="success">Shipped</label>-->
                                                                        {{ $returned->message }}
                                                                    </td>
                                                                    {{-- <td>
                                                                        <h6>{{ $returned->commission }}</h6>
                                                                    </td> --}}
                                                                    <td>{{ $returned->created_at->format('d-m-Y H:i:s') }}
                                                                    </td>
                                                                    <td class="d-flex">
                                                                        <a class="px-1"
                                                                            href="{{ route('repaymentProductBundle', $returned->id) }}">Repayment
                                                                            Now</a>

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

                            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="dashboard-profile">
                                    <div class="title">
                                        <h2>My Profile</h2>

                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg') }}#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="profile-tab dashboard-bg-box">
                                        <div class="dashboard-title dashboard-flex">
                                            <div class="row">
                                                <h3>Profile</h3>
                                                @if ($isActiveMember)
                                                    <br>
                                                    <h3 class="text-danger">Your Are A Supreme User</h3>
                                                @else
                                                    <br>
                                                    <h3 class="text-danger">Your Are A Free User</h3>
                                                @endif
                                            </div>
                                            @if ($isActiveMember)
                                                <div class="ms-auto">
                                                    <br>
                                                    {{-- <h3 class="text-danger">Your Paid Member</h3> --}}
                                                    <h6 class="mb-1">Affiliate Link</h6>
                                                    <div class="input-group mb-3">
                                                        <input id="referralLink" type="text"
                                                            value="{{ route('referralRegister', $user->username ?? '') }}"
                                                            class="form-control" readonly
                                                            aria-label="Recipient's username"
                                                            aria-describedby="basic-addon2">
                                                        <button class="input-group-text" id="copyLink"><i
                                                                class="fa fa-copy"></i></button>
                                                    </div>
                                                </div>
                                            @endif


                                        </div>

                                        <ul>


                                            @if ($bundleOrders->where('status', 'cancelled')->count() > 0)
                                                <h3 class="text-light bg-danger p-2">You Order Cancelled check details in
                                                    "Orders" Section </h3>
                                            @endif

                                            <li>
                                                <h5>Total Commission :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs. {{ $totalCommission }}
                                                </h5>
                                                <a href="{{ route('bundles.viewAllCommission') }}"
                                                    class="nav-link btn text-danger" data-bs-target="#pills-partner"
                                                    role="tab" aria-selected="false"><i data-feather="users"></i>
                                                    View All Commission</a>
                                            </li>
                                            <li>
                                                <h5>P Wallet :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs.
                                                    @php
                                                        $profitCommission = (($totalCommission * 90) / 100) - $getCompletedPendingWithdraws;
                                                        $profitCommission = ($profitCommission + $getReceivedPoints) - $getSentPoints;

                                                   @endphp
                                                    {{ $profitCommission }}</h5>

                                                @if ($profitCommission >= 2000)
                                                    @if (blank($paymentType))
                                                    <button
                                                    class=" btn text-danger"
                                                    data-bs-toggle="modal" data-bs-target="#paymentMethod">Withdraw Now</button>
                                                    @else
                                                        
                                                    <button class=" btn text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#withdrawPaymentMethod">Withdraw Now
                                                    </button>
                                                    @endif
                                                @endif

                                            </li>

                                            <li>
                                                <h5>R Wallet :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs.
                                                    {{ ($totalCommission * 10) / 100 }}</h5>
                                            </li>
                                            <li>
                                                <h5>You Have Sent Points  :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs.
                                                    {{ $getSentPoints }}</h5>
                                            </li>
                                            <li>
                                                <h5>You Have Received Points  :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs.
                                                    {{ $getReceivedPoints }}</h5>
                                            </li>
                                            <li>
                                                <h5>User Received Points :</h5>
                                                <h5 class="badge theme-bg-color text-white">Rs.
                                                    {{ ($totalCommission * 10) / 100 }}</h5>
                                            </li>
                                            <li>
                                                <h5>User Points :</h5>
                                                <form action="{{ route('bundles.sendUserPoint') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="points" value="{{ $profitCommission }}">
                                                    <button type="submit" class="btn btn-danger">Send User Points</button>
                                                </form>
                                            </li>
                                            <li>
                                                <h5>Circle Counter :</h5>
                                                <main class="main">
                                                    <section class="chart" id="chartContainer">
                                                        <figure class="chart__figure">
                                                            <canvas class="chart__canvas" id="chartCanvas" width="100" height="100" aria-label="Example doughnut chart showing data as a percentage" role="img"></canvas>
                                                            <figcaption class="chart__caption">
                                                                {{ substr($getCircleCounter, -1) }}
                                                            </figcaption>
                                                        </figure>
                                                    </section>
                                                </main>

                                               
                                                @if ($getCircleCounter > 0 && $getCircleCounter % 10 == 0 && $unAssignedCircleCommission > 0 )
                                                    <div class="">
                                                        <a href="{{ route('bundles.viewAllCircleCommission') }}" class="btn btn-danger">Claim Circle Commission</a>
                                                    </div>
                                                @endif
                                                
                                            </li>

                                        </ul>
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
                                                        <th scope="col">Level</th>
                                                        <th scope="col">Username</th>
                                                        <th scope="col">Commission</th>
                                                        <th scope="col">Points</th>

                                                        <th scope="col">Join Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($levels as $refer)
                                                        <tr>
                                                            <td>{{ $refer->level_no ?? '-' }}</td>
                                                            <td>{{ $refer->rewardOn ?? '-' }}</td>
                                                            <td>{{ $refer->commission ?? '-' }}</td>

                                                            <td>{{ $refer->points ?? '-' }} </td>
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
    <div class="modal fade theme-modal view-modal  py-5" id="paymentMethod" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body py-5">
                    <div class="row g-sm-4 g-2">
                        <h1 class="py-3">First Add Payment Method</h1>
                        <form class="row" action="{{ route('user.bundlePaymentType.store') }}" method="POST">
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
    <!-- payement method Modal -->
    <div class="modal fade theme-modal view-modal  py-5" id="withdrawPaymentMethod" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body py-5">
                    <div class="row g-sm-4 g-2">
                       @if (!blank($paymentType))
                           
                       <form class="row" action="{{ route('withdrawBundlePayment') }}" method="POST">
                           @csrf
                           <h1 class="text-danger">Withdraw Tax will be 16%</h1>
                           <div class="form-group col-md-6  my-3">
                               <label for="">Withdraw Method</label>
                               <select name="payment_type" disabled id="payment_type" class="form-control" required>
                                   <option value="" selected disabled>Select Payement Method</option>
                                   <option {{ $paymentType->payment_type == 'jazzcash' ? 'selected' : ''}}  value="jazzcash">JazzCash</option>
                                   <option {{ $paymentType->payment_type == 'easypaisa' ? 'selected' : '' }} value="easypaisa">EasyPaisa</option>
                                   <option {{ $paymentType->payment_type == 'bank' ? 'selected' : '' }} value="bank">Bank</option>
                               </select>
                           </div>
                           @if ($paymentType->payment_type == 'bank')                               
                           <div class="form-group col-md-6  my-3 bank_name">
                               <label for="bank_name">Bank Name </label>
                               <input type="text" readonly class="form-control" id="bank_name"
                                   placeholder="Enter your bank name" name="bank_name">
                           </div>
                           @endif
                           <div class="form-group col-md-6 my-3">
                               <label for="title">Account Title</label>
                               <input type="text" required readonly class="form-control" value="{{ $paymentType->account_title }}" id="title"
                                   placeholder="Account name" name="account_title">
                           </div>
                           <div class="form-group col-md-6  my-3">
                               <label for="account">Account Number</label>
                               <input type="text" required readonly class="form-control" value="{{ $paymentType->account_no }}" id="account"
                                   placeholder="eg: 2323*****" name="account_no">
                           </div>
                           
                           <div class="form-group col-md-6  my-3">
                                
                               <label for="account">Enter Withdraw Amount </label>
                               <input type="number" required min="1000"  class="form-control"  id="account"
                                   placeholder="eg: 2323*****" name="amount">
                           </div>


                           <div class="col-12">
                               <button type="submit"
                                   class="ms-auto btn bg-danger view-button icon text-white fw-bold btn-md">Confirm</button>

                           </div>
                       </form>
                       @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / end payment method Modal -->
    <style>
        @keyframes fadein {
  0% {
    opacity: 0;
  }
  40% {
    opacity: 0;
  }
  80% {
    opacity: 1;
  }
  100% {
    opacity: 1;
  }
}
 /* .main {
  display: grid;
  width: 20vw;
  height: 20vh;
  background-color: #fff;
}  */

.chart {
  position: relative;
  margin: auto;
  font-weight: 900;
}
.chart__figure {
  display: flex;
  justify-content: space-between;
  height: 30px;
}
@media screen and (max-width: 540px) {
  .chart__figure {
    flex-direction: column;
    height: auto;
  }
}
.chart__canvas {
  margin: auto;
}
.chart__caption {
  display: flex;
  justify-content: center;
  flex-direction: column;
  margin-left: 30px;
  letter-spacing: 0.4px;
  font-size: 36px;
  line-height: 56px;
  height: 100%;
  width: calc(80px + 160px);
  font-family: "Barlow Condensed", sans-serif;
  color: #01713c;
}
@media screen and (max-width: 540px) {
  .chart__caption {
    margin: 15px auto auto;
    text-align: center;
    min-width: 160px;
  }
}
.chart span {
  font-size: 16px;
  line-height: 24px;
  font-family: "Montserrat", sans-serif;
  color: #334466;
}
.chart__value {
  display: grid;
  position: absolute;
  top: 0;
  left: 40px;
  height: calc(40px + 160px);
  width: 160px;
  animation: fadein 1400ms;
  display: none !important;
}
@media screen and (max-width: 540px) {
  .chart__value {
    left: 0;
    right: 0;
    width: 100%;
  }
}
.chart__value p {
  font-size: 40px;
  margin: auto;
  padding-left: 6px;
  font-family: "Barlow Condensed", sans-serif;
  color: #01713c;
  background-color: #fff;
}
    </style>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="{{ asset('newtheme/assets/js/user-dashboard-tab.js') }}"></script>
    <!-- Nav & tab upside js -->
    <script src="{{ asset('assets/js/nav-tab.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

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
            $(".navbar-toggler").append('Menus')
            $(".navbar-toggler").on('click', function() {
                $(".show").removeClass('modal-backdrop');
            });
            $("#paidOrderToDashboard").on('click', function() {
                $("#getPaidOrderContainer").hide();
                $("section.user-dashboard-section.section-b-space").show();
            });
            $("#cancelledOrderToDashboard").on('click', function() {
                $("#getCancelledOrderContainer").hide();
                $("section.user-dashboard-section.section-b-space").show();
            });
            $("#getCancelledDeliveryToDashboard").on('click', function() {
                $("#getCancelledDeliveryContainer").hide();
                $("section.user-dashboard-section.section-b-space").show();
            });
            $("#stoppedToDashboard").on('click', function() {
                $("#getStoppedContainer").hide();
                $("section.user-dashboard-section.section-b-space").show();
            });
            // This demo uses the Chartjs javascript library
// Simple yet flexible JavaScript charting for designers & developers
// Webite: https://www.chartjs.org
// CDN: https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js
      
const percent = {{ substr($getCircleCounter, -1) }}0;
const color = '#01713c';
const canvas = 'chartCanvas';
const container = 'chartContainer';

const percentValue = percent; // Sets the single percentage value
const colorGreen = color, // Sets the chart color
animationTime = '1400'; // Sets speed/duration of the animation
var lastDigit = percentValue % 10;
const chartCanvas = document.getElementById(canvas), // Sets canvas element by ID
chartContainer = document.getElementById(container), // Sets container element ID
divElement = document.createElement('div'), // Create element to hold and show percentage value in the center on the chart
domString = '<div class="chart__value"><p>' + {{ substr($getCircleCounter, -1) }} + '</p></div>'; // String holding markup for above created element

// Create a new Chart object
const doughnutChart = new Chart(chartCanvas, {
  type: 'doughnut', // Set the chart to be a doughnut chart type
  data: {
    datasets: [
    {
      data: [percentValue, 100 - percentValue], // Set the value shown in the chart as a percentage (out of 100)
      backgroundColor: [colorGreen], // The background color of the filled chart
      borderWidth: 0 // Width of border around the chart
    }] },


  options: {
    cutoutPercentage: 84, // The percentage of the middle cut out of the chart
    responsive: false, // Set the chart to not be responsive
    tooltips: {
      enabled: false // Hide tooltips
    } } });



Chart.defaults.global.animation.duration = animationTime; // Set the animation duration

divElement.innerHTML = domString; // Parse the HTML set in the domString to the innerHTML of the divElement
chartContainer.appendChild(divElement.firstChild); // Append the divElement within the chartContainer as it's child
        });
    </script>
    <style>
        .navbar-light .navbar-toggler-icon {
            background-image: none !important;
        }

        .navbar.navbar-expand-xl.navbar-light.navbar-sticky.p-0 {
            display: flex;
            justify-content: space-around;
        }
    </style>

@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick-theme.css') }}">

<!-- Iconly css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bulk-style.css') }}">

<!-- Template css -->
<link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
