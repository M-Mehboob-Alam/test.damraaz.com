@extends('admin.layouts.app')
@section('content')
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
                                    <li>Total Items {{ $orders->total_items }}</li>
                                    <li>Total Rs.{{ $orders->total_amount }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-inner cart-section order-details-table">
                            <div class="row g-4">
                                <div class="col-xl-8">
                                    <div class="table-responsive table-details">
                                        <table class="table cart-table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Items</th>
                                                    <th class="text-end" colspan="2">
                                                        <a href="javascript:void(0)" class="theme-color">Items Details</a>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $user_profit = 0;
                                                @endphp
                                                @foreach ($orders->order_detail as $details)
                                                    @php
                                                        $user_profit += $details->profit * $details->quantity;
                                                    @endphp
                                                    <tr class="table-order">

                                                        <td>
                                                            <p>{{ $details->product->name }}</p>

                                                        </td>
                                                        <td>
                                                            <p>Quantity</p>
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
                                                            <p>User Profit</p>
                                                            <h5>Rs.{{ $details->profit * $details->quantity }}</h5>
                                                        </td>
                                                    </tr>
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
                                                <p>Pay on Delivery (Cash/Card). Cash on delivery (COD)
                                                    available. Card/Net banking acceptance subject to device
                                                    availability.</p>
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
