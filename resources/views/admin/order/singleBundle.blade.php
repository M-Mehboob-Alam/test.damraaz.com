@extends('admin.layouts.app')
@section('content')
@php
$user_profit = 0;
$delivery_charges = 0;
$detail = $orders;
@endphp
    <!-- tracking table start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header title-header-block package-card">
                            <div>
                                <h5>Bundle :{{ $orders->product_bundle->name }}</h5>
                                <h5 class="text-danger">Status {{ $orders->status }}</h5>
                                <h5 class="text-success">Business Name: {{ $orders->user->business }}</h5>
                                <h5 class="text-warning">Message: </h5>
                                {{ $orders->message }}
                            </div>
                            <div class="card-order-section">
                                <ul>
                                    <li>{{ $orders->created_at }}</li>
                                    <li>Total Rs.{{ $orders->amount }}</li>
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



                                                    <ul class="shop_styling" >
                                                        <li>Bundle Name</li>
                                                        <li><strong>{{$detail->product_bundle->name}}</strong></li>
                                                        <li>Order Status</li>
                                                        <li><strong>{{$detail->status}}</strong></li>

                                                        <li>Slip Image</li>
                                                        <li><a href="{{asset($detail->slip)}}" target="_blank">
                                                            <img src="{{asset($detail->slip)}}" height="50px" width="50px" alt=""></a></li>

                                                    </ul>

                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">Details</th>

                                                        </tr>
                                                    </thead>

                                            </tbody>

                                            <tfoot>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Commission :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>Rs.{{ $orders->product_bundle->commission }}
                                                        </h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Points :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>Rs.{{ $orders->product_bundle->points }}</h4>
                                                    </td>
                                                </tr>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Bundle Levels:</h5>
                                                    </td>
                                                    <td>
                                                        <h4>Rs. {{ $orders->product_bundle->level }}</h4>
                                                    </td>
                                                </tr>



                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h4 class="theme-color fw-bold">Total Price :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">Rs.{{ $orders->amount }}</h4>
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
                                                <li>Order Date: {{ $orders->created_at }}</li>
                                                <li>Order Total: Rs.{{ $orders->amount }}</li>
                                                <li>Amount Paid Via Profit Rs.{{ $orders->payment_method }} </li>
                                            </ul>



                                            <div class="payment-mode">
                                                <h4>payment method</h4>
                                                <p>Using
                                                    {{$orders->payment_method}}

                                                </p>


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
