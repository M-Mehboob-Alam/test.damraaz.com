@extends('layouts.app')
@section('title')
404
@endsection
@section('content')




      <!-- 404 Section Start -->
      <section class="page-not-found">
        <div class="container">
          <div class="row gx-md-2 gx-0 gy-md-0 gy-3">
            <div class="col-md-8 m-auto">
              <div class="page-image">
                <img src="{{asset('newtheme/assets/images/inner-page/404.svg')}}" class="img-fluid blur-up lazyload" alt="" />
              </div>
            </div>

            <div class="col-md-8 mx-auto mt-md-5 mt-3">
              <div class="page-container pass-forgot">
                <div>
                  <h2>page not found</h2>
                  <p class="font-md">The page you are looking for doesn't exist or an other error occurred. Go back, or head over to choose a new direction.</p>
                  <a href="{{route('/')}}" class="btn-solid mb-line">Back Home Page <i class="arrow"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- 404 Section End -->


@endsection
