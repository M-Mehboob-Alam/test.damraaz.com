@extends('layouts.app')
@section('title')
 Your {{$shop->name}} Shop Home
@endsection


@section('content')
    @if ($shop->user_id == '58')
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong class="text-uppercase"> Set Delivery Charges For All Products  </strong>
            <form action="{{ route('setAllProductDeliveryCharges') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="number" name="delivery_charges", required class="form-control" placeholder="Enter Charges">
                </div>
                <br>

                <button type="submit" class="btn btn-success">Update</button>
                <br>
            </form>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

    </div>
    @endif
    @if ($shop->status == 'blocked')

    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong class="text-uppercase">Your Shop Is :{{$shop->status}}!</strong> Reason: {{$shop->message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @if ($errors->any())
          @foreach ($errors->all() as $error)
              <div class="text-danger">{{$error}}</div>
          @endforeach
      @endif
    </div>
    @endif
    <!-- Dashboard Start -->
    <section class="user-dashboard">
      <div class="container-lg">
        <div class="row g-3 g-xl-4 tab-wrap">
          <div class="col-lg-4 col-xl-3 sticky">
            <button id="setting_shower" class="setting-menu btn-solid btn-sm d-lg-none">Setting Menu <i class="arrow"></i></button>
            <div class="side-bar" id="setting_hider">
              <span  id="setting_closer" class="back-side d-lg-none"> <i data-feather="x"></i></span>
              <div class="profile-box" >
                <div class="img-box">
                  <img class="img-fluid" src="{{asset($shop->image)}}" alt="user" />
                  <div class="edit-btn">
                    <i data-feather="edit"></i>
                    <input class="updateimg" type="file" name="img" />
                  </div>
                </div>

                <div class="user-name">
                  <h5>{{$shop->name}}</h5>
                  <h6>{{$shop->address}}</h6>
                </div>
              </div>

              <ul class="nav nav-tabs nav-tabs2" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="true">
                    Dashboard
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">
                    New Orders {{$shop_orders->where('status', 'pending')->count()}}
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="processing-orders-tab" data-bs-toggle="tab" data-bs-target="#processing-orders" type="button" role="tab" aria-controls="orders" aria-selected="false">
                    Processing Orders {{$shop_orders->where('status', 'processing')->count()}}
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="delivered-orders-tab" data-bs-toggle="tab" data-bs-target="#delivered-orders" type="button" role="tab" aria-controls="orders" aria-selected="false">
                    Delivered Orders {{$shop_orders->where('status', 'delivered')->count()}}
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="cancelled-orders-tab" data-bs-toggle="tab" data-bs-target="#cancelled-orders" type="button" role="tab" aria-controls="orders" aria-selected="false">
                    Cancelled Orders {{$shop_orders->where('status', 'cancelled')->count()}}
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="on-delivery-orders-tab" data-bs-toggle="tab" data-bs-target="#on-delivery-orders" type="button" role="tab" aria-controls="orders" aria-selected="false">
                    On-Delivery Orders {{$shop_orders->where('status', 'onDelivery')->count()}}
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="return-orders-tab" data-bs-toggle="tab" data-bs-target="#return-orders" type="button" role="tab" aria-controls="orders" aria-selected="false">
                    Return Orders {{$shop_orders->where('status', 'return')->count()}}
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="refund-orders-tab" data-bs-toggle="tab" data-bs-target="#refund-orders" type="button" role="tab" aria-controls="orders" aria-selected="false">
                    Refund Orders {{$shop_orders->where('status', 'refund')->count()}}
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    Profile
                    <span><i data-feather="chevron-right"></i></span>
                  </button>
                </li>

              </ul>
            </div>
          </div>

          <div class="col-lg-8 col-xl-9">
            <div class="right-content tab-content" id="myTabContent">
              <!-- User Dashboard Start -->
              <div class="tab-pane show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="dashboard-tab">
                  <div class="title-box3">
                    <h3>Welcome Back To Your Shop {{$shop->name}} <a href="{{route('user.product.create')}}" class="btn btn-success">Add New Product</a></h3>

                  </div>

                  <div class="row g-0 option-wrap">
                    <div class="col-sm-6 col-xl-4">
                      <a href="{{route('userAllProducts')}}" data-class="orders" class="tab-box">
                        <img src="{{asset('newtheme/assets/svg/1.svg')}}" alt="shopping bag" />
                        <h5>All Products {{\App\Models\Product::where('user_id', auth()->user()->id)->count()}}</h5>

                      </a>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                      <a href="{{route('userUploadedProducts', ['products'=>'accepted'])}}" data-class="wishlist" class="tab-box">
                        <img src="{{asset('newtheme/assets/svg/2.svg')}}" alt="wishlist" />
                        <h5>Published Products {{\App\Models\Product::where('user_id', auth()->user()->id)->where('status', 'accepted')->count()}}</h5>

                      </a>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                      <a href="{{route('userUploadedProducts', ['products'=>'pending'])}}" data-class="savedAddress" class="tab-box">
                        <img src="{{asset('newtheme/assets/svg/3.svg')}}" alt="address" />
                        <h5>In Review Products {{\App\Models\Product::where('user_id', auth()->user()->id)->where('status', 'pending')->count()}}</h5>

                      </a>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                      <a href="{{route('userUploadedProducts', ['products'=>'rejected'])}}" data-class="payment" class="tab-box">
                        <img src="{{asset('newtheme/assets/svg/4.svg')}}" alt="payment" />
                        <h5>Rejected Products {{\App\Models\Product::where('user_id', auth()->user()->id)->where('status', 'rejected')->count()}}</h5>

                      </a>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                      <a href="javascript:void(0)" data-class="profile" class="tab-box">
                        <img src="{{asset('newtheme/assets/svg/5.svg')}}" alt="profile" />
                        <h5>Profile</h5>

                      </a>
                    </div>
                    {{-- <div class="col-sm-6 col-xl-4">
                      <a href="javascript:void(0)" data-class="security" class="tab-box">
                        <img src="{{asset('newtheme/assets/svg/6.svg')}}" alt="security" />
                        <h5>Security</h5>

                      </a>
                    </div> --}}
                  </div>
                </div>
              </div>
              <!-- User Dashboard End -->

              <!-- Order Tabs Start -->
              <div class="tab-pane" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                <div class="cart-wrap order-content">
                  <div class="title-box3">
                    <h3>New Orders {{$shop_orders->where('status', 'pending')->count()}}</h3>

                  </div>

                  <div class="order-wraper">
                   @foreach ($shop_orders->where('status', 'pending') as $items)
                   {{-- {{dd($items)}} --}}



                   <div class="order-box">
                    <div class="order-header">
                      <span><i data-feather="box"></i></span>
                      <div class="order-content">

                        <h5 class="order-status success">{{$items->status}}</h5>
                            <div class="d-flex justify-content-around flex-column flex-md-row">
                                <div class="status">
                                    <p>Place {{$items->created_at}} Updated At <strong>{{$items->updated_at}}</strong></p>

                                    <p>Change the Order Status By: <strong>{{$items->changed_status == 'Seller' ? 'You' : 'Support Team'  }}</strong></p>

                                    <p>Message: <strong>{{$items->message}}</strong></p>
                                    <p>Order ID: <strong>{{$items->orderId}}</strong></p>
                                    <p>Order ID: <strong>{{$items->orders->status ?? 'Maybe Deleted'}}</strong></p>
                                </div>
                                <div class="devlier">
                                    <h3>Delivery Details</h3>
                                    <p>Name : <strong>{{$items->orders->name  ?? 'Maybe Deleted'}}</strong></p>
                                    <p>MObile : <strong>{{$items->orders->phone  ?? 'Maybe Deleted'}}</strong></p>
                                    <p>State/Province : <strong>{{$items->orders->province  ?? 'Maybe Deleted'}}</strong></p>
                                    <p>City : <strong>{{$items->orders->city  ?? 'Maybe Deleted'}}</strong></p>
                                    <p>Address : <strong>{{$items->orders->address  ?? 'Maybe Deleted'}}</strong></p>
                                </div>
                            </div>
                        <!-- Button trigger modal -->
                        <button type="button" {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$items->id}}">
                            Change Status
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$items->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeShopOrderStatus')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$items->id}}">
                                        <input type="hidden" name="shop_id" value="{{$items->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$items->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$items->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$items->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$items->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$items->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$items->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$items->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$items->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="order-info m-2">
                        @foreach ($items->order_details as $item)
                      <div class="product-details" style="border: 1px solid rgb(199, 199, 199); border-radius:10px; padding:1rem; margin:1rem 0px;" >
                        <div class="img-box"><img src="{{asset($item->product_image)}}" alt="product" /></div>
                        <div class="product-content">
                          <h4><strong class="text-uppercase text-light p-1" style="background-color: black">{{$item->status}}</strong></h4>
                            <br>
                          <h5>{{$item->product_name}}</h5>

                          <span>Prise : <span>Rs.{{$item->price}}</span></span>
                          <span>Sale Price : <span>Rs.{{$item->discount_price}}</span></span>

                          <span>Order Id : <span>{{$item->order->orderId}}</span></span>
                          <span>Quantity : <span>{{$item->quantity}}</span></span>
                             <!-- Button trigger modal -->
                        <button type="button" {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSubItem{{$item->id}}">
                            Change Status
                        </button>
                        </div>
                      </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalSubItem{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeOrderStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="shop_id" value="{{$item->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$item->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$item->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$item->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$item->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$item->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$item->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$item->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$item->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                      @endforeach


                    </div>
                  </div>

                   @endforeach

                  </div>
                </div>
              </div>
              <!-- Order Tabs End -->
              <!-- Order Tabs Start -->
              <div class="tab-pane" id="processing-orders" role="tabpanel" aria-labelledby="processing-tab">
                <div class="cart-wrap order-content">
                  <div class="title-box3">
                    <h3>Processing Orders {{$shop_orders->where('status', 'processing')->count()}}</h3>

                  </div>

                  <div class="order-wraper">
                   @foreach ($shop_orders->where('status', 'processing') as $items)
                   <div class="order-box">
                    <div class="order-header">
                      <span><i data-feather="box"></i></span>
                      <div class="order-content">

                        <h5 class="order-status success">{{$items->status}}</h5>
                        <div class="d-flex justify-content-around flex-column flex-md-row">
                            <div class="status">
                                <p>Place {{$items->created_at}} Updated At <strong>{{$items->updated_at}}</strong></p>

                                <p>Change the Order Status By: <strong>{{$items->changed_status == 'Seller' ? 'You' : 'Support Team'  }}</strong></p>

                                <p>Message: <strong>{{$items->message}}</strong></p>
                                <p>Order ID: <strong>{{$items->orderId}}</strong></p>
                                <p>Order ID: <strong>{{$items->orders->status ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                            <div class="devlier">
                                <h3>Delivery Details</h3>
                                <p>Name : <strong>{{$items->orders->name  ?? 'Maybe Deleted'}}</strong></p>
                                <p>MObile : <strong>{{$items->orders->phone  ?? 'Maybe Deleted'}}</strong></p>
                                <p>State/Province : <strong>{{$items->orders->province  ?? 'Maybe Deleted'}}</strong></p>
                                <p>City : <strong>{{$items->orders->city  ?? 'Maybe Deleted'}}</strong></p>
                                <p>Address : <strong>{{$items->orders->address  ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                        </div>
                           @if (!is_null($items->orders))
                           <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$items->id}}">
                            Change Status
                        </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$items->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeShopOrderStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$items->id}}">
                                        <input type="hidden" name="shop_id" value="{{$items->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$items->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$items->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$items->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$items->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$items->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$items->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$items->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$items->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="order-info">
                        @foreach ($items->order_details as $item)
                      <div class="product-details" style="border: 1px solid rgb(199, 199, 199); border-radius:10px; padding:1rem; margin:1rem 0px;" >
                        <div class="img-box"><img src="{{asset($item->product_image)}}" alt="product" /></div>
                        <div class="product-content">
                            <h4><strong class="text-uppercase text-light p-1" style="background-color: black">{{$item->status}}</strong></h4>
                            <br>
                          <h5>{{$item->product_name}}</h5>

                          <span>Prise : <span>Rs.{{$item->price}}</span></span>
                          <span>Sale Price : <span>Rs.{{$item->discount_price}}</span></span>

                          <span>Order Id : <span>{{$item->order->orderId}}</span></span>
                          <span>Quantity : <span>{{$item->quantity}}</span></span>

                             <!-- Button trigger modal -->
                             <button type="button" {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSubItem{{$item->id}}">
                                Change Status
                            </button>
                            </div>
                          </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalSubItem{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('changeOrderStatus')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="shop_id" value="{{$item->shop_id}}">
                                            <div class="mb-3">
                                              <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                             <select name="status" required id="" class="form-control">
                                                <option value="pending" {{$item->status == 'pending' ? 'selected':''}}>New</option>
                                                <option value="processing" {{$item->status == 'processing' ? 'selected':''}}>Processing</option>
                                                <option value="delivered" {{$item->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                                <option value="onDelivery" {{$item->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                                <option value="cancelled" {{$item->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                                <option value="return" {{$item->status == 'return' ? 'selected':''}}>Return</option>
                                                <option value="refund" {{$item->status == 'refund' ? 'selected':''}}>Refund</option>

                                             </select>
                                            </div>
                                            <div class="mb-3">
                                              <label for="message-text" class="col-form-label">Message:</label>
                                              <textarea class="form-control" name="message" required id="message-text">{{$item->message}}</textarea>
                                             <br>
                                              <button type="stubmit" class="btn btn-primary">Submit</button>
                                            </div>
                                          </form>
                                    </div>
                                    <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                                </div>
                            </div>
                      @endforeach


                    </div>
                  </div>
                   @endforeach

                  </div>
                </div>
              </div>
              <!-- Order Tabs End -->
              <!-- Order Tabs Start -->
              <div class="tab-pane" id="delivered-orders" role="tabpanel" aria-labelledby="delivered-tab">
                <div class="cart-wrap order-content">
                  <div class="title-box3">
                    <h3>Delivered Orders {{$shop_orders->where('status', 'delivered')->count()}}</h3>

                  </div>

                  <div class="order-wraper">
                   @foreach ($shop_orders->where('status', 'delivered') as $items)
                   <div class="order-box">
                    <div class="order-header">
                      <span><i data-feather="box"></i></span>
                      <div class="order-content">
                        <h5 class="order-status success">{{$items->status}}</h5>
                        <div class="d-flex justify-content-around flex-column flex-md-row">
                            <div class="status">
                                <p>Place {{$items->created_at}} Updated At <strong>{{$items->updated_at}}</strong></p>

                                <p>Change the Order Status By: <strong>{{$items->changed_status == 'Seller' ? 'You' : 'Support Team'  }}</strong></p>

                                <p>Message: <strong>{{$items->message}}</strong></p>
                                <p>Order ID: <strong>{{$items->orderId}}</strong></p>
                                <p>Order ID: <strong>{{$items->orders->status ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                            <div class="devlier">
                                <h3>Delivery Details</h3>
                                <p>Name : <strong>{{$items->orders->name  ?? 'Maybe Deleted'}}</strong></p>
                                <p>MObile : <strong>{{$items->orders->phone  ?? 'Maybe Deleted'}}</strong></p>
                                <p>State/Province : <strong>{{$items->orders->province  ?? 'Maybe Deleted'}}</strong></p>
                                <p>City : <strong>{{$items->orders->city  ?? 'Maybe Deleted'}}</strong></p>
                                <p>Address : <strong>{{$items->orders->address  ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                        </div>
                        <h6>
                           @if (!is_null($items->orders))
                           <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$items->id}}">
                            Change Status
                        </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$items->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeShopOrderStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$items->id}}">
                                        <input type="hidden" name="shop_id" value="{{$items->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$items->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$items->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$items->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$items->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$items->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$items->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$items->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$items->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="order-info">
                        @foreach ($items->order_details as $item)
                      <div class="product-details" style="border: 1px solid rgb(199, 199, 199); border-radius:10px; padding:1rem; margin:1rem 0px;" >
                        <div class="img-box"><img src="{{asset($item->product_image)}}" alt="product" /></div>
                        <div class="product-content">
                            <h4><strong class="text-uppercase text-light p-1" style="background-color: black">{{$item->status}}</strong></h4>
                            <br>
                          <h5>{{$item->product_name}}</h5>

                          <span>Prise : <span>Rs.{{$item->price}}</span></span>
                          <span>Sale Price : <span>Rs.{{$item->discount_price}}</span></span>

                          <span>Order Id : <span>{{$item->order->orderId}}</span></span>
                          <span>Quantity : <span>{{$item->quantity}}</span></span>

                            <!-- Button trigger modal -->
                            <button type="button" {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSubItem{{$item->id}}">
                                Change Status
                            </button>
                            </div>
                          </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalSubItem{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('changeOrderStatus')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="shop_id" value="{{$item->shop_id}}">
                                            <div class="mb-3">
                                              <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                             <select name="status" required id="" class="form-control">
                                                <option value="pending" {{$item->status == 'pending' ? 'selected':''}}>New</option>
                                                <option value="processing" {{$item->status == 'processing' ? 'selected':''}}>Processing</option>
                                                <option value="delivered" {{$item->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                                <option value="onDelivery" {{$item->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                                <option value="cancelled" {{$item->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                                <option value="return" {{$item->status == 'return' ? 'selected':''}}>Return</option>
                                                <option value="refund" {{$item->status == 'refund' ? 'selected':''}}>Refund</option>

                                             </select>
                                            </div>
                                            <div class="mb-3">
                                              <label for="message-text" class="col-form-label">Message:</label>
                                              <textarea class="form-control" name="message" required id="message-text">{{$item->message}}</textarea>
                                             <br>
                                              <button type="stubmit" class="btn btn-primary">Submit</button>
                                            </div>
                                          </form>
                                    </div>
                                    <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                                </div>
                            </div>
                      @endforeach


                    </div>
                  </div>
                   @endforeach

                  </div>
                </div>
              </div>
              <!-- Order Tabs End -->

              <!-- Order Tabs Start -->
              <div class="tab-pane" id="cancelled-orders" role="tabpanel" aria-labelledby="cancelled-orders-tab">
                <div class="cart-wrap order-content">
                  <div class="title-box3">
                    <h3>Cancelled Orders {{$shop_orders->where('status', 'cancelled')->count()}}</h3>
                  </div>

                  <div class="order-wraper">
                   @foreach ($shop_orders->where('status', 'cancelled') as $items)
                   {{-- {{dd($items)}} --}}
                   <div class="order-box">
                    <div class="order-header">
                      <span><i data-feather="box"></i></span>
                      <div class="order-content">
                        <h5 class="order-status success">{{$items->status}}</h5>
                        <div class="d-flex justify-content-around flex-column flex-md-row">
                            <div class="status">
                                <p>Place {{$items->created_at}} Updated At <strong>{{$items->updated_at}}</strong></p>

                                <p>Change the Order Status By: <strong>{{$items->changed_status == 'Seller' ? 'You' : 'Support Team'  }}</strong></p>

                                <p>Message: <strong>{{$items->message}}</strong></p>
                                <p>Order ID: <strong>{{$items->orderId}}</strong></p>
                                <p>Order ID: <strong>{{$items->orders->status ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                            <div class="devlier">
                                <h3>Delivery Details</h3>
                                <p>Name : <strong>{{$items->orders->name  ?? 'Maybe Deleted'}}</strong></p>
                                <p>MObile : <strong>{{$items->orders->phone  ?? 'Maybe Deleted'}}</strong></p>
                                <p>State/Province : <strong>{{$items->orders->province  ?? 'Maybe Deleted'}}</strong></p>
                                <p>City : <strong>{{$items->orders->city  ?? 'Maybe Deleted'}}</strong></p>
                                <p>Address : <strong>{{$items->orders->address  ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                        </div>

                        <h6>
                           <!-- Button trigger modal -->
                           @if (!is_null($items->orders))
                           <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$items->id}}">
                            Change Status
                        </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$items->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeShopOrderStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$items->id}}">
                                        <input type="hidden" name="shop_id" value="{{$items->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$items->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$items->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$items->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$items->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$items->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$items->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$items->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$items->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="order-info">
                        @foreach ($items->order_details as $item)
                      <div class="product-details" style="border: 1px solid rgb(199, 199, 199); border-radius:10px; padding:1rem; margin:1rem 0px;" >
                        <div class="img-box"><img src="{{asset($item->product_image)}}" alt="product" /></div>
                        <div class="product-content">
                            <h4><strong class="text-uppercase text-light p-1" style="background-color: black">{{$item->status}}</strong></h4>
                            <br>
                          <h5>{{$item->product_name}}</h5>

                          <span>Prise : <span>Rs.{{$item->price}}</span></span>
                          <span>Sale Price : <span>Rs.{{$item->discount_price}}</span></span>

                          <span>Order Id : <span>{{$item->order->orderId}}</span></span>
                          <span>Quantity : <span>{{$item->quantity}}</span></span>

                             <!-- Button trigger modal -->
                             <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSubItem{{$item->id}}">
                                Change Status
                            </button>
                            </div>
                          </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalSubItem{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('changeOrderStatus')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="shop_id" value="{{$item->shop_id}}">
                                            <div class="mb-3">
                                              <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                             <select name="status" required id="" class="form-control">
                                                <option value="pending" {{$item->status == 'pending' ? 'selected':''}}>New</option>
                                                <option value="processing" {{$item->status == 'processing' ? 'selected':''}}>Processing</option>
                                                <option value="delivered" {{$item->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                                <option value="onDelivery" {{$item->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                                <option value="cancelled" {{$item->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                                <option value="return" {{$item->status == 'return' ? 'selected':''}}>Return</option>
                                                <option value="refund" {{$item->status == 'refund' ? 'selected':''}}>Refund</option>

                                             </select>
                                            </div>
                                            <div class="mb-3">
                                              <label for="message-text" class="col-form-label">Message:</label>
                                              <textarea class="form-control" name="message" required id="message-text">{{$item->message}}</textarea>
                                             <br>
                                              <button type="stubmit" class="btn btn-primary">Submit</button>
                                            </div>
                                          </form>
                                    </div>
                                    <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                                </div>
                            </div>
                      @endforeach



                    </div>
                  </div>
                   @endforeach

                  </div>
                </div>
              </div>
              <!-- Order Tabs End -->
              <!-- Order Tabs Start -->
              <div class="tab-pane" id="on-delivery-orders" role="tabpanel" aria-labelledby="on-delivery-orders-tab">
                <div class="cart-wrap order-content">
                  <div class="title-box3">
                    <h3>On-Delivery Orders {{$shop_orders->where('status', 'onDelivery')->count()}}</h3>

                  </div>

                  <div class="order-wraper">
                   @foreach ($shop_orders->where('status', 'onDelivery') as $items)
                   <div class="order-box">
                    <div class="order-header">
                      <span><i data-feather="box"></i></span>
                      <div class="order-content">
                        <h5 class="order-status success">{{$items->status}}</h5>
                        <div class="d-flex justify-content-around flex-column flex-md-row">
                            <div class="status">
                                <p>Place {{$items->created_at}} Updated At <strong>{{$items->updated_at}}</strong></p>

                                <p>Change the Order Status By: <strong>{{$items->changed_status == 'Seller' ? 'You' : 'Support Team'  }}</strong></p>

                                <p>Message: <strong>{{$items->message}}</strong></p>
                                <p>Order ID: <strong>{{$items->orderId}}</strong></p>
                                <p>Order ID: <strong>{{$items->orders->status ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                            <div class="devlier">
                                <h3>Delivery Details</h3>
                                <p>Name : <strong>{{$items->orders->name  ?? 'Maybe Deleted'}}</strong></p>
                                <p>MObile : <strong>{{$items->orders->phone  ?? 'Maybe Deleted'}}</strong></p>
                                <p>State/Province : <strong>{{$items->orders->province  ?? 'Maybe Deleted'}}</strong></p>
                                <p>City : <strong>{{$items->orders->city  ?? 'Maybe Deleted'}}</strong></p>
                                <p>Address : <strong>{{$items->orders->address  ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                        </div>

                        <h6>
                           @if (!is_null($items->orders))
                           <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$items->id}}">
                            Change Status
                        </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$items->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeShopOrderStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$items->id}}">
                                        <input type="hidden" name="shop_id" value="{{$items->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$items->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$items->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$items->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$items->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$items->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$items->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$items->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$items->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="order-info">
                        @foreach ($items->order_details as $item)
                        <div class="product-details" style="border: 1px solid rgb(199, 199, 199); border-radius:10px; padding:1rem; margin:1rem 0px;" >
                          <div class="img-box"><img src="{{asset($item->product_image)}}" alt="product" /></div>
                          <div class="product-content">
                            <h4><strong class="text-uppercase text-light p-1" style="background-color: black">{{$item->status}}</strong></h4>
                            <br>
                            <h5>{{$item->product_name}}</h5>

                            <span>Prise : <span>Rs.{{$item->price}}</span></span>
                            <span>Sale Price : <span>Rs.{{$item->discount_price}}</span></span>

                            <span>Order Id : <span>{{$item->order->orderId}}</span></span>
                            <span>Quantity : <span>{{$item->quantity}}</span></span>
      <!-- Button trigger modal -->
      <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSubItem{{$item->id}}">
        Change Status
    </button>
    </div>
  </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalSubItem{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('changeOrderStatus')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <input type="hidden" name="shop_id" value="{{$item->shop_id}}">
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Select Stutus</label>
                     <select name="status" required id="" class="form-control">
                        <option value="pending" {{$item->status == 'pending' ? 'selected':''}}>New</option>
                        <option value="processing" {{$item->status == 'processing' ? 'selected':''}}>Processing</option>
                        <option value="delivered" {{$item->status == 'delivered' ? 'selected':''}}>Delivered</option>
                        <option value="onDelivery" {{$item->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                        <option value="cancelled" {{$item->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                        <option value="return" {{$item->status == 'return' ? 'selected':''}}>Return</option>
                        <option value="refund" {{$item->status == 'refund' ? 'selected':''}}>Refund</option>

                     </select>
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Message:</label>
                      <textarea class="form-control" name="message" required id="message-text">{{$item->message}}</textarea>
                     <br>
                      <button type="stubmit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
            <div class="modal-footer">

            <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
        </div>
    </div>
                        @endforeach



                    </div>
                  </div>
                   @endforeach

                  </div>
                </div>
              </div>
              <!-- Order Tabs End -->
              <!-- Order Tabs Start -->
              <div class="tab-pane" id="return-orders" role="tabpanel" aria-labelledby="return-orders-tab">
                <div class="cart-wrap order-content">
                  <div class="title-box3">
                    <h3>Return Orders {{$shop_orders->where('status', 'return')->count()}}</h3>

                  </div>

                  <div class="order-wraper">
                   @foreach ($shop_orders->where('status', 'return') as $items)
                   <div class="order-box">
                    <div class="order-header">
                      <span><i data-feather="box"></i></span>
                      <div class="order-content">
                        <h5 class="order-status success">{{$items->status}}</h5>
                        <div class="d-flex justify-content-around flex-column flex-md-row">
                            <div class="status">
                                <p>Place {{$items->created_at}} Updated At <strong>{{$items->updated_at}}</strong></p>

                                <p>Change the Order Status By: <strong>{{$items->changed_status == 'Seller' ? 'You' : 'Support Team'  }}</strong></p>

                                <p>Message: <strong>{{$items->message}}</strong></p>
                                <p>Order ID: <strong>{{$items->orderId}}</strong></p>
                                <p>Order ID: <strong>{{$items->orders->status ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                            <div class="devlier">
                                <h3>Delivery Details</h3>
                                <p>Name : <strong>{{$items->orders->name  ?? 'Maybe Deleted'}}</strong></p>
                                <p>MObile : <strong>{{$items->orders->phone  ?? 'Maybe Deleted'}}</strong></p>
                                <p>State/Province : <strong>{{$items->orders->province  ?? 'Maybe Deleted'}}</strong></p>
                                <p>City : <strong>{{$items->orders->city  ?? 'Maybe Deleted'}}</strong></p>
                                <p>Address : <strong>{{$items->orders->address  ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                        </div>

                        <h6>
                           @if (!is_null($items->orders))
                           <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$items->id}}">
                            Change Status
                        </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$items->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeShopOrderStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$items->id}}">
                                        <input type="hidden" name="shop_id" value="{{$items->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$items->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$items->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$items->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$items->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$items->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$items->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$items->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$items->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="order-info">
                        @foreach ($items->order_details as $item)
                        <div class="product-details" style="border: 1px solid rgb(199, 199, 199); border-radius:10px; padding:1rem; margin:1rem 0px;" >
                          <div class="img-box"><img src="{{asset($item->product_image)}}" alt="product" /></div>
                          <div class="product-content">
                            <h4><strong class="text-uppercase text-light p-1" style="background-color: black">{{$item->status}}</strong></h4>
                            <br>
                            <h5>{{$item->product_name}}</h5>

                            <span>Prise : <span>Rs.{{$item->price}}</span></span>
                            <span>Sale Price : <span>Rs.{{$item->discount_price}}</span></span>

                            <span>Order Id : <span>{{$item->order->orderId}}</span></span>
                            <span>Quantity : <span>{{$item->quantity}}</span></span>

                               <!-- Button trigger modal -->
                        <button type="button" {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSubItem{{$item->id}}">
                            Change Status
                        </button>
                        </div>
                      </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalSubItem{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeOrderStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="shop_id" value="{{$item->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$item->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$item->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$item->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$item->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$item->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$item->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$item->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$item->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                  </div>
                   @endforeach

                  </div>
                </div>
              </div>
              <!-- Order Tabs End -->
              <!-- Order Tabs Start -->
              <div class="tab-pane" id="refund-orders" role="tabpanel" aria-labelledby="refund-orders-tab">
                <div class="cart-wrap order-content">
                  <div class="title-box3">
                    <h3>Refund Orders {{$shop_orders->where('status', 'refund')->count()}}</h3>

                  </div>

                  <div class="order-wraper">
                   @foreach ($shop_orders->where('status', 'refund') as $items)
                   <div class="order-box">
                    <div class="order-header">
                      <span><i data-feather="box"></i></span>
                      <div class="order-content">
                        <h5 class="order-status success">{{$items->status}}</h5>
                        <div class="d-flex justify-content-around flex-column flex-md-row">
                            <div class="status">
                                <p>Place {{$items->created_at}} Updated At <strong>{{$items->updated_at}}</strong></p>

                                <p>Change the Order Status By: <strong>{{$items->changed_status == 'Seller' ? 'You' : 'Support Team'  }}</strong></p>

                                <p>Message: <strong>{{$items->message}}</strong></p>
                                <p>Order ID: <strong>{{$items->orderId}}</strong></p>
                                <p>Order ID: <strong>{{$items->orders->status ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                            <div class="devlier">
                                <h3>Delivery Details</h3>
                                <p>Name : <strong>{{$items->orders->name  ?? 'Maybe Deleted'}}</strong></p>
                                <p>MObile : <strong>{{$items->orders->phone  ?? 'Maybe Deleted'}}</strong></p>
                                <p>State/Province : <strong>{{$items->orders->province  ?? 'Maybe Deleted'}}</strong></p>
                                <p>City : <strong>{{$items->orders->city  ?? 'Maybe Deleted'}}</strong></p>
                                <p>Address : <strong>{{$items->orders->address  ?? 'Maybe Deleted'}}</strong></p>
                            </div>
                        </div>

                        <h6>
                           @if (!is_null($items->orders))
                           <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$items->id}}">
                            Change Status
                        </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$items->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('changeShopOrderStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$items->id}}">
                                        <input type="hidden" name="shop_id" value="{{$items->shop_id}}">
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                         <select name="status" required id="" class="form-control">
                                            <option value="pending" {{$items->status == 'pending' ? 'selected':''}}>New</option>
                                            <option value="processing" {{$items->status == 'processing' ? 'selected':''}}>Processing</option>
                                            <option value="delivered" {{$items->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                            <option value="onDelivery" {{$items->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                            <option value="cancelled" {{$items->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                            <option value="return" {{$items->status == 'return' ? 'selected':''}}>Return</option>
                                            <option value="refund" {{$items->status == 'refund' ? 'selected':''}}>Refund</option>

                                         </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Message:</label>
                                          <textarea class="form-control" name="message" required id="message-text">{{$items->message}}</textarea>
                                         <br>
                                          <button type="stubmit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">

                                <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="order-info">
                        @foreach ($items->order_details as $item)
                      <div class="product-details" style="border: 1px solid rgb(199, 199, 199); border-radius:10px; padding:1rem; margin:1rem 0px;" >
                        <div class="img-box"><img src="{{asset($item->product_image)}}" alt="product" /></div>
                        <div class="product-content">
                            <h4><strong class="text-uppercase text-light p-1" style="background-color: black">{{$item->status}}</strong></h4>
                            <br>
                          <h5>{{$item->product_name}}</h5>

                          <span>Prise : <span>Rs.{{$item->price}}</span></span>
                          <span>Sale Price : <span>Rs.{{$item->discount_price}}</span></span>

                          <span>Order Id : <span>{{$item->order->orderId}}</span></span>
                          <span>Quantity : <span>{{$item->quantity}}</span></span>

                            <!-- Button trigger modal -->
                            <button {{($items->orders->status == 'pending'|| $items->orders->status =='cancelled'||$items->orders->status =='return'|| $items->orders->status =='refund'||$items->orders->status =='deliverd'|| $items->orders->status=='onDelivery') ? 'disabled':'' }} type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSubItem{{$item->id}}">
                                Change Status
                            </button>
                            </div>
                          </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalSubItem{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Order Status</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('changeOrderStatus')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="shop_id" value="{{$item->shop_id}}">
                                            <div class="mb-3">
                                              <label for="recipient-name" class="col-form-label">Select Stutus</label>
                                             <select name="status" required id="" class="form-control">
                                                <option value="pending" {{$item->status == 'pending' ? 'selected':''}}>New</option>
                                                <option value="processing" {{$item->status == 'processing' ? 'selected':''}}>Processing</option>
                                                <option value="delivered" {{$item->status == 'delivered' ? 'selected':''}}>Delivered</option>
                                                <option value="onDelivery" {{$item->status == 'onDelivery' ? 'selected':''}}>On-Delivery</option>
                                                <option value="cancelled" {{$item->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                                <option value="return" {{$item->status == 'return' ? 'selected':''}}>Return</option>
                                                <option value="refund" {{$item->status == 'refund' ? 'selected':''}}>Refund</option>

                                             </select>
                                            </div>
                                            <div class="mb-3">
                                              <label for="message-text" class="col-form-label">Message:</label>
                                              <textarea class="form-control" name="message" required id="message-text">{{$item->message}}</textarea>
                                             <br>
                                              <button type="stubmit" class="btn btn-primary">Submit</button>
                                            </div>
                                          </form>
                                    </div>
                                    <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                                </div>
                            </div>
                      @endforeach


                    </div>
                  </div>
                   @endforeach

                  </div>
                </div>
              </div>
              <!-- Order Tabs End -->

              <!-- Order Detail Tab Start -->
              <div class="tab-pane" id="orders-details" role="tabpanel" aria-labelledby="orders-details">
                <div class="order-detail-wrap order-content">
                  <div class="row g-3 g-md-4">
                    <div class="col-12">
                      <div class="order-summery-wrap mt-0 order-data">
                        <div class="banner-box">
                          <div class="media">
                            <div class="img">
                              <i data-feather="package"></i>
                            </div>
                            <div class="media-body">
                              <h2>Order Delivered</h2>
                              <span class="font-sm">Delivered On July 15 2022</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="product-details">
                        <div class="img-box"><img src="../assets/images/fashion/product/front/4.jpg" alt="product" /></div>
                        <div class="product-content">
                          <h5>Women’s long sleeve Jacket</h5>
                          <p class="truncate-3">
                            Versatile sporty slogans short sleeve quirky laid back orange lux hoodies vests pins badges. Versatile sporty slogans short sleeve quirky laid back orange lux hoodies
                            vests pins badges. Cutting edge crops stone transparent.
                          </p>
                          <span>Prize : <span>$120.00</span></span>
                          <span>Size : <span>M</span></span>
                          <span>Order Id : <span>edf125qa1d35</span></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="order-data summery-wrap">
                        <div class="order-summery-box">
                          <h5 class="cart-title">Price Details (1 Quantity)</h5>
                          <ul class="order-summery">
                            <li>
                              <span>Bag total</span>
                              <span>$220.00</span>
                            </li>

                            <li>
                              <span>Bag savings</span>
                              <span class="theme-color">-$20.00</span>
                            </li>

                            <li>
                              <span>Coupon Discount</span>
                              <a href="offer.html" class="font-danger">$120.00</a>
                            </li>

                            <li>
                              <span>Delivery</span>
                              <span>$50.00</span>
                            </li>

                            <li class="pb-0">
                              <span>Total Amount</span>
                              <span>$270.00</span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="row gy-3 gy-sm-0 g-3 g-md-4">
                        <div class="col-sm-6">
                          <div class="order-data general-details">
                            <!-- Payment Method Start -->
                            <div class="payment-method mt-0">
                              <h5 class="cart-title">Payment Method</h5>
                              <div class="payment-box">
                                <img src="../assets/icons/png/1.png" alt="card" />
                                <span class="font-sm title-color"> **** **** **** 6502</span>
                              </div>
                            </div>
                            <!-- Payment Method End -->

                            <button class="btn-solid mb-line btn-sm mt-4">Get Invoice <i class="arrow"></i></button>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="order-data general-details">
                            <!-- Contact Start -->
                            <div class="payment-method mt-0">
                              <h5 class="cart-title">Contact Us</h5>

                              <div class="payment-box">
                                <i data-feather="phone"></i>
                                <span class="font-sm title-color">
                                  <a class="content-color fw-500" href="tel:2554-4454-5646">2554-4454-5646</a>
                                </span>
                              </div>

                              <div class="payment-box mt-3">
                                <i data-feather="phone"></i>
                                <span class="font-sm title-color">
                                  <a class="content-color fw-500" href="tel:5452-2545-2154">5452-2545-2154</a>
                                </span>
                              </div>

                              <div class="payment-box mt-3">
                                <i data-feather="mail"></i>
                                <span class="font-sm title-color">
                                  <a class="content-color fw-500" href="mailto:someone@example.com">someone@example.com</a>
                                </span>
                              </div>
                            </div>
                            <!-- Contact End -->
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="order-data general-details">
                        <!-- Address Section Start -->
                        <div class="address-ordered p-0">
                          <h5 class="cart-title">Order Address</h5>
                          <div class="address">
                            <h5 class="font-default title-color">Nadine Vogt <span class="badges badges-pill badges-theme">Home</span></h5>
                            <p class="font-default content-color"><i data-feather="map-pin"></i> 1418 Riverwood Drive, Suite 3245 Cottonwood, CA 96052, United States</p>
                          </div>
                        </div>
                        <!-- Address Section End -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Order Detail Tab End -->

              <!-- Saved Address Tabs Start -->
              <div class="tab-pane" id="savedAddress" role="tabpanel" aria-labelledby="savedAddress-tab">
                <div class="address-tab">
                  <div class="title-box3">
                    <h3>Your Saved Address</h3>
                    <p>here is your saved address, from here you can easily add or modify your address</p>
                  </div>

                  <div class="row g-3 g-md-4">
                    <div class="col-md-6 col-lg-12 col-xl-6">
                      <div class="address-box checked">
                        <div class="radio-box">
                          <div>
                            <input class="radio-input" type="radio" checked id="radio1" name="radio1" />
                            <label class="radio-label" for="radio1">Abigail</label>
                          </div>
                          <span class="badges badges-pill badges-theme">Home</span>
                          <div class="option-wrap">
                            <span class="edit" data-bs-toggle="modal" data-bs-target="#edditAddress"><i data-feather="edit"></i></span>
                            <span class="delet ms-0" data-bs-toggle="modal" data-bs-target="#conformation"><i data-feather="trash"></i></span>
                          </div>
                        </div>
                        <div class="address-detail">
                          <p class="content-color font-default">3385 Happy Hollow Road Wilmington, NC 28412</p>
                          <p class="content-color font-default">United State,325014</p>
                          <span class="content-color font-default">Mobile: <span class="title-color font-default fw-500"> 423-772-0570</span></span>
                          <span class="content-color font-default mt-1">Delivery: <span class="title-color font-default fw-500"> 2 March</span></span>
                          <span class="content-color font-default mt-1">Cash on Delivery: <span class="title-color font-default fw-500"> Available</span></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-12 col-xl-6">
                      <div class="address-box">
                        <div class="radio-box">
                          <div>
                            <input class="radio-input" type="radio" id="radio3" name="radio1" />
                            <label class="radio-label" for="radio3">Freddy J. Burns</label>
                          </div>
                          <span class="badges badges-pill badges-theme">Home</span>
                          <div class="option-wrap">
                            <span class="edit" data-bs-toggle="modal" data-bs-target="#edditAddress"><i data-feather="edit"></i></span>
                            <span class="delet ms-0" data-bs-toggle="modal" data-bs-target="#conformation"><i data-feather="trash"></i></span>
                          </div>
                        </div>
                        <div class="address-detail">
                          <p class="content-color font-default">198 Terry Lane Orlando, FL 32809</p>
                          <p class="content-color font-default">Germany,254685</p>
                          <span class="content-color font-default">Mobile: <span class="title-color font-default fw-500"> 353-582-5870</span></span>

                          <span class="content-color font-default mt-1">Delivery: <span class="title-color font-default fw-500"> 4 March</span></span>
                          <span class="content-color font-default mt-1">Cash on Delivery: <span class="title-color font-default fw-500"> Available</span></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-12 col-xl-6">
                      <div class="address-box">
                        <div class="radio-box">
                          <div>
                            <input class="radio-input" type="radio" id="radio2" name="radio1" />
                            <label class="radio-label" for="radio2">Nadine Vogt</label>
                          </div>
                          <span class="badges badges-pill badges-theme">Office</span>
                          <div class="option-wrap">
                            <span class="edit" data-bs-toggle="modal" data-bs-target="#edditAddress"><i data-feather="edit"></i></span>
                            <span class="delet ms-0" data-bs-toggle="modal" data-bs-target="#conformation"><i data-feather="trash"></i></span>
                          </div>
                        </div>
                        <div class="address-detail">
                          <p class="content-color font-default">Wachaustrasse 22 8045 WEINITZEN</p>
                          <p class="content-color font-default">Austria,35546</p>
                          <span class="content-color font-default">Mobile: <span class="title-color font-default fw-500"> 454-254-3654</span></span>
                          <span class="content-color font-default mt-1">Delivery: <span class="title-color font-default fw-500"> 5 March</span></span>
                          <span class="content-color font-default mt-1">Cash on Delivery: <span class="title-color font-default fw-500">Not Available</span></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-12 col-xl-6">
                      <div class="address-box add-new d-flex flex-column gap-2 align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addNewAddress">
                        <span class="plus-icon"><i data-feather="plus"></i></span>
                        <h4 class="theme-color font-xl fw-500">Add New Address</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Saved Address Tabs End -->

              <!-- Payment Tabs Start -->
              <div class="tab-pane" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                <div class="payment-tab">
                  <div class="d-flex align-items-start align-items-sm-center justify-content-between title-box3">
                    <div>
                      <h3>Your Saved Card</h3>
                      <p>here is your saved card, from here you can easily add or modify your card</p>
                    </div>
                    <button class="btn btn-outline btn-sm white-space-no" data-bs-toggle="modal" data-bs-target="#addNewcard">Add Card</button>
                  </div>

                  <div class="payment-section">
                    <div class="row g-3 g-xl-4">
                      <div class="col-sm-6 col-xl-4">
                        <div class="payment-card bg-theme-blue border-color-blue">
                          <div class="bank-info">
                            <img class="bank" src="../assets/icons/png/bank1.png" alt="bank1" />
                            <div class="card-type">
                              <img class="bank-card" src="../assets/icons/png/1.png" alt="card" />
                            </div>
                          </div>

                          <div class="card-details">
                            <span>Card Number</span>
                            <h5>6458 50XX XXXX 0851</h5>
                          </div>

                          <div class="card-details-wrap">
                            <div class="card-details">
                              <span>Name On Card</span>
                              <h5>Josephin water</h5>
                            </div>

                            <div class="text-center card-details">
                              <span>Validity</span>
                              <h5>XX/XX</h5>
                            </div>
                          </div>

                          <div class="btn-box">
                            <span data-bs-toggle="modal" data-bs-target="#editCard"> <i data-feather="edit"></i></span>
                            <span data-bs-toggle="modal" data-bs-target="#conformation"><i data-feather="trash"></i></span>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6 col-xl-4">
                        <div class="payment-card bg-theme-orange border-color-orange">
                          <div class="bank-info">
                            <img class="bank" src="../assets/icons/png/bank2.png" alt="bank1" />
                            <div class="card-type">
                              <img class="bank-card" src="../assets/icons/png/2.png" alt="card" />
                            </div>
                          </div>

                          <div class="card-details">
                            <span>Card Number</span>
                            <h5>2564 75XX XXXX 3545</h5>
                          </div>

                          <div class="card-details-wrap">
                            <div class="card-details">
                              <span>Name On Card</span>
                              <h5>Josephin water</h5>
                            </div>
                            <div class="text-center card-details">
                              <span>Validity</span>
                              <h5>XX/XX</h5>
                            </div>
                          </div>

                          <div class="btn-box">
                            <span data-bs-toggle="modal" data-bs-target="#editCard"><i data-feather="edit"></i></span>
                            <span data-bs-toggle="modal" data-bs-target="#conformation"><i data-feather="trash"></i></span>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6 col-xl-4">
                        <div class="payment-card bg-theme-yellow border-color-yellow">
                          <div class="bank-info">
                            <img class="bank" src="../assets/icons/png/bank3.png" alt="bank1" />
                            <div class="card-type">
                              <img class="bank-card" src="../assets/icons/png/5.png" alt="card" />
                            </div>
                          </div>

                          <div class="card-details">
                            <span>Card Number</span>
                            <h5>8564 34XX XXXX 9564</h5>
                          </div>

                          <div class="card-details-wrap">
                            <div class="card-details">
                              <span>Name On Card</span>
                              <h5>Josephin water</h5>
                            </div>
                            <div class="text-center card-details">
                              <span>Validity</span>
                              <h5>XX/XX</h5>
                            </div>
                          </div>

                          <div class="btn-box">
                            <span data-bs-toggle="modal" data-bs-target="#editCard"><i data-feather="edit"> </i></span>
                            <span data-bs-toggle="modal" data-bs-target="#conformation"><i data-feather="trash"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Payment Tabs End -->

              <!-- Profile Tabs Start -->
              <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="profile">
                  <div class="title-box3">
                    <h3>Your Shop Information</h3>
                  </div>

                  <form action="{{ route('updateShopRequest')}}" method="POST" class="custom-form form-pill">
                    <input type="hidden" name="id" value="{{$shop->id}}">
                    @csrf
                    <div class="row g-3 g-xl-4">
                      <div class="col-sm-12 text-center">
                        <div class="input-box">
                          {{-- <label for="fullname">Shop Name</label> --}}
                          {{-- <input class="form-control" id="fullname" name="fullname"  value="{{$shop->name}}" type="text"  /> --}}
                          <a href="{{asset($shop->image)}}" target="_blank">
                          <img src="{{asset($shop->image)}}" alt="" style="height: 200px ; width:200px; object-fit:contain">
                        </a>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-box">
                          <label for="fullname">Change Shop Image</label>
                          <input class="form-control" id="fullname" name="image"  type="file"  />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-box">
                          <label for="fullname">Shop Name</label>
                          <input class="form-control" id="fullname" name="name"  required value="{{$shop->name}}" type="text"  />
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="input-box">
                          <label for="email">Provine</label>
                          <input class="form-control" id="email" name="province" required type="text" value="{{$shop->province}}" />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-box">
                          <label for="email">City</label>
                          <input class="form-control" id="email" name="city" required type="text" value="{{$shop->city}}" />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-box">
                          <label for="email">Address</label>
                          <input class="form-control" id="email" name="address" required type="text" value="{{$shop->address}}" />
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="input-box">
                          <label for="mobile">Mobile</label>
                          <input maxlength="10" class="form-control" readonly id="mobile" name="mobile" required type="number" value="{{$shop->mobile}}" />
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-box">
                          <label for="mobile">WhatsApp</label>
                          <input maxlength="10" class="form-control" readonly id="mobile" name="whatsapp" required type="number" value="{{$shop->whatsapp}}" />
                        </div>
                      </div>
                    <div class="btn-box">
                        @if ($shop->status == 'blocked')
                            <button type="submit" class="btn-outline btn-sm">Update</button>
                        @endif
                      {{-- <button class="btn-outline btn-sm">Cancel</button>
                      <button class="btn-solid btn-sm">Save Changes <i class="arrow"></i></button> --}}
                    </div>
                  </form>
                </div>
              </div>
              <!-- Profile Tabs End -->

              {{-- <!-- Security Tabs Start -->
              <div class="tab-pane" id="security" role="tabpanel" aria-labelledby="security-tab">
                <div class="privacy-tab">
                  <div class="privacy box">
                    <div class="title-box3">
                      <h3>Privacy</h3>
                    </div>

                    <div class="setting-option">
                      <div class="content-box">
                        <h6 class="font-roboto">Allows others to see my profile</h6>
                        <p class="font-roboto">all peoples will be able to see my profile.</p>
                      </div>
                      <label class="switch"> <input checked type="checkbox" name="chk1" value="option1" class="setting-check" /><span class="switch-state"></span> </label>
                    </div>

                    <div class="setting-option mt-3">
                      <div class="content-box">
                        <h6 class="font-roboto">Who has save this profile only that people see my profile</h6>
                        <p class="font-roboto">all peoples will not be able to see my profile.</p>
                      </div>
                      <label class="switch"> <input type="checkbox" name="chk2" value="option1" class="setting-check" /><span class="switch-state"></span> </label>
                    </div>

                    <button class="btn-solid btn-sm">Save Changes <i class="arrow"></i></button>
                  </div>

                  <div class="account-box">
                    <div class="title-box3">
                      <h3>Account settings</h3>
                    </div>

                    <div class="setting-option">
                      <div class="content-box">
                        <h6 class="font-roboto">Deleting Your Account Will Permanently</h6>
                        <p class="font-roboto">Once your account is deleted, you will be logged out and will be unable to log in back.</p>
                      </div>
                      <label class="switch"> <input type="checkbox" name="chk3" value="option2" class="setting-check" checked /><span class="switch-state"></span> </label>
                    </div>

                    <div class="setting-option mt-3">
                      <div class="content-box">
                        <h6 class="font-roboto">Deleting Your Account Will Temporary</h6>
                        <p class="font-roboto">Once your account is deleted, you will be logged out and you will be create new account.</p>
                      </div>
                      <label class="switch"> <input type="checkbox" name="chk4" value="option4" class="setting-check" /><span class="switch-state"></span> </label>
                    </div>

                    <button class="btn-solid btn-sm">Save Changes <i class="arrow"></i></button>
                  </div>
                </div>
              </div>
              <!-- Security Tabs End --> --}}
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Dashboard End -->
  <!-- / end payment method Modal -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

  <script src="{{ asset('newtheme/assets/js/user-dashboard-tab.js') }}"></script>
  <script>
      // alert(' working ');
      $(document).ready(function() {
// alert(' working ');

          $('#setting_shower').on('click', function() {
              $('#setting_hider').addClass("show-menu");
          });
          $('#setting_closer').on('click', function() {
              $('#setting_hider').removeClass("show-menu");
          });
          $('#setting_hider').on('click', function() {
              $('#setting_hider').removeClass("show-menu");
          });


          $('.alert').alert();
      });
  </script>

@endsection
