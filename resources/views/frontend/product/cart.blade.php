@extends('layouts.app')
@section('title')
Cart
@endsection
@section('content')
<style>
    @media only screen and (max-width: 767px) {
    .hide_table_on_mobile{
        display: none !important;
    }
    }
</style>
@php $total = 0;
$delivery_charges=0;
$profit=0;

@endphp
    <!-- Cart Section Start -->
    <section class="section-b-space card-page">
      <div class="container-lg">
        <div class="row g-3 g-md-4 cart">
          <div class="col-md-7 col-lg-8">
            <div class="cart-wrap">
              <div class="items-list">
                <table class="table cart-table m-md-0 hide_table_on_mobile">
                  <thead>
                    <tr>
                      <th class="d-none d-sm-table-cell">PRODUCT</th>
                      <th class="d-none d-sm-table-cell">PRICE</th>
                      <th class="d-none d-lg-table-cell">QUANTITY</th>
                      <th class="d-none d-lg-table-cell">TOTAL</th>
                      <th class="d-none d-xl-table-cell">Your Profit</th>
                      <th class="d-none d-xl-table-cell">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @if(session('cart'))
                    {{-- {{dd(session('cart'))}} --}}
                    @foreach(session('cart') as $id => $items)
                        @php
                        $delivery_charges += $items['shop_charges'];
                        @endphp
                        <tr class="" style="background-color: rgb(0, 0, 0); color:white">
                            <td class="border " style="color: white">Shop Name: <strong>{{$items['shop_name']}}</strong></td>
                            <td class="border" style="color: white">Delivery Changes: <strong>{{$items['shop_charges']}}</strong></td>
                        </tr>
                        @foreach ($items['products'] as $details)
                            @php
                            $total += $details['discount_price'] * $details['quantity'];
                            $profit += $details['profit'] * $details['quantity'];

                            @endphp




                              <tr data-id="{{ $details['slug'] }}" >
                                <td>
                                  <div class="product-detail">
                                    <img class="pr-img" src="{{asset($details['images'])}}" alt="image" />
                                    <div class="details">
                                      <h4 class="title-color font-default2"><a class="name" href="{{route('product.show',$details['slug'])}}">{{ Illuminate\Support\Str::limit($details['name'],15,'...') }} </a></h4>

                                      <span class="size gap-2 d-flex d-sm-none">

                                        @if (is_null($details['discount_price']))

                                          <span> Rs. {{$details['price']}}</span>
                                        @else
                                       <span>RS. {{$details['discount_price']}}</span>
                                        @endif
                                        </span>

                                    </div>
                                  </div>

                                </td>

                                <td class="price d-none d-sm-table-cell">

                                    @if (is_null($details['discount_price']))

                                    <span> Rs. {{$details['price']}}</span>
                                  @else
                                 <span>RS. {{$details['discount_price']}}</span>
                                  @endif
                                </td>

                                <td class="d-none d-lg-table-cell">

                                    <form id="_{{$details['slug']}}" action="{{route('update.cart')}}" method="POST">
                                        <input type="hidden" name="id" value="{{$details['slug']}}" >
                                        <input type="hidden" name="update" value="minus" >
                                        @method('PATCH')
                                        @csrf

                                        <input type="hidden" id="number{{$details['slug']}}" name="quantity" value="{{$details['quantity']}}" min="1" max="10" />
                                    </form>
                                    <form id="{{$details['slug']}}" action="{{route('update.cart')}}" method="POST">
                                        <input type="hidden" name="id" value="{{$details['slug']}}" >
                                        <input type="hidden" name="update" value="plus" >
                                        @method('PATCH')
                                        @csrf
                                        <input type="hidden" id="number{{$details['slug']}}" name="quantity" value="{{$details['quantity']}}" min="1" max="10" />
                                    </form>
                                    <form  action="{{route('update.cart')}}" method="POST">
                                        <input type="hidden" name="id" value="{{$details['slug']}}" >
                                        @method('PATCH')
                                        @csrf
                                        <div class="plus-minus">
                                            <button class="sub"  onclick="document.getElementById('_{{$details['slug']}}').submit();" data-feather="minus"></button>
                                            <input type="number" onchange="this.form.submit()" id="number{{$details['slug']}}" name="quantity" value="{{$details['quantity']}}" min="1" max="10" />
                                            <button class="add" onclick="document.getElementById('{{$details['slug']}}').submit();" data-feather="plus"></button>
                                          </div>
                                    </form>


                                  </td>
                                <td class="total d-none d-xl-table-cell"> Rs.

                                    @if (is_null($details['discount_price']))
                                    {{$details['price']*$details['quantity']}}

                                  @else
                                  {{$details['discount_price']*$details['quantity']}}
                                  @endif

                                </td>
                                <td>

                                <div class="input-group mb-3">
                                    <form  action="{{route('update.cart')}}" method="POST">
                                        <input type="hidden" name="id" value="{{$details['slug']}}" >

                                        @method('PATCH')
                                        @csrf
                                        <div class="d-flex">
                                            <input type="number" onchange="this.form.submit()" name="profit" min="1" class="form-control form-control-sm profit_update" value="{{ $details['profit']??0 }}"   aria-describedby="button-addon2">
                                            <button class="btn theme-bg-color view-button icon text-white fw-bold btn-sm updater_profit px-1 py-1" type="submit" id="button-addon2">Update</button>
                                        </div>

                                    </form>
                                </div>
                                 </td>
                                 <td>
                                    <form action="{{ route('remove.from.cart') }}" method="POST">
                                        <input type="hidden" name="id" value="{{$details['slug']}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="remove close_button text-danger remove-from-cart-mobile" >Remove </button>
                                    </form>
                                    {{-- <a class="remove close_button remove-from-cart" href="javascript:void(0)">Remove</a> --}}
                                 </td>
                              </tr>
                              @endforeach
                    @endforeach
                @else
                    No product found in cart
                @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="display_on_mobile  d-md-none">
            @if(session('cart'))
            @foreach(session('cart') as $id => $items)
            <div class="container" style="background-color: rgb(0, 0, 0); color:white; padding:15px">
                <h3 class="">Shop Name: <strong class="text-uppercase">{{$items['shop_name']}}</strong></h3>
                <h3 class="">Delivery Changes: Rs. <strong class="text-uppercase">{{$items['shop_charges']}}</strong></h3>
            </div>
                @foreach ($items['products'] as $details)


              <div class="row" style="border: 1px solid gray; border-radius:10px; padding:1rem 0px; margin:10px 5px">
                <div class="col-6">
                    <img  style="height:100%;width:100%; object-fit:contain" src="{{asset($details['images'])}}" alt="image" />

                </div>
                <div class="col-6">
                    <div class="product-detail">
                        <div class="details">
                          <h4 class="title-color font-default2"><a class="name" href="{{route('product.show',$details['slug'])}}">{{ Illuminate\Support\Str::limit($details['name'],15,'...') }} </a></h4>

                          <span class="size gap-2 d-flex  fw-bold">

                            @if (is_null($details['discount_price']))

                              <span> Rs. {{$details['price']}}</span>
                            @else
                           <span>RS. {{$details['discount_price']}}</span>
                            @endif
                            </span>
                            <span class="fw-bold">
                                Total: Rs.
                                @if (is_null($details['discount_price']))
                                {{$details['price']*$details['quantity']}}

                              @else
                              {{$details['discount_price']*$details['quantity']}}
                              @endif
                            </span>
                        </div>

                        <form id="_{{$details['slug']}}" action="{{route('update.cart')}}" method="POST">
                            <input type="hidden" name="id" value="{{$details['slug']}}" >
                            <input type="hidden" name="update" value="minus" >
                            @method('PATCH')
                            @csrf

                            <input type="hidden" id="number{{$details['slug']}}" name="quantity" value="{{$details['quantity']}}" min="1" max="10" />
                        </form>
                        <form id="{{$details['slug']}}" action="{{route('update.cart')}}" method="POST">
                            <input type="hidden" name="id" value="{{$details['slug']}}" >
                            <input type="hidden" name="update" value="plus" >
                            @method('PATCH')
                            @csrf
                            <input type="hidden" id="number{{$details['slug']}}" name="quantity" value="{{$details['quantity']}}" min="1" max="10" />
                        </form>
                        <form  action="{{route('update.cart')}}" method="POST">
                            <input type="hidden" name="id" value="{{$details['slug']}}" >
                            @method('PATCH')
                            @csrf
                            <div class="plus-minus">
                                <button class="sub"  onclick="document.getElementById('_{{$details['slug']}}').submit();" data-feather="minus"></button>
                                <input type="number" onchange="this.form.submit()" id="number{{$details['slug']}}" name="quantity" value="{{$details['quantity']}}" min="1" max="10" />
                                <button class="add" onclick="document.getElementById('{{$details['slug']}}').submit();" data-feather="plus"></button>
                              </div>
                        </form>

                       <span class="fw-bold">Your Profit Rs.{{ $details['profit']??0 }} / Quantity</span>
                      <div class="input-group mb-3">
                        <form  action="{{route('update.cart')}}" method="POST">
                            <input type="hidden" name="id" value="{{$details['slug']}}" >

                            @method('PATCH')
                            @csrf
                            <div class="d-flex">
                                <input type="number" onchange="this.form.submit()" name="profit" class="form-control form-control-sm profit_update" value="{{ $details['profit']??0 }}"   aria-describedby="button-addon2">
                                <button class="btn theme-bg-color view-button icon text-white fw-bold btn-sm updater_profit px-1 py-1" type="submit" id="button-addon2">Update</button>
                            </div>

                        </form>
                    </div>
                    <form action="{{ route('remove.from.cart') }}" method="POST">
                        <input type="hidden" name="id" value="{{$details['slug']}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="remove close_button text-danger remove-from-cart-mobile" >Remove Item</button>
                    </form>
                      </div>
                </div>
              </div>

              @endforeach
            @endforeach
        @else
            No product found in cart
        @endif
          </div>
          <div class="col-md-5 col-lg-4">
            <div class="summery-wrap">

              <div class="cart-wrap grand-total-wrap">
                <div>
                  <div class="order-summery-box">
                    <h5 class="cart-title">Cart Details</h5>
                    <ul class="order-summery">
                      <li>
                        <span>Profit</span>
                        <span><strong>RS. {{$profit}}</strong></span>
                      </li>

                      <li>
                        <span>Subtotal</span>
                        <span class="theme-color"><strong>RS. {{$total}}</strong></span>
                      </li>

                      <li>
                        <span>Delivery Charges</span>
                        <span><strong>RS. {{$delivery_charges}}</strong></span>
                      </li>

                      <li class="pb-0">
                        <span>Total (PKR)</span>
                        <span><strong>RS. {{$total+$delivery_charges+$profit}}</strong></span>
                      </li>
                    </ul>
                    <div class="row g-3 mt-2">
                      <div class="col-6 col-md-12">
                        <a href="{{route('checkout')}}" class="btn-solid checkout-btn">Checkout <i class="arrow"></i></a>
                      </div>
                      <div class="col-6 col-md-12">
                        <a href="{{url('/')}}" class="btn-outline w-100 justify-content-center checkout-btn"> Back To Shop </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Cart Section End -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <script type="text/javascript">

     $(document).ready(function() {





    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    });
    </script>
<style>
    input.form-control.form-control-sm.profit_update {
    width: 80px;
}
</style>
@endsection




