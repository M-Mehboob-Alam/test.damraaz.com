@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->
    <!-- All User Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <h1>It's {{$user->username}}</h1>
                        <hr>
                        <form method="POST" action="{{route('admin.user.detail.update')}}" class="theme-form theme-form-2 mega-form">

                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="col-12 alert-dismissible fade show" role="alert">{{ $error }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="user_id" id="" value="{{$user->id}}">
                            <div class="row">
                                <div  class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Business Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"  name="business" type="text" required value="{{ $user->business }}">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Full Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" required name="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-12">
                                        <input class="btn btn-success ms-auto" type="submit"  value="Update">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form method="POST" action="{{route('admin.updateUsername')}}" class="theme-form theme-form-2 mega-form">

                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="col-12 alert-dismissible fade show" role="alert">{{ $error }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="user_id" id="" value="{{$user->id}}">
                            <div class="row">

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">User Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="username" id="check_username_ajax" required value="{{ $user->username }}">
                                    </div>
                                    <span class="check_username_span"></span>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-12">
                                        <input class="btn btn-success ms-auto" type="submit" id="check_username_ajax_btn"  value="Update Username">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form method="POST" action="{{route('admin.updatePhone')}}" class="theme-form theme-form-2 mega-form">

                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="col-12 alert-dismissible fade show" role="alert">{{ $error }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="user_id" id="" value="{{$user->id}}">
                            <div class="row">

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Phone No</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" required name="phone" id="check_phone_ajax" value="{{ $user->phone }}">
                                    </div>
                                    <span class="check_phone_span"></span>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-12">
                                        <input class="btn btn-success ms-auto" type="submit" id="check_phone_ajax_btn" value="Update Phone Number">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form method="POST" action="{{route('admin.updateEmail')}}" class="theme-form theme-form-2 mega-form">

                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="col-12 alert-dismissible fade show" role="alert">{{ $error }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="user_id" id="" value="{{$user->id}}">
                            <div class="row">

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" required id="check_email_ajax" name="email"  value="{{ $user->email }}">
                                    </div>
                                    <span class="check_email_ajax_span"></span>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-12">
                                        <input class="btn btn-success ms-auto" type="submit"  id="check_email_ajax_btn" value="Update Email">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>

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
                <form action="{{ route('admin.user.password.update',$user->id) }}" method="POST">
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        var verifyUsername = false;
        var verifyPhone = false;
        var verifyEmail = false;
        $(document).ready(function(){
            $('#check_username_ajax').keyup(function(){
                var check_username = $('#check_username_ajax').val();
                console.log(check_username);
                $.ajax({
                    type:'GET',
                    url:"{{ route('admin.checkUsername') }}",
                    data:{data:check_username},
                    success:function(data){
                            if((data.yes)){
                               $('.check_username_span').removeClass('text-danger');
                               $('.check_username_span').addClass('text-success');
                               $('.check_username_span').empty().append('Unique Username');
                               verifyUsername = true;
                            }else{
                                $('.check_username_span').removeClass('text-success');
                                $('.check_username_span').addClass('text-danger');
                                $('.check_username_span').empty().append('Username already taken');
                                verifyUsername = false;
                            }
                    }
                 });
            });
            $('#check_username_ajax_btn').click(function(e){
                if(!verifyUsername){
                    alert('please enter unique name to edit username');
                    e.preventDefault();
                }
            });
            $('#check_phone_ajax').keyup(function(){
                var check_phone = $('#check_phone_ajax').val();
                console.log(check_phone);
                $.ajax({
                    type:'GET',
                    url:"{{ route('admin.checkPhone') }}",
                    data:{data:check_phone},
                    success:function(data){
                            if((data.yes)){
                               $('.check_phone_span').removeClass('text-danger');
                               $('.check_phone_span').addClass('text-success');
                               $('.check_phone_span').empty().append('Unique Phone No');
                               verifyPhone = true;
                            }else{
                                $('.check_phone_span').removeClass('text-success');
                                $('.check_phone_span').addClass('text-danger');
                                $('.check_phone_span').empty().append('Phone No already taken');
                                verifyPhone = false;
                            }
                    }
                 });
            });
            $('#check_phone_ajax_btn').click(function(e){
                if(!verifyPhone){
                    alert('please enter Unique Phone No');
                    e.preventDefault();
                }
            });
            $('#check_email_ajax').keyup(function(){
                var check_email = $('#check_email_ajax').val();
                console.log(check_email);
                $.ajax({
                    type:'GET',
                    url:"{{ route('admin.checkEmail') }}",
                    data:{data:check_email},
                    success:function(data){
                            if((data.yes)){
                               $('.check_email_ajax_span').removeClass('text-danger');
                               $('.check_email_ajax_span').addClass('text-success');
                               $('.check_email_ajax_span').empty().append('Unique Email');
                               verifyEmail = true;
                            }else{
                                $('.check_email_ajax_span').removeClass('text-success');
                                $('.check_email_ajax_span').addClass('text-danger');
                                $('.check_email_ajax_span').empty().append('Email already taken');
                                verifyEmail = false;
                            }
                    }
                 });
            });
            $('#check_email_ajax_btn').click(function(e){
                if(!verifyEmail){
                    alert('please enter unique email to edit email');
                    e.preventDefault();
                }
            });

        });
    </script>
@endsection
