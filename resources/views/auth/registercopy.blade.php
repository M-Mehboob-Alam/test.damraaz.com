<!--{{-- @extends('layouts.app')-->

<!--@section('content')-->
<!--<div class="container">-->
<!--    <div class="row justify-content-center">-->
<!--        <div class="col-md-8">-->
<!--            <div class="card">-->
<!--                <div class="card-header">{{ __('Register') }}</div>-->

<!--                <div class="card-body">-->
<!--                    <form method="POST" action="{{ route('register') }}">-->
<!--                        @csrf-->

<!--                        <div class="row mb-3">-->
<!--                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>-->

<!--                                @error('name')-->
<!--                                    <span class="invalid-feedback" role="alert">-->
<!--                                        <strong>{{ $message }}</strong>-->
<!--                                    </span>-->
<!--                                @enderror-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="row mb-3">-->
<!--                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="email">-->

<!--                                @error('phone')-->
<!--                                    <span class="invalid-feedback" role="alert">-->
<!--                                        <strong>{{ $message }}</strong>-->
<!--                                    </span>-->
<!--                                @enderror-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="row mb-3">-->
<!--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">-->

<!--                                @error('password')-->
<!--                                    <span class="invalid-feedback" role="alert">-->
<!--                                        <strong>{{ $message }}</strong>-->
<!--                                    </span>-->
<!--                                @enderror-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="row mb-3">-->
<!--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>-->

<!--                            <div class="col-md-6">-->
<!--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="row mb-0">-->
<!--                            <div class="col-md-6 offset-md-4">-->
<!--                                <button type="submit" class="btn btn-primary">-->
<!--                                    {{ __('Register') }}-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--@endsection --}}-->

@extends('layouts.app')

