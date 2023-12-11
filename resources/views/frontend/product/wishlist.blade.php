@extends('layouts.app')
@section('title')
    Wishlist Products
@endsection
@section('content')
 
        <!-- Shop Section Start -->
        <section class="shop-page">
            <div class="container-lg">
              <div class="row gy-4 g-lg-3 g-xxl-4">
                <div class="col-12">
                  <div class="row gy-5 gx-0">
                    <div class="col-12 order-2 order-lg-1">
                      <div class="round-wrap-content p-0 overflow-hidden">
                        <!-- Banner Start -->
                        <div class="sub-banner">
                          {{-- <img class="bg-img img-fluid" src="{{asset($category->image)}}" alt="banner" /> --}}
                          <div class="heading-box">
                            <div class="title-box4">
                              <h2 class="heading text-center">Wishlist Products <span class="bg-theme-blue"></span></h2>

                            </div>

                          </div>
                        </div>
                        <!-- Banner End -->
                      </div>
                    </div>
                    <div class="col-12 order-1 order-lg-2">
                      <div class="shop-product">
                        <div class="top-header-wrap">
                          <div class="grid-option-wrap">

                              <div class="select-menu">
                                  <form method="get" action="{{ route('frontend.all_product') }}" class="input-group">
                                      <input type="text" name="name" value="{{ request()->name }}"
                                          class="form-control" placeholder="Search by name"
                                          aria-label="Example text with button addon">
                                      <input type="number" name="min_price" value="{{ request()->min_price }}"
                                          class="form-control" placeholder="min price"
                                          aria-label="Example text with button addon">
                                      <input type="number" name="max_price" value="{{ request()->max_price }}"
                                          class="form-control" placeholder="max price"
                                          aria-label="Example text with button addon">
                                      <select class="form-control" name="sort" aria-label="Default select example">
                                          <option selected disabled>Sort By</option>
                                          <option value="lowToHigh" {{ request()->sort == 'lowToHigh' ? 'selected' : '' }}>
                                              Low
                                              To High</option>
                                          <option value="highToLow" {{ request()->sort == 'highToLow' ? 'selected' : '' }}>
                                              High
                                              To Low</option>
                                      </select>
                                      <button class="btn theme-bg-color text-white m-0" type="submit"
                                          id="button-addon1">Search</button>
                                  </form>


                            </div>

                          </div>
                        </div>

                        <div class="product-tab-content">
                          <div class="view-option row g-3 g-xl-4 ratio_asos row-cols-2 row-cols-sm-3 row-cols-xl-4 grid-section">
                            @if (is_null(session('wishlist')))
                            <div class="container text-center">
                                <h1> Your Wishlist is empty </h1>
                                <br>
            
                                <a href="{{route('/')}}" class="btn btn-success">Go To Home and Add Products into wishlist</a>
                            </div>
                            @endif
                            @if(session('wishlist'))
                              @foreach(session('wishlist') as $id => $wishlist)
                              <div>
                                  <div class="product-card">
                                    <div class="img-box">

                                      <a href="{{route('product.show',['id'=>$id])}}" class="primary-img"><img class="img-fluid bg-img" src="{{asset($wishlist['images'])}}" alt="product" /> </a>

                                    </div>

                                    <!-- Content Box -->
                                    <div class="content-box">
                                      <a href="{{route('product.show',['id'=>$id])}}">
                                       
                                        <h5>{{$wishlist['name']}}</h5>
                                        @if (is_null($wishlist['discount_price']))

                                        <span>Rs.{{$wishlist['discount_price']}}</span>
                                        @else
                                        <span>Rs.{{$wishlist['discount_price']}}</span> <del>Rs.{{$wishlist['price']}}</del>

                                        @endif

                                      </a>
                                      {{-- <a href="javascript:void(0)" class="btn btn-solid btn-sm mb-line addtocart-btn">Add To Cart <i class="arrow"></i> </a> --}}
                                    </div>
                                  </div>
                                </div>
                         
                          @endforeach
                          @endif

                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>


 
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