@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">



            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.bundleOrder', 'pending') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">New Bundle Payment</span>
                                    <h4 class="mb-0 counter">{{ $bundleOrders }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.getBundleOrder', 'pending') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">New Bundle Order</span>
                                    <h4 class="mb-0 counter">{{ App\Models\OrderProductBundle::where('status', 'pending')->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.userProduct.index', 'pending') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">New Products</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\Product::where('status','pending')->where('isActive', false)->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.orders.index', ['orders' => 'pending']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">New Orders</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\Order::where('status','pending')->count()  }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.orders.stoppedBundlePayments', ['status' => 'pending']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">New Stopped Earning Payment</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\BundleStoppedPayment::where('status','pending')->count()  }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.newShop') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">New Shop</span>
                                    <h4 class="mb-0 counter">{{  \App\Models\Shop::where('status','pending')->count() }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-user-add-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.withdraws.index', ['withdraws' => 'pending']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">New Withdraw</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\Withdraw::where('status', 'pending')->count() }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class=" ri-currency-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.orders.index', ['orders' => 'onDelivery']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">On-Delilvery</span>
                                    <h4 class="mb-0 counter">
                                        {{ \App\Models\Order::where('status', 'onDelivery')->count() }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-archive-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.orders.index', ['orders' => 'delivered']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Delivered</span>
                                    <h4 class="mb-0 counter">
                                        {{ \App\Models\Order::where('status', 'delivered')->count() }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-archive-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.orders.index', ['orders' => 'cancelled']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Cancelled Or</span>
                                    <h4 class="mb-0 counter">
                                        {{ \App\Models\Order::where('status', 'cancelled')->count() }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-archive-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.orders.index', ['orders' => 'return']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Return Orders</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\Order::where('status', 'return')->count() }}
                                        <span class="badge badge-light-danger grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-archive-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.orders.index', ['orders' => 'refund']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Refund Orders</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\Order::where('status', 'refund')->count() }}
                                        <span class="badge badge-light-danger grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-archive-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.userProduct.index', 'accepted') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Published Products</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\Product::where('status','accepted')->where('isActive', true)->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.userProduct.index', 'rejected') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Rejected Products</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\Product::where('status','rejected')->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.products.inActive') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">In-Active Products</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\Product::where('isActive', false)->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>



            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.withdraws.index', ['withdraws' => 'completed']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">completed withdraw</span>
                                    <h4 class="mb-0 counter">
                                        {{ \App\Models\Withdraw::where('status', 'completed')->count() }}
                                        <span class="badge badge-light-success grow">
                                            {{-- <i data-feather="trending-down"></i>8.5%</span> --}}
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class=" ri-currency-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.withdraws.index', ['withdraws' => 'cancelled']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Cancelled withdraw</span>
                                    <h4 class="mb-0 counter">
                                        {{ \App\Models\Withdraw::where('status', 'cancelled')->count() }}
                                        <span class="badge badge-light-success grow">
                                            {{-- <i data-feather="trending-down"></i>8.5%</span> --}}
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class=" ri-currency-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.withdraws.index', ['withdraws' => 'approved']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">approved withdraws</span>
                                    <h4 class="mb-0 counter">
                                        {{ \App\Models\Withdraw::where('status', 'approved')->count() }}
                                        <span class="badge badge-light-danger grow">
                                            {{-- <i data-feather="trending-down"></i>8.5%</span> --}}
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class=" ri-currency-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-2-bg b-r-4 card-body">
                        <a href="{{ route('admin.category.index') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Categories</span>
                                    <h4 class="mb-0 counter">{{ $categories }}
                                        <span class="badge badge-light-danger grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>
                                <div class="align-self-center text-center">
                                    <i class="ri-shopping-bag-3-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.user.index') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Users</span>
                                    <h4 class="mb-0 counter">{{ $users }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-user-add-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.allShops',['shop'=>'approved'])  }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Approved Shop</span>
                                    <h4 class="mb-0 counter">{{  \App\Models\Shop::where('status','approved')->count() }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-user-add-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.allShops',['shop'=>'blocked'])  }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Blocked Shop</span>
                                    <h4 class="mb-0 counter">{{  \App\Models\Shop::where('status','blocked')->count() }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-user-add-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.allShops',['shop'=>'inActive'])  }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">In-Active Shop</span>
                                    <h4 class="mb-0 counter">{{  \App\Models\Shop::where('status','inActive')->count() }}
                                        <span class="badge badge-light-success grow">
                                            <i data-feather="trending-down"></i>8.5%</span>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-user-add-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.bundleOrder', 'approved') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Accepted Bundle Payment</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\BuyProductBundle::where('status', 'approved')->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.bundleOrder', 'approved') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Cancelled Bundle Payment</span>
                                    <h4 class="mb-0 counter">{{ \App\Models\BuyProductBundle::where('status', 'cancelled')->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.getBundleOrder', 'delivered') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Delivered Bundle Order</span>
                                    <h4 class="mb-0 counter">{{ App\Models\OrderProductBundle::where('status', 'delivered')->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.getBundleOrder', 'cancelled') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Cancelled Bundle Order</span>
                                    <h4 class="mb-0 counter">{{ App\Models\OrderProductBundle::where('status', 'cancelled')->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.getBundleOrder', 'return') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Return Bundle Order</span>
                                    <h4 class="mb-0 counter">{{ App\Models\OrderProductBundle::where('status', 'return')->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <a href="{{ route('admin.getBundleOrder', 'refund') }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Refund Bundle Order</span>
                                    <h4 class="mb-0 counter">{{ App\Models\OrderProductBundle::where('status', 'refund')->count() }}

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <!--<i class="ri-chat-3-line"></i>-->
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <a href="{{ route('admin.orders.index', ['orders' => 'pending']) }}">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">New Orders</span>
                                    <h4 class="mb-0 counter">
                                        {{ \App\Models\Order::where('status', 'pending')->count() }}
                                        <span class="badge badge-light-success grow">

                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-archive-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div> --}}

        </div>
        <div class="row my-2 text-center ">
            <h2 class="text-center bg-success py-2 rounded">Total Record</h2>
            <div class="col-md-6  my-2"><b>Total Referral Amount</b></div>
            <div class="col-md-6 my-2"><b>{{$referrals}}</b></div>

            <div class="col-md-6  my-2"><b>Pending Withdraws</b></div>
            <div class="col-md-6 my-2"><b>{{$withdraws->where('status','pending')->sum('amount')}}</b></div>

            <div class="col-md-6  my-2"><b>Completed Withdraws</b></div>
            <div class="col-md-6 my-2"><b>{{$withdraws->where('status','completed')->sum('amount')}}</b></div>

            <div class="col-md-6  my-2"><b>Cancelled Withdraws</b></div>
            <div class="col-md-6 my-2"><b>{{$withdraws->where('status','cancelled')->sum('amount')}}</b></div>

            <div class="col-md-6  my-2"><b>Approved Withdraws</b></div>
            <div class="col-md-6 my-2"><b>{{$withdraws->where('status','approved')->sum('amount')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Withdraws</b></div>
            <div class="col-md-6 my-2"><b>{{$withdraws->sum('amount')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Pending Bonus</b></div>
            <div class="col-md-6 my-2"><b>{{$pendingBonus}}</b></div>

            <div class="col-md-6  my-2"><b>Total Assigned Bonus</b></div>
            <div class="col-md-6 my-2"><b>{{$assignedBonus}}</b></div>

            <div class="col-md-6  my-2"><b>Total Discounted Price of User Products</b></div>
            <div class="col-md-6 my-2"><b>{{$userProducts->sum('discount_price')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Delivery Charges of User Products</b></div>
            <div class="col-md-6 my-2"><b>{{$userProducts->sum('delivery_charges')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Sale of User Products</b></div>
            <div class="col-md-6 my-2"><b>{{$userProducts->sum('orders_detail_sum_amount')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Delivery Charges for Sale of User Products</b></div>
            <div class="col-md-6 my-2"><b>{{$userProducts->sum('orders_detail_sum_delivery_charges')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Profit earned by Sealer  of User Products</b></div>
            <div class="col-md-6 my-2"><b>{{$userProducts->sum('orders_detail_sum_profit')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Discounted Price of {{env('APP_NAME')}} Products</b></div>
            <div class="col-md-6 my-2"><b>{{$adminProducts->sum('discount_price')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Delivery Charges of {{env('APP_NAME')}} Products</b></div>
            <div class="col-md-6 my-2"><b>{{$adminProducts->sum('delivery_charges')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Sale of {{env('APP_NAME')}} Products</b></div>
            <div class="col-md-6 my-2"><b>{{$adminProducts->sum('orders_detail_sum_amount')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Delivery Charges for Sale of {{env('APP_NAME')}} Products</b></div>
            <div class="col-md-6 my-2"><b>{{$adminProducts->sum('orders_detail_sum_delivery_charges')}}</b></div>

            <div class="col-md-6  my-2"><b>Total Profit earned by Sealer  of {{env('APP_NAME')}} Products</b></div>
            <div class="col-md-6 my-2"><b>{{$adminProducts->sum('orders_detail_sum_profit')}}</b></div>

        </div>
    </div>
@endsection