@section('content')
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
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Sign In</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Sign In</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- log in section start -->
    <section class="log-in-section section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('assets/images/inner-page/sign-up.png') }}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Welcome To Damraaz</h3>
                            <h4>Create New Account</h4>
                        </div>

                        <div class="input-box">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif
                            <form class="row g-4" id="registerForm" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="alert alert-danger hide" id="error-message"></div>
                                <div class="alert alert-success hide" id="sent-message"></div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="fullname"
                                            placeholder="Full Name">
                                        <label for="fullname">Full Name</label>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" name="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" required
                                            id="email" placeholder="Email Address">
                                        <label for="email">Email</label>
                                        <span id="email_address"></span>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="tel"  name="phone" value="+92 3" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            placeholder="Email Address">
                                        <input id="page_name_field_hidden" type="hidden" value="+92 3" size="50" />
                                        <label for="phone">Phone</label>
                                        <span id="phone_number"></span>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="username"
                                            class="form-control @error('username') is-invalid @enderror" id="username"
                                            placeholder="Password">
                                        <label for="username">Username</label>
                                        <span id="username_msg"></span>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        @if (isset($user))
                                            <input type="text" value="{{ $user ?? '' }}" readonly name="refer_by"
                                                class="form-control" id="refer_by" placeholder="Enter Refer by Username">
                                        @else
                                            <input type="text" name="refer_by" class="form-control" id="refer_by"
                                                placeholder="Enter Refer by Username">
                                        @endif
                                        <label for="refer_by">Refer By </label>
                                    </div>
                                    <span id="refer_by_msg"></span>
                                    @error('refer_by')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" required name="password" class="form-control"
                                            id="password" placeholder="Enter Your Password">
                                        <label for="password">Password</label>
                                        <span toggle="#password"
                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            {{-- <input class="checkbox_animated check-box" required type="checkbox"
                                                id="flexCheckDefault"> --}}
                                            <label class="form-check-label" for="flexCheckDefault">I agree with
                                                <a href="{{ route('frontend.privacy.policy') }}">Terms and
                                                    Privacy</a></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div id="recaptcha-container"></div>
                                    <button class="btn btn-animation w-100" type="button" onclick="OTPSend();">Verify
                                        OTP</button>
                                </div>
                            </form>
                            <form class="col-12 mt-4  g-4 hide" id="otpVerify">
                                <div class="form-floating theme-form-floating my-2">
                                    <input type="number" id="otp-code" class="form-control" placeholder="Enter OTP Code">
                                    <label for="refer_by">Enter Otp </label>
                                </div>
                                <button type="button" class="btn btn-info btn-animation w-100"     onclick="OTPVerify();">Sign Up</button>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6>or</h6>
                        </div>

                        {{-- <div class="log-in-button">
                            <ul>
                                <li>
                                    <a href="https://accounts.google.com/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin"
                                        class="btn google-button w-100">
                                        <img src="{{asset('assets/images/inner-page/google.png')}}" class="blur-up lazyload"
                                            alt="">
                                        Sign up with Google
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/" class="btn google-button w-100">
                                        <img src="{{asset('assets/images/inner-page/facebook.png')}}" class="blur-up lazyload"
                                            alt=""> Sign up with Facebook
                                    </a>
                                </li>
                            </ul>
                        </div> --}}

                        <div class="other-log-in">
                            <h6></h6>
                        </div>

                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="{{ route('login') }}">Log In</a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
            </div>
        </div>
    </section>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>
    <script type="text/javascript">
        const config = {
            apiKey: "AIzaSyC-BLcrZfWCpy_OpftND8L8brIYgJZtUKs",
            authDomain: "damraaz-c3c96.firebaseapp.com",
            projectId: "damraaz-c3c96",
            storageBucket: "damraaz-c3c96.appspot.com",
            messagingSenderId: "93588772831",
            appId: "1:93588772831:web:c7ca030f702b78c8e4166a",
            measurementId: "G-6XLVRPCCVN"
        };

        firebase.initializeApp(config);
    </script>
    <script type="text/javascript">
        // reCAPTCHA widget    
        
        window.onload=function () {
      render();
    };
    function render() {
        window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

        function OTPSend() {
            document.getElementById('otpVerify').classList.add("d-block");
            var phoneNumber = document.getElementById('phone').value;
            const appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNumber,window.recaptchaVerifier).then(function (confirmationResult) {
              
              window.confirmationResult=confirmationResult;
              coderesult=confirmationResult;
              console.log(coderesult);
    
              document.getElementById("sent-message").innerHTML = "Message sent succesfully.";
             document.getElementById("sent-message").classList.add("d-block");
                
          }).catch((error) => {
                    // console.log(error);
                    document.getElementById("error-message").innerHTML = error.message;
                    document.getElementById("error-message").classList.add("d-block");
                });
        }

        function OTPVerify() {
            var code = document.getElementById('otp-code').value;
            confirmationResult.confirm(code).then(function(result) {

                // User signed in successfully.
                var user = result.user;
                console.log(user);
                document.getElementById("sent-message").innerHTML = "You are succesfully logged in.";
                document.getElementById("sent-message").classList.add("d-block");
                document.getElementById("registerForm").submit();


            }).catch(function(error) {
                console.log(error);
                document.getElementById("error-message").innerHTML = error.message;
                document.getElementById("error-message").classList.add("d-block");

            });
        }
    </script>

@endsection
@section('scripts')
    <script>
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

                            } else {
                                $("#phone_number").text('This phone is unique');
                                $("#phone_number").removeClass("text-danger");
                                $("#phone_number").addClass("text-success");
                            }

                        }

                    });
                }
            });

            $("#username").on('keyup', function() {
                var username = $('#username').val();
                // console.log(username);
                if (username !== "") {
                    // console.log(username);
                    $.ajax({
                        type: 'get',
                        url: '{{ url('check-user') }}',
                        data: {
                            'username': username
                        },
                        success: function(data) {
                            // console.log(data.msg);
                            if (data.msg) {
                                $("#username_msg").text('This username is already taken');
                                $("#username_msg").addClass("text-danger");
                                $("#username_msg").removeClass("text-success");

                            } else {
                                $("#username_msg").text('This username is unique');
                                $("#username_msg").removeClass("text-danger");
                                $("#username_msg").addClass("text-success");
                            }

                        }

                    });
                }
            });
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

                            } else {
                                $("#refer_by_msg").text('This refer by not matched');
                                $("#refer_by_msg").removeClass("text-success");
                                $("#refer_by_msg").addClass("text-danger");
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

                            } else {
                                $("#email_address").text('This email is unique');
                                $("#email_address").removeClass("text-danger");
                                $("#email_address").addClass("text-success");
                            }

                        }

                    });
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
@endsection
