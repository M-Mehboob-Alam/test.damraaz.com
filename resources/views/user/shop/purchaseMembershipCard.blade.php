@extends('layouts.app')
@section('title')
Purchased Membership Card
@endsection
@php
    use Illuminate\Support\Facades\Crypt;
    $cryptedAmount = $amount;
    $amount = Crypt::decrypt($amount);
    $amount = (int) $amount;
@endphp

@section('content')
 <!-- Main Start -->
 <div class="main">
    <section class="page-body p-0">
      <div class="row g-0 ratio_asos">
        <div class="order-2 order-lg-1 col-lg-5">
          <div class="content-box">
            <div>

              <h5 class="my-5">Membership Cards<span class="bg-theme-blue"></span></h5>


              @if ($errors->any())
              @foreach ($errors->all() as $error)
                 <div class="text-danger">{{$error}}</div>
              @endforeach
             @endif

                <div class="main_card_wraper">
                    @foreach ($packages as $key=> $item)
                    <div class="main_card">
                        <form action="{{route('purchase.membership.now')}}" method="POST" enctype="multipart/form-data" class="custom-form form-pill">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $cryptedAmount }}">
                            <input type="hidden" name="package" value="{{ $item->id }}">
                            <input type="hidden" name="purchased_with" value="{{ $purchasedWith }}">

                        <div class="card-{{ $key == 4 ? 'premium':'basic' }}">
                          <div class="card-header header-{{ $key == 4 ? 'premium':'basic' }}">
                            <h1 class="">{{ $item->name }}</h1>
                          </div>
                          <div class="card-body">
                            <p><h2>Rs{{ $item->price }}</h2></p>
                            <div class="card-element-hidden-{{ $key == 4 ? 'premium':'basic' }}">
                              <ul class="card-element-container">
                                <li class="card-element">BV {{ $item->bv }}</li>
                                <br>
                                <li class="card-element">Levels {{ $item->level }}</li>
                                <br>
                                <li class="card-element">Courses {{ $item->course }}</li>

                              </ul>
                              @if ($amount > $item->price)
                              <button type="submit" class="btn btn-{{ $key == 4 ? 'premium':'basic' }}">Buy Now</button>
                              @else
                              <button type="button" class="btn btn-{{ $key == 4 ? 'premium':'basic' }}" disabled>Buy Now</button>
                              @endif

                            </div>
                          </div>
                        </div>
                    </form>
                    </div>
                        @endforeach
                </div>

            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
  <!-- Main End -->
  <style>
 @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap');



.main_card_wraper {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  width: 95vw !important;
}
.main_card_wraper h1{
 font-size: 2rem;
}

.card-basic,
.card-premium,
.card-standard {
  margin: 0 2rem 1rem 0;
  padding: 0 0 0.5rem 0;
  width: 13rem;
  background: #fff;
  color: #444;
  text-align: center;
  border-radius: 1rem;
  box-shadow: 0.5rem 0.5rem 1rem rgba(51, 51, 51, 0.2);
  overflow: hidden;
  transition: all 0.1ms ease-in-out;
}
.card-basic:hover,
.card-premium:hover,
.card-standard:hover {
  transform: scale(1.02);
}

.card-header {
  height: 7rem;
  text-transform: uppercase;
  font-weight: 700;
  font-size: 0.8rem;
  padding: 1rem 0;
  color: #fff;
  clip-path: polygon(0 0, 100% 0%, 100% 85%, 0% 100%);
}

.header-basic,
.btn-basic {
  background: linear-gradient(135deg, rgb(0, 119, 238), #06c766);
}

.header-standard,
.btn-standard {
  background: linear-gradient(135deg, #b202c9, #cf087c);
}

.header-premium,
.btn-premium {
  background: linear-gradient(135deg, #eea300, #ee5700);
}

.card-body {
  padding: 0.5rem 0;
}
.card-body h2 {
  font-size: 2rem;
  font-weight: 700;
}

.card-element-container {
  color: #444;
  list-style: none;
}

.btn {
  margin: 0.5rem 0;
  padding: 0.7rem 1rem;
  outline: none;
  border-radius: 1rem;
  font-size: 1rem;
  font-weight: 700;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: all 0.1ms ease-in-out;
}

.btn:hover {
  transform: scale(0.95);
}

.btn:active {
  transform: scale(1);
}

.card-element-hidden {
  display: none;
}

  </style>
@endsection
