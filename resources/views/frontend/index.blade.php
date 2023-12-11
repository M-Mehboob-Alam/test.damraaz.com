
@extends('layouts.app')
@section('title')
    {{ 'Home' }}
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <!-- Swiper Slider Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css">

    <style>
        .custom-slider{
    width: 90%;
    margin: auto;
}

        .change-custom-slider{
    /* width: 90%;
    margin: auto; */
}
.custom-box{
  width: 200px;
  height: 200px;
  text-align:center;
  box-shadow: 2px 2px 3px gray;
  margin: 15px;
  /* font-size: 5em; */
  /* padding: 10px; */
}
.change-custom-box{
  width: 200px;
  height: 300px;
  text-align:center;
  box-shadow: 2px 2px 3px gray;
  margin: 15px;
  /* font-size: 5em; */
  /* padding: 10px; */
}
.slick-prev, .slick-next{
  position: absolute;
  line-height: 0;
  top: 50%;
  width: 30px;
  height: 30px;
  display: block;
  padding: 0;
  -webkit-transform: translate(0, -50%);
  transform: translate(0, -50%);
  cursor: pointer;
  color: transparent;
  border: none;
  outline: none;
  border-radius: 50px;
  background: #043e46;
}
.slick-slider{
  user-select: none;
}
.slick-next{
  right: 2px;
}
.slick-prev{
  left: -4px;
  z-index: 1;
}
.slick-next:before{
  content: '\003e';
  font-size: 1.2em;
  font-weight: 1000;
  padding-left: 12px;
  color: white;
}
.slick-prev:before{
  content: '\003c';
  font-size: 1.2em;
  font-weight: 1000;
  padding-left: 9px;
  color: white;
}

@media only screen and (max-width:550px){
    .change-custom-box{
    height: 210px;
    }
    ._img_box{
        height: 100px !important;
    }

}
    </style>




    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($sliders as $key => $slider)
                @if ($key == 0)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                @else
                    <button type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide-to="{{ $key }}" aria-label="Slide {{ $key + 1 }}"></button>
                @endif
            @endforeach

        </div>
        <div class="carousel-inner">
            @foreach ($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="...">
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- <section class="pb-0 ratio_asos">
        <div class="container-lg">
            <div class="title-box">
                <h2 class="unique-heading">Our Catalog </h2>
                <span class="title-divider1"><span class="squre"></span><span class="squre"></span></span>

                <p>The best Categories to change your style.</p>

            </div>


        </div>


        </div>
        </div>
    </section>

    <div class="custom-slider"  >

        @foreach ($categories as $kia => $item)


        <div class="custom-box" >
            <a href="{{route('category.show', ['id'=>$item->slug])}}">
            <h3 class="py-2">{{$item->name}}</h3>
            <img src="{{asset($item->image)}}" alt="" style="height: 100%; width:100%">
            </a>
        </div>

        @endforeach

    </div> --}}

      <!-- New Arrived Section Start -->
      <section class="pb-0 ratio_asos">
        <div class="container-lg">
            <div class="title-box">
                <h2 class="unique-heading">NEW ARRIVALS </h2>
                <span class="title-divider1"><span class="squre"></span><span class="squre"></span></span>

                <p>The best ways to change your style.</p>

                <h3><a href="{{ route('frontend.all_product') }}">View All</a></h3>
            </div>


        </div>


        </div>
        </div>
    </section>
    <!-- New Arrived Section End -->


    <div class="custom-slider"  >


        @forelse($newProducts as $product)
        <div class="change-custom-box">
            <div class="product-card">
                <div class="img-box _img_box" style="height: 200px; width:auto;">

                    <a href="{{ route('product.show',  $product->slug) }}" class="primary-img"><img
                            class=" bg-img" src="{{ asset($product->image) }}"
                            alt="product" style="height:100%; width:100%; object-fit:contain" /> </a>

                </div>

                <!-- Content Box -->
                <div class="content-box text-center">
                    <a href="{{ route('product.show', $product->slug) }}">
                        <p>Category: {{ $product->category->name }}</p>
                        <h5 class="text-center px-2">{{ $product->name }}</h5>
                        @if (is_null($product->discount_price))
                            <span>Rs.{{ $product->price }}</span>
                        @else
                            <span>Rs.{{ $product->discount_price }}</span>
                            <del>Rs.{{ $product->price }}</del>
                        @endif

                    </a>
                    {{-- <a href="javascript:void(0)" class="btn btn-solid btn-sm mb-line addtocart-btn">Add To Cart <i class="arrow"></i> </a> --}}
                </div>
            </div>
        </div>
    @empty
        No Product found
    @endforelse


    </div>

    <!-- Top Product Section Start -->
    <section class="pb-0 mb-5">
        <div class="container-lg">
            <div class="title-box">
                <h2 class="unique-heading">All Products</h2>
                <span class="title-divider1"><span class="squre"></span><span class="squre"></span></span>
                <p>A conscious collection made entirely sustainable
                    materials.</p>
            </div>

        </div>
    </section>
    <div class="container text-center my-2">
        <h5><a href="{{ route('frontend.all_product') }}">View All Products</a></h5>
    </div>

    <div class="container">
        <div class="row"  >


            @forelse($products as $product)
            <div class="col-6 col-md-4 col-lg-3 mt-3">
                <div class="product-card">
                    <div class="img-box _img_box" style="height: 200px; width:auto;">

                        <a href="{{ route('product.show',  $product->slug) }}" class="primary-img"><img
                                class=" bg-img" src="{{ asset($product->image) }}"
                                alt="product" style="height:100%;width:100%;object-fit:contain" /> </a>

                    </div>

                    <!-- Content Box -->
                    <div class="content-box text-center">
                        <a href="{{ route('product.show',  $product->slug) }}">
                            <p>Category: {{ $product->category->name }}</p>
                            <h5 class="text-center px-2">{{ $product->name }}</h5>
                            @if (is_null($product->discount_price))
                                <span>Rs.{{ $product->price }}</span>
                            @else
                                <span>Rs.{{ $product->discount_price }}</span>
                                <del>Rs.{{ $product->price }}</del>
                            @endif

                        </a>
                        {{-- <a href="javascript:void(0)" class="btn btn-solid btn-sm mb-line addtocart-btn">Add To Cart <i class="arrow"></i> </a> --}}
                    </div>
                </div>
            </div>
        @empty
            No Product found
        @endforelse


        </div>
    </div>




    <div class="container text-center my-5">
        <h5><a href="{{ route('frontend.all_product') }}">View All Products</a></h5>
    </div>
    <!-- New Arrived Section End -->

    <!-- Swiper Slider Js -->
    {{-- <script src="{{ asset('newtheme/assets/js/swiper-slider/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('newtheme/assets/js/swiper-slider/swiper-custom.min.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}

    {{-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script> --}}
    {{-- <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> --}}
    {{-- <script type="text/javascript" src="slick/slick.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> --}}



<script type="text/javascript">
const $jq = jQuery.noConflict();
$jq(document).ready(function(){
    // alert('working');
    $jq('.custom-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
        {
            breakpoint: 1200,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: false
            }
        },
        {
            breakpoint: 900,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: false
            }
        },
        {
            breakpoint: 550,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: false
            }
        }
        ]
        });
    $jq('.change-custom-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
        {
            breakpoint: 1200,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: false
            }
        },
        {
            breakpoint: 900,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: false
            }
        },
        {
            breakpoint: 550,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: false
            }
        }
        ]
        });
    });
  </script>
@endsection

