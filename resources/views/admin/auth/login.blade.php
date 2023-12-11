@extends('layouts.app')

@section('content')
 <style type="text/css">
    .hide {
        display: none;
    }

   .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
    }
</style>
 <!-- Breadcrumb Section Start -->
 <section class="breadscrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>Log In</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Log In</li>
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
                        <img src="{{asset('assets/images/inner-page/sign-up.png')}}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Welcome To Admin Damraaz</h3>
                            <h4>Log in Your Admin Account</h4>
                        </div>

                        <div class="input-box">
                             @if ($errors->any())
                                 @foreach ($errors->all() as $error)
                                     <div>{{$error}}</div>
                                 @endforeach
                             @endif
                                <form class="row g-4" id="LogForm"  method="POST" action="{{route('adminLoginPost')}}" >
                                @csrf
                                    <div class="alert alert-danger hide" id="error-message"></div>
                                    <div class="alert alert-success hide" id="sent-message"></div>
                                   
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" required name="email"  class="form-control @error('email') is-invalid @enderror" id="email" >
                                      
                                        <label for="email">email</label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" required name="password" class="form-control" id="password"
                                            placeholder="Enter Your Password">
                                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        <label for="password">Password</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div id="recaptcha-container"></div>
                                    <button class="btn btn-animation w-100"  type="submit">Log In</button>
                                </div>
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
                                        Log In with Google
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/" class="btn google-button w-100">
                                        <img src="{{asset('assets/images/inner-page/facebook.png')}}" class="blur-up lazyload"
                                            alt=""> Log In with Facebook
                                    </a>
                                </li>
                            </ul>
                        </div> --}}

                        <div class="other-log-in">
                            <h6></h6>
                        </div>

                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="{{route('register')}}">Register</a>
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
            apiKey: "{{env('FIREBASE_API_KEY')}}",
            authDomain: "{{env('FIREBASE_AUTH_DOMAIN')}}",
            projectId: "{{env('FIREBASE_PROJECT_ID')}}",
            storageBucket:"{{env('FIREBASE_STORAGE_BUCKET')}}",
            messagingSenderId:"{{env('FIREBASE_MESSAGING_SENDER_ID')}}",
            appId: "{{env('FIREBASE_APP_ID')}}",
            measurementId: "{{env('FIREBASE_MEASUREMENT_ID')}}",
        };
        
        firebase.initializeApp(config);
    </script>
    <script type="text/javascript">  
        // reCAPTCHA widget    
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': (response) => {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                onSignInSubmit();
            }
        });
            
        function otpSend() {
            document.getElementById('otpVerify').classList.add("d-block");
            var phoneNumber = document.getElementById('phone').value;
            const appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;
                    // console.log(confirmationResult);
                    document.getElementById("sent-message").innerHTML = "Message sent succesfully.";
                    document.getElementById("sent-message").classList.add("d-block");
                }).catch((error) => {
                    // console.log(error);
                    document.getElementById("error-message").innerHTML = error.message;
                    document.getElementById("error-message").classList.add("d-block");
                });
        }

        function otpVerify() {
            var code = document.getElementById('otp-code').value;
            confirmationResult.confirm(code).then(function (result) {
                
                // User signed in successfully.
                var user = result.user;
                // console.log(user);
                document.getElementById("sent-message").innerHTML = "You are succesfully logged in.";
                document.getElementById("sent-message").classList.add("d-block");
                document.getElementById("LogForm").submit();
               
      
            }).catch(function (error) {
                //  console.log(error);
                document.getElementById("error-message").innerHTML = error.message;
                document.getElementById("error-message").classList.add("d-block");
                
            });
        }
    </script>
    
    <script>
        function eidt() {
            var readOnlyLength = $('#page_name_field_hidden').val().length;
            $('#phone').on('keypress, keydown', function (event) {
                if ((event.which != 37 && (event.which != 39)) &&
                    ((this.selectionStart < readOnlyLength) ||
                        ((this.selectionStart == readOnlyLength) && (event.which == 8)))) {
                    return false;
                }
            });
        }
    </script>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
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
