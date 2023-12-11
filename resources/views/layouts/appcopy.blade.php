<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Damraaz') }}</title>
    <link rel="icon" href="{{ asset('assets/images/favicon/1.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}" />

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css') }}">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick-theme.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bulk-style.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">




    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
</head>

<body class="theme-color-2 bg-effect">
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div id="app">
        @include('layouts.include.navbar')
        @yield('content')
        @include('layouts.include.footer')
        <!-- Cookie Bar Box Start -->
        <!--<div class="cookie-bar-box">-->
        <!--    <div class="cookie-box">-->
        <!--        <div class="cookie-image">-->
        <!--            <img src="../assets/images/cookie-bar.png" class="blur-up lazyload" alt="">-->
        <!--            <h2>Cookies!</h2>-->
        <!--        </div>-->

        <!--        <div class="cookie-contain">-->
        <!--            <h5 class="text-content">We use cookies to make your experience better</h5>-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="button-group">-->
        <!--        <button class="btn privacy-button">Privacy Policy</button>-->
        <!--        <button class="btn ok-button">OK</button>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- Cookie Bar Box End -->

        <div class="button-item">
            <button class="item-btn btn text-white">
                <i class="iconly-Bag-2 icli"></i>
            </button>
        </div>
        <div class="item-section">
            <button class="close-button">
                <i class="fas fa-times"></i>
            </button>
            <h6>
                <i class="iconly-Bag-2 icli"></i>
                <span>{{ count((array) session('cart')) }} Items</span>
            </h6>
            <ul class="items-image">
                @if (session('cart'))
                    @foreach (array_slice(session('cart'), 0, 3) as $id => $details)
                        @php $image=json_decode($details['images']);@endphp
                        <li>
                            <img src="{{ asset($image[0]) }}" alt="">
                        </li>
                    @endforeach
                @endif
                @if (count((array) session('cart')) > 3)
                    <li>+{{ count((array) session('cart')) - 3 }}</li>
                @endif
            </ul>
            <a href="{{ route('cart') }}" class="btn item-button btn-sm fw-bold">
                @if (session('cart'))
                    @php
                        $sum = 0;
                        $profit = 0;
                        $delivery_charges = 0;
                        
                    @endphp
                    @foreach (session('cart') as $id => $details)
                        @php
                            $sum += $details['discount_price'] * $details['quantity'];
                            $profit += $details['profit'] * $details['quantity'];
                            $delivery_charges += $details['delivery_charges'];
                        @endphp
                    @endforeach
                    Rs. {{ $delivery_charges + $profit + $sum }}
                @endif
            </a>
        </div>

        <div class="theme-option">
            <div class="back-to-top">
                <a id="back-to-top" href="#">
                    <i class="fas fa-chevron-up"></i>
                </a>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('assets/js/lazysizes.min.js') }}"></script>

    <!-- Slick js-->
    <script src="{{ asset('assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('assets/js/auto-height.js') }}"></script>

    <!-- Quantity Js -->
    <script src="{{ asset('assets/js/quantity.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('assets/js/timer1.js') }}"></script>
    <script src="{{ asset('assets/js/timer2.js') }}"></script>
    <script src="{{ asset('assets/js/timer3.js') }}"></script>
    <script src="{{ asset('assets/js/timer4.js') }}"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('assets/js/fly-cart.js') }}"></script>

    <!-- WOW js -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-wow.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @yield('scripts')

    <script>
        $(document).ready(function() {
            $('.product_item').click(function() {
                var link = $(this).data('href');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(link).select();
                document.execCommand("copy");
                $temp.remove();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#outsideButton').on('click', function() {

                // location.window="{{ route('home') }}";
                // $('#pills-order-tab').click();

                // Trigger the tab button click event

                // Show the tab content
                $('#pills-order-tab').tab('show');
                $('#pills-order').addClass('show active');
            });
        });
    </script>
</body>

</html>
