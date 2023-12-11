@extends('admin.layouts.app')
@section('content')
@php
$user_profit = 0;
$delivery_charges = 0;

@endphp
    <!-- tracking table start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header title-header-block package-card">
                            <div>
                                <h5>Order #{{ $orders->orderId }}</h5>
                                <h5 class="text-danger">Status {{ $orders->status }}</h5>
                                <h5 class="text-success">Business Name: {{ $orders->user->business }}</h5>
                                <h5 class="text-warning">Message: </h5>
                                {{ $orders->message }}
                            </div>
                            <div class="card-order-section">
                                <ul>
                                    <li>{{ $orders->created_at }}</li>
                                    <li>Total Rs.{{ $orders->total_amount }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-inner cart-section order-details-table">
                            <div class="row g-4">
                                <div class="col-xl-8">
                                    <div class="table-responsive table-details">
                                        <table class="table cart-table table-borderless">


                                            <tbody>
                                                <style>
                                                    .shop_styling{
                                                        width: 70%;
                                                        display: flex;
                                                        flex-wrap: wrap;
                                                        justify-content:space-between;
                                                        flex-direction: row;

                                                    }
                                                    .shop_styling li{
                                                        display: inline-block;
                                                        width: 50%;
                                                        margin: 5px 0px;
                                                    }
                                                </style>

                                                @foreach ($orders->shop_orders as $detail)

                                                    <ul class="shop_styling" >
                                                        <li>Shop Name</li>
                                                        <li><strong>{{$detail->shop_name}}</strong></li>
                                                        <li>Shop Status</li>
                                                        <li><strong>{{$detail->shop->status}}</strong></li>

                                                        <li>Shop Image</li>
                                                        <li><a href="" target="_blank">
                                                            <img src="{{asset($detail->shop->image)}}" height="50px" width="50px" alt=""></a></li>
                                                        <li>Shop Province</li>
                                                        <li><strong>{{$detail->shop->province}}</strong></li>

                                                        <li>Shop City</li>
                                                        <li><strong>{{$detail->shop->city}}</strong></li>
                                                        <li>Shop Address</li>
                                                        <li><strong>{{$detail->shop->address}}</strong></li>

                                                        <li>Shop Mobile</li>
                                                        <li><strong>{{$detail->shop->mobile}}</strong></li>
                                                        <li>Shop Joined Us</li>
                                                        <li><strong>{{$detail->shop->created_at}}</strong></li>
                                                    </ul>

                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">Deliery Charges Rs. {{$detail->shop_charges}}</th>
                                                            @php
                                                                $delivery_charges += $detail->shop_charges;
                                                            @endphp
                                                            <th class="text-end" colspan="2">
                                                                <a href="javascript:void(0)" class="theme-color">Items Details</a>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($detail->order_details as $details)


                                                    @php
                                                        $user_profit += $details->profit * $details->quantity;
                                                    @endphp
                                                    <tr class="table-order">
                                                        <td>
                                                            <p>{{ $details->product_name }}</p>
                                                            <p><a href="{{asset($details->product_image)}}" target="_blank">
                                                                <img src="{{asset($details->product_image)}}" height="50px" width="50px" alt=""></a></p>

                                                        </td>
                                                        <td>
                                                            <p class="mt-5">Quantity</p>
                                                            <h5>{{ $details->quantity }}</h5>
                                                            <p>Delivery Date</p>
                                                            <h5>{{ $details->created_at->addDays($details->delivery_days) }}
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <p>Discount Price</p>
                                                            <h5>Rs.{{ $details->discount_price }}</h5>
                                                            <p>Price</p>
                                                            <h5>Rs.{{ $details->price }}</h5>
                                                        </td>

                                                        <td>
                                                            <h6 class="bg-dark text-light p-2 text-uppercase"><strong >{{ $details->status }}</strong></h6>
                                                            <p>User Profit</p>
                                                            <h5>Rs.{{ $details->profit * $details->quantity }}</h5>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endforeach

                                            </tbody>

                                            <tfoot>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Subtotal :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>Rs.{{ $orders->total_amount - $delivery_charges - $user_profit }}
                                                        </h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Delivery Charges :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>Rs.{{ $delivery_charges }}</h4>
                                                    </td>
                                                </tr>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>User Profits:</h5>
                                                    </td>
                                                    <td>
                                                        <h4>Rs. {{ $user_profit }}</h4>
                                                    </td>
                                                </tr>



                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h4 class="theme-color fw-bold">Total Price :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">Rs.{{ $orders->total_amount }}</h4>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="order-success">
                                        <div class="row g-4">
                                            <h4>summery</h4>
                                            <ul class="order-details">
                                                <li>Order ID: {{ $orders->orderId }}</li>
                                                <li>Order Date: {{ $orders->created_at }}</li>
                                                <li>Order Total: Rs.{{ $orders->total_amount }}</li>
                                                @if (is_null($orders->payment_method))
                                                <li>Advanced Paid Rs.{{ $orders->amount_paid }} </li>
                                                @elseif ($orders->payment_method == 'cod')
                                                <li>Delivery Charges Paid Rs.{{ $delivery_charges }} </li>
                                                @else
                                                <li>Amount Paid Via Profit Rs.{{ $orders->amount_paid }} </li>
                                                @endif
                                            </ul>

                                            <h4>shipping address</h4>
                                            <ul class="order-details">
                                                <li>{{ $orders->name }}</li>
                                                <li>{{ $orders->city }}</li>
                                                <li>{{ $orders->province }}, {{ $orders->area }}, {{ $orders->address }}
                                                    {{ $orders->house }} {{ $orders->street }} {{ $orders->nearest }}
                                                    Contact No. {{ $orders->phone }}</li>
                                            </ul>

                                            <div class="payment-mode">
                                                <h4>payment method</h4>
                                                <p>Using
                                                    {{$orders->payment_method??'cod'}}
                                                    @if (is_null($orders->payment_method))
                                                        Advance Payment
                                                    @elseif ($orders->payment_method == 'cod')
                                                        COD(Cash On Delivery)
                                                    @else
                                                        Using Profit
                                                    @endif
                                                </p>
                                                @if ($orders->payment_method != 'profit')
                                                <h4>
                                                    Slip
                                                    <a href="{{ route('view_receipt', ['filename' => $orders->screenshot]) }}" target="_blank">View Receipt</a>
                                                </h4>
                                                @else
                                                    Using Profit
                                                @endif

                                                {{-- <p>Pay on Delivery (Cash/Card). Cash on delivery (COD)
                                                    available. Card/Net banking acceptance subject to device
                                                    availability.</p> --}}
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- section end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tracking table end -->

    <div class="container-fluid">
        <!-- footer start-->
        <footer class="footer">
            <div class="row">
                <div class="col-md-12 footer-copyright text-center">
                    <p class="mb-0">Copyright 2023 © Damraaz</p>
                </div>
            </div>
        </footer>
    </div>
    </div>
@endsection
