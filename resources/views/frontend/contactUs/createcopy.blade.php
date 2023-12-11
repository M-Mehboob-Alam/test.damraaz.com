@extends('layouts.app')
@section('title')
    Contact Us
@endsection
@section('content')

      <section class="contact-section">
        <div class="container-lg">
          <div class="row gy-4 gy-xl-0 gx-0 gx-xl-4">
            <div class="col-xl-6 order-2 order-xl-1">
              <!-- Reply From Section Start -->
              <div class="replay-form round-wrap-content top-space" id="replaySection">
                <div class="title-box4">
                  <h4 class="heading">Leave a Comment<span class="bg-theme-blue"></span></h4>
                </div>

                <form action="javascript:void(0)" class="custom-form form-pill">
                  <div class="row g-3 g-sm-4">
                    <div class="col-sm-6">
                      <div class="input-box">
                        <label for="fName">First Name</label>
                        <input name="fName" id="fName" type="text" class="form-control" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input-box">
                        <label for="lName">Last Name</label>
                        <input name="lName" id="lName" type="text" class="form-control" />
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="input-box">
                        <label for="email">Email Address</label>
                        <input name="email" id="email" type="email" class="form-control" />
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="input-box">
                        <label for="email">Phone Number</label>
                        <input maxlength="9" name="email" id="number" type="number" class="form-control" />
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-box">
                        <label for="comment">Comments</label>
                        <textarea name="comment" class="form-control" id="comment" cols="30" rows="5"></textarea>
                      </div>
                    </div>

                    <div class="col-12 text-end">
                      <button class="post-button btn btn-solid btn-sm mb-line">Post Comment <i class="arrow"></i></button>
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
                          <p class="content-color">1418 Riverwood Drive, Suite 3245 Cottonwood, CA 96052, United States</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="steps-box">
                        <span><i data-feather="phone"></i></span>
                        <div class="content">
                          <h4 class="title-color">Contact Number</h4>
                          <p class="content-color">+91 123 - 456 - 7890</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="steps-box">
                        <span><i data-feather="mail"></i></span>
                        <div class="content">
                          <h4 class="title-color">Email Address</h4>
                          <p class="content-color">fashion098@gmail.com</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="steps-box">
                        <span><i data-feather="map"></i></span>
                        <div class="content">
                          <h4 class="title-color">Other Address</h4>
                          <p class="content-color">ABC Complex,Near xyz, New York USA 123456</p>
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
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7227.225249699896!2d55.17263937326456!3d25.081115462415855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1632538854272!5m2!1sen!2sin"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
      <!-- Map Section End -->
   
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Contact Us</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Box Section Start -->
    <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-image">
                                    <img src="../assets/images/inner-page/contact-us.png"
                                        class="img-fluid blur-up lazyloaded" alt="">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact-title">
                                    <h3>Get In Touch</h3>
                                </div>

                                <div class="contact-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-phone"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Phone</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>(+1) 618 190 496</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Email</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>geweto9420@chokxus.com</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>London Office</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>Cruce Casa de Postas 29</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-building"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Bournemouth Office</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>Visitación de la Encina 22</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    @if ($errors->any())
                         @foreach ($errors->all() as $error)
                             <div class="alert alert-danger">{{$error}}</div>
                         @endforeach
                     @endif
                    <div class="title d-xxl-none d-block">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="right-sidebar-box">
                        <form method="POST" action="{{route('frontend.contactUs.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlInput" class="form-label"> Name</label>
                                    <div class="custom-input">
                                        <input type="text" name="name" required class="form-control" id="exampleFormControlInput"
                                            placeholder="Enter  Name">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="col-xxl-6 col-lg-12 col-sm-6">-->
                            <!--    <div class="mb-md-4 mb-3 custom-form">-->
                            <!--        <label for="exampleFormControlInput1" class="form-label">Last Name</label>-->
                            <!--        <div class="custom-input">-->
                            <!--            <input type="text" class="form-control" id="exampleFormControlInput1"-->
                            <!--                placeholder="Enter Last Name">-->
                            <!--            <i class="fa-solid fa-user"></i>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlInput2" class="form-label">Email Address</label>
                                    <div class="custom-input">
                                        <input type="email"  name="email" required class="form-control" id="exampleFormControlInput2"
                                            placeholder="Enter Email Address">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlInput3" class="form-label">Phone Number</label>
                                    <div class="custom-input">
                                        <input type="tel" class="form-control" required  name="phone" id="exampleFormControlInput3"
                                            placeholder="Enter Your Phone Number" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                            this.value.slice(0, this.maxLength);">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="exampleFormControlTextarea" class="form-label">Message</label>
                                    <div class="custom-textarea">
                                        <textarea class="form-control" required id="exampleFormControlTextarea"
                                            placeholder="Enter Your Message" rows="6"  name="message"></textarea>
                                        <i class="fa-solid fa-message"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-animation btn-md fw-bold ms-auto">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Box Section End -->

    <!-- Map Section Start -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="map-box">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d2994.3803116994895!2d55.29773782339708!3d25.222534631321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m5!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai%20-%20United%20Arab%20Emirates!3m2!1d25.2048493!2d55.2707828!4m0!5e1!3m2!1sen!2sin!4v1652217109535!5m2!1sen!2sin"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Map Section End -->
@endsection