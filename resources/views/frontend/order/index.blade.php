@extends('layouts.app')
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
            height: 50% !important;
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
            height: 50% !important;
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
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Orders Record</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Orders Record</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row">

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
                <div class="col-md-6 my-1">
                    <form action="" method="get">
                        <select name="days" id="" class="form-control" onchange="form.submit()">
                            <option value="" @selected(request()->days == null)>All</option>
                            <option value="7" @selected(request()->days == '7')> 7 Days</option>
                            <option value="30" @selected(request()->days == '30')> 30 Days</option>
                        </select>
                    </form>
                </div>
                {{-- <div class="col-md-6 my-1"><button onclick="printToPDF()" type="button"
                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md ">
                        <i data-feather="save" class="edit"></i> Sale Report</button>
                </div> --}}
                {{-- <div class="table-responsive" id="contentToPrint">
                    <table class="table order-table">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Profit</th>
                                <th scope="col">Order date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="product-image">{{ $order->orderId }}</td>
            <td>{{ $order->total_amount }}</td>
            <td>
                <!--<label class="success">Shipped</label>-->
                {{ $order->status }}
            </td>
            <td>
                <h6>{{ $order->user_profit }}</h6>
            </td>
            <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
            <td class="d-flex">

                <a class="px-1" href="{{ route('user.order.detail', $order->id) }}"><i data-feather="eye" class="edit"></i></a>
                @if ($order->status == 'delivered')
                <a class="px-1" href="javascript:void(0)" data-bs-toggle="modal" title="Rating Modal" data-bs-target="#rating{{ $order->id }}">Rating</a>
                @endif
                @php
                $daysPlus5 = $order->updated_at->addDays(5);
                $now = Carbon\Carbon::now();
                @endphp
                @if ($order->status == 'delivered' && $daysPlus5 > $now)
                <a href="javascript:void(0)" data-bs-toggle="modal" title="Return Order back" data-bs-target="#return{{ $order->id }}"><i data-feather="x-square" class="edit"></i></a>
                @endif


            </td>
            </tr>

            @if ($order->status == 'delivered' && $daysPlus5 > $now)
            <!-- order return -->
            <div class="modal fade theme-modal view-modal " id="return{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Return Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-sm-4 g-2">
                                <form method="post" enctype="multipart/form-data" action="{{ route('user.order.return', $order->id) }}">
                                    @csrf
                                    <div class="col-md-6 my-1">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" required name="name" id="name">
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <label for="whatsapp">WhatsApp #</label>
                                        <input type="tel" class="form-control" required name="whatsapp" id="whatsapp">
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <label for="reason">Reason</label>
                                        <input type="text" class="form-control" required name="reason" id="reason">
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <label for="images">Images</label>
                                        <input type="file" multiple accept="images/*" class="form-control" required name="images[]" id="images">
                                    </div>
                                    <div class="col-md-12 ">
                                        <button class="btn theme-bg-color view-button icon text-white fw-bold btn-md ms-auto">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/order return -->
            @endif
            @if ($order->status == 'delivered')
            <!-- order Rating -->
            <div class="modal fade theme-modal view-modal " id="rating{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ratings</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-sm-4 g-2">
                                <form method="post" enctype="multipart/form-data" action="{{ route('user.rating.store', $order->id) }}">
                                    @csrf
                                    <div class="col-md-6">
                                        <h6>Rating for Price</h6>
                                        <div class="rating">
                                            <input type="radio" id="star5{{ $order->id }}" name="price_rating" value="5" />
                                            <label for="star5{{ $order->id }}"></label>
                                            <input type="radio" id="star4{{ $order->id }}" name="price_rating" value="4" />
                                            <label for="star4{{ $order->id }}"></label>
                                            <input type="radio" id="star3{{ $order->id }}" name="price_rating" value="3" />
                                            <label for="star3{{ $order->id }}"></label>
                                            <input type="radio" id="star2{{ $order->id }}" name="price_rating" value="2" />
                                            <label for="star2{{ $order->id }}"></label>
                                            <input type="radio" id="star1{{ $order->id }}" required name="price_rating" value="1" />
                                            <label for="star1{{ $order->id }}"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Rating for Quality</h6>
                                        <div class="rating2">
                                            <input type="radio" id="qulaity5{{ $order->id }}" name="quality_rating" value="5" />
                                            <label for="qulaity5{{ $order->id }}"></label>
                                            <input type="radio" id="qulaity4{{ $order->id }}" name="quality_rating" value="4" />
                                            <label for="qulaity4{{ $order->id }}"></label>
                                            <input type="radio" id="qulaity3{{ $order->id }}" name="quality_rating" value="3" />
                                            <label for="qulaity3{{ $order->id }}"></label>
                                            <input type="radio" id="qulaity2{{ $order->id }}" name="quality_rating" value="2" />
                                            <label for="qulaity2{{ $order->id }}"></label>
                                            <input type="radio" id="qulaity1{{ $order->id }}" required name="quality_rating" disabled value="1" />
                                            <label for="qulaity1{{ $order->id }}"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <button class="btn theme-bg-color view-button icon text-white fw-bold btn-md ms-auto">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/order Rating -->
            @endif
            @empty
            <tr>
                <td>No Orders Found</td>
            </tr>
            @endforelse
            </tbody>
            </table>
        </div>
        <nav class="custome-pagination">
            <ul class="pagination justify-content-center">

                <li class="page-item">
                    {!! $orders->links() !!}
                </li>
        </nav> --}}


                <div class="order-tab dashboard-bg-box">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-in-progress-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-in-progress" role="tab" aria-controls="pills-in-progress"
                                aria-selected="true">In-Progress <span
                                    class="badge  bg-info ">{{ $inProgressOrders->count() }}</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-delivered-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-delivered" role="tab" aria-controls="pills-delivered"
                                aria-selected="false">Delivered <span
                                    class="badge  bg-info ">{{ $deliveredOrders->count() }}</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-returned-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-returned" type="button" role="tab"
                                aria-controls="pills-returned" aria-selected="false">Returned <span
                                    class="badge  bg-info ">{{ $returnedOrders->count() }}</span></button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-in-progress" role="tabpanel"
                            aria-labelledby="pills-in-progress-tab" tabindex="0">
                            <div class="row">
                                @forelse($inProgressOrders as $inProgress)
                                    @if ($inProgress->total_items == 1)
                                        @forelse($inProgress->ordersDetail as $inprogressDetail)
                                            <div class="col-md-6 my-2">
                                                <div class="card">
                                                    <div class="card-header theme-bg-color text-white">
                                                        <div class="py-0 my-0 h5">Order# {{ $inProgress->orderId }}</div>
                                                        Order Date {{ $inProgress->created_at->format('d M, Y') }}
                                                    </div>
                                                    <div class="card-body">
                                                        <div
                                                            class="card-title pb-1 border-bottom d-flex justify-content-between ">
                                                            <b>Total Amount</b> <b>RS. 757
                                                            </b>
                                                        </div>
                                                        <div class="StepProgress border-bottom my-2">
                                                            <div class="StepProgress-item "><strong>Supplier</strong>
                                                                @if ($inprogressDetail->product->user_id)
                                                                    {{ $inprogressDetail->product->user->business ?? '' }}
                                                                @else
                                                                    {{ env('APP_NAME') }}
                                                                @endif
                                                            </div>
                                                            <div class="StepProgress-item is-done">
                                                                <strong>Customer</strong>
                                                                <p class="card-text">Name<br>123456789<br>address </p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-3">
                                                                <img src="per.jpg" height="100px" width="100px"
                                                                    alt="">
                                                            </div>
                                                            <div class=" col-9">
                                                                <a href="#" class="text-danger"> Cancel Item ></a>
                                                                <p> <span class="text-muted">item ID: 23456</span>
                                                                    <br>
                                                                    <span>product name</span>
                                                                    <br>
                                                                    <span class="text-success">Profit: 50</span>
                                                                </p>
                                                                <div class="col-4 text-center">

                                                                    <div class="bg-primary rounded-pill text-white">Out of
                                                                        stock</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif($inProgress->total_items > 1)
                                        <div class="col-md-6 my-2">
                                            <div class="card">
                                                <div class="card-header theme-bg-color text-white">
                                                    <div class="py-0 my-0 h5">Order# {{ $inProgress->orderId }}</div>
                                                    Order Date {{ $inProgress->created_at->format('d M, Y') }}
                                                </div>
                                                <div class="card-body">
                                                    <div
                                                        class="card-title pb-1 border-bottom d-flex justify-content-between ">
                                                        <b>Total Amount</b> <b>RS. 757
                                                        </b>
                                                    </div>

                                                    <div class="StepProgress border-bottom my-2">
                                                        <div class="StepProgress-item "><strong>Supplier</strong>
                                                            @if ($inprogressDetail->product->user_id)
                                                                {{ $inprogressDetail->product->user->business ?? '' }}
                                                            @else
                                                                {{ env('APP_NAME') }}
                                                            @endif
                                                        </div>
                                                        <div class="StepProgress-item is-done">
                                                            <strong>Customer</strong>
                                                            <p class="card-text">Name<br>123456789<br>address </p>
                                                        </div>
                                                    </div>
                                                    @foreach ($inProgress->ordersDetail as $inprogressDetail)
                                                        <div class="row my-1 py-1 border-bottom">
                                                            <div class="col-3">
                                                                <img src="per.jpg" height="100px" width="100px"
                                                                    alt="">
                                                            </div>
                                                            <div class="col-9">
                                                                <a href="#" class="text-danger"> Cancel Item ></a>
                                                                <p> <span class="text-muted">item ID:
                                                                        {{ $inprogressDetail->product_id }}</span>
                                                                    <br>
                                                                    <span>product name</span>
                                                                    <br>
                                                                    <span class="text-success">Profit: 50</span>
                                                                </p>
                                                                <div class="col-4 text-center">

                                                                    <div class="bg-primary rounded-pill text-white">Out of
                                                                        stock</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                            <div class="table-responsive" id="contentToPrint">
                                <table class="table order-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Total Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Profit</th>
                                            <th scope="col">Order date</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($inProgressOrders as $inProgress)
                                            <tr>
                                                <td class="product-image">{{ $inProgress->orderId }}</td>
                                                <td>{{ $inProgress->total_amount }}</td>
                                                <td>{{ $inProgress->status }}</td>
                                                <td>
                                                    <h6>{{ $inProgress->user_profit }}</h6>
                                                </td>
                                                <td>{{ $inProgress->created_at->format('d-m-Y H:i:s') }}</td>
                                                <td><a href="{{ route('invoice.generate', ['id' => $inProgress->id]) }}">Print
                                                        Invoice</a></td>

                                                <td class="d-flex">
                                                    <a class="px-1"
                                                        href="{{ route('user.order.detail', $inProgress->id) }}"><i
                                                            data-feather="eye" class="edit"></i></a>
                                                    <a href="#" title="Track Your Order">Track</a>
                                                </td>
                                            </tr>


                                        @empty
                                            <tr>
                                                <td>No Orders Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-delivered" role="tabpanel"
                            aria-labelledby="pills-delivered-tab" tabindex="0">
                            <div class="table-responsive" id="contentToPrint">
                                <table class="table order-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Total Amount</th>
                                            <th scope="col">Return Date</th>
                                            <th scope="col">Profit</th>
                                            <th scope="col">Order date</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($deliveredOrders as $delivered)
                                            <tr>
                                                <td class="product-image"> {{ $delivered->orderId }}</td>
                                                <td>{{ $delivered->total_amount }}</td>
                                                @php
                                                    $returnDate = $delivered->updated_at->addDays(5);
                                                @endphp
                                                <td class="countdown success" data-date="{{ $returnDate }}"> </td>
                                                <td>
                                                    <h6>{{ $delivered->user_profit }}</h6>
                                                </td>
                                                <td>{{ $delivered->created_at->format('d-m-Y H:i:s') }} </td>
                                                <td><a href="{{ route('invoice.generate', ['id' => $delivered->id]) }}">Print
                                                        Invoice</a></td>

                                                <td class="d-flex">
                                                    <a class="px-1"
                                                        href="{{ route('user.order.detail', $delivered->id) }}"><i
                                                            data-feather="eye" class="edit"></i></a>
                                                    <a href="#" title="Track Your Order">Track</a>


                                                    <a class="px-1" href="javascript:void(0)" data-bs-toggle="modal"
                                                        title="Rating Modal"
                                                        data-bs-target="#rating{{ $delivered->id }}">Rating</a>
                                                    <a class="px-1" href="javascript:void(0)" data-bs-toggle="modal"
                                                        title="Rating Modal"
                                                        data-bs-target="#feedback{{ $delivered->id }}">Feedback</a>
                                                    @php
                                                        $daysPlus5 = $delivered->updated_at->addDays(5);
                                                        $now = Carbon\Carbon::now();
                                                    @endphp
                                                    @if ($daysPlus5 > $now)
                                                        <a href="javascript:void(0)" class="text-danger"
                                                            data-bs-toggle="modal" title="Return Order back"
                                                            data-bs-target="#return{{ $delivered->id }}">Return/Refund</a>
                                                    @endif
                                                </td>
                                            </tr>

                                            @if ($daysPlus5 > $now)
                                                <!-- order return -->
                                                <div class="modal fade theme-modal view-modal "
                                                    id="return{{ $delivered->id }}" tabindex="-1"
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
                                                                <div class="row g-sm-4 g-2">
                                                                    <form method="post" enctype="multipart/form-data"
                                                                        action="{{ route('user.order.return', $delivered->id) }}">
                                                                        @csrf
                                                                        <div class="col-md-6 my-1">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                required name="name" id="name">
                                                                        </div>
                                                                        <div class="col-md-6 my-1">
                                                                            <label for="whatsapp">WhatsApp
                                                                                #</label>
                                                                            <input type="tel" class="form-control"
                                                                                required name="whatsapp" id="whatsapp">
                                                                        </div>
                                                                        <div class="col-md-6 my-1">
                                                                            <label for="reason">Reason</label>
                                                                            <input type="text" class="form-control"
                                                                                required name="reason" id="reason">
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
                                            <!-- order Rating -->
                                            <div class="modal fade theme-modal view-modal "
                                                id="rating{{ $delivered->id }}" tabindex="-1"
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
                                                                    action="{{ route('user.rating.store', $delivered->id) }}">
                                                                    @csrf
                                                                    <div class="col-md-6">
                                                                        <h6>Rating for Price</h6>
                                                                        <div class="rating">
                                                                            <input type="radio"
                                                                                id="star5{{ $delivered->id }}"
                                                                                name="price_rating" value="5" />
                                                                            <label
                                                                                for="star5{{ $delivered->id }}"></label>
                                                                            <input type="radio"
                                                                                id="star4{{ $delivered->id }}"
                                                                                name="price_rating" value="4" />
                                                                            <label
                                                                                for="star4{{ $delivered->id }}"></label>
                                                                            <input type="radio"
                                                                                id="star3{{ $delivered->id }}"
                                                                                name="price_rating" value="3" />
                                                                            <label
                                                                                for="star3{{ $delivered->id }}"></label>
                                                                            <input type="radio"
                                                                                id="star2{{ $delivered->id }}"
                                                                                name="price_rating" value="2" />
                                                                            <label
                                                                                for="star2{{ $delivered->id }}"></label>
                                                                            <input type="radio"
                                                                                id="star1{{ $delivered->id }}" required
                                                                                name="price_rating" value="1" />
                                                                            <label
                                                                                for="star1{{ $delivered->id }}"></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <h6>Rating for Quality</h6>
                                                                        <div class="rating2">
                                                                            <input type="radio"
                                                                                id="qulaity5{{ $delivered->id }}"
                                                                                name="quality_rating" value="5" />
                                                                            <label
                                                                                for="qulaity5{{ $delivered->id }}"></label>
                                                                            <input type="radio"
                                                                                id="qulaity4{{ $delivered->id }}"
                                                                                name="quality_rating" value="4" />
                                                                            <label
                                                                                for="qulaity4{{ $delivered->id }}"></label>
                                                                            <input type="radio"
                                                                                id="qulaity3{{ $delivered->id }}"
                                                                                name="quality_rating" value="3" />
                                                                            <label
                                                                                for="qulaity3{{ $delivered->id }}"></label>
                                                                            <input type="radio"
                                                                                id="qulaity2{{ $delivered->id }}"
                                                                                name="quality_rating" value="2" />
                                                                            <label
                                                                                for="qulaity2{{ $delivered->id }}"></label>
                                                                            <input type="radio"
                                                                                id="qulaity1{{ $delivered->id }}" required
                                                                                name="quality_rating" disabled
                                                                                value="1" />
                                                                            <label
                                                                                for="qulaity1{{ $delivered->id }}"></label>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <div class="col-md-12">
                                                                            <label for="review" class="form-label">Review </label>
                                                                            <textarea class="form-control" name="review" id="review" cols="3" rows="3" placeholder="Enter Your message here"></textarea>
                                                                        </div> --}}
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
                                            <div class="modal fade theme-modal view-modal "
                                                id="feedback{{ $delivered->id }}" tabindex="-1"
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
                                                                    action="{{ route('user.rating.store', $delivered->id) }}">
                                                                    @csrf
                                                                    {{-- <div class="col-md-6">
                                                                        <h6>Rating for Price</h6>
                                                                        <div class="rating">
                                                                            <input type="radio"
                                                                                id="star5{{ $delivered->id }}"
                                                        name="price_rating"
                                                        value="5" />
                                                        <label for="star5{{ $delivered->id }}"></label>
                                                        <input type="radio" id="star4{{ $delivered->id }}" name="price_rating" value="4" />
                                                        <label for="star4{{ $delivered->id }}"></label>
                                                        <input type="radio" id="star3{{ $delivered->id }}" name="price_rating" value="3" />
                                                        <label for="star3{{ $delivered->id }}"></label>
                                                        <input type="radio" id="star2{{ $delivered->id }}" name="price_rating" value="2" />
                                                        <label for="star2{{ $delivered->id }}"></label>
                                                        <input type="radio" id="star1{{ $delivered->id }}" required name="price_rating" value="1" />
                                                        <label for="star1{{ $delivered->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Rating for Quality</h6>
                                                <div class="rating2">
                                                    <input type="radio" id="qulaity5{{ $delivered->id }}" name="quality_rating" value="5" />
                                                    <label for="qulaity5{{ $delivered->id }}"></label>
                                                    <input type="radio" id="qulaity4{{ $delivered->id }}" name="quality_rating" value="4" />
                                                    <label for="qulaity4{{ $delivered->id }}"></label>
                                                    <input type="radio" id="qulaity3{{ $delivered->id }}" name="quality_rating" value="3" />
                                                    <label for="qulaity3{{ $delivered->id }}"></label>
                                                    <input type="radio" id="qulaity2{{ $delivered->id }}" name="quality_rating" value="2" />
                                                    <label for="qulaity2{{ $delivered->id }}"></label>
                                                    <input type="radio" id="qulaity1{{ $delivered->id }}" required name="quality_rating" disabled value="1" />
                                                    <label for="qulaity1{{ $delivered->id }}"></label>
                                                </div>
                                            </div> --}}
                                                                    <div class="col-md-12">
                                                                        <label for="review" class="form-label">Review
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
                                            <!--/order Rating -->
                                        @empty
                                            <tr>
                                                <td>No Orders Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-returned" role="tabpanel"
                            aria-labelledby="pills-returned-tab" tabindex="0">
                            <div class="table-responsive" id="contentToPrint">
                                <table class="table order-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Total Amount</th>
                                            {{-- <th scope="col">Status</th> --}}
                                            <th scope="col">Profit</th>
                                            <th scope="col">Order date</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($returnedOrders as $returned)
                                            <tr>
                                                <td class="product-image"> {{ $returned->orderId }}</td>
                                                <td>{{ $returned->total_amount }}</td>
                                                <td>
                                                    <h6>{{ $returned->user_profit }}</h6>
                                                </td>
                                                <td>{{ $returned->created_at->format('d-m-Y H:i:s') }}</td>
                                                <td><a href="{{ route('invoice.generate', ['id' => $returned->id]) }}">Print
                                                        Invoice</a></td>
                                                <td class="d-flex">
                                                    <a class="px-1"
                                                        href="{{ route('user.order.detail', $returned->id) }}">
                                                        <i data-feather="eye" class="edit"></i></a>



                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>No Orders Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <nav class="custome-pagination">
        <ul class="pagination justify-content-center">

            <li class="page-item">
                {!! $orders->links() !!}
            </li>
    </nav> --}}
                </div>
            </div>
        </div>
    </section>
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
