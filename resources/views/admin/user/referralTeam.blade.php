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
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Business</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($referrals as $refer)
                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>{{ $refer->name }} </td>
                                            <td>{{ $refer->username }}</td>
                                            <td>{{ $refer->email }}</td>
                                            <td>{{ $refer->business }}</td>
                                            <td>{{ $refer->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
            </div>
        </div>
    </div>
  
@endsection
