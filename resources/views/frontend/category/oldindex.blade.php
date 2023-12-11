@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Categories</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Categories</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Start -->
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
                    <div class="row g-4 ratio_65">
                        @foreach ($categories as $category)
                        <div class=" col-md-4 col-sm-6 ">
                            <div class="blog-box wow fadeInUp">
                                <div class="blog-image">
                                    <a href="{{route('category.show',$category->id)}}">
                                        <img src="{{asset($category->image)}}" class="bg-img blur-up lazyload" alt="{{$category->name??''}}">
                                    </a>
                                </div>

                                <div class="blog-contain">                                    
                                    <a href="{{route('category.show',$category->id)}}">
                                        <h3>{{$category->name??''}}</h3>
                                    </a>
                                    <p>{{$category->detail??''}}</p>
                                    <button onclick="location.href = '{{route('category.show',$category->id)}}';" class="blog-button">Read More
                                        <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>                       
                            
                        @endforeach
                    </div>

                    <nav class="custome-pagination">
                        <ul class="pagination justify-content-center">
                            
                            <li class="page-item ">
                                {{$categories->links()}}
                            </li>
                            
                        </ul>
                    </nav>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
