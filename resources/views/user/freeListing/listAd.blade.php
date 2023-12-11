@extends('layouts.app')
@section('title')
    Ad List
@endsection

@section('content')

<section class="contact-section">

    <div class="container-lg">
        {{-- <h2 class="text-center">Ad Show</h2> --}}
        
      <div class="row gy-2 gy-xl-0 gx-0 gx-xl-4">
      
        @if($ad)
        {{-- @if($ad->images)
        @foreach(json_decode($ad->images) as $image)
            <img src="{{ asset('images/listing/' . $image) }}" class="d-block w-100" alt="Ad Image">
        @endforeach
    @endif --}}
    <div class="row">
        <div class="col-md-7">
        
                {{-- <div id="myCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                  <div class="carousel-inner">
                     @if($ad->images)
                        @foreach(json_decode($ad->images) as $image)
                            <div class="carousel-item active">
                              <img src="{{ asset('images/listing/'. $image) }}" class="d-block w-100" alt="Ad Image">
                            </div>
                        @endforeach
                    @endif
                   
              
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div> --}}
                <div id="carouselExampleIndicators" class="carousel slide mb-3" data-bs-ride="carousel" style="height: 400px; overflow: hidden;">
                  <div class="carousel-indicators">
                      @if($ad->images)
                          @foreach(json_decode($ad->images) as $key => $image)
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" @if($key === 0) class="active" @endif aria-label="Slide {{ $key + 1 }}"></button>
                          @endforeach
                      @endif
                  </div>
                  <div class="carousel-inner">
                      @if($ad->images)
                          @foreach(json_decode($ad->images) as $key => $image)
                              <div class="carousel-item @if($key === 0) active @endif" style="height: 400px;">
                                  <img src="{{ asset('images/listing/'. $image) }}" class="d-block w-100 h-100" alt="Ad Image" style="object-fit: fill;">
                              </div>
                          @endforeach
                      @endif
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                  </button>
              </div>
              
              
                {{-- carousel end --}}
                <div class="ad-details border border-1 mb-3">
                  <div class="row p-2 m-2">
                    <h1 class="mb-3">Rs {{ $ad->item_price }}</h1>
                  <h3 class="mb-2">{{ $ad->item_title }}</h3>
                  <h5>{{ $ad->address.', '.$ad->city }}</h5>
                  </div>  
                </div>
                <div class="border border-1 mb-3">
                  <div class="row p-2 m-2">
                    <h2 class="mb-2">Details</h2>
                    <div class="d-flex justify-content-between">
                      <div>
                          <h4>Item Title: <span>{{ $ad->item_title }}</span></h4>
                      </div>
                      <div>
                          <h4>Price: <span>{{ $ad->item_price }}</span></h4>
                      </div>
                  </div>
                  
                    </div>
                  
                </div>
                <div class="border border-1 mb-3">
                  <div class="row p-2 m-2">
                    <h2 class="mb-2">Description</h2>
              
                  <h5>{{ $ad->item_description }}</h5>
    
                  </div>
                  
                </div>
                {{-- <div class="card-body">
                  <h2 class="card-title">Rs {{ $ad->item_price }}</h2>
                  
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item mb-2">{{ $ad->item_title }}</li>
                </ul>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item mb-2">{{ $ad->city }}</li>
                  </ul>
             
              <div class="card w-75 mt-2">
                <div class="card-body">
                  <h2 class="card-title">Description</h2>
                  <p class="card-text">{{ $ad->item_description }}</p>
    
                </div>
              </div> --}}
         
        </div>
        <div class="col-md-5">
            <div class="ad-details border border-1 mb-3">
              <div class="row p-2 m-2">
                <h2 class="mb-3">Seller Name: {{ $ad->user->name }}</h2>
              <h5>Contact Number: {{ $ad->user->phone }}</h5>
              </div>  
            </div>
            <div class="ad-details border border-1 mb-3">
              <div class="row p-2 m-2">
                <h2 class="mb-3">Location</h2>
                <div>
                  <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024" class="cc9ef69b"><path d="M512 85.33c211.75 0 384 172.27 384 384 0 200.58-214.8 392.34-312.66 469.34H440.68C342.83 861.67 128 669.9 128 469.33c0-211.73 172.27-384 384-384zm0 85.34c-164.67 0-298.67 133.97-298.67 298.66 0 160.02 196.89 340.53 298.46 416.6 74.81-56.72 298.88-241.32 298.88-416.6 0-164.69-133.98-298.66-298.67-298.66zm0 127.99c94.1 0 170.67 76.56 170.67 170.67s-76.56 170.66-170.66 170.66-170.67-76.56-170.67-170.66S417.9 298.66 512 298.66zm0 85.33c-47.06 0-85.33 38.28-85.33 85.34s38.27 85.33 85.34 85.33 85.33-38.27 85.33-85.33-38.27-85.34-85.33-85.34z"></path></svg>
                  {{ $ad->address.', '.$ad->city }}</h5>
                </div>
              {{-- <h5>Contact Number: {{ $ad->user->phone }}</h5> --}}
              </div>  
            </div>
        </div>
    </div>
@endif
      
      </div>
    </div>
  </section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
      // alert('hi1');

      // var myCarousel = document.querySelector('#myCarousel')
      // var carousel = new bootstrap.Carousel(myCarousel)

  </script>
@endsection