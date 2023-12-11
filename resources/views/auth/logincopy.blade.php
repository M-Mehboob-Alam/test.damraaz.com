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
                            <h3>Welcome To Damraaz</h3>
                            <h4>Log in you Account</h4>
                            
                        </div>

                        <div class="input-box">
                             <!--@if ($errors->any())-->
                             <!--    @foreach ($errors->all() as $error)-->
                             <!--        <div>{{$error}}</div>-->
                             <!--    @endforeach-->
                             <!--@endif-->
                                <form class="row g-4" id="LogForm"  method="POST" action="{{ route('login') }}" >
                                @csrf
                                    <div class="alert alert-danger hide" id="error-message"></div>
                                    <div class="alert alert-success hide" id="sent-message"></div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" required name="email"  name="email" class="form-control @error('email') is-invalid @enderror" id="email" >

                                        <label for="email">Email</label>
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
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox"
                                                id="flexCheckDefault">
                                            <label class="form-check-label" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} for="flexCheckDefault">Remember me</label>
                                        </div>
                                        <a href="{{route('password.request')}}" class="forgot-password">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="col-12">
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

                        <!--<div class="other-log-in">-->
                        <!--    <h6></h6>-->
                        <!--</div>-->

                        <div class="sign-up-box">
                            <h4>Don't have an account?</h4>
                            <a href="{{route('register')}}">Register</a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
            </div>
        </div>
    </section>

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
