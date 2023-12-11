<!DOCTYPE html>
<!-- Html start -->
<html lang="en">
  <!-- Head Start -->
  @php
      use App\Models\User;
      $getRegisteredUserCounter = User::count();
      $getLastRegisteredUserId = User::latest()->first();
  @endphp
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="{{env('APP_NAME')}}" />
    <meta name="keywords" content="{{env('APP_NAME')}}" />
    <meta name="author" content="{{env('APP_NAME')}}" />
    <link rel="icon" href="{{asset('newtheme/assets/images/favicon/favicon.png')}}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset('newtheme/assets/images/favicon/favicon.png')}}" type="image/x-icon" />
    <link rel="manifest" href="./manifest.json" />
    <link rel="icon" href="{{asset('newtheme/assets/images/favicon/favicon.png')}}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{asset('newtheme/assets/images/favicon/favicon.png')}}" />
    <meta name="theme-color" content="#0f8fac" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="{{env('APP_NAME')}}" />
    <meta name="msapplication-TileImage" content="../assets/images/favicon/favicon.png')}}" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Register - {{env('APP_NAME')}}</title>

    <!-- Google Jost Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Google Monsterrat Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet" />

    <!-- Google Leckerli Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet" />

    <!-- Bootstrap Css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{asset('newtheme/assets/css/vendors/bootstrap.css')}}" />

    <!-- Style Css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="{{asset('newtheme/assets/css/style.css')}}" />
  </head>
  <!-- Head End -->

  <!-- Body Start -->
  <body>
    <!-- Loader Start -->
    <div class="loader-wrapper">
      <div class="loader animate">
        <span>D</span>
        <span>A</span>
        <span>M</span>
        <span>R</span>
        <span>A</span>
        <span>A</span>
        <span>Z</span>
      </div>
    </div>
    <!-- Loader End -->
    <style type="text/css">
        .hide {
            display: none;
        }

        .field-icon {
            float: right;
            margin-top: -31px;
            position: relative;
            right: 10px;
            z-index: 2;
        }
    </style>
    <!-- Main Start -->
    <div class="main">
      <section class="page-body p-0">
        <div class="row g-0 ratio_asos">
          <div class="order-2 order-lg-1 col-lg-5">
            <div class="content-box">
              <div>
                <h5>CREATE ACCOUNT<span class="bg-theme-blue"></span></h5>

                                @if ($errors->any())
                                 @foreach ($errors->all() as $error)
                                    <div class="text-danger">{{$error}}</div>
                                 @endforeach
                                @endif
                <form  class="custom-form form-pill" id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="alert alert-danger hide" id="error-message"></div>
                                <div class="alert alert-success hide" id="sent-message"></div>
                                <div class="input-box">
                                    <label for="name">Full Name</label>
                                    <input class="form-control" type="text" required name="name" id="name" value="{{ old('name')}}" placeholder="Enter Your Full Name" />
                                </div>
                                <div class="input-box">
                                  <label for="email">Email</label>
                                  <input class="form-control" type="email" required name="email" id="email" value="{{ old('email')}}" placeholder="Enter Your Email" />
                                  <span id="email_address"></span>
                                </div>

                <div class="input-box">
                    <label for="phone">Phone</label>
                        <input type="number"  name="phone" value="{{ old('phone')}}" min="11"  name="phone"
                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                            placeholder="Your Phone No like 03123456789">
                        <input id="page_name_field_hidden" type="hidden" min="11" value="{{ old('phone')}}" size="50" />

                        <span id="phone_number"></span>


                </div>

                <div class="input-box">

                        <label for="username">Username</label>
                        <input type="text" readonly name="username" value="DMRU{{  $getLastRegisteredUserId->id }}"
                            class="form-control @error('username') is-invalid @enderror" id="username"
                            placeholder="Unique Username">
                        <span id="username_msg"></span>


                </div>
                <div class="input-box">

                        <label for="refer_by">Refer By </label>
                        <script>
                            var isReferedSponsorName = false;
                        </script>
                        @if (isset($user))
                        <script>
                            var isReferedSponsorName = true;
                        </script>
                            <input type="text" value="{{ $user ?? '' }}" readonly name="refer_by"
                                class="form-control" id="refer_by" placeholder="Enter Refer by Username">

                        @else
                            <input type="text" name="refer_by" class="form-control" id="refer_by"
                                placeholder="Enter Refer by Username">
                        @endif

                    <span id="refer_by_msg"></span>

                </div>
                <div class="input-box">
                    <label for="password">Password</label>
                    <div class="icon-input">
                      <input class="form-control" type="password" required name="password" id="password" />
                      <img class="showHidePassword" src="{{asset('newtheme/assets/icons/svg/eye-1.svg')}}" alt="eye" />
                    </div>
                  </div>
                <div class="input-box">
                    <div class="forgot-box">
                        <div class="form-check ps-0 m-0 remember-box">
                            {{-- <input class="checkbox_animated check-box" required type="checkbox"
                                id="flexCheckDefault"> --}}
                            <label class="form-check-label" for="flexCheckDefault">I agree with
                                <a href="{{ route('frontend.privacy.policy') }}" class="text-primary">Terms and
                                    Privacy</a></label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div id="recaptcha-container"></div>
                    <button class="btn-solid rounded-pill line-none" type="submit" id="register_verify" >Register</button>
                </div>
                </form>

                <a href="{{url('/')}}" class="btn-solid rounded-pill line-none btn-outline mt-3 d-flex justify-content-center">Home <i class="arrow"></i></a>

                <span class="backto-link font-default content-color text-decoration-none">Already have an Account?, <a class="text-decoration-underline theme-color" href="{{route('login')}}"> Sign In</a> </span>

              </div>
            </div>
          </div>

          <div class="order-1 order-lg-2 col-lg-7">
            <div class="img-box">
              {{-- <img class="bg-img" src="{{asset('newtheme/assets/images/inner-page/banner.jpg')}}" alt="banner" /> --}}
              <img class="bg-img" src="https://images.pexels.com/photos/5632402/pexels-photo-5632402.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="banner" />
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- Main End -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
 <!-- Bootstrap Js -->
 <script src="{{asset('newtheme/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

 <!-- Feather Icon -->
 <script src="{{asset('newtheme/assets/js/feather/feather.min.js')}}"></script>

    <!-- Password Show-Hide js -->
    <script src="{{asset('newtheme/assets/js/password-showhide.js')}}"></script>

  <!-- Script Js -->
  <script src="{{asset('newtheme/assets/js/script.js')}}"></script>


  <script>
        var verifyPhone = false;
        var verifyEmail = false;
        var verifyUsername = false;
        var verifyRefer = false;
    $(document).ready(function() {

        $("#phone").on('keyup', function() {
            var phone = $('#phone').val();
            // console.log(phone);
            if (phone !== "") {
                // console.log(phone);
                $.ajax({
                    type: 'get',
                    url: '{{ url('check-user') }}',
                    data: {
                        'phone': phone
                    },
                    success: function(data) {
                        // console.log(data.msg);
                        if (data.msg) {
                            $("#phone_number").text('This phone is already taken');
                            $("#phone_number").addClass("text-danger");
                            $("#phone_number").removeClass("text-success");
                            verifyPhone = false;

                        } else {
                            $("#phone_number").text('This phone is unique');
                            $("#phone_number").removeClass("text-danger");
                            $("#phone_number").addClass("text-success");
                            verifyPhone = true;
                        }

                    }

                });
            }
        });

        verifyUsername = true;
        // $("#username").on('keyup', function() {
        //     var username = $('#username').val();
        //     // console.log(username);
        //     if (username !== "") {
        //         // console.log(username);
        //         $.ajax({
        //             type: 'get',
        //             url: '{{ url('check-user') }}',
        //             data: {
        //                 'username': username
        //             },
        //             success: function(data) {
        //                 // console.log(data.msg);
        //                 if (data.msg) {
        //                     $("#username_msg").text('This username is already taken');
        //                     $("#username_msg").addClass("text-danger");
        //                     $("#username_msg").removeClass("text-success");
        //                     verifyUsername = false;

        //                 } else {
        //                     $("#username_msg").text('This username is unique');
        //                     $("#username_msg").removeClass("text-danger");
        //                     $("#username_msg").addClass("text-success");
        //                     verifyUsername = true;
        //                 }

        //             }

        //         });
        //     }
        // });
        $("#refer_by").on('keyup', function() {
            var refer_by = $('#refer_by').val();
            // console.log(refer_by);
            if (refer_by !== "") {
                // console.log(refer_by);
                $.ajax({
                    type: 'get',
                    url: '{{ url('check-user') }}',
                    data: {
                        'refer_by': refer_by
                    },
                    success: function(data) {
                        // console.log(data.msg);
                        if (data.msg) {
                            $("#refer_by_msg").text('This refer by matched');
                            $("#refer_by_msg").addClass("text-success");
                            $("#refer_by_msg").removeClass("text-danger");
                            verifyRefer = true;
                        } else {
                            $("#refer_by_msg").text('This refer by not matched');
                            $("#refer_by_msg").removeClass("text-success");
                            $("#refer_by_msg").addClass("text-danger");
                            verifyRefer = false;
                        }

                    }

                });
            }
        });
        $("#email").on('keyup', function() {
            var email = $('#email').val();
            // console.log(phone);
            if (email !== "") {
                // console.log(phone);
                $.ajax({
                    type: 'get',
                    url: '{{ url('check-user') }}',
                    data: {
                        'email': email
                    },
                    success: function(data) {
                        // console.log(data.msg);
                        if (data.msg) {
                            $("#email_address").text('This email is already taken');
                            $("#email_address").addClass("text-danger");
                            $("#email_address").removeClass("text-success");
                            verifyEmail = false;

                        } else {
                            $("#email_address").text('This email is unique');
                            $("#email_address").removeClass("text-danger");
                            $("#email_address").addClass("text-success");
                            verifyEmail = true;
                        }

                    }

                });
            }
        });

        $('#register_verify').click(function(e){


            if( document.getElementById('refer_by').value === '' ){
                verifyRefer = true;
                isReferedSponsorName = true;
            }


            if(verifyRefer){
                isReferedSponsorName = true;
            }
            if(verifyEmail && verifyPhone  && verifyUsername){

                $('#register_verify').prop('disabled', false);

            }else{
                $('#register_verify').prop('disabled', true);
                if(!verifyEmail){
                    alert('please enter valide email');
                }
                if(!verifyPhone){
                    alert('please enter valide phone no');
                }

                if(!isReferedSponsorName){
                    if(!verifyRefer){
                    alert('please enter valide Sponsor username');
                }
                }
                if(!verifyUsername){
                    alert('please enter valide username');
                }

            }
            if(!(verifyEmail && verifyPhone  && verifyUsername && isReferedSponsorName)){
                $('#register_verify').prop('disabled', false);
                e.preventDefault();
            }

            var getPhoneLength = $('#phone').val();
            if (getPhoneLength.length != 11) {
                alert('Phone No must be 11 digits ');
                $('#register_verify').prop('disabled', false);
                e.preventDefault();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>
  </body>
  <!-- Body End -->
</html>
<!-- Html End -->
