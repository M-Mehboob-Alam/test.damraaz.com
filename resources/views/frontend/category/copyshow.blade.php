@extends('layouts.app')
@section('title')
Category-{{$category->slug}}
@endsection
@section('content')
    <style>
        .responsive {
            /* width: 100%;
            height: 300px; */
            object-fit: auto;
            /*  max-width: 400px;*/

        }
    </style>
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Shop By Category</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $category->name ?? '' }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Poster Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div>
                        <!--img-fluid bg-img-->
                        <img src="https://admin.damraaz.com/{{ $category->image }}"
                            class="rounded responsive mx-auto d-block rounded-3 blur-up lazyload" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Poster Section End -->

    <!-- Shop Section Start -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <!--<div class="col-custome-3">-->
                <!--    <div class="left-box wow fadeInUp">-->
                <!--        <div class="shop-left-sidebar">-->
                <!--            <div class="back-button">-->
                <!--                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>-->
                <!--            </div>-->

                <!--            <div class="filter-category">-->
                <!--                <div class="filter-title">-->
                <!--                    <h2>Filters</h2>-->
                <!--                    <a href="javascript:void(0)">Clear All</a>-->
                <!--                </div>-->
                <!--                <ul>-->
                <!--                    <li>-->
                <!--                        <a href="javascript:void(0)">Vegetable</a>-->
                <!--                    </li>-->
                <!--                    <li>-->
                <!--                        <a href="javascript:void(0)">Fruit</a>-->
                <!--                    </li>-->
                <!--                    <li>-->
                <!--                        <a href="javascript:void(0)">Fresh</a>-->
                <!--                    </li>-->
                <!--                    <li>-->
                <!--                        <a href="javascript:void(0)">Milk</a>-->
                <!--                    </li>-->
                <!--                    <li>-->
                <!--                        <a href="javascript:void(0)">Meat</a>-->
                <!--                    </li>-->
                <!--                </ul>-->
                <!--            </div>-->

                <!--            <div class="accordion custome-accordion" id="accordionExample">-->
                <!--                <div class="accordion-item">-->
                <!--                    <h2 class="accordion-header" id="headingOne">-->
                <!--                        <button class="accordion-button" type="button" data-bs-toggle="collapse"-->
                <!--                            data-bs-target="#collapseOne" aria-expanded="true"-->
                <!--                            aria-controls="collapseOne">-->
                <!--                            <span>Categories</span>-->
                <!--                        </button>-->
                <!--                    </h2>-->
                <!--                    <div id="collapseOne" class="accordion-collapse collapse show"-->
                <!--                        aria-labelledby="headingOne">-->
                <!--                        <div class="accordion-body">-->
                <!--                            <div class="form-floating theme-form-floating-2 search-box">-->
                <!--                                <input type="search" class="form-control" id="search"-->
                <!--                                    placeholder="Search ..">-->
                <!--                                <label for="search">Search</label>-->
                <!--                            </div>-->

                <!--                            <ul class="category-list custom-padding custom-height">-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="fruit">-->
                <!--                                        <label class="form-check-label" for="fruit">-->
                <!--                                            <span class="name">Fruits & Vegetables</span>-->
                <!--                                            <span class="number">(15)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="cake">-->
                <!--                                        <label class="form-check-label" for="cake">-->
                <!--                                            <span class="name">Bakery, Cake & Dairy</span>-->
                <!--                                            <span class="number">(12)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="behe">-->
                <!--                                        <label class="form-check-label" for="behe">-->
                <!--                                            <span class="name">Beverages</span>-->
                <!--                                            <span class="number">(20)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="snacks">-->
                <!--                                        <label class="form-check-label" for="snacks">-->
                <!--                                            <span class="name">Snacks & Branded Foods</span>-->
                <!--                                            <span class="number">(05)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="beauty">-->
                <!--                                        <label class="form-check-label" for="beauty">-->
                <!--                                            <span class="name">Beauty & Household</span>-->
                <!--                                            <span class="number">(30)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="pets">-->
                <!--                                        <label class="form-check-label" for="pets">-->
                <!--                                            <span class="name">Kitchen, Garden & Pets</span>-->
                <!--                                            <span class="number">(50)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="egg">-->
                <!--                                        <label class="form-check-label" for="egg">-->
                <!--                                            <span class="name">Eggs, Meat & Fish</span>-->
                <!--                                            <span class="number">(19)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="food">-->
                <!--                                        <label class="form-check-label" for="food">-->
                <!--                                            <span class="name">Gourment & World Food</span>-->
                <!--                                            <span class="number">(30)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="care">-->
                <!--                                        <label class="form-check-label" for="care">-->
                <!--                                            <span class="name">Baby Care</span>-->
                <!--                                            <span class="number">(20)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="fish">-->
                <!--                                        <label class="form-check-label" for="fish">-->
                <!--                                            <span class="name">Fish & Seafood</span>-->
                <!--                                            <span class="number">(10)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="marinades">-->
                <!--                                        <label class="form-check-label" for="marinades">-->
                <!--                                            <span class="name">Marinades</span>-->
                <!--                                            <span class="number">(05)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="lamb">-->
                <!--                                        <label class="form-check-label" for="lamb">-->
                <!--                                            <span class="name">Mutton & Lamb</span>-->
                <!--                                            <span class="number">(09)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="other">-->
                <!--                                        <label class="form-check-label" for="other">-->
                <!--                                            <span class="name">Port & other Meats</span>-->
                <!--                                            <span class="number">(06)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="pour">-->
                <!--                                        <label class="form-check-label" for="pour">-->
                <!--                                            <span class="name">Pourltry</span>-->
                <!--                                            <span class="number">(01)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="salami">-->
                <!--                                        <label class="form-check-label" for="salami">-->
                <!--                                            <span class="name">Sausages, bacon & Salami</span>-->
                <!--                                            <span class="number">(03)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->

                <!--                <div class="accordion-item">-->
                <!--                    <h2 class="accordion-header" id="headingTwo">-->
                <!--                        <button class="accordion-button collapsed" type="button"-->
                <!--                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"-->
                <!--                            aria-expanded="false" aria-controls="collapseTwo">-->
                <!--                            <span>Food Preference</span>-->
                <!--                        </button>-->
                <!--                    </h2>-->
                <!--                    <div id="collapseTwo" class="accordion-collapse collapse show"-->
                <!--                        aria-labelledby="headingTwo">-->
                <!--                        <div class="accordion-body">-->
                <!--                            <ul class="category-list custom-padding">-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="veget">-->
                <!--                                        <label class="form-check-label" for="veget">-->
                <!--                                            <span class="name">Vegetarian</span>-->
                <!--                                            <span class="number">(08)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox" id="non">-->
                <!--                                        <label class="form-check-label" for="non">-->
                <!--                                            <span class="name">Non Vegetarian</span>-->
                <!--                                            <span class="number">(09)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->

                <!--                <div class="accordion-item">-->
                <!--                    <h2 class="accordion-header" id="headingThree">-->
                <!--                        <button class="accordion-button collapsed" type="button"-->
                <!--                            data-bs-toggle="collapse" data-bs-target="#collapseThree"-->
                <!--                            aria-expanded="false" aria-controls="collapseThree">-->
                <!--                            <span>Price</span>-->
                <!--                        </button>-->
                <!--                    </h2>-->
                <!--                    <div id="collapseThree" class="accordion-collapse collapse show"-->
                <!--                        aria-labelledby="headingThree">-->
                <!--                        <div class="accordion-body">-->
                <!--                            <div class="range-slider">-->
                <!--                                <input type="text" class="js-range-slider" value="">-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->

                <!--                <div class="accordion-item">-->
                <!--                    <h2 class="accordion-header" id="headingSix">-->
                <!--                        <button class="accordion-button collapsed" type="button"-->
                <!--                            data-bs-toggle="collapse" data-bs-target="#collapseSix"-->
                <!--                            aria-expanded="false" aria-controls="collapseSix">-->
                <!--                            <span>Rating</span>-->
                <!--                        </button>-->
                <!--                    </h2>-->
                <!--                    <div id="collapseSix" class="accordion-collapse collapse show"-->
                <!--                        aria-labelledby="headingSix">-->
                <!--                        <div class="accordion-body">-->
                <!--                            <ul class="category-list custom-padding">-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox">-->
                <!--                                        <div class="form-check-label">-->
                <!--                                            <ul class="rating">-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                            </ul>-->
                <!--                                            <span class="text-content">(5 Star)</span>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox">-->
                <!--                                        <div class="form-check-label">-->
                <!--                                            <ul class="rating">-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                            </ul>-->
                <!--                                            <span class="text-content">(4 Star)</span>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox">-->
                <!--                                        <div class="form-check-label">-->
                <!--                                            <ul class="rating">-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                            </ul>-->
                <!--                                            <span class="text-content">(3 Star)</span>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox">-->
                <!--                                        <div class="form-check-label">-->
                <!--                                            <ul class="rating">-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                            </ul>-->
                <!--                                            <span class="text-content">(2 Star)</span>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox">-->
                <!--                                        <div class="form-check-label">-->
                <!--                                            <ul class="rating">-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star" class="fill"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                                <li>-->
                <!--                                                    <i data-feather="star"></i>-->
                <!--                                                </li>-->
                <!--                                            </ul>-->
                <!--                                            <span class="text-content">(1 Star)</span>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->

                <!--                <div class="accordion-item">-->
                <!--                    <h2 class="accordion-header" id="headingFour">-->
                <!--                        <button class="accordion-button collapsed" type="button"-->
                <!--                            data-bs-toggle="collapse" data-bs-target="#collapseFour"-->
                <!--                            aria-expanded="false" aria-controls="collapseFour">-->
                <!--                            <span>Discount</span>-->
                <!--                        </button>-->
                <!--                    </h2>-->
                <!--                    <div id="collapseFour" class="accordion-collapse collapse show"-->
                <!--                        aria-labelledby="headingFour">-->
                <!--                        <div class="accordion-body">-->
                <!--                            <ul class="category-list custom-padding">-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault">-->
                <!--                                            <span class="name">upto 5%</span>-->
                <!--                                            <span class="number">(06)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault1">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault1">-->
                <!--                                            <span class="name">5% - 10%</span>-->
                <!--                                            <span class="number">(08)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault2">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault2">-->
                <!--                                            <span class="name">10% - 15%</span>-->
                <!--                                            <span class="number">(10)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault3">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault3">-->
                <!--                                            <span class="name">15% - 25%</span>-->
                <!--                                            <span class="number">(14)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault4">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault4">-->
                <!--                                            <span class="name">More than 25%</span>-->
                <!--                                            <span class="number">(13)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->

                <!--                <div class="accordion-item">-->
                <!--                    <h2 class="accordion-header" id="headingFive">-->
                <!--                        <button class="accordion-button collapsed" type="button"-->
                <!--                            data-bs-toggle="collapse" data-bs-target="#collapseFive"-->
                <!--                            aria-expanded="false" aria-controls="collapseFive">-->
                <!--                            <span>Pack Size</span>-->
                <!--                        </button>-->
                <!--                    </h2>-->
                <!--                    <div id="collapseFive" class="accordion-collapse collapse show"-->
                <!--                        aria-labelledby="headingFive">-->
                <!--                        <div class="accordion-body">-->
                <!--                            <ul class="category-list custom-padding custom-height">-->
                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault5">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault5">-->
                <!--                                            <span class="name">400 to 500 g</span>-->
                <!--                                            <span class="number">(05)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault6">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault6">-->
                <!--                                            <span class="name">500 to 700 g</span>-->
                <!--                                            <span class="number">(02)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault7">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault7">-->
                <!--                                            <span class="name">700 to 1 kg</span>-->
                <!--                                            <span class="number">(04)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault8">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault8">-->
                <!--                                            <span class="name">120 - 150 g each Vacuum 2 pcs</span>-->
                <!--                                            <span class="number">(06)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault9">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault9">-->
                <!--                                            <span class="name">1 pc</span>-->
                <!--                                            <span class="number">(09)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault10">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault10">-->
                <!--                                            <span class="name">1 to 1.2 kg</span>-->
                <!--                                            <span class="number">(06)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault11">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault11">-->
                <!--                                            <span class="name">2 x 24 pcs Multipack</span>-->
                <!--                                            <span class="number">(03)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault12">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault12">-->
                <!--                                            <span class="name">2x6 pcs Multipack</span>-->
                <!--                                            <span class="number">(04)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault13">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault13">-->
                <!--                                            <span class="name">4x6 pcs Multipack</span>-->
                <!--                                            <span class="number">(05)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault14">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault14">-->
                <!--                                            <span class="name">5x6 pcs Multipack</span>-->
                <!--                                            <span class="number">(09)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault15">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault15">-->
                <!--                                            <span class="name">Combo 2 Items</span>-->
                <!--                                            <span class="number">(10)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault16">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault16">-->
                <!--                                            <span class="name">Combo 3 Items</span>-->
                <!--                                            <span class="number">(14)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault17">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault17">-->
                <!--                                            <span class="name">2 pcs</span>-->
                <!--                                            <span class="number">(19)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault18">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault18">-->
                <!--                                            <span class="name">3 pcs</span>-->
                <!--                                            <span class="number">(14)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault19">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault19">-->
                <!--                                            <span class="name">2 pcs Vacuum (140 g to 180 g each-->
                <!--                                                )</span>-->
                <!--                                            <span class="number">(13)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault20">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault20">-->
                <!--                                            <span class="name">4 pcs</span>-->
                <!--                                            <span class="number">(18)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault21">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault21">-->
                <!--                                            <span class="name">4 pcs Vacuum (140 g to 180 g each-->
                <!--                                                )</span>-->
                <!--                                            <span class="number">(07)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault22">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault22">-->
                <!--                                            <span class="name">6 pcs</span>-->
                <!--                                            <span class="number">(09)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault23">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault23">-->
                <!--                                            <span class="name">6 pcs carton</span>-->
                <!--                                            <span class="number">(11)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->

                <!--                                <li>-->
                <!--                                    <div class="form-check ps-0 m-0 category-list-box">-->
                <!--                                        <input class="checkbox_animated" type="checkbox"-->
                <!--                                            id="flexCheckDefault24">-->
                <!--                                        <label class="form-check-label" for="flexCheckDefault24">-->
                <!--                                            <span class="name">6 pcs Pouch</span>-->
                <!--                                            <span class="number">(16)</span>-->
                <!--                                        </label>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="col-custome-12">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>

                        <div class="top-filter-menu row">
                            <div class="category-dropdown col-md-10">
                                <!--<h5 class="text-content">Sort By :</h5>-->
                                <!--<div class="dropdown">-->
                                <!--    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"-->
                                <!--        data-bs-toggle="dropdown">-->
                                <!--        <span>Most Popular</span> <i class="fa-solid fa-angle-down"></i>-->
                                <!--    </button>-->
                                <!--    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">-->
                                <!--        <li>-->
                                <!--            <a class="dropdown-item" id="pop" href="javascript:void(0)">Popularity</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a class="dropdown-item" id="low" href="javascript:void(0)">Low - High-->
                                <!--                Price</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a class="dropdown-item" id="high" href="javascript:void(0)">High - Low-->
                                <!--                Price</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a class="dropdown-item" id="rating" href="javascript:void(0)">Average-->
                                <!--                Rating</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a class="dropdown-item" id="aToz" href="javascript:void(0)">A - Z Order</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a class="dropdown-item" id="zToa" href="javascript:void(0)">Z - A Order</a>-->
                                <!--        </li>-->
                                <!--        <li>-->
                                <!--            <a class="dropdown-item" id="off" href="javascript:void(0)">% Off - Hight To-->
                                <!--                Low</a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</div>-->
                                <form method="get" action="{{ route('frontend.all_product') }}" class="input-group">
                                    <input type="text" name="name" value="{{ request()->name }}"
                                        class="form-control" placeholder="Search by name"
                                        aria-label="Example text with button addon">
                                    <input type="number" name="min_price" value="{{ request()->min_price }}"
                                        class="form-control" placeholder="min price"
                                        aria-label="Example text with button addon">
                                    <input type="number" name="max_price" value="{{ request()->max_price }}"
                                        class="form-control" placeholder="max price"
                                        aria-label="Example text with button addon">
                                    <select class="form-control" name="sort" aria-label="Default select example">
                                        <option selected disabled>Sort By</option>
                                        <option value="lowToHigh" {{ request()->sort == 'lowToHigh' ? 'selected' : '' }}>
                                            Low
                                            To High</option>
                                        <option value="highToLow" {{ request()->sort == 'highToLow' ? 'selected' : '' }}>
                                            High
                                            To Low</option>
                                    </select>
                                    <button class="btn theme-bg-color text-white m-0" type="submit"
                                        id="button-addon1">Search</button>
                                </form>
                            </div>

                            <div class="grid-option d-none d-md-block col-md-2">
                                <ul>
                                    <li class="three-grid">
                                        <a href="javascript:void(0)">
                                            <img src="../assets/svg/grid-3.svg" class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none active">
                                        <a href="javascript:void(0)">
                                            <img src="../assets/svg/grid-4.svg"
                                                class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="../assets/svg/grid.svg"
                                                class="blur-up lazyload img-fluid d-lg-none d-inline-block"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="../assets/svg/list.svg" class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                        @forelse($products as $product)
                            @php
                                $wishlists = session('wishlist');
                                $search = false;
                                if ($wishlists) {
                                    $search = array_key_exists($product->id, $wishlists);
                                }
                            @endphp
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('product.show', $product->id) }}">
                                                @php
                                                    $image = json_decode($product->images);
                                                @endphp
                                                <img src="{{ asset($image[0]) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#viewDetail{{ $product->id }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="{{ route('add.to.wishlist', $product->id) }}"
                                                        class="notifi-wishlist">
                                                        <i
                                                            class="{{ $search == true ? 'text-danger fa-solid' : 'fa-regular' }} fa-heart"></i>

                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Buy Now">
                                                <form action="{{ route('add.to.cart', $product->id) }}">
                                                    <input type="hidden" name="checkout" value="yes">
                                                <button class="btn" type="submit">
                                                    <i class="iconly-Bag-2 icli"></i>
                                                </button>
                                                </form>
                                            </li>



                                                <!--<li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">-->
                                                <!--    <a href="compare.html">-->
                                                <!--        <i data-feather="refresh-cw"></i>-->
                                                <!--    </a>-->
                                                <!--</li>-->

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">{{ $category->name ?? '' }}</span>
                                            <a href="{{ route('product.show', $product->id) }}">
                                                <h5 class="name">{{ $product->name ?? '' }}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">{{ $product->info ?? '' }}
                                            </p>
                                            <!--<div class="product-rating mt-2">-->
                                            <!--    <ul class="rating">-->
                                            <!--        <li>-->
                                            <!--            <i data-feather="star" class="fill"></i>-->
                                            <!--        </li>-->
                                            <!--        <li>-->
                                            <!--            <i data-feather="star" class="fill"></i>-->
                                            <!--        </li>-->
                                            <!--        <li>-->
                                            <!--            <i data-feather="star" class="fill"></i>-->
                                            <!--        </li>-->
                                            <!--        <li>-->
                                            <!--            <i data-feather="star" class="fill"></i>-->
                                            <!--        </li>-->
                                            <!--        <li>-->
                                            <!--            <i data-feather="star"></i>-->
                                            <!--        </li>-->
                                            <!--    </ul>-->
                                            <!--    <span>(4.0)</span>-->
                                            <!--</div>-->
                                            <!--<h6 class="unit">250 ml</h6>-->
                                            <h5 class="price"><span class="theme-color">Rs.
                                                    {{ $product->discount_price ?? '' }}</span> <del>Rs.
                                                    {{ $product->price ?? '' }}</del>
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <a href="{{ route('add.to.cart', $product->id) }}"
                                                    class="btn btn-add-cart addcart-button">Add
                                                    <span class="add-icon bg-light-gray">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </a>
                                                <div class="cart_qty qty-box">
                                                    <div class="input-group bg-white">
                                                        <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick View Modal Box Start -->
                            <div class="modal fade theme-modal view-modal " id="viewDetail{{ $product->id }}"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                                    <div class="modal-content">
                                        <div class="modal-header p-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-sm-4 g-2">
                                                <div class="col-lg-6">
                                                    <div class="slider-image">
                                                        <img src="{{ asset($image[0]) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="right-sidebar-modal">
                                                        <h4 class="title-name">{{ $product->name ?? '' }}</h4>
                                                        <h4 class="price">Rs. {{ $product->discount_price ?? '' }}
                                                            <del>Rs.
                                                                {{ $product->price ?? '' }}</del></h4>

                                                        <!--<div class="product-rating">-->
                                                        <!--    <ul class="rating">-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star" class="fill"></i>-->
                                                        <!--        </li>-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star" class="fill"></i>-->
                                                        <!--        </li>-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star" class="fill"></i>-->
                                                        <!--        </li>-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star" class="fill"></i>-->
                                                        <!--        </li>-->
                                                        <!--        <li>-->
                                                        <!--            <i data-feather="star"></i>-->
                                                        <!--        </li>-->
                                                        <!--    </ul>-->
                                                        <!--    <span class="ms-2">8 Reviews</span>-->
                                                        <!--    <span class="ms-2 text-danger">6 sold in last 16 hours</span>-->
                                                        <!--</div>-->

                                                        <div class="product-detail">
                                                            <h4>Product Details :</h4>
                                                            <p>{{ $product->info }}</p>
                                                        </div>

                                                        <ul class="brand-list">
                                                            <!--<li>-->
                                                            <!--    <div class="brand-box">-->
                                                            <!--        <h5>Brand Name:</h5>-->
                                                            <!--        <h6>Black Forest</h6>-->
                                                            <!--    </div>-->
                                                            <!--</li>-->

                                                            <li>
                                                                <div class="brand-box">
                                                                    <h5>Product Code:</h5>
                                                                    <h6>DM{{ $product->id }}</h6>
                                                                </div>
                                                            </li>

                                                            <!--<li>-->
                                                            <!--    <div class="brand-box">-->
                                                            <!--        <h5>Product Type:</h5>-->
                                                            <!--        <h6>White Cream Cake</h6>-->
                                                            <!--    </div>-->
                                                            <!--</li>-->
                                                        </ul>

                                                        <!--<div class="select-size">-->
                                                        <!--    <h4>Cake Size :</h4>-->
                                                        <!--    <select class="form-select select-form-size">-->
                                                        <!--        <option selected>Select Size</option>-->
                                                        <!--        <option value="1.2">1/2 KG</option>-->
                                                        <!--        <option value="0">1 KG</option>-->
                                                        <!--        <option value="1.5">1/5 KG</option>-->
                                                        <!--        <option value="red">Red Roses</option>-->
                                                        <!--        <option value="pink">With Pink Roses</option>-->
                                                        <!--    </select>-->
                                                        <!--</div>-->

                                                        <div class="modal-button">
                                                            <button
                                                                onclick="location.href = '{{ route('add.to.cart', $product->id) }}';"
                                                                class="btn btn-md add-cart-button icon">Add
                                                                To Cart</button>
                                                            <button
                                                                onclick="location.href = '{{ route('product.show', $product->id) }}';"
                                                                class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                                                View More Details</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Quick View Modal Box End -->
                        @empty
                            No Product found
                        @endforelse
                    </div>
                    <nav class="custome-pagination">
                        <ul class="pagination justify-content-center">
                            <!--<li class="page-item disabled">-->
                            <!--    <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-disabled="true">-->
                            <!--        <i class="fa-solid fa-angles-left"></i>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <li class="page-item ">
                                <!--<a class="page-link" href="javascript:void(0)">1</a>-->
                                {!! $products->render() !!}
                            </li>
                            <!--<li class="page-item" aria-current="page">-->
                            <!--    <a class="page-link" href="javascript:void(0)">2</a>-->
                            <!--</li>-->
                            <!--<li class="page-item">-->
                            <!--    <a class="page-link" href="javascript:void(0)">3</a>-->
                            <!--</li>-->
                            <!--<li class="page-item">-->
                            <!--    <a class="page-link" href="javascript:void(0)">-->
                            <!--        <i class="fa-solid fa-angles-right"></i>-->
                            <!--    </a>-->
                            <!--</li>-->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop Section End -->
@endsection
