@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All <span class="text-uppercase"> {{ $withdraw }} </span> Withdraws </h5>
                            <!--<a href="#" class="btn btn-solid">Download all orders</a>-->
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package withdraw-table theme-table" id="table_id">
                                    <thead>
                                        <tr>

                                            <th>Username</th>
                                            <th>Withdraw Of</th>

                                            <th>Amount</th>

                                            <th>Date</th>
                                            <th>Updated </th>


                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($withdraws as $withdr)
                                            <tr data-bs-toggle="offcanvas" href="#withdraw-details">
                                                <td>
                                                    {{ $withdr->user->username }}
                                                </td>
                                                <td>
                                                    {{ $withdr->withdrawOf }}
                                                </td>

                                                <td>
                                                    @if ($withdr->withdrawOf == 'Saving')
                                                    {{ $withdr->amount * 25/100 }}
                                                    @elseif($withdr->withdrawOf == 'Shop')
                                                    {{ $withdr->amount * 90/100 }}
                                                    @elseif($withdr->withdrawOf == 'Branding')
                                                    {{ $withdr->amount * 95/100 }}
                                                    @else
                                                    {{ $withdr->amount * 90/100 }}
                                                    @endif

                                                </td>



                                                <td> {{ $withdr->created_at }}</td>

                                                <td>
                                                    {{ $withdr->updated_at }}
                                                </td>



                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a
                                                                href="{{ route('admin.user.detail', ['user' => $withdr->user_id]) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a
                                                                href="{{ route('admin.view.withdraw.status', ['withdraw' => $withdr->id]) }}">
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
