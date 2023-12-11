@extends('layouts.app')
@section('title')
    Product Bundles
@endsection


@section('content')
    <!-- Main Start -->
    <div class="main">
        <section class="page-body p-0">



            <h1 class="text-center">Product Bundles</h1>
            <br>
            <div class="container mt-3">
                <div class="row">
                    @foreach ($bundles as $item)
                        <div class="card col-xs-12 col-sm-6 col-md-4 ">
                            <div class="card-img">
                                <a href="{{ asset($item->photo) }}" target="_blank">
                                <img class="card-img-top rounded" style="object-fit: cover"
                                    src="{{ asset($item->photo) }}"
                                    alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body shadow rounded">
                                <h3 class="card-title font-weight-bold text-capitalize">{{ $item->name }}</h3>
                                <h4 class="card-text">Price <span class="bolding"></span> Rs.{{ $item->price }}</h4>
                                {{-- <h4 class="card-text">Commission Rs.{{ $item->commission }}</h4> --}}
                                <h4 class="card-text">Points {{ $item->points }}</h4>
                                <a href="{{ route('buyNowProductBundle', $item->id) }}" class="btn btn-primary mt-2">Buy Now</a>
                                <a href="{{ route('productBundleDetail', $item->id) }}" class="btn btn-primary mt-2">View Details</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

    </div>

    </div>
    </section>
    </div>
    <!-- Main End -->
    <style>
        .card-img {
            padding-top: 100%;
            position: relative;
        }
        .card-text{
            /* font-size: 1.2rem; */
        }

        .card {
            border: none !important;
            margin-bottom: 20px !important;
        }

        .card-img-top {
            height: 100%;
            width: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
        }
        h4{
            font-weight: 400;
        }
    </style>
    {{-- <style>
 @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap');



.main_card_wraper {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  width: 95vw !important;
}
.main_card_wraper h1{
 font-size: 2rem;
}

.card-basic,
.card-premium,
.card-standard {
  margin: 0 2rem 1rem 0;
  padding: 0 0 0.5rem 0;
  width: 20rem;
  background: #fff;
  color: #444;
  text-align: center;
  border-radius: 1rem;
  box-shadow: 0.5rem 0.5rem 1rem rgba(51, 51, 51, 0.2);
  overflow: hidden;
  transition: all 0.1ms ease-in-out;
}
.card-basic:hover,
.card-premium:hover,
.card-standard:hover {
  transform: scale(1.02);
}

.card-header {
  height: 7rem;
  text-transform: uppercase;
  font-weight: 700;
  font-size: 0.8rem;
  padding: 1rem 0;
  color: #fff;
  clip-path: polygon(0 0, 100% 0%, 100% 85%, 0% 100%);
}

.header-basic,
.btn-basic {
  background: linear-gradient(135deg, rgb(0, 119, 238), #06c766);
}

.header-standard,
.btn-standard {
  background: linear-gradient(135deg, #b202c9, #cf087c);
}

.header-premium,
.btn-premium {
  background: linear-gradient(135deg, #eea300, #ee5700);
}

.card-body {
  padding: 0.5rem 0;
}
.card-body h2 {
  font-size: 2rem;
  font-weight: 700;
}

.card-element-container {
  color: #444;
  list-style: none;
}

.btn {
  margin: 0.5rem 0;
  padding: 0.7rem 1rem;
  outline: none;
  border-radius: 1rem;
  font-size: 1rem;
  font-weight: 700;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: all 0.1ms ease-in-out;
}

.btn:hover {
  transform: scale(0.95);
}

.btn:active {
  transform: scale(1);
}

.card-element-hidden {
  display: none;
}

  </style> --}}
    @push('scripts')
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
    @endpush
@endsection
