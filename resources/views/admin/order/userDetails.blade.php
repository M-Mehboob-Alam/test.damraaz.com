@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All Orders </h5>
                            <!--<a href="#" class="btn btn-solid">Download all orders</a>-->
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package order-table theme-table" id="table_id">
                                    <thead>
                                        <tr>

                                            <th>Username</th>

                                            <th>Amount</th>
                                            <th>Items</th>
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

                                                <td> {{ $ordr->total_amount }}</td>

                                                <td> {{ $ordr->total_items }}</td>

                                                <td> {{ $ordr->created_at }}</td>

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
