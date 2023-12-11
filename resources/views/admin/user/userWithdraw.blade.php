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
                                        {{-- <th></th> --}}
                                        <th>Amount</th>

                                        <th>Status</th>
                                        <th>Message</th>

                                        {{-- <th>Created Date</th> --}}
                                        <th>Updated Date</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($withdraw as $with)
                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>
                                                {{ $with->amount }}
                                            </td>


                                            <td> {{ $with->status }}</td>
                                            <td> {{ $with->message }}</td>
                                            {{-- <td> {{ $with->status }}</td> --}}




                                            <td>
                                                {{ $with->updated_at }}
                                            </td>



                                            <td>
                                                <ul>


                                                    <li>
                                                        <a
                                                            href="{{ route('admin.view.withdraw.status', ['withdraw' => $with->id]) }}">
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
  
@endsection
