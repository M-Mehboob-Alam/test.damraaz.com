@extends('layouts.app')
@section('content')
    {{-- <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2 class="mb-2">Withdraw</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Withdraw</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End --> --}}

    <!-- Compare Section Start -->
    <section class="compare-section  container">
        <div class="container-fluid-lg">
            <div class="row">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                @if (!blank($paymentType) && $paymentType->payment_type == 'bank')
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('images/bank.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Bank</h5>
                                <p class="card-text">Withdraw Commission Using Bank</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Limit : Rs. 500 </li>
                                <li class="list-group-item">Charge - 0%</li>
                                <li class="list-group-item">Processing Time - 1 Working days</li>
                            </ul>

                            <div class="card-body">
                                <a href="#"
                                    class="btn-block btn theme-bg-color view-button icon text-white fw-bold btn-md"
                                    data-bs-toggle="modal" data-bs-target="#bankModal">Withdraw</a>
                            </div>
                        </div>
                    </div>
                @elseif(!blank($paymentType) && $paymentType->payment_type == 'jazzcash')
                    <div class="col-md-4 my-1">
                        <div class="card">
                            <img src="{{ asset('images/jazzcash.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Jazz Cash</h5>
                                <p class="card-text">Withdraw Commission Using Jazz Cash</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Limit : Rs. 500 </li>
                                <li class="list-group-item">Charge - 0%</li>
                                <li class="list-group-item">Processing Time - 1 Working days</li>
                            </ul>

                            <div class="card-body">
                                <a href="#"
                                    class="btn-block btn theme-bg-color view-button icon text-white fw-bold btn-md"
                                    data-bs-toggle="modal" data-bs-target="#JazzCashModal">Withdraw</a>
                            </div>
                        </div>
                    </div>
                @elseif (!blank($paymentType) && $paymentType->payment_type == 'easypaisa')
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('images/easypaisa.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Easy Paisa</h5>
                                <p class="card-text">Withdraw Commission Using Easy Paisa</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Limit : Rs. 500 </li>
                                <li class="list-group-item">Charge - 0%</li>
                                <li class="list-group-item">Processing Time - 1 Working days</li>
                            </ul>

                            <div class="card-body">
                                <a href="#"
                                    class="btn-block btn theme-bg-color view-button icon text-white fw-bold btn-md"
                                    data-bs-toggle="modal" data-bs-target="#easyPaisaModal">Withdraw</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 my-2">
                        <h3 class="text-danger"> First Add Your Payment Method</h3>
                        <a class="ms-auto btn theme-bg-color view-button icon text-white fw-bold btn-md"
                            href="{{ route('home') }}">Add Payment Method</a>

                    </div>
                @endif
            </div>
            @if (!blank($paymentType) && $paymentType->payment_type == 'bank')
                <!-- bank Modal -->
                <div class="modal fade theme-modal view-modal " id="bankModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                        <div class="modal-content">
                            <div class="modal-header p-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-sm-4 g-2">
                                    <form class="row" action="{{ route('user.withdraw.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="payment_type" id="" value="bank">


                                        <div class="form-group col-md-6 my-3">
                                            <label for="title">Account Title</label>
                                            <input type="text" required class="form-control"id="title"
                                                placeholder="Account name" readonly
                                                value="{{ $paymentType->account_title }}" name="account_title">
                                        </div>
                                        <div class="form-group col-md-6  my-3">
                                            <label for="account">Account Number</label>
                                            <input type="text" required class="form-control"id="account"
                                                placeholder="eg: 2323*****" readonly
                                                value="{{ $paymentType->account_no }}" name="account_no">
                                        </div>
                                        <div class="form-group col-md-6  my-3">
                                            <label for="">Bank Name</label>
                                            <input type="text" required class="form-control" readonly
                                                value="{{ $paymentType->bank_name }}" name="bank_name" id=""
                                                placeholder="Enter Your Bank Name">
                                        </div>
                                        <div class="form-group col-md-6  my-3">
                                            <label for="amount">Enter Amount <span class="text-danger"> &#40;Withdraw
                                                    Limit
                                                    min:500 &#41;</span></label>
                                            <input type="number" required class="form-control" id="amount"
                                                placeholder="Enter Amount eg: 500" name="amount">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="ms-auto btn theme-bg-color view-button icon text-white fw-bold btn-md">Confirm</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / end bank Modal -->
            @elseif(!blank($paymentType) && $paymentType->payment_type == 'jazzcash')
                <!-- jazz Cash Modal -->
                <div class="modal fade theme-modal view-modal " id="JazzCashModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                        <div class="modal-content">
                            <div class="modal-header p-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-sm-4 g-2">
                                    <form class="row" action="{{ route('user.withdraw.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="payment_type" id="" value="jazzcash">


                                        <div class="form-group col-md-6 my-3">
                                            <label for="title">Account Title</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{ $paymentType->account_title }}" id="title"
                                                placeholder="Account name" required name="account_title">
                                        </div>
                                        <div class="form-group col-md-6  my-3">
                                            <label for="account">Account Number</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{ $paymentType->account_no }}" id="account"
                                                placeholder="eg: 2323*****" required name="account_no">
                                        </div>
                                        <div class="form-group col-md-6  my-3">
                                            <label for="amount">Enter Amount <span class="text-danger"> &#40;Withdraw
                                                    Limit
                                                    min:500 &#41;</span></label>
                                            <input type="number" required class="form-control" id="amount"
                                                min="500" placeholder="Enter Amount eg: 500" name="amount">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="ms-auto btn theme-bg-color view-button icon text-white fw-bold btn-md">Confirm</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / jazz Cash Modal -->
            @elseif (!blank($paymentType) && $paymentType->payment_type == 'easypaisa')
                <!-- Easy Paisa Modal -->
                <div class="modal fade theme-modal view-modal " id="easyPaisaModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                        <div class="modal-content">
                            <div class="modal-header p-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-sm-4 g-2">
                                    <form class="row" action="{{ route('user.withdraw.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="payment_type" id="" value="easypaisa">


                                        <div class="form-group col-md-6 my-3">
                                            <label for="title">Account Title</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{ $paymentType->account_title }}" id="title"
                                                placeholder="Account name" required name="account_title">
                                        </div>
                                        <div class="form-group col-md-6  my-3">
                                            <label for="account">Account Number</label>
                                            <input type="text" class="form-control" required readonly
                                                value="{{ $paymentType->account_no }}" id="account"
                                                placeholder="eg: 2323*****" name="account_no">
                                        </div>
                                        <div class="form-group col-md-6  my-3">
                                            <label for="amount">Enter Amount <span class="text-danger"> &#40;Withdraw
                                                    Limit
                                                    min:500 &#41;</span></label>
                                            <input type="number" required class="form-control" id="amount"
                                                min="500" placeholder="Enter Amount eg: 500" name="amount">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="ms-auto btn theme-bg-color view-button icon text-white fw-bold btn-md">Confirm</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / Easy Paisa Modal -->
            @endif
        </div>
    </section>
    <!-- Compare Section End -->
@endsection
