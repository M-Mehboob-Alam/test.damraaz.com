@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">

                        </div>
                        <h5>Shop Details</h5>
                        Mega Sales Status Is @if ($shops->isAllowedMegaSale)
                          <span class="text-success">Allowed</span>
                        @else
                           <spna class="text-danger">Not Allowed</spna>
                        @endif
                        @if ($shops->isAllowedMegaSale)
                            <a href="{{ route('admin.changeMegaSaleStatus', $shops->id) }}" class="btn btn-danger ">Set To Not Allow Mega Sales</a>
                        @else
                            <a href="{{ route('admin.changeMegaSaleStatus', $shops->id) }}" class="btn btn-warning " >Set To Allow Mega Sales</a>
                        @endif
                        <form action="{{route('admin.approvedNewShop')}}" method="POST">
                            <input required type="hidden" name="id" value="{{$shops->id}}">
                            @csrf
                            <div class="mb-3 text-center">
                              <label for="exampleInputPassword1" class="form-label">Shop Image</label>
                              <br>
                                <img src="{{asset($shops->image)}}" alt="" class="" style="height: 300px; width: 300px; object-fit:contain">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Shop Name</label>
                              <input required type="text" class="form-control" name="name" value="{{$shops->name}}" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <h6>Do You Have Products Available At WholeSale Rate?:</h6>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" {{$shops->wholesale ? 'checked' : ''}} required name="wholesale" id="inlineRadio1" value=1>
                                  <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" {{$shops->wholesale ? '' : 'checked'}} name="wholesale" id="inlineRadio2" value=0>
                                  <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                             </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Change Shop Status</label>
                              <select class="form-control" name="status" required >
                                <option value="">Select Status</option>
                                <option {{$shops->status =="approved" ? 'selected': ''}} value="approved">Approved</option>
                                <option {{$shops->status =="pending" ? 'selected': ''}} value="pending">Pending</option>
                                <option {{$shops->status =="blocked" ? 'selected': ''}} value="blocked">Blocked</option>
                                <option {{$shops->status =="inActive" ? 'selected': ''}} value="inActive">In-Active</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Message</label>
                                <textarea name="message" required class="form-control">{{$shops->message}}</textarea>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Shop Mobile</label>
                              <input required type="number" class="form-control" name="mobile" value="{{$shops->mobile}}" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">WhatsApp</label>
                                <input required type="number" class="form-control" name="whatsapp" value="{{$shops->whatsapp}}" id="exampleInputPassword1">
                              </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Shop State/Province</label>
                              <input required type="text" class="form-control" name="province" value="{{$shops->province}}" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Shop City</label>
                              <input required type="text" class="form-control" name="city" value="{{$shops->city}}" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Shop Address</label>
                              <input required type="text" class="form-control" name="address" value="{{$shops->address}}" id="exampleInputPassword1">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                        <div class="title-header option-title">
                            <h5>All Products</h5>
                            {{-- <form class="d-inline-flex">
                                <a href="{{ route('admin.product.create') }}" class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Add New
                                </a>
                            </form> --}}
                        </div>

                        <div class="table-responsive product-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Active</th>
                                            <th>Image</th>
                                            <!--<th>info</th>-->
                                            <th>Date</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->status }}</td>
                                                <td>
                                                    @if ($product->isActive)
                                                        Yes
                                                    @else
                                                        Not
                                                    @endif
                                                </td>
                                                <td>

                                                    <div class="table-image">
                                                        <img src="{{ asset($product->image) }}" class="img-fluid" alt="">
                                                    </div>
                                                </td>

                                                <!--<td>{{ $product->detail }}    </td>-->

                                                <td>{{ $product->created_at }}</td>

                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('admin.product.show', $product->id) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('admin.product.edit', $product->id) }}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#delete{{ $product->id }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                            <!-- Delete Modal Box Start -->
                                                            <div class="modal fade theme-modal remove-coupon"
                                                                id="delete{{ $product->id }}" aria-hidden="true"
                                                                tabindex="-1">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header d-block text-center">
                                                                            <h5 class="modal-title w-100"
                                                                                id="exampleModalLabel22">Are You Sure ?</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"><i
                                                                                    class="fas fa-times"></i></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="remove-box">
                                                                                <p>You wanna delete this</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-animation btn-md fw-bold"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <form
                                                                                action="{{ route('admin.product.destroy', $product->id) }}"
                                                                                method="POST" class="">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-animation btn-md fw-bold"
                                                                                    data-bs-target="#exampleModalToggle2"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-dismiss="modal">Yes</button>
                                                                                {{-- <button type="submit" class=" text-danger btn" style="background-color: white; padding:3px;" title="Delete"><i class="fa fa-trash"></i></button> --}}
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="title-header option-title">
                            <h5>Shop Orders</h5>

                        </div>

                        <div class="table-responsive product-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>username</th>
                                            <th>receiver name</th>
                                            <th>Status</th>
                                            <th>Total Amount</th>
                                            <th>City</th>
                                            <!--<th>info</th>-->
                                            <th>Date</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($shop_orders as $product)
                                            @if (!is_null($product->orders))


                                            <tr>
                                                <td>{{ $product->orders->orderId ?? '' }}</td>
                                                <td>{{ $product->orders->user->username ?? ''}}</td>
                                                <td>{{ $product->orders->name ?? ''}}</td>
                                                <td>{{ $product->orders->status ?? ''}}</td>
                                                <td>{{ $product->orders->total_amount ?? ''}}</td>
                                                <td> {{ $product->orders->city ?? '' }}</td>

                                                <td>{{ $product->created_at }}</td>

                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('admin.view.order', $product->orders->id) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>

                                                         <li>
                                                            <a href="{{ route('admin.view.order.status', $product->orders->id) }}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
