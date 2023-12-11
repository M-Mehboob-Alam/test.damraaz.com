@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Order Detail</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <button type="button" onclick=location.href="{{route('invoice.generate',['id' => $order->id])}}"
                class="btn theme-bg-color view-button icon text-white fw-bold btn-md ms-auto">Print Invoice</button>

            <div class="row g-sm-4 g-3" id="contentToPrint">
                <div class="col-xxl-9 col-12">
                    <div class="cart-table order-table order-table-2">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                        $delivery_charges = 0;
                                        $price = 0;
                                        $discount_price;
                                    @endphp
                                    @foreach ($order->ordersDetail as $detail)
                                        @php
                                            $subtotal += $detail['discount_price'] * $detail['quantity'];
                                            $price += $detail['price'] * $detail['quantity'];
                                            $delivery_charges += $detail['delivery_charges'];
                                        @endphp
                                        <tr>
                                            <td class="product-detail">
                                                <div class="product border-0">
                                                    <a href="{{ route('product.show', $detail->product_id) }}"
                                                        class="product-image">
                                                        @php $image=json_decode($detail->product->images);@endphp
                                                        <img src="{{ asset($image[0]) }}" class="img-fluid blur-up lazyload"
                                                            alt="">
                                                    </a>
                                                    <div class="product-detail">
                                                        <ul>
                                                            <li class="name">
                                                                <h4 class="table-title text-content">Name</h4>
                                                                <a
                                                                    href="{{ route('product.show', $detail->product_id) }}">{{ $detail->product->name }}</a>
                                                            </li>

                                                            <!--<li class="text-content">Sold By: Fresho</li>-->

                                                            <!--<li class="text-content">Quantity - 500 g</li>-->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="price">
                                                <h4 class="table-title text-content">Price</h4>
                                                <h6 class="theme-color">{{ $detail->discount_price }}</h6>
                                            </td>

                                            <td class="quantity">
                                                <h4 class="table-title text-content">Qty</h4>
                                                <h4 class="text-title">{{ $detail->quantity }}</h4>
                                            </td>

                                            <td class="subtotal">
                                                <h4 class="table-title text-content">Total</h4>
                                                <h5>{{ $detail->discount_price * $detail->quantity }}</h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-xxl-3 col-12">
                    <div class="row g-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="summery-box">
                                <div class="summery-header">
                                    <h3>Price Details</h3>
                                    <h5 class="ms-auto theme-color">({{ $order->total_items ?? '' }} Items)</h5>
                                </div>

                                <ul class="summery-contain">
                                    <li>
                                        <h4>Profit</h4>
                                        <h4 class="price">Rs. {{ $order->user_profit ?? '' }}</h4>
                                    </li>
                                    <li>
                                        <h4>Subtotal</h4>
                                        <h4 class="price">Rs. {{ $subtotal }}</h4>
                                    </li>

                                    <li>
                                        <h4>Shipping</h4>
                                        <h4 class="price ">Rs. {{ $delivery_charges }}</h4>
                                    </li>

                                    <li>
                                        <h4>Discount</h4>
                                        <h4 class="price  theme-color">Rs. {{ $price - $subtotal }}</h4>
                                    </li>
                                </ul>

                                <ul class="summery-total">
                                    <li class="list-total">
                                        <h4>Total (PKR)</h4>
                                        <h4 class="price">RS. {{ $order->total_amount }}</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-6">
                            <div class="summery-box">
                                <div class="summery-header d-block">
                                    <h3>Shipping Address</h3>
                                </div>

                                <ul class="summery-contain pb-0 border-bottom-0">
                                    <li class="d-block">
                                        <h4>{{ $order->house }}, {{ $order->street }},</h4>
                                        <h4 class="mt-2">{{ $order->city }}, {{ $order->province }}</h4>
                                    </li>

                                    <!--<li class="pb-0">-->
                                    <!--    <h4>Expected Date Of Delivery:</h4>-->
                                    <!--    <h4 class="price theme-color">-->
                                    <!--<a href="order-tracking.html" class="text-danger">Track Order</a>-->
                                    <!--    </h4>-->
                                    <!--</li>-->
                                </ul>

                                <!--<ul class="summery-total">-->
                                <!--    <li class="list-total border-top-0 pt-2">-->
                                <!--        <h4 class="fw-bold">Oct 21, 2021</h4>-->
                                <!--    </li>-->
                                <!--</ul>-->
                            </div>
                        </div>
                        @if ($order->sataus == 'return')
                            <div class="col-lg-12 col-sm-6">
                                <div class="summery-box">
                                    <div class="summery-header d-block">
                                        <h3>Return Detail</h3>
                                    </div>

                                    <ul class="summery-contain pb-0 border-bottom-0">
                                        <li class="d-block">
                                            <h4>{{ $order->returnDetail->name }}</h4>
                                        </li>
                                        <li class="pb-0">
                                            <h4>{{ $order->returnDetail->whatsapp }}</h4>
                                        </li>
                                        <li class="pb-0">
                                            <h4>{{ $order->returnDetail->reason }}</h4>
                                        </li>
                                        <li class="pb-0">
                                            <h4>{{ $order->returnDetail->message }}</h4>
                                        </li>
                                        @php
                                            $images = json_decode($order->returnDetail->images);
                                        @endphp
                                        @forelse ($images as $img)
                                            <li class="pb-0"><img class="img-thumbanil" src="{{ asset($img) }}"></li>
                                        @empty
                                            <li></li>
                                        @endforelse
                                    </ul>

                                    <!--<ul class="summery-total">-->
                                    <!--    <li class="list-total border-top-0 pt-2">-->
                                    <!--        <h4 class="fw-bold">Oct 21, 2021</h4>-->
                                    <!--    </li>-->
                                    <!--</ul>-->
                                </div>
                            </div>
                        @endif

                        <!--<div class="col-12">-->
                        <!--    <div class="summery-box">-->
                        <!--        <div class="summery-header d-block">-->
                        <!--            <h3>Payment Method</h3>-->
                        <!--        </div>-->

                        <!--        <ul class="summery-contain pb-0 border-bottom-0">-->
                        <!--            <li class="d-block pt-0">-->
                        <!--                <p class="text-content">Pay on Delivery (Cash/Card). Cash on delivery (COD)-->
                        <!--                    available. Card/Net banking acceptance subject to device availability.</p>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Cart Section End -->


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

                    var pdf = new jsPDF('p', 'pt', 'letter');

                    var pageHeight = 980;
                    var pageWidth = 900;
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
                    pdf.save("{{ $order->orderId }}");
                }
            });
        }
    </script>
@endsection
