@extends('layouts.app')
@section('title')
    About Us
@endsection
@php
                      $store = \App\Models\StoreInformation::findOrFail(1);
                  @endphp
@section('content')
  <!-- Main Start -->
  <main class="main about-us-page">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
      <div class="banner">
        {{-- <img class="bg-img bg-top" src="../assets/images/inner-page/banner-p.jpg" alt="banner" /> --}}
        <div class="container-lg">
          <div class="breadcrumb-box">
            <div class="heading-box">
              <h1>About Us</h1>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- About Us Section Start -->
    <section class="about-section">
      <div class="container-lg">
        <div class="row g-0 g-lg-4 g-xl-5">
          <div class="col-lg-12 ">
            <div class="align-ment">
              <div class="contenten-wrap">
                <div class="content-box">
                  <h5>Welcome To Damraaz</h5>
                  <h4>We Provide Latest Style, Unique Innovation and Creativity</h4>

                  <p>
                    Damraaz is a Professional ecommerce Platform. Here we will provide you only interesting content, which you will like very much. We're dedicated to providing you the best of ecommerce, with a focus on dependability and Selling. We're working to turn our passion for ecommerce into a booming online website. We hope you enjoy our ecommerce as much as we enjoy offering them to you.

                    I will keep posting more important posts on my Website for all of you. Please give your support and love.
                  </p>
                </div>
                <div class="row g-3 g-lg-2 g-xl-3 widget-list">
                  <div class="col-6 col-sm-4">
                    <div class="widget">
                      <span><i data-feather="users"></i></span>

                      <div>
                        <h6>328M</h6>
                        <p>Register</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-sm-4">
                    <div class="widget">
                      <span><i data-feather="shopping-bag"></i></span>

                      <div>
                        <h6>20,000+</h6>
                        <p>Seller</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-sm-4">
                    <div class="widget">
                      <span><i data-feather="shopping-cart"></i></span>

                      <div>
                        <h6>70,000+</h6>
                        <p>Daily Orders</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-sm-4">
                    <div class="widget">
                      <span><i data-feather="tv"></i></span>

                      <div>
                        <h6>200M</h6>
                        <p>Daily Page visit</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-sm-4">
                    <div class="widget">
                      <span><i data-feather="graph"></i></span>

                      <div>
                        <h6>80%</h6>
                        <p>Growth Per Year</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-sm-4">
                    <div class="widget">
                      <span><i data-feather="award"></i></span>

                      <div>
                        <h6>500+</h6>
                        <p>Top Brands</p>
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
    <!-- About Us Section End -->




    <!-- Service Section Start -->
    <section class="service-section2 about-service about-section">
      <div class="container-lg">
        <div class="title-box">
          <h4 class="unique-heading">We are offering</h4>
          <span class="title-divider1"><span class="squre"></span><span class="squre"></span></span>
          <p>We provide different type of service for purchased product on our site</p>
        </div>

        <div class="row g-3 g-lg-4">
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>Affiliate Program</h5>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>Drop Shipping</h5>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>Product Branding</h5>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>Free Signup Earning</h5>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>Free Training System</h5>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>Sale Product Earn Commission</h5>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>LMS , Direct Sale</h5>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>Sale Target Reward</h5>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service-box">
              <div class="media">
                <span class="svg-wrap">
                  <svg>
                    <use xlink:href="../assets/icons/svg/service/_sprite.svg#truck"></use>
                  </svg>
                </span>
                <div class="media-body">
                  <h5>Any issue, Return Product available</h5>

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- Service Section End -->

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
  </main>
  <!-- Main End -->
    {{-- <section class="contact-box-section">
        <div class="container">
            <h2>About Us!</h2>
            <h3 style="text-align: center;">Welcome To <span id="W_Name1">Damraaz</span></h3>
            <p><span id="W_Name2">Damraaz</span> is a Professional <span id="W_Type1">ecommerce</span> Platform. Here we
                will provide you only interesting content, which you will like very much. We're dedicated to providing you
                the best of <span id="W_Type2">ecommerce</span>, with a focus on dependability and <span
                    id="W_Spec">Selling</span>. We're working to turn our passion for <span id="W_Type3">ecommerce</span>
                into a booming <a href="https://www.blogearns.com/2021/05/free-about-us-page-generator.html" rel="do-follow"
                    style="color: inherit; text-decoration: none;">online website</a>. We hope you enjoy our <span
                    id="W_Type4">ecommerce</span> as much as we enjoy offering them to you.</p>
            <p>I will keep posting more important posts on my Website for all of you. Please give your support and love.</p>
            <p style="font-weight: bold; text-align: center;">Thanks For Visiting Our Site<br><br>
                <span style="color: blue; font-size: 16px; font-weight: bold; text-align: center;">Have a nice day!</span>
            </p>

        </div>
        <div class="container-fluid-lg">
            <ul class="list-group col-6 mx-auto">
                <h3 class="my-2">We are offering</h3>
                <li class="list-group-item">Affiliate Program</li>
                <li class="list-group-item">Drop Shipping</li>
                <li class="list-group-item">Product Branding</li>
                <li class="list-group-item">Free Signup Earning</li>
                <li class="list-group-item">Free Training System</li>
                <li class="list-group-item">Sale Product Earn Commission</li>
                <li class="list-group-item">LMS , Direct Sale</li>
                <li class="list-group-item">Sale Target Reward</li>
                <li class="list-group-item">Any issue, Return Product available</li>
            </ul>
        </div>
    </section> --}}
@endsection
