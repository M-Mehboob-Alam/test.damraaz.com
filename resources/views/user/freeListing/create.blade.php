@extends('layouts.app')
@section('title')
    Free Listing
@endsection
@section('content')

<section class="contact-section">
    <div class="container-lg">
      <div class="row gy-4 gy-xl-0 gx-0 gx-xl-4">
        <div class="col-xl-12 order-2 order-xl-1">
          <!-- Reply From Section Start -->
          <div class="replay-form round-wrap-content top-space" id="replaySection">
            <div class="title-box4">
              <h4 class="heading">Upload New Ad<span class="bg-theme-blue"></span></h4>
            </div>

            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
            @endif
                <form method="POST" action="{{route('listing.store')}}" class="custom-form form-pill" class="dropzone" id="my-dropzone" enctype="multipart/form-data">
                    @csrf
              <div class="row g-3 g-sm-4">
                <div class="col-sm-12">
                  <div class="input-box">
                    <label for="item_title">Item Title <span class="text-danger">*</span></label>
                    <input name="item_title" required id="item_title" type="text" class="form-control" />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="input-box">
                    <label for="item_price">Item Price <span class="text-danger">*</span></label>
                    <input name="item_price" required id="item_price" type="number" class="form-control" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-box">
                    <label for="comment">Description <span class="text-danger">*</span></label>
                    <textarea name="item_description" required class="form-control" id="item_description"  cols="30" rows="5"></textarea>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="input-box">
                    <label for="email">Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="image" required class="form-control"/>
               
                    {{-- <input maxlength="11" required  name="phone" id="number" type="number" class="form-control" /> --}}
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="input-box">
                    <label for="email">Images <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="images[]" id="images" multiple>
    
                  </div>
                </div>
               
              

           
                <div class="col-sm-12">
                  <div class="input-box">
                    <label for="email">City <span class="text-danger">*</span></label>
                    <input type="text" name="city" required id="city" class="form-control" />
                  </div>
                </div>
             
                <div class="col-12">
                  <div class="input-box">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    <textarea name="address" required class="form-control" id="address"  cols="20" rows="3"></textarea>
                  </div>
                </div>

                <div class="col-12 text-end">
                  <button type="submit" class="post-button btn btn-solid btn-sm mb-line">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <!-- Reply From Section End -->
        </div>

      
      </div>
    </div>
  </section>
{{-- @endsection
@section('javascript') --}}
<!-- Include Dropzone.js CSS -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
      // alert('hi1');



  </script>
@endsection