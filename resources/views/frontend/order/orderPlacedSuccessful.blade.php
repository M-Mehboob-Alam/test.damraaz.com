@extends('layouts.app')
@section('title')
Order Placed Successful!
@endsection
@section('content')



    <!-- Top Section Start -->
    <section class="p-0">
      <div class="success-icon">
        <div class="img-wrap">
          <img class="success-img img-fluid" src="{{asset('newtheme/assets/svg/order-success.svg')}}" alt="vector" />
          <img class="check" src="{{asset('newtheme/assets/svg/check.svg')}}" alt="check" />
        </div>

        <div class="success-contain">
          <h1>Order Success</h1>
          <h5 class="font-light">Your Order Is Successfully Placed And Your Order Is On The Processing</h5>
          <h6 class="font-light">Transaction ID:{{$order->orderId}}</h6>
        </div>
      </div>
    </section>
    <!-- Top Section End -->



@endsection


