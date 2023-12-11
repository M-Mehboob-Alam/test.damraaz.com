@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All <span class="text-uppercase"> {{ $order }} </span> Bundle </h5>
                            <!--<a href="#" class="btn btn-solid">Download all orders</a>-->
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package order-table theme-table" id="table_id">
                                    <thead>
                                        <tr>

                                            <th>Username</th>
                                            <th>Bundle</th>
                                            <th>Order Amount</th>
                                            <th>Delivery Amount</th>
                                            <th>Delivery Slip</th>
                                            <th>Date</th>
                                            <th>Updated </th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $ordr)
                                            <tr data-bs-toggle="offcanvas" href="#order-details">
                                                <td>
                                                    {{ $ordr->user->username }}
                                                </td>
                                                <td>
                                                    {{ $ordr->product_bundle->name }}
                                                </td>

                                                <td> {{ $ordr->buy_product_bundle->amount }}</td>
                                                <td> {{ $ordr->product_bundle->delivery_charges }}</td>
                                                <td> 
                                                    <a href="{{ asset($ordr->image) }}" target="_blank">
                                                        <img src="{{ asset($ordr->image) }}" style="height: 50px; width:50px" alt="">
                                                    </a>
                                                </td>



                                                <td> {{ $ordr->created_at }}</td>

                                                <td>
                                                    {{ $ordr->updated_at }}
                                                </td>



                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a target="_blank" href="{{ route('admin.getBundleOrderView', ['order' => $ordr->id]) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a
                                                            target="_blank" href="{{ route('admin.getBundleOrderStatus', ['order' => $ordr->id]) }}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->

    <!-- footer start-->
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
