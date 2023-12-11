@extends('layouts.app')
@section('title')
{{$product}} products
@endsection


@section('content')


    <!-- Dashboard Start -->
    <section class="user-dashboard">
      <div class="container-lg">
        <div class="row g-3 g-xl-4 tab-wrap">
          <div class="col-lg-4 col-xl-3 sticky">
            <button class="setting-menu btn-solid btn-sm d-lg-none">Setting Menu <i class="arrow"></i></button>
            <div class="side-bar">
              <span class="back-side d-lg-none"> <i data-feather="x"></i></span>
              <div class="profile-box">
                <div class="img-box">
                  <img class="img-fluid" src="{{asset($shop->image)}}" alt="user" />
                  <div class="edit-btn">
                    <i data-feather="edit"></i>
                    <input class="updateimg" type="file" name="img" />
                  </div>
                </div>

                <div class="user-name">
                  <h5>{{$shop->name}}</h5>
                  <h6>{{$shop->address}}</h6>
                </div>
              </div>

              <ul class="nav nav-tabs nav-tabs2" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a href="{{route('shopDetails')}}" class="nav-link active" id="dashboard-tab"  role="tab" aria-controls="dashboard" aria-selected="true">
                    Dashboard
                    <span><i data-feather="chevron-right"></i></span>
                  </a>
                </li>

              </ul>
            </div>
          </div>

          <div class="col-lg-8 col-xl-9">
            <div class="right-content tab-content" id="myTabContent">







              <!-- Saved Address Tabs End -->

              <!-- Payment Tabs Start -->
              <div class="tab-pane active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                <div class="payment-tab">
                  <div class="d-flex align-items-start align-items-sm-center justify-content-between title-box3">
                    <div>
                      <h3>Your {{$product}} Products {{$products->count()}}</h3>

                    </div>
                    {{-- <button class="btn btn-outline btn-sm white-space-no" data-bs-toggle="modal" data-bs-target="#addNewcard">Add Card</button> --}}
                  </div>

                  <div class="payment-section">
                    <div class="row g-3 g-xl-4">

                        @foreach ($products as $pro)
                        <div class="col-sm-6 col-xl-6">
                            <div class="payment-card bg-theme-blue border-color-blue">
                                <a href="{{route('editUserProduct', ['product'=>$pro->id])}}"> <i data-feather="edit"></i></a>
                                <a href="{{route('deleteUserProduct', ['product'=>$pro->id])}}"><i data-feather="trash"></i></a>
                              <div class="bank-info" style="height: 100px">
                                <a href="{{asset($pro->image)}}" target="_blank">
                                <img class="bank" style="height: 50px; width:50px; object-fit:contain;" src="{{asset($pro->image)}}" />
                            </a>
                              </div>
                              <div class="product_imagess" style="height: 100px">
                                @if (!is_null($pro->images))
                                @foreach (json_decode($pro->images) as $item)
                                <a href="{{asset($item)}}" target="_blank">
                                  <img src="{{asset($item)}}" style="width: 100px; height:50px; object-fit:contain; padding:5px;"  alt="">
                                </a>
                                @endforeach
                                @endif
                              </div>



                              <div class="card-details">
                                <h3>{{$pro->name}}
                                    @if ( $pro->isMegaSale)

                                    <span class="text-light p-1 bg-danger">Mega Sale</span>
                                    @endif
                                </h3>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                  </svg> Cat: <b>{{$pro->category->name}}</b></h5>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                  </svg> Quantity: <b>{{$pro->quantity}}</b></h5>
                                <h5> Product Status : <b>{{$pro->status}}</b></h5>
                                <h5>Status: <b>@if ($pro->isActive)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                      </svg>  Show
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                  </svg> Not Show
                                @endif</b></h5>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                  </svg> Price Rs.{{$pro->price}}</h5>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                                    <path d="M0 5a5.002 5.002 0 0 0 4.027 4.905 6.46 6.46 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05c0-.046 0-.093.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.46 3.46 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98c-.003.046-.003.097-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5zm16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0zm-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787H8.25zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674l.077.018z"/>
                                  </svg> Sale Price Rs.{{$pro->discount_price}}</h5>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                  </svg> <b>Delivery Days </b> <br>{{$pro->delivery_days}}</h5>
                                <h5><b>Delivery Charges Rs.</b> <br>{{$pro->delivery_charges}}</h5>
                                <h5><b>Offer:</b> <br>{{$pro->offer}}</h5>
                                <h5><b>Deals:</b> <br>{{$pro->deal}}</h5>
                                <h5><b>Short Description:</b> <br>{{$pro->info}}</h5>
                                <h5><b>Long Description.</b> <br>{{$pro->detail}}</h5>
                              </div>
                            </div>
                          </div>
                        @endforeach



                    </div>
                  </div>
                </div>
              </div>
              <!-- Payment Tabs End -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Dashboard End -->


@endsection
