@extends('layouts.app')
@section('title')
    Wishlist Products
@endsection
@section('content')
  {{-- <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Wishlist</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End --> --}}

    <!-- Wishlist Section Start -->
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-3 g-2">
                @if (is_null(session('wishlist')))
                <div class="container text-center">
                    <h1> Your Wishlist is empty </h1>
                    <br>

                    <a href="{{route('/')}}" class="btn btn-success">Go To Home and Add Products into wishlist</a>
                </div>
                @endif
                @if(session('wishlist'))
                    @foreach(session('wishlist') as $id => $wishlist)
                        <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain" data-id="{{ $id }}">
                        <div class="product-box-3 h-100">
                            <div class="product-header">
                                <div class="product-image">
                                    @php $image=json_decode($wishlist['images']);@endphp
                                    <a href="{{route('product.show',$id)}}">
                                        <img src="{{asset($image[0])}}" class="img-fluid blur-up lazyload" alt="">
                                    </a>
    
                                    <div class="product-header-top">
                                        <button class="btn wishlist-button close_button remove-from-wishlist">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="product-footer">
                                <div class="product-detail">
                                    <!--this is category name commented-->
                                    <!--<span class="span-name">vegetable</span>-->
                                    <a href="{{route('product.show',$id)}}">
                                        <h5 class="name">{{$wishlist['name']}}</h5>
                                    </a>
                                    <!--<h6 class="unit mt-1">250 ml</h6>-->
                                    <h5 class="price">
                                        <span class="theme-color">Rs. {{$wishlist['price']}}</span>
                                        <del>Rs. {{$wishlist['discount_price']}}</del>
                                    </h5>
    
                                    <div class="add-to-cart-box bg-white mt-2">
                                        <a href="{{route('add.to.cart',$id)}}" class="btn btn-add-cart addcart-button">Add to cart </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Wishlist Section End -->
@endsection

@section('scripts')
<script type="text/javascript">
  
    $(".remove-from-wishlist").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.wishlist') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents(".product-box-contain").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>
@endsection