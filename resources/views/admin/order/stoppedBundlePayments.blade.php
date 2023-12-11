@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All <span class="text-uppercase"> {{ $order }} </span> Stopped In-direct Earning </h5>
                            <!--<a href="#" class="btn btn-solid">Download all orders</a>-->
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package order-table theme-table" id="table_id">
                                    <thead>
                                        <tr>

                                            <th>Username</th>                                            
                                            <th>Amount</th>
                                            <th>Payment Method</th>                                           
                                            <th>Slip</th>
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
                                                    {{ $ordr->amount }}
                                                </td>
                                                <td> {{ $ordr->payment_type }}</td>
                                                <td> 
                                                    <a href="{{ asset($ordr->slip) }}" target="_blank">
                                                        <img src="{{ asset($ordr->slip) }}" style="height: 50px; width:50px" alt="">
                                                    </a>
                                                </td>



                                                <td> {{ $ordr->created_at }}</td>

                                                <td>
                                                    {{ $ordr->updated_at }}
                                                </td>



                                                <td>
                                                    <ul>
                                                       

                                                        <li>
                                                            <a
                                                            target="_blank" href="{{ route('admin.changeStatusStoppedBundlePayments', ['id' => $ordr->id]) }}">
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
