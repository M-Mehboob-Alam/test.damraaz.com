@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->
    <!-- All User Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                       
                        <div class="table-responsive table-product">
                            <table class="table all-package theme-table" id="table_id">
                                <thead>
                                    <tr>
                                        <th>OrderId</th>
                                        <th>Total Amount</th>
                                        <th>Profit</th>

                                        <th>Status</th>

                                        <th>Updated Date</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders as $ordr)
                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>
                                                {{ $ordr->orderId }}
                                            </td>
                                            <td>
                                                {{ $ordr->total_amount }}
                                            </td>

                                            <td> {{ $ordr->user_profit }}</td>
                                            <td> {{ $ordr->status }}</td>



                                            <td>
                                                {{ $ordr->updated_at }}
                                            </td>



                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.view.order', ['order' => $ordr->id]) }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            href="{{ route('admin.view.order.status', ['order' => $ordr->id]) }}">
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
  
@endsection
