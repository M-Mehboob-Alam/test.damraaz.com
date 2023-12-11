@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
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
                                            <tr class="product-box-contain" data-id="{{ $id }}">
                                                <td class="product-detail">
                                                    <div class="product border-0">

                                                        <a href="{{route('product.show',$id)}}" class="product-image">
                                                            <img src="{{asset($details['images'])}}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                        <div class="product-detail">
                                                            <ul>
                                                                <li class="name">
                                                                    <a class="name" href="{{route('product.show',$id)}}">{{ Illuminate\Support\Str::limit($details['name'],15,'...') }} </a>
                                                                </li>

                                                                <!--<li class="text-content"><span class="text-title">Sold-->
                                                                <!--        By:</span> Fresho</li>-->

                                                                <!--<li class="text-content"><span-->
                                                                <!--        class="text-title">Quantity</span> - 500 g</li>-->

                                                                <!--<li>-->
                                                                <!--    <h5 class="text-content d-inline-block">Price :</h5>-->
                                                                <!--    <span>$35.10</span>-->
                                                                <!--    <span class="text-content">$45.68</span>-->
                                                                <!--</li>-->

                                                                <!--<li>-->
                                                                <!--    <h5 class="saving theme-color">Saving : $20.68</h5>-->
                                                                <!--</li>-->

                                                                <!--<li class="quantity-price-box">-->
                                                                <!--    <div class="cart_qty">-->
                                                                <!--        <div class="input-group">-->
                                                                <!--            <button type="button" class="btn qty-left-minus"-->
                                                                <!--                data-type="minus" data-field="">-->
                                                                <!--                <i class="fa fa-minus ms-0"-->
                                                                <!--                    aria-hidden="true"></i>-->
                                                                <!--            </button>-->
                                                                <!--            <input class="form-control input-number qty-input"-->
                                                                <!--                type="text" name="quantity" value="{{$details['quantity']}}">-->
                                                                <!--            <button type="button" class="btn qty-right-plus"-->
                                                                <!--                data-type="plus" data-field="">-->
                                                                <!--                <i class="fa fa-plus ms-0"-->
                                                                <!--                    aria-hidden="true"></i>-->
                                                                <!--            </button>-->
                                                                <!--        </div>-->
                                                                <!--    </div>-->
                                                                <!--</li>-->

                                                                <!--<li>-->
                                                                <!--    <h5>Total: $35.10</h5>-->
                                                                <!--</li>-->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="price">
                                                    <h4 class="table-title text-content">Price</h4>
                                                    <h5>RS. {{$details['discount_price']}}<del class="text-content">Rs. {{$details['price']}}</del></h5>
                                                    <h6 class="theme-color">You Save : Rs. {{($details['price']-$details['discount_price'])*$details['quantity']}}</h6>
                                                </td>

                                                <td class="quantity">
                                                    <h4 class="table-title text-content">Qty</h4>
                                                    <div class="quantity-price">
                                                        <div class="cart_qty">
                                                            <div class="input-group">
                                                                <button type="button" class="btn qty-left-minus updater"
                                                                    data-type="minus" data-field="">
                                                                    <i class="fa fa-minus ms-0" aria-hidden="true"></i>
                                                                </button>
                                                                <input data-th="Quantity" class="form-control input-number qty-input update-cart quantity_update " type="number"
                                                                    name="quantity" value="{{ $details['quantity'] }}">
                                                                <button type="button" class="btn qty-right-plus updater"
                                                                    data-type="plus" data-field="">
                                                                    <i class="fa fa-plus ms-0" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="">
                                                    <h4 class="table-title text-content">Total</h4>
                                                    <h5>Rs. {{$details['discount_price']*$details['quantity']}}</h5>
                                                </td>
                                                <!--<td class="profit">-->
                                                <!--    <h4 class="table-title text-content">Profit</h4>-->
                                                <!--    <div class="quantity-price">-->
                                                <!--        <div class="cart_qty">-->
                                                <!--            <div class="input-group">-->
                                                <!--                <button type="button" class="btn qty-left-minus updater_profit"-->
                                                <!--                    data-type="minus" data-field="">-->
                                                <!--                    <i class="fa fa-minus ms-0" aria-hidden="true"></i>-->
                                                <!--                </button>-->
                                                <!--                <input data-th="Profit" class="form-control input-number  profit_update " type="number"-->
                                                <!--                    name="profit" value="{{ $details['profit']??0 }}">-->
                                                <!--                <button type="button" class="btn qty-right-plus updater_profit"-->
                                                <!--                    data-type="plus" data-field="">-->
                                                <!--                    <i class="fa fa-plus ms-0" aria-hidden="true"></i>-->
                                                <!--                </button>-->
                                                <!--            </div>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</td>-->
                                                <td>
                                                          <h4 class="table-title text-content">Enter Your Profit</h4>
                                                      <div class="input-group mb-3">
                                                          <input type="number" class="form-control form-control-sm profit_update" value="{{ $details['profit']??0 }}"   aria-describedby="button-addon2">
                                                          <button class="btn theme-bg-color view-button icon text-white fw-bold btn-sm updater_profit px-1 py-1" type="button" id="button-addon2">Update</button>
                                                       </div>
                                                </td>

                                                <td class="save-remove">
                                                    <h4 class="table-title text-content">Action</h4>
                                                    <!--<a class="save notifi-wishlist" href="javascript:void(0)">Save for later</a>-->
                                                    <a class="remove close_button remove-from-cart" href="javascript:void(0)">Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        No product found in cart
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>Cart Total</h3>
                        </div>

                        <div class="summery-contain">
                            <!--<div class="coupon-cart">-->
                            <!--    <h6 class="text-content mb-2">Coupon Apply</h6>-->
                            <!--    <div class="mb-3 coupon-box input-group">-->
                            <!--        <input type="email" class="form-control" id="exampleFormControlInput1"-->
                            <!--            placeholder="Enter Coupon Code Here...">-->
                            <!--        <button class="btn-apply">Apply</button>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <ul>
                                <li>
                                    <h4>Profit</h4>
                                    <h4 class="price">RS. {{$profit}}</h4>
                                </li>
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price">RS. {{$total}}</h4>
                                </li>

                                <!--<li>-->
                                <!--    <h4>Coupon Discount</h4>-->
                                <!--    <h4 class="price">(-) 0.00</h4>-->
                                <!--</li>-->

                                <li class="align-items-start">
                                    <h4>Shipping</h4>
                                    <h4 class="price text-end">RS. {{$delivery_charges}}</h4>
                                </li>
                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total (PKR)</h4>
                                <h4 class="price theme-color">RS. {{$total+$delivery_charges+$profit}}</h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button onclick="location.href = '{{route('checkout')}}';"
                                        class="btn btn-animation proceed-btn fw-bold">Process To Checkout</button>
                                </li>

                                <li>
                                    <button onclick="location.href = '{{url('/')}}';"
                                        class="btn btn-light shopping-button text-dark">
                                        <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection

@section('scripts')
<script type="text/javascript">

    $(".updater").click(function (e) {
        e.preventDefault();

        var ele = $(this);
        // alert(ele);
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity_update").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
    $(".updater_profit").click(function (e) {
        e.preventDefault();

        var ele = $(this);
        // alert(ele);
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                profit: ele.parents("tr").find(".profit_update").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

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

</script>
@endsection
