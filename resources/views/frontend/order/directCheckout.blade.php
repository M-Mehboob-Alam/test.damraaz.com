@extends('layouts.app')
@section('title')
Checkout
@endsection
@section('content')
 <!-- Main Start -->


<style>
    .error {
    color: red;
    font-size: 12px;
}
</style>

    <section class="checkout-section-2 container section-b-space">
        <div class="container-fluid-lg">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
               <div class="text-danger">{{$error}}</div>
            @endforeach
           @endif
            <h1>Deliver Address</h1>
            <hr>
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
            @if($cart)
            {{-- {{dd($cart)}} --}}

                @php
                $delivery_charges += $cart['shop_charges'];
                $total += $cart['discount_price'] * $cart['quantity'];
                $profit += $cart['profit'] * $cart['quantity'];
                $total = $total + $profit + $delivery_charges;
                @endphp
            @endif
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-new-address" role="tabpanel"
                    aria-labelledby="nav-new-address-tab">
                    <form method="POST" action="{{ route('storeDirectPlaceOrder') }}" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" required id="name" value="{{old('name')}}"  name="name"
                                    aria-describedby="">
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" required id="phone" value="{{old('phone')}}" name="phone"
                                    aria-describedby="">
                                @error('phone')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="province" class="form-label">Province / State</label>
                                <input type="text" class="form-control" value="{{old('province')}}" required id="province" name="province"
                                    aria-describedby="">
                                @error('province')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" required value="{{old('city')}}" id="city" name="city"
                                    aria-describedby="">
                                @error('city')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                {{-- <input type="text" class="form-control" required id="address-input" name="address"
                                    aria-describedby=""> --}}
                                    <textarea class="form-control" required id="address-input" name="address">{{old('address')}}</textarea>
                                @error('address')
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
                <h1>Payment Details</h1>
                <h1></h1>
                <div class="col-12 my-2">
                    <label class="form-label" for="payment_method">Payment Method</label>
                    <select name="payment_method" required id="payment_method" class="form-control">
                        <option value="">Seletect</option>
                        <option value="profit">Using Profit</option>
                        <option value="cod">Cash On Delivery</option>
                        <option value="advance">Advance Payment</option>
                    </select>
                </div>
                <div class="row g-sm-4 g-3 my-2" id="account-details-form" >
                    <div class="col-12 my-2">
                        <label class="form-label" for="delivery_fee">Payment(Pay this amount and upload screenshot of Payment)</label>
                        <input type="text" class="form-control" readonly  name="paid" id="amount_paid">
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label" for="account_number">Account Type</label>
                        <select class="form-control" name="account_type" id="account_type">
                            <option value="">-- Select Account Type --</option>
                            @forelse($accounts as $index=> $account)
                                <option value="{{ $account->account_type }}" bank-name="{{ $account->bank }}" data-account-type="{{ $account->account_title }}" data-account-title="{{ $account->account_title }}" data-account-number="{{ $account->account_no }}">{{ $account->account_type }} </option>
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
                            <div class="mb-3 col-md-6" id="add_bank_name_show">
                                <label for="account_number" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" name="bank" id="add_bank_name_value" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 my-2">
                        <input type="file" class="form-control" name="image" id="payment_image" accept="image/*" style="display: none;">
                        <label class="form-label" for="payment_image">Screenshot of Payment</label>

                    </div>
                </div>

                <button type="submit" id="place_order_btn" class="btn btn-animation  btn-success proceed-btn fw-bold"  disabled>Place Order</button>
                </form>
            </div>

        </div>
    </section>

      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

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
        // $('#account_type').on( "select", function() {
        //     alert('changed');
        // });
        $('#account-details-form').hide();

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
            if(selectedMethod == 'profit'){
                $('#account-details-form').hide();
                $('#dynamic-form').hide();
                $('#place_order_btn').removeAttr('disabled');

                // placeOrderBtn.disabled = true;
            }else{
                $('#account-details-form').show();
                $('#dynamic-form').show();
            }
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
            const selectedBankName = selectedAccountOption.getAttribute('bank-name');
            const selectedAccountType = selectedAccountOption.getAttribute('data-account-type');
                if(selectedAccountOption.value == 'Bank'){
                    $('#add_bank_name_show').show();
                    $('#add_bank_name_value').val(selectedBankName);
                    // document.getElementById('add_bank_name_value').value = selectedBankName;

                }else{
                    $('#add_bank_name_show').hide();
                    $('#add_bank_name_value').val('');
                }
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


