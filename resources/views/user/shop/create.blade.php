@extends('layouts.app')
@section('title')
New Shop Requrest
@endsection


@section('content')
 <!-- Main Start -->
 <div class="main">
    <section class="page-body p-0">
      <div class="row g-0 ratio_asos">
        <div class="order-2 order-lg-1 col-lg-5">
          <div class="content-box">
            <div>

              <h5> Register Your Shop<span class="bg-theme-blue"></span></h5>
              <h4>12% Service Charges</h4>
              <p>These Information Will Public After Approval</p>
              @if ($errors->any())
              @foreach ($errors->all() as $error)
                 <div class="text-danger">{{$error}}</div>
              @endforeach
             @endif
              <form action="{{route('uploadNewShopRequest')}}" method="POST" enctype="multipart/form-data" class="custom-form form-pill">
                @csrf
                <div class="input-box">
                  <label for="full-name">Shop Display Image</label>
                  <input class="form-control" type="file" required name="image" id="full-name" />
                </div>
                <div class="input-box">
                  <label for="full-name">Shop Name</label>
                  <input class="form-control" type="text" required name="name" id="full-name" />
                </div>
                <div class="input-box">
                  <label for="full-name">Shop Province/State</label>
                  <input class="form-control" type="text" required name="province" id="full-name" />
                </div>
                <div class="input-box">
                  <label for="full-name">Shop City</label>
                  <input class="form-control" type="text" required name="city" id="full-name" />
                </div>
                <div class="input-box">
                  <label for="full-name">Shop Address</label>
                  <input class="form-control" type="text" required name="address" id="full-name" />
                </div>
                <div class="input-box">
                  <label for="full-name">Shop Contact Mobile No</label>
                  <input class="form-control" type="number" required name="mobile" id="full-name" />
                </div>
                <div class="input-box">
                  <label for="full-name">WhatsApp No</label>
                  <input class="form-control" type="number" required name="whatsapp" id="full-name" />
                </div>
                <div class="input-box">

                  <h6>Do You Have Products Available At WholeSale Rate?:</h6>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" required name="wholesale" id="inlineRadio1" value=1>
                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="wholesale" id="inlineRadio2" value=0>
                    <label class="form-check-label" for="inlineRadio2">No</label>
                  </div>
                </div>


                <button type="submit" class="btn-solid rounded-pill line-none theme-color">SignUp <i class="arrow"></i></button>

              </form>



            </div>
          </div>
        </div>
        <div class="order-1 order-lg-2 col-lg-7">
          <div class="img-box">
            {{-- <img  src="{{asset('newtheme/assets/images/inner-page/banner.jpg')}}" alt="banner" class="img-fluid"/> --}}
            <img  src="https://images.pexels.com/photos/5632402/pexels-photo-5632402.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="banner" class="img-fluid"/>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- Main End -->
@endsection
