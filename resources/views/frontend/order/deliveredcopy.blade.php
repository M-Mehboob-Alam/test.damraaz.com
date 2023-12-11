@extends('layouts.app')
@section('title')
Delivered Orders
@endsection
@section('content')
    <style>
        .StepProgress {
            position: relative !important;
            padding-left: 45px !important;
            list-style: none !important;
        }

        .StepProgress::before {
            display: inline-block !important;
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: 13px !important;
            width: 10px !important;
            height: 46% !important;
            border-left: 2px solid #CCC !important;
        }

        .StepProgress-item {
            position: relative !important;
            counter-increment: list !important;
        }

        .StepProgress-item:not(:last-child) {
            padding-bottom: 20px !important;
        }

        .StepProgress-item::before {
            display: inline-block !important;
            content: '' !important;
            position: absolute !important;
            left: -30px !important;
            height: 45% !important;
            width: 10px !important;
        }

        .StepProgress-item::after {
            content: '' !important;
            display: inline-block !important;
            position: absolute !important;
            top: 0 !important;
            left: -37px !important;
            width: 12px !important;
            height: 12px !important;
            border: 2px solid #CCC !important;
            border-radius: 50% !important;
            background-color: #FFF !important;
        }

        /* .StepProgress-item.is-done::before {
                                                        border-left: 2px solid green !important;
                                                    } */

        .StepProgress-item.is-done::after {
            content: '' !important;
            font-size: 10px !important;
            color: #FFF !important;
            text-align: center !important;
            /* border: 2px solid green !important; */
            background-color: #000 !important;
        }

        .StepProgress strong {
            display: block !important;
        }
    </style>
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: var(--theme-color);
        }
    </style>
    <style>
        .rating {
            direction: rtl;
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            float: right;
            cursor: pointer;
            color: #ccc;
        }

        .rating label:before {
            content: '\2605';
            font-size: 5em;
        }

        .rating input:checked~label {
            color: #ffca08;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: #ffca08;
        }

        .rating2 {
            direction: rtl;
            display: inline-block;
        }

        .rating2 input {
            display: none;
        }

        .rating2 label {
            float: right;
            cursor: pointer;
            color: #ccc;
        }

        .rating2 label:before {
            content: '\2605';
            font-size: 5em;
        }

        .rating2 input:checked~label {
            color: #ffca08;
        }

        .rating2 label:hover,
        .rating2 label:hover~label {
            color: #ffca08;
        }
    </style>

    <div class="container">
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                    <a href="{{ route('order.inProgress') }}"
                        class="nav-link  border rounded pill {{ Request::routeIs('order.inProgress') ? 'active' : '' }}">In-Progress</a>

                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('order.delivered') }}"
                            class="nav-link  border rounded pill {{ Request::routeIs('order.delivered') ? 'active' : '' }}">Delivered</a>

                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('order.returned') }}"
                            class="nav-link  border rounded pill {{ Request::routeIs('order.returned') ? 'active' : '' }}">Returned</a>
                    </li>
                </ul>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="col-12 alert-dismissible fade show" role="alert">{{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="order-tab dashboard-bg-box">
                    <div class="row">

                        @foreach ($duplicators as $inProgress)
                            {{-- @foreach ($inProgress as $d) --}}
                            {{-- {{dd(gettype($d[1]))}} --}}
                            {{-- @endforeach --}}
                            {{-- {{dd(gettype($inProgress))}} --}}
                            <div class="col-md-6 my-2">
                                <div class="card">

                                    <div class="card-header theme-bg-color text-white">
                                        <div class="py-0 my-0 d-flex justify-content-between">
                                            <span>
                                                <h5>Order# {{ $inProgress['orderId'] }}</h5>Order Date
                                                {{ $inProgress['created_at']->format('d M, Y') }}
                                            </span>
                                            <a href="#" class="btn btn-info text-white"><u>Track History</u></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title pb-1 border-bottom d-flex justify-content-between ">
                                            <b>Total Amount</b> <b>{{ $inProgress['amount'] }}
                                            </b>
                                        </div>
                                        <div class="StepProgress border-bottom my-2">
                                            <div class="StepProgress-item "><strong>Supplier</strong>
                                                {{ $inProgress['products'][0]['supplier'] }}
                                            </div>
                                            <div class="StepProgress-item is-done">
                                                <strong>Customer</strong>
                                                <p class="card-text">
                                                    {{ $inProgress['name'] }}<br>{{ $inProgress['phone'] }}<br>{{ $inProgress['house'] }}&nbsp;
                                                    {{ $inProgress['street'] }}&nbsp; {{ $inProgress['city'] }} &nbsp;
                                                    {{ $inProgress['nearest'] }}
                                                </p>
                                            </div>
                                        </div>

                                        @foreach ($inProgress['products'] as $product)
                                            <div class="row">
                                                <div class="col-md-3 col-5">
                                                    @php
                                                        $image = json_decode($product['images']);
                                                    @endphp
                                                    <img src="{{ asset($image[0]) }}" height="100px" width="100px"
                                                        alt="">
                                                </div>
                                                <div class=" col-md-9 col-7">
                                                    @php
                                                        $daysPlus5 = $inProgress['updated_at']->addDays(5);
                                                        $now = Carbon\Carbon::now();
                                                    @endphp
                                                    @if ($daysPlus5 > $now)
                                                        <a href="javascript:void(0)" class="text-danger"
                                                            data-bs-toggle="modal" title="Return Order back"
                                                            data-bs-target="#return{{ $inProgress['order_id'] }}">Return/Refund</a>
                                                        <!-- order return modal -->
                                                        <div class="modal fade theme-modal view-modal "
                                                            id="return{{ $inProgress['order_id'] }}" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div
                                                                class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Return Order
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div>
                                                                            <form method="post" class="row g-sm-4 g-2"
                                                                                enctype="multipart/form-data"
                                                                                action="{{ route('user.order.return', $inProgress['order_id']) }}">
                                                                                @csrf
                                                                                <div class="col-md-6 my-1">
                                                                                    <label for="name">Name</label>
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        name="name" id="name">
                                                                                </div>
                                                                                <div class="col-md-6 my-1">
                                                                                    <label for="whatsapp">WhatsApp
                                                                                        #</label>
                                                                                    <input type="tel"
                                                                                        class="form-control" required
                                                                                        name="whatsapp" id="whatsapp">
                                                                                </div>
                                                                                <div class="col-md-6 my-1">
                                                                                    <label for="reason">Reason</label>
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        name="reason" id="reason">
                                                                                </div>
                                                                                <div class="col-md-6 my-1">
                                                                                    <label for="images">Images</label>
                                                                                    <input type="file" multiple
                                                                                        class="form-control" required
                                                                                        name="images[]" id="images">
                                                                                </div>
                                                                                <div class="col-md-12 ">
                                                                                    <button
                                                                                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md ms-auto">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/order return -->
                                                    @endif
                                                    <p> <span class="text-muted">item ID:
                                                            {{ $product['product_id'] }}</span>
                                                        <br>
                                                        <span>{{ $product['product_name'] }}</span>
                                                        <br>
                                                        <span class="text-success">Profit: {{ $product['profit'] }}</span>
                                                    </p>
                                                    <div class="d-flex ">
                                                        <a class="px-1" href="javascript:void(0)"
                                                            data-bs-toggle="modal" title="Rating Modal"
                                                            data-bs-target="#rating{{ $inProgress['order_id'] }}">Rating</a>
                                                        <a class="px-1" href="javascript:void(0)"
                                                            data-bs-toggle="modal" title="Rating Modal"
                                                            data-bs-target="#feedback{{ $inProgress['order_id'] }}">Feedback</a>
                                                    </div>
                                                    <!-- order Rating -->
                                                    <div class="modal fade theme-modal view-modal "
                                                        id="rating{{ $inProgress['order_id'] }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div
                                                            class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Ratings</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row g-sm-4 g-2">
                                                                        <form method="post" enctype="multipart/form-data"
                                                                            action="{{ route('user.rating.store', $inProgress['order_id']) }}">
                                                                            @csrf
                                                                            <div class="col-md-6">
                                                                                <h6>Rating for Price</h6>
                                                                                <div class="rating">
                                                                                    <input type="radio"
                                                                                        id="star5{{ $inProgress['order_id'] }}"
                                                                                        name="price_rating"
                                                                                        value="5" />
                                                                                    <label
                                                                                        for="star5{{ $inProgress['order_id'] }}"></label>
                                                                                    <input type="radio"
                                                                                        id="star4{{ $inProgress['order_id'] }}"
                                                                                        name="price_rating"
                                                                                        value="4" />
                                                                                    <label
                                                                                        for="star4{{ $inProgress['order_id'] }}"></label>
                                                                                    <input type="radio"
                                                                                        id="star3{{ $inProgress['order_id'] }}"
                                                                                        name="price_rating"
                                                                                        value="3" />
                                                                                    <label
                                                                                        for="star3{{ $inProgress['order_id'] }}"></label>
                                                                                    <input type="radio"
                                                                                        id="star2{{ $inProgress['order_id'] }}"
                                                                                        name="price_rating"
                                                                                        value="2" />
                                                                                    <label
                                                                                        for="star2{{ $inProgress['order_id'] }}"></label>
                                                                                    <input type="radio"
                                                                                        id="star1{{ $inProgress['order_id'] }}"
                                                                                        required name="price_rating"
                                                                                        value="1" />
                                                                                    <label
                                                                                        for="star1{{ $inProgress['order_id'] }}"></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h6>Rating for Quality</h6>
                                                                                <div class="rating2">
                                                                                    <input type="radio"
                                                                                        id="qulaity5{{ $inProgress['order_id'] }}"
                                                                                        name="quality_rating"
                                                                                        value="5" />
                                                                                    <label
                                                                                        for="qulaity5{{ $inProgress['order_id'] }}"></label>
                                                                                    <input type="radio"
                                                                                        id="qulaity4{{ $inProgress['order_id'] }}"
                                                                                        name="quality_rating"
                                                                                        value="4" />
                                                                                    <label
                                                                                        for="qulaity4{{ $inProgress['order_id'] }}"></label>
                                                                                    <input type="radio"
                                                                                        id="qulaity3{{ $inProgress['order_id'] }}"
                                                                                        name="quality_rating"
                                                                                        value="3" />
                                                                                    <label
                                                                                        for="qulaity3{{ $inProgress['order_id'] }}"></label>
                                                                                    <input type="radio"
                                                                                        id="qulaity2{{ $inProgress['order_id'] }}"
                                                                                        name="quality_rating"
                                                                                        value="2" />
                                                                                    <label
                                                                                        for="qulaity2{{ $inProgress['order_id'] }}"></label>
                                                                                    <input type="radio"
                                                                                        id="qulaity1{{ $inProgress['order_id'] }}"
                                                                                        required name="quality_rating"
                                                                                        disabled value="1" />
                                                                                    <label
                                                                                        for="qulaity1{{ $inProgress['order_id'] }}"></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 ">
                                                                                <button
                                                                                    class="btn theme-bg-color view-button icon text-white fw-bold btn-md ms-auto">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- order rating..end --}}
                                                    {{-- order feedback ...start --}}
                                                    <div class="modal fade theme-modal view-modal "
                                                        id="feedback{{ $inProgress['order_id'] }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div
                                                            class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Feedback</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row g-sm-4 g-2">
                                                                        <form method="post" enctype="multipart/form-data"
                                                                            action="{{ route('user.rating.store', $inProgress['order_id']) }}">
                                                                            @csrf

                                                                            <div class="col-md-12">
                                                                                <label for="review"
                                                                                    class="form-label">Review
                                                                                </label>
                                                                                <textarea class="form-control" name="review" id="review" cols="3" rows="3"
                                                                                    placeholder="Enter Your message here"></textarea>
                                                                            </div>
                                                                            <div class="col-md-12 ">
                                                                                <button
                                                                                    class="btn theme-bg-color view-button icon text-white fw-bold btn-md ms-auto">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/order Rating end-->
                                                    <div class="col-md-4 col-8 text-center">

                                                        <div class="bg-primary rounded-pill text-white">
                                                            {{ $inProgress['status'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script>
        function printToPDF() {
            console.log('converting...');

            var printableArea = document.getElementById('contentToPrint');

            html2canvas(printableArea, {
                useCORS: true,
                onrendered: function(canvas) {

                    var pdf = new jsPDF('l', 'pt', 'letter');

                    var pageHeight = 900;
                    var pageWidth = 1500;
                    for (var i = 0; i <= printableArea.clientHeight / pageHeight; i++) {
                        var srcImg = canvas;
                        var sX = 0;
                        var sY = pageHeight * i; // start 1 pageHeight down for every new page
                        var sWidth = pageWidth;
                        var sHeight = pageHeight;
                        var dX = 0;
                        var dY = 0;
                        var dWidth = pageWidth;
                        var dHeight = pageHeight;

                        window.onePageCanvas = document.createElement("canvas");
                        onePageCanvas.setAttribute('width', pageWidth);
                        onePageCanvas.setAttribute('height', pageHeight);
                        var ctx = onePageCanvas.getContext('2d');
                        ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

                        var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
                        var width = onePageCanvas.width;
                        var height = onePageCanvas.clientHeight;

                        if (i > 0) // if we're on anything other than the first page, add another page
                            pdf.addPage(612, 791); // 8.5" x 11" in pts (inches*72)

                        pdf.setPage(i + 1); // now we declare that we're working on that page
                        pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .62), (height *
                            .62)); // add content to the page

                    }
                    pdf.save("sale-report-{{ time() }}");
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var hash = window.location.hash;
            if (hash) {
                // Show the tab content
                $('#pills-order-tab').tab('show');
                $('#pills-order').addClass('show active');
                $(hash).tab('show');
                $(hash).addClass('show active');
            }

            $('.bank_name').hide();
            $("#payment_type").change(function() {
                var payment = $(this).val();
                if (payment == 'bank') {
                    $('.bank_name').show();
                } else {
                    $('.bank_name').hide();
                }
            });


            // countdown

            // Select all elements with class "countdown"
            var countdownElements = $(".countdown");

            // Update each countdown element
            countdownElements.each(function() {
                var countdownElement = $(this);
                var countDownDate = new Date(countdownElement.data("date")).getTime();

                // Update the countdown every 1 second
                var countdown = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the countdown in the current countdown element
                    countdownElement.html(days + "d " + hours + "h " + minutes + "m " + seconds +
                        "s");

                    if (distance < 0) {
                        clearInterval(countdown);
                        countdownElement.html("Countdown finished");
                    }
                }, 1000);
            });
            // countdown
        });
    </script>
@endsection
