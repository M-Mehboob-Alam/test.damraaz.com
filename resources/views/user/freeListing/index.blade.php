@extends('layouts.app')
@section('title')
    Ads Listing
@endsection
@section('content')

{{-- <section class="contact"> --}}
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form action="{{ route('searchAds') }}" method="GET" class="d-flex w-100">
                        <div class="input-group me-2">
                            <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                        <div class="flex-grow-1"></div>
                        <div>
                            <a href="{{ Auth::check() ? route('listing.create') : route('login') }}" class="btn btn-outline-success">
                                {{ Auth::check() ? 'Upload Ad' : 'Upload Ad' }}
                            </a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </nav>
    
        <div class="row gy-xl-0 gx-0 gx-xl-4">
            <div class="container mt-5">
                <h1 class="text-center mb-4">All Ads</h1>
                <div class="row row-cols-md-3 g-3">
                    <!-- Loop through your filtered ads data and create a card for each ad -->
                    @foreach($ads as $ad)
                    <div class="col-md-3">
                       <a href="{{route('listing.show',$ad->id)}}">
                        <div class="card">
                            <!-- Assuming $ad contains information about each ad -->
                            <img src="{{ asset('images/listing/' . $ad->image) }}" class="card-img-top" alt="Ad Image" width="100%" height="300px">
                            <div class="card-body">
                                <h3 class="card-text">Rs {{ $ad->item_price }}</h3>
                                <h4 class="card-title">{{ $ad->item_title }}</h4>
                                {{-- <p class="card-text">{{ $ad->item_description }}</p> --}}
                                
                                <h6 class="card-text">{{ $ad->city }}</h6>
                                <!-- Add any other relevant ad information here -->
                            </div>
                        </div>
                       </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
  {{-- </section> --}}
{{-- @endsection
@section('javascript') --}}
<!-- Include Dropzone.js CSS -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
      
  </script>
@endsection