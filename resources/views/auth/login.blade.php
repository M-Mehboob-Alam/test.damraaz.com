<!DOCTYPE html>
<!-- Html start -->
<html lang="en">
  <!-- Head Start -->
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
    <title>Login - {{env('APP_NAME')}}</title>

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

    <!-- Main Start -->
    <div class="main">
      <section class="page-body p-0">
        <div class="row g-0 ratio_asos">
          <div class="order-2 order-lg-1 col-lg-5">
            <div class="content-box">
              <div>
                <h5>LOGIN <span class="bg-theme-blue"></span></h5>
                <p class="font-md content-color">How do i get access order,wishlist and recomendation ?</p>
                                @if ($errors->any())
                                 @foreach ($errors->all() as $error)
                                    <div class="text-danger">{{$error}}</div>
                                 @endforeach
                                @endif
                <form action="{{route('login')}}" class="custom-form form-pill" method="POST">
                    @csrf
                  <div class="input-box">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" required name="email" id="email" />
                  </div>

                  <div class="input-box">
                    <label for="password">Password</label>
                    <div class="icon-input">
                      <input class="form-control" type="password" required name="password" id="password" />
                      <img class="showHidePassword" src="{{asset('newtheme/assets/icons/svg/eye-1.svg')}}" alt="eye" />
                    </div>
                  </div>

                  <a href="{{route('password.request')}}" >Forgot Password?</a>

                  <button type="submit" class="btn-solid rounded-pill line-none">Signin <i class="arrow"></i></button>
                  <a href="{{url('/')}}" class="btn-solid rounded-pill line-none btn-outline mt-3 d-flex justify-content-center">Home <i class="arrow"></i></a>
                </form>

                <span class="backto-link font-default content-color text-decoration-none">If you are new, <a class="text-decoration-underline theme-color" href="{{route('register')}}"> Create Now </a> </span>

              </div>
            </div>
          </div>

          <div class="order-1 order-lg-2 col-lg-7">
            <div class="img-box">
              {{-- <img class="bg-img" src="{{asset('newtheme/assets/images/inner-page/banner.jpg')}}" alt="banner" /> --}}
              <img class="bg-img" src="https://images.pexels.com/photos/6214477/pexels-photo-6214477.jpeg?auto=compress&cs=tinysrgb&w=600" alt="banner" />
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- Main End -->

 <!-- Bootstrap Js -->
 <script src="{{asset('newtheme/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

 <!-- Feather Icon -->
 <script src="{{asset('newtheme/assets/js/feather/feather.min.js')}}"></script>

    <!-- Password Show-Hide js -->
    <script src="{{asset('newtheme/assets/js/password-showhide.js')}}"></script>

  <!-- Script Js -->
  <script src="{{asset('newtheme/assets/js/script.js')}}"></script>
  </body>
  <!-- Body End -->
</html>
<!-- Html End -->
