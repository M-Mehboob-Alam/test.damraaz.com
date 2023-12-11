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

                                                        <li>Delivery Slip</li>
                                                        <li><a href="{{asset($detail->image)}}" target="_blank">
                                                            <img src="{{asset($detail->image)}}" height="50px" width="50px" alt=""></a></li>

                                                            
                                                            <li>Name</li><li>
                                                                {{$orders->name}}
                                                            </li>
                                                            <li>Phone</li>
                                                            <li>
                                                                {{$orders->phone}}
                                                            </li>
                                                            <li>City </li><li>
                                                                {{$orders->city}}
                                                            </li>
                                                            <li>state</li><li>
                                                                {{$orders->state}}
                                                            </li>
                                                            <li>address</li><li>
                                                                {{$orders->address}}
                                                            </li>
                                                            <li>Notes</li><li>
                                                                {{$orders->notes}}
                                                            </li>
                                                    </ul>
                                                    
        
        
                                                        
        
        

                                                  

                                            </tbody>

                                          
                                        </table>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="order-success">
                                        <div class="row g-4">
                                            <h4>summery</h4>
                                            <ul class="order-details">
                                                <li>Order Date: {{ $orders->created_at }}</li>
                                                <li>Order Total: Rs.{{ $orders->delivery_charges }}</li>
                                                {{-- <li>Amount Paid Via Profit Rs.{{ $orders->payment_method }} </li> --}}
                                            </ul>
                                          
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
