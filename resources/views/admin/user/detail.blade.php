@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->
    <!-- All User Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <h1>It's {{ $user->username }}</h1>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           Delete User
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete {{$user->username}} Confirmation!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.adminDeleteUser')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                           
                                            <div class="mb-3">
                                              <label for="exampleInputPassword1" class="form-label">Type: "{{$user->username}}" To Delete IT</label>
                                              <input type="text" required name="username" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-secondary">Delete</button>
                                          </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                        data-bs-dismiss="modal">close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="title-header option-title">

                            @if (blank($shop))
                                No Shop
                            @else
                                <div class="btn-group">
                                    <a href="{{ route('admin.viewShopDetail', ['shop' => $shop->user_id]) }}"
                                        class="btn btn-danger active" target="_blank" aria-current="page">Shop Details</a>

                                </div>
                            @endif
                            <div class="btn-group">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#change-password"
                                    class="btn btn-danger active" target="_blank" aria-current="page">Change Password</a>

                            </div>

                        </div>
                        <hr>
                        <div class="title-header option-title">
                            <h5>Profile Setting</h5>
                            <div class="btn-group">
                                <a href="{{ route('admin.userPersonalDetail', $user->id) }}" class="btn btn-danger active"
                                    target="_blank" aria-current="page">Personal Profile</a>

                            </div>
                        </div>

                        <hr>
                        <div class="title-header option-title">
                            <h5>User Orders</h5>
                            <div class="btn-group">
                                <a href="{{ route('admin.userOrders', $user->id) }}" class="btn btn-danger active"
                                    target="_blank" aria-current="page">User Orders</a>

                            </div>
                        </div>
                        <hr>
                        <div class="title-header option-title">
                            <h5>Referral Team</h5>
                            <div class="btn-group">
                                <a href="{{ route('admin.userReferralTeam', $user->id) }}" class="btn btn-danger active"
                                    target="_blank" aria-current="page">Details</a>

                            </div>
                        </div>

                        <hr>
                        <div class="title-header option-title">
                            <h5>Referral Commission</h5>
                            <div class="btn-group">
                                <a href="{{ route('admin.userReferralCommission', $user->id) }}"
                                    class="btn btn-danger active" target="_blank" aria-current="page">Details</a>
                            </div>
                        </div>

                        <hr>
                        <div class="title-header option-title">
                            <h5>User Commission</h5>
                            <div class="btn-group">
                                <a href="{{ route('admin.userCommission', $user->id) }}" class="btn btn-danger active"
                                    target="_blank" aria-current="page">Details</a>

                            </div>

                        </div>

                        <hr>

                        <div class="title-header option-title">
                            <h5>User Sale Commission</h5>
                            <div class="btn-group">
                                <a href="{{ route('admin.userSaleCommission', $user->id) }}" class="btn btn-danger active"
                                    target="_blank" aria-current="page">Details</a>
                            </div>
                        </div>

                        <hr>
                        <div class="title-header option-title">
                            <h5>User Withdraw</h5>
                            <div class="btn-group">
                                <a href="{{ route('admin.userWithdraw', $user->id) }}" class="btn btn-danger active"
                                    target="_blank" aria-current="page">Details</a>
                            </div>
                        </div>

                        <hr>
                        <div class="title-header option-title">
                            <h5>User Balance </h5>
                        </div>
                        <div class="table-responsive table-product">
                            <table class="table all-package theme-table" id="table_id">
                                <thead>
                                    <tr>

                                        <th>Total Profit/Commission</th>
                                        <th> {{ $commission_count + $sale_commission_count }}</th>


                                    </tr>
                                    <tr>
                                        <th>Total Withdraw Completed</th>
                                        <th> {{ $withdraw_count }}</th>
                                    </tr>
                                    <tr>
                                        <th> Withdraw Request</th>
                                        <th> {{ $withdraw_pending }}</th>
                                    </tr>
                                    <tr>

                                        <th>Remaining Balance</th>
                                        <th> {{ $commission_count + $sale_commission_count - $withdraw_count }}</th>




                                    </tr>
                                </thead>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All User Table Ends-->

        <div class="container-fluid">
            <!-- footer start-->
            <footer class="footer">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">Copyright 2022 © Fastkart theme by pixelstrap</p>
                    </div>
                </div>
            </footer>
            <!-- footer end-->
        </div>
    </div>


    <!-- change password modal box start -->
    <div class="modal fade theme-modal" id="change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change User Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('admin.user.password.update', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="password" required class="form-control" name="password" id="Pass"
                                placeholder="Enter Password" autocomplete="false">
                            <label for="Pass">Enter Password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn theme-bg-color btn-md text-white"
                            data-bs-dismiss="modal">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- change password modal box end -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        var verifyUsername = false;
        var verifyPhone = false;
        var verifyEmail = false;
        $(document).ready(function() {
            $('#check_username_ajax').keyup(function() {
                var check_username = $('#check_username_ajax').val();
                console.log(check_username);
                $.ajax({
                    type: 'GET',
                    url: "{{ route('admin.checkUsername') }}",
                    data: {
                        data: check_username
                    },
                    success: function(data) {
                        if ((data.yes)) {
                            $('.check_username_span').removeClass('text-danger');
                            $('.check_username_span').addClass('text-success');
                            $('.check_username_span').empty().append('Unique Username');
                            verifyUsername = true;
                        } else {
                            $('.check_username_span').removeClass('text-success');
                            $('.check_username_span').addClass('text-danger');
                            $('.check_username_span').empty().append('Username already taken');
                            verifyUsername = false;
                        }
                    }
                });
            });
            $('#check_username_ajax_btn').click(function(e) {
                if (!verifyUsername) {
                    alert('please enter unique name to edit username');
                    e.preventDefault();
                }
            });
            $('#check_phone_ajax').keyup(function() {
                var check_phone = $('#check_phone_ajax').val();
                console.log(check_phone);
                $.ajax({
                    type: 'GET',
                    url: "{{ route('admin.checkPhone') }}",
                    data: {
                        data: check_phone
                    },
                    success: function(data) {
                        if ((data.yes)) {
                            $('.check_phone_span').removeClass('text-danger');
                            $('.check_phone_span').addClass('text-success');
                            $('.check_phone_span').empty().append('Unique Phone No');
                            verifyPhone = true;
                        } else {
                            $('.check_phone_span').removeClass('text-success');
                            $('.check_phone_span').addClass('text-danger');
                            $('.check_phone_span').empty().append('Phone No already taken');
                            verifyPhone = false;
                        }
                    }
                });
            });
            $('#check_phone_ajax_btn').click(function(e) {
                if (!verifyPhone) {
                    alert('please enter Unique Phone No');
                    e.preventDefault();
                }
            });
            $('#check_email_ajax').keyup(function() {
                var check_email = $('#check_email_ajax').val();
                console.log(check_email);
                $.ajax({
                    type: 'GET',
                    url: "{{ route('admin.checkEmail') }}",
                    data: {
                        data: check_email
                    },
                    success: function(data) {
                        if ((data.yes)) {
                            $('.check_email_ajax_span').removeClass('text-danger');
                            $('.check_email_ajax_span').addClass('text-success');
                            $('.check_email_ajax_span').empty().append('Unique Email');
                            verifyEmail = true;
                        } else {
                            $('.check_email_ajax_span').removeClass('text-success');
                            $('.check_email_ajax_span').addClass('text-danger');
                            $('.check_email_ajax_span').empty().append('Email already taken');
                            verifyEmail = false;
                        }
                    }
                });
            });
            $('#check_email_ajax_btn').click(function(e) {
                if (!verifyEmail) {
                    alert('please enter unique email to edit email');
                    e.preventDefault();
                }
            });

        });
    </script>
@endsection
