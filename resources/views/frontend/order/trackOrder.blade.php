@extends('layouts.app')
@section('content')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: var(--theme-color);
        }
    </style>
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Track Order</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Track Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Search Bar Section Start -->
    <section class="search-section ">
        <div class="container-fluid-lg">
           
            <div class="row">
                <div class="col-xxl-6 col-xl-8 mx-auto">
                    <div class="title d-block text-center">
                        <h2>Search for track order</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                    </div>
                    <div class="search-box">
                        <form method="get" class="input-group">
                            <select class="form-select" id="orderId" data-live-search="true" name="order_id">
                                <option value="" selected >All</option>
                                @forelse($ordersList as $ord)
                                    <option {{ request()->order_id == $ord->orderId ? 'selected' : '' }}
                                        value="{{ $ord->orderId }}">{{ $ord->orderId }}</option>
                                @empty
                                    <option>Orders not found to search</option>
                                @endforelse
                            </select>

                            <!--<input type="text" name="order_id" data-live-search="true" value="{{ request()->order_id }}" class="form-control" placeholder="Search by Order Id" aria-label="Example text with button addon">-->
                            <button class="btn theme-bg-color text-white m-0" type="submit"
                                id="button-addon1">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Bar Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="row">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-process-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-process" href="{{ route('user.order.track') }}" role="tab"
                                aria-controls="pills-process" aria-selected="true">Pending <span class="badge  bg-info ">{{$orders->count()}}</span></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-confirm-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-confirm" href="{{ route('user.order.track') }}" role="tab"
                                aria-controls="pills-confirm" aria-selected="false">Processing <span class="badge  bg-info ">{{$processings->count()}}</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-on-the-way-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-on-the-way" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Delivered <span class="badge  bg-info ">{{$delivereds->count()}}</span></button>
                        </li>
                    </ul>
    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-process" role="tabpanel"
                            aria-labelledby="pills-process-tab" tabindex="0">
                           <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            @php
                                                $subtotal = 0;
                                                $delivery_charges = 0;
                                                $price = 0;
                                                $discount_price;
                                            @endphp
        
                                            @forelse($orders as $order)
                                                @forelse($order->ordersDetail as $detail)
                                                    @php
                                                        $subtotal += $detail['discount_price'] * $detail['quantity'];
                                                        $price += $detail['price'] * $detail['quantity'];
                                                        $delivery_charges += $detail['delivery_charges'];
                                                    @endphp
                                                    <tr>
                                                        <td class="product-detail">
                                                            <div class="product border-0">
                                                                <a href="{{ route('product.show', $detail->product_id) }}"
                                                                    class="product-image">
                                                                    @php $image=json_decode($detail->product->images);@endphp
                                                                    <img width="100" src="https://admin.damraaz.com/{{ $image[0] }}"
                                                                        class="img-fluid blur-up lazyload" alt="">
                                                                </a>
                                                                <div class="product-detail">
                                                                    <ul>
                                                                        <li class="name">
                                                                            <h4 class="table-title text-content">Name</h4>
                                                                            <a
                                                                                href="{{ route('product.show', $detail->product_id) }}">{{ \Illuminate\Support\Str::limit($detail->product->name, 15, $end='...') }} </a>
                                                                        </li>
        
                                                                        <!--<li class="text-content">Sold By: Fresho</li>-->
        
                                                                        <!--<li class="text-content">Quantity - 500 g</li>-->
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
        
                                                        <td class="price">
                                                            <h4 class="table-title text-content">Order ID</h4>
                                                            <h6 class="theme-color">{{ $order->orderId }}</h6>
                                                        </td>
                                                        <td class="price">
                                                            <h4 class="table-title text-content">Price</h4>
                                                            <h6 class="theme-color">{{ $detail->discount_price }}</h6>
                                                        </td>
        
                                                        <td class="quantity">
                                                            <h4 class="table-title text-content">Qty</h4>
                                                            <h4 class="text-title">{{ $detail->quantity }}</h4>
                                                        </td>
        
                                                        <td class="subtotal">
                                                            <h4 class="table-title text-content">Total</h4>
                                                            <h5>{{ $detail->discount_price * $detail->quantity }}</h5>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>Search by order id</td>
                                                    </tr>
                                                @endforelse
                                            @empty
                                                <tr>
                                                    <td>Order not found</td>
                                                </tr>
                                            @endforelse
        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           </div>
                           
                        </div>
                        <div class="tab-pane fade" id="pills-confirm" role="tabpanel" aria-labelledby="pills-confirm-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                    $delivery_charges = 0;
                                                    $price = 0;
                                                    $discount_price;
                                                @endphp
            
                                                @forelse($processings as $processing)
                                                    @forelse($processing->ordersDetail as $detail)
                                                        @php
                                                            $subtotal += $detail['discount_price'] * $detail['quantity'];
                                                            $price += $detail['price'] * $detail['quantity'];
                                                            $delivery_charges += $detail['delivery_charges'];
                                                        @endphp
                                                        <tr>
                                                            <td class="product-detail">
                                                                <div class="product border-0">
                                                                    <a href="{{ route('product.show', $detail->product_id) }}"
                                                                        class="product-image">
                                                                        @php $image=json_decode($detail->product->images);@endphp
                                                                        <img width="100" src="https://admin.damraaz.com/{{ $image[0] }}"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                    </a>
                                                                    <div class="product-detail">
                                                                        <ul>
                                                                            <li class="name">
                                                                                <h4 class="table-title text-content">Name</h4>
                                                                                <a
                                                                                    href="{{ route('product.show', $detail->product_id) }}">{{ \Illuminate\Support\Str::limit($detail->product->name, 15, $end='...') }} </a>
                                                                            </li>
            
                                                                            <!--<li class="text-content">Sold By: Fresho</li>-->
            
                                                                            <!--<li class="text-content">Quantity - 500 g</li>-->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
            
                                                            <td class="price">
                                                                <h4 class="table-title text-content">Order ID</h4>
                                                                <h6 class="theme-color">{{ $processing->orderId }}</h6>
                                                            </td>
                                                            <td class="price">
                                                                <h4 class="table-title text-content">Price</h4>
                                                                <h6 class="theme-color">{{ $detail->discount_price }}</h6>
                                                            </td>
            
                                                            <td class="quantity">
                                                                <h4 class="table-title text-content">Qty</h4>
                                                                <h4 class="text-title">{{ $detail->quantity }}</h4>
                                                            </td>
            
                                                            <td class="subtotal">
                                                                <h4 class="table-title text-content">Total</h4>
                                                                <h5>{{ $detail->discount_price * $detail->quantity }}</h5>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>Search by order id</td>
                                                        </tr>
                                                    @endforelse
                                                @empty
                                                    <tr>
                                                        <td>Order not found</td>
                                                    </tr>
                                                @endforelse
            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                               </div>
                        </div>
                        <div class="tab-pane fade" id="pills-on-the-way" role="tabpanel" aria-labelledby="pills-on-the-way-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                    $delivery_charges = 0;
                                                    $price = 0;
                                                    $discount_price;
                                                @endphp
            
                                                @forelse($delivereds as $delivered)
                                                    @forelse($delivered->ordersDetail as $detail)
                                                        @php
                                                            $subtotal += $detail['discount_price'] * $detail['quantity'];
                                                            $price += $detail['price'] * $detail['quantity'];
                                                            $delivery_charges += $detail['delivery_charges'];
                                                        @endphp
                                                        <tr>
                                                            <td class="product-detail">
                                                                <div class="product border-0">
                                                                    <a href="{{ route('product.show', $detail->product_id) }}"
                                                                        class="product-image">
                                                                        @php $image=json_decode($detail->product->images);@endphp
                                                                        <img width="100" src="https://admin.damraaz.com/{{ $image[0] }}"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                    </a>
                                                                    <div class="product-detail">
                                                                        <ul>
                                                                            <li class="name">
                                                                                <h4 class="table-title text-content">Name</h4>
                                                                                <a
                                                                                    href="{{ route('product.show', $detail->product_id) }}">{{ \Illuminate\Support\Str::limit($detail->product->name, 15, $end='...') }} </a>
                                                                            </li>
            
                                                                            <!--<li class="text-content">Sold By: Fresho</li>-->
            
                                                                            <!--<li class="text-content">Quantity - 500 g</li>-->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
            
                                                            <td class="price">
                                                                <h4 class="table-title text-content">Order ID</h4>
                                                                <h6 class="theme-color">{{ $delivered->orderId }}</h6>
                                                            </td>
                                                            <td class="price">
                                                                <h4 class="table-title text-content">Price</h4>
                                                                <h6 class="theme-color">{{ $detail->discount_price }}</h6>
                                                            </td>
            
                                                            <td class="quantity">
                                                                <h4 class="table-title text-content">Qty</h4>
                                                                <h4 class="text-title">{{ $detail->quantity }}</h4>
                                                            </td>
            
                                                            <td class="subtotal">
                                                                <h4 class="table-title text-content">Total</h4>
                                                                <h5>{{ $detail->discount_price * $detail->quantity }}</h5>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>Search by order id</td>
                                                        </tr>
                                                    @endforelse
                                                @empty
                                                    <tr>
                                                        <td>Order not found</td>
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

                {{-- <div class="col-xxl-3 col-lg-4">
                    <div class="row g-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="summery-box">
                                <div class="summery-header">
                                    <h3>Price Details</h3>
                                    <h5 class="ms-auto theme-color">({{ $order->total_items ?? '' }} Items)</h5>
                                </div>

                                <ul class="summery-contain">
                                    <li>
                                        <h4>Profit</h4>
                                        <h4 class="price">Rs. {{ $order->user_profit ?? '' }}</h4>
                                    </li>
                                    <li>
                                        <h4>Subtotal</h4>
                                        <h4 class="price">Rs. {{ $subtotal }}</h4>
                                    </li>

                                    <li>
                                        <h4>Shipping</h4>
                                        <h4 class="price ">Rs. {{ $delivery_charges }}</h4>
                                    </li>

                                    <li>
                                        <h4>Discount</h4>
                                        <h4 class="price  theme-color">Rs. {{ $price - $subtotal }}</h4>
                                    </li>
                                </ul>

                                <ul class="summery-total">
                                    <li class="list-total">
                                        <h4>Total (PKR)</h4>
                                        <h4 class="price">RS. {{ $order->total_amount }}</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-6">
                            <div class="summery-box">
                                <div class="summery-header d-block">
                                    <h3>Shipping Address</h3>
                                </div>

                                <ul class="summery-contain pb-0 border-bottom-0">
                                    <li class="d-block">
                                        <h4>{{ $order->house }}, {{ $order->street }},</h4>
                                        <h4 class="mt-2">{{ $order->city }}, {{ $order->province }}</h4>
                                    </li>

                                    <!--<li class="pb-0">-->
                                    <!--    <h4>Expected Date Of Delivery:</h4>-->
                                    <!--    <h4 class="price theme-color">-->
                                    <!--<a href="order-tracking.html" class="text-danger">Track Order</a>-->
                                    <!--    </h4>-->
                                    <!--</li>-->
                                </ul>

                                <!--<ul class="summery-total">-->
                                <!--    <li class="list-total border-top-0 pt-2">-->
                                <!--        <h4 class="fw-bold">Oct 21, 2021</h4>-->
                                <!--    </li>-->
                                <!--</ul>-->
                            </div>
                        </div>

                        <!--<div class="col-12">-->
                        <!--    <div class="summery-box">-->
                        <!--        <div class="summery-header d-block">-->
                        <!--            <h3>Payment Method</h3>-->
                        <!--        </div>-->

                        <!--        <ul class="summery-contain pb-0 border-bottom-0">-->
                        <!--            <li class="d-block pt-0">-->
                        <!--                <p class="text-content">Pay on Delivery (Cash/Card). Cash on delivery (COD)-->
                        <!--                    available. Card/Net banking acceptance subject to device availability.</p>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // 
        });
    </script>
@endsection
