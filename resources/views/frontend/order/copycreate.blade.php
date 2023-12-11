@extends('layouts.app')
@section('content')
<style>
    .error {
    color: red;
    font-size: 12px;
}
</style>
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Checkout</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-new-address-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-new-address" type="button" role="tab" aria-controls="nav-home"
                        aria-selected="true">New Address</button>
                    <button class="nav-link" id="nav-old-address-tab" data-bs-toggle="tab" data-bs-target="#nav-old-address"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Old Address</button>
                </div>
            </nav>
            @php $total = 0;
                $delivery_charges=0;
                $profit=0;
                
                @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php
                        $total += $details['discount_price'] * $details['quantity'];
                        $profit += $details['profit'] * $details['quantity'];
                        $delivery_charges += $details['delivery_charges'] 
                    @endphp
                @endforeach
            @endif
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-new-address" role="tabpanel"
                    aria-labelledby="nav-new-address-tab">
                    <form method="POST" action="{{ route('place.order') }}" enctype="multipart/form-data">
                        <div class="row g-sm-4 g-3 my-2">
                            @csrf
                            {{-- <div class="md-b col-md-12">
                                <select id="address" name="address" class="form-control">
                                    <option value="">-- Select Address --</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}">{{ $order->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="mb-3 col-md-6">
                                <label for="business" class="form-label">Business Name </label>
                                <input type="text" class="form-control" {{ Auth()->user()->business ? 'readonly' : '' }}
                                    id="business" name="business" aria-describedby=""
                                    value="{{ Auth()->user()->business ?? '' }}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" required id="name" name="name"
                                    aria-describedby="">
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" required id="address-input" name="address"
                                    aria-describedby="">
                                @error('address')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" required id="phone" name="phone"
                                    aria-describedby="">
                                @error('phone')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" required id="province" name="province"
                                    aria-describedby="">
                                @error('province')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" required id="city" name="city"
                                    aria-describedby="">
                                @error('city')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="area" class="form-label">Area</label>
                                <input type="text" class="form-control" required id="area" name="area"
                                    aria-describedby="">
                                @error('area')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="house" class="form-label">House</label>
                                <input type="text" class="form-control" required id="house" name="house"
                                    aria-describedby="">
                                @error('house')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="street" class="form-label">Street</label>
                                <input type="text" class="form-control" required id="street" name="street"
                                    aria-describedby="">
                                @error('street')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nearest" class="form-label">Nearest</label>
                                <input type="text" class="form-control" required id="nearest" name="nearest"
                                    aria-describedby="">
                                @error('nearest')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                </div>
                <div class="tab-pane fade" id="nav-old-address" role="tabpanel" aria-labelledby="nav-old-address-tab">
                    <div class="row  g-sm-4 g-3 my-2">
                        @foreach ($orders as $order)
                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" value="{{ $order->id }}" type="radio"
                                                name="exampleRadio" id="radio{{ $order->id }}">
                                            <label class="form-check-label" for="radio{{ $order->id }}">
                                                <h4>{{ $order->name ?? '' }}</h4>
                                                <b>House:</b> {{ $order->house ?? '' }} <b>Street:</b>
                                                {{ $order->street ?? '' }} <b>address:</b> {{ $order->address ?? '' }}
                                                <b>Nearest:</b> {{ $order->nearest ?? '' }} <b>Area:</b>
                                                {{ $order->area ?? '' }} <b>City:</b> {{ $order->city ?? '' }}
                                                <b>Province:</b> {{ $order->province ?? '' }}
                                                <b>Phone: </b>{{ $order->phone ?? '' }}

                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 my-2">
                    <label class="form-label" for="payment_method">Payment Method</label>
                    <select name="payment_method" required id="payment_method" class="form-control">
                        <option value="profit">Using Profit</option>
                        <option value="cod">Cash On Delivery</option>
                        <option value="advance">Advance Payment</option>
                    </select>
                </div>
                <div class="row g-sm-4 g-3 my-2" id="account-details-form" style="display: none;">
                    <div class="col-12 my-2">
                        <label class="form-label" for="delivery_fee">Payment(Pay this amount and upload screenshot of Payment)</label>
                        <input type="text" class="form-control" readonly  name="paid" id="amount_paid">
                    </div>
                    
                    <div class="col-12 my-2">
                        <label class="form-label" for="account_number">Account Type</label>
                        <select class="form-control" name="account_type" id="account_type">
                            <option value="">-- Select Account Type --</option>
                            @forelse($accounts as $index=> $account)
                                <option value="{{ $account->bank }}" data-account-title="{{ $account->account_title }}" data-account-number="{{ $account->account_no }}">{{ $account->bank }} </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                    <div id="dynamic-form" style="display: none;">
                    <!-- Dynamic form content goes here -->
                        <div class="row g-sm-4 g-3">
                            <div class="mb-3 col-md-6">
                                <label for="account_title" class="form-label">Account Title</label>
                                <input type="text" class="form-control" name="account_title" id="account_title" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" class="form-control" name="account_number" id="account_number" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 my-2">
                        <label class="form-label" for="payment_image">Screenshot of Payment</label>
                        <input type="file" class="form-control" name="image" id="payment_image"
                            accept="image/*" style="display: none;">
                    </div>
                </div>

                <button type="submit" id="place_order_btn" class="btn btn-animation proceed-btn fw-bold"  disabled>Place Order</button>
                </form>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#nav-new-address-tab').click(function() {
                clearFields();
                $('.form-check-input:checked').prop('checked', false);

            });
            $('.form-check-input').change(function() {
                const selectedAddressId = $('.form-check-input:checked').val();
                // alert(selectedAddressId);

                if (selectedAddressId !== '') {
                    $.ajax({
                        url: `/show-address/${selectedAddressId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            populateFields(data);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                } else {
                    // Clear the fields when a new address is entered
                    clearFields();
                }
            });

            function populateFields(data) {
                // Populate the fields based on the retrieved address data

                $('#name').val(`${data.name}`);
                $('#address-input').val(`${data.address}`);
                $('#phone').val(`${data.phone}`);
                $('#province').val(`${data.province}`);
                $('#city').val(`${data.city}`);
                $('#area').val(`${data.area}`);
                $('#street').val(`${data.street}`);
                $('#country').val(`${data.country}`);
                $('#nearest').val(`${data.nearest}`);
                $('#house').val(`${data.house}`);
            }

            function clearFields() {
                $('#name').val("");
                $('#address-input').val("");
                $('#phone').val("");
                $('#province').val("");
                $('#city').val("");
                $('#area').val("");
                $('#street').val("");
                $('#country').val("");
                $('#nearest').val("");
                $('#house').val("");
            }
        });
    </script>
<script>
    $(document).ready(function () {
        const accountDetailsForm = document.getElementById('account-details-form');
        const accountType = document.getElementById('account_type');
        const accountTitle = document.getElementById('account_title');
        const accountNumber = document.getElementById('account_number');
        const dynamicForm = document.getElementById('dynamic-form');
        const deliveryFeeInput = document.getElementById('amount_paid');
        const paymentMethodSelect = document.getElementById('payment_method');
        const placeOrderBtn = document.getElementById('place_order_btn');
        const paymentImageInput = document.getElementById('payment_image');

        // Event listener for payment method change
        paymentMethodSelect.addEventListener('change', function () {
            const selectedMethod = paymentMethodSelect.value;

            if (selectedMethod === 'advance' || selectedMethod === 'cod') {
                accountDetailsForm.style.display = 'block';
                if (selectedMethod === 'advance') {
                    const totalAmount = {{ $total }};
                    deliveryFeeInput.value = 'Rs. ' + totalAmount;
                    document.getElementById('amount_paid').value = totalAmount;
                    // deliveryFeeInput.value = 'Rs. {{ $total }}';
                } else {
                    const deliveryCharges = {{ $delivery_charges }};
                    deliveryFeeInput.value = 'Rs. ' + deliveryCharges;
                    document.getElementById('amount_paid').value = deliveryCharges;
                    // deliveryFeeInput.value = 'Rs. {{ $delivery_charges }}';
                }
            } else {
                accountDetailsForm.style.display = 'none';
            }
            
            // Show/hide payment screenshot input based on selected payment method
            if (selectedMethod === 'advance' || selectedMethod === 'cod') {
                paymentImageInput.style.display = 'block';
            } else {
                paymentImageInput.style.display = 'none';
            }
            togglePlaceOrderButton();
        });

        // Event listener for account type change
        accountType.addEventListener('change', function () {
            const selectedAccountOption = accountType.options[accountType.selectedIndex];
            const selectedAccountTitle = selectedAccountOption.getAttribute('data-account-title');
            const selectedAccountNumber = selectedAccountOption.getAttribute('data-account-number');

            if (selectedAccountTitle && selectedAccountNumber) {
                dynamicForm.style.display = 'block';
                accountTitle.value = selectedAccountTitle;
                accountNumber.value = selectedAccountNumber;
            } else {
                dynamicForm.style.display = 'none';
            }

            togglePlaceOrderButton();
        });

        // Event listener for payment image selection
        $('#payment_image').change(function () {
            const fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass('selected').html(fileName);

            togglePlaceOrderButton();
        });

        function togglePlaceOrderButton() {
            if (paymentMethodSelect.value === 'advance' || paymentMethodSelect.value === 'cod') {
                if (accountType.value !== '' && $('#payment_image').val() !== '') {
                    placeOrderBtn.disabled = false;
                } else {
                    placeOrderBtn.disabled = true;
                }
            } else {
                placeOrderBtn.disabled = false;
            }
        }
    });
</script>


@endsection
