@extends('admin.layouts.app')
@section('content')
    <style>
        .text-bold {
            font-weight: 800;
        }

        text-color {
            color: #0093c4;
        }

        /* Main image - left */
        .main-img img {
            width: 100%;
        }

        /* Preview images */
        .previews img {
            width: 100%;
            height: 140px;
        }

        .main-description .category {
            text-transform: uppercase;
            color: #0093c4;
        }

        .main-description .product-title {
            font-size: 2.5rem;
        }

        .old-price-discount {
            font-weight: 600;
        }

        .new-price {
            font-size: 2rem;
        }

        .details-title {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 1.2rem;
            color: #757575;
        }

        .buttons .block {
            margin-right: 5px;
        }

        .quantity input {
            border-radius: 0;
            height: 40px;

        }


        .custom-btn {
            text-transform: capitalize;
            background-color: #0093c4;
            color: white;
            width: 150px;
            height: 40px;
            border-radius: 0;
        }

        .custom-btn:hover {
            background-color: #0093c4 !important;
            font-size: 18px;
            color: white !important;
        }

        .similar-product img {
            height: 400px;
        }

        .similar-product {
            text-align: left;
        }

        .similar-product .title {
            margin: 17px 0px 4px 0px;
        }

        .similar-product .price {
            font-weight: bold;
        }

        .questions .icon i {
            font-size: 2rem;
        }

        .questions-icon {
            font-size: 2rem;
            color: #0093c4;
        }


        /* Small devices (landscape phones, less than 768px) */
        @media (max-width: 767.98px) {

            /* Make preview images responsive  */
            .previews img {
                width: 100%;
                height: auto;
            }

        }
    </style>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-5">
                <div class="main-img">
                    @php
                        $images = json_decode($product->images);
                    @endphp
                    <a href="{{ asset($product->image) }}" target="_blank">
                    <img class="" style="height: 200px; width:200px; object-fit:contain" src="{{ asset($product->image) }}"
                        alt="ProductS">
                    </a>
                    <div class="row my-3 previews">
                        @foreach ($images as $image)
                            <div class="col-md-3">
                                <a href="{{ asset($image) }}" target="_blank">
                                <img class="w-100"
                                    src="{{ asset($image) }}"
                                    alt="Sale" style="height: 150px; width:150px; object-fit:contain">
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="main-description px-2">
                    <div class="category text-bold">
                        Category: {{ $product->category->name ?? '' }}
                    </div>
                    <div class="product-title text-bold my-3">
                        {{ $product->name }}
                        @if ($product->isMegaSale)
                        <span class="badge badge-danger">Mega Sale</span>
                        @endif

                    </div>


                    <div class="price-area my-4">
                        <p class="old-price mb-1">Rs. <del>{{ $product->price }}</del> </p>
                        <p class="new-price text-bold mb-1">Rs. {{ $product->discount_price }}</p>
                    </div>
                </div>

                <div class="product-details my-4">
                    <p class="details-title text-color mb-1">Quantity</p>
                    <p class="description">{{ $product->quantity ?? '' }} </p>
                </div>
                <div class="product-details my-4">
                    <p class="details-title text-color mb-1">is Active</p>
                    <p class="description">{{ $product->isActive ? 'Yes': 'Not' }} </p>
                </div>
                <div class="product-details my-4">
                    <p class="details-title text-color mb-1">Status</p>
                    <p class="description">{{ $product->status  }} </p>
                </div>
                <div class="product-details my-4">
                    <p class="details-title text-color mb-1">Offer</p>
                    <p class="description">{{ $product->offer ?? '' }} </p>
                </div>
                <div class="product-details my-4">
                    <p class="details-title text-color mb-1">Product Info</p>
                    <p class="description">{{ $product->info ?? '' }} </p>
                </div>
                <div class="product-details my-4">
                    <p class="details-title text-color mb-1">Product Details</p>
                    <p class="description">{{ $product->detail ?? '' }} </p>
                </div>

                <div class="delivery my-4">
                    <p class="font-weight-bold mb-0"><span><i class="fa-solid fa-truck"></i></span> <b>Delivery days:
                            {{ $product->delivery_days }} </b> </p>


                </div>
                <div class="delivery-options my-4">
                    <p class="font-weight-bold mb-0"><span><i class="fa-solid fa-filter"></i></span> <b>Delivery charges:
                            {{ $product->delivery_charges }}</b></p>
                </div>


            </div>
        </div>
        @if ($product->user_id)
            <div class="row">
                <div class="table-responsive product-table">
                    <div>
                        <table class="table all-package theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Refer By</th>
                                    <th>Email</th>
                                    <th>Shop</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $product->user->name ?? '' }}</td>
                                    <td>{{ $product->user->username ?? '' }}</td>
                                    <td>{{ $product->user->refer_by ?? '' }}</td>
                                    <td>{{ $product->user->email ?? '' }}</td>
                                    <td>{{ $shop->name ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
