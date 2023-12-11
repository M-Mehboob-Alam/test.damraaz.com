@extends('layouts.app')
@section('title')
    Contact Us
@endsection
@php
                      $store = \App\Models\StoreInformation::findOrFail(1);
                  @endphp
@section('content')

      <section class="contact-section">
        <div class="container-lg">
          <div class="row gy-4 gy-xl-0 gx-0 gx-xl-4">
            <div class="col-xl-6 order-2 order-xl-1">
              <!-- Reply From Section Start -->
              <div class="replay-form round-wrap-content top-space" id="replaySection">
                <div class="title-box4">
                  <h4 class="heading">Leave a Message<span class="bg-theme-blue"></span></h4>
                </div>

                @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
                @endif
                    <form method="POST" action="{{route('frontend.contactUs.store')}}" class="custom-form form-pill">
                        @csrf
                  <div class="row g-3 g-sm-4">
                    <div class="col-sm-6">
                      <div class="input-box">
                        <label for="fName">Full Name</label>
                        <input name="name" required id="fName" type="text" class="form-control" />
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="input-box">
                        <label for="email">Email Address</label>
                        <input name="email" required id="email" type="email" class="form-control" />
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="input-box">
                        <label for="email">Phone Number</label>
                        <input maxlength="11" required  name="phone" id="number" type="number" class="form-control" />
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-box">
                        <label for="comment">Message</label>
                        <textarea name="message" required class="form-control" id="comment"  cols="30" rows="5"></textarea>
                      </div>
                    </div>

                    <div class="col-12 text-end">
                      <button type="submit" class="post-button btn btn-solid btn-sm mb-line">Submit <i class="arrow"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- Reply From Section End -->
            </div>

            <div class="col-xl-6 order-1 order-xl-2">
              <div class="address-content round-wrap-content">
                <div class="title-box4">
                  <h4 class="heading">Let's Get In Touch<span class="bg-theme-blue"></span></h4>
                </div>

                <div class="steps-wrap">
                  <div class="row">
                    <div class="col-12">
                      <div class="steps-box mt-0">
                        <span><i data-feather="map-pin"></i></span>
                        <div class="content">
                          <h4 class="title-color">Address</h4>
                          <p class="content-color">{{$store->location}}</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="steps-box">
                        <span><i data-feather="phone"></i></span>
                        <div class="content">
                          <h4 class="title-color">Contact Number</h4>
                          <p class="content-color">{{$store->phone}}</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="steps-box">
                        <span><i data-feather="mail"></i></span>
                        <div class="content">
                          <h4 class="title-color">Email Address</h4>
                          <p class="content-color">{{$store->email}}</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="steps-box">
                        <span><i data-feather="map"></i></span>
                        <div class="content">
                          <h4 class="title-color">Other Address</h4>
                          <p class="content-color">{{$store->location}}</p>
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

      <!-- Map Section Start -->
      <div class="map-section">
        <div class="row g-0">
          <div class="col-12 p-0">
            <div class="location-map">
              <iframe
                class="map-iframe"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14326300.209526515!2d48.42930294463846!3d28.760405695272553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38db52d2f8fd751f%3A0x46b7a1f7e614925c!2sPakistan!5e0!3m2!1sen!2sin!4v1694091137314!5m2!1sen!2sin"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
      <!-- Map Section End -->


@endsection
