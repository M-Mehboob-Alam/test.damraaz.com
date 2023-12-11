@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Branding Information</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form" method="POST"
                                    action="{{ route('admin.branding.update' ) }}"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="{{ $branding->id }}">

                                    @csrf



                                    <div class="mb-4 row align-items-center">
                                        <a href="{{ asset($branding->image) }}" target="_blank">
                                        <img src="{{ asset($branding->image) }}" height="200px" width="1020px" alt="">
                                        </a>
                                        <label class="col-sm-3 col-form-label form-label-title">Change Branding Image</label>
                                        <div class="form-group col-sm-9">
                                            <input class="form-control @error('image') is-invalid @enderror" name="image"
                                                type="file"  placeholder="branding Name">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">branding Name</label>
                                        <div class="col-sm-9">
                                            <input value="{{ $branding->name ?? '' }}"
                                                class="form-control  @error('name') is-invalid @enderror" name="name"
                                                type="text" placeholder="branding Name">
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-3 form-label-title">branding phone</div>
                                        <div class="col-sm-9">
                                            <textarea name="phone" id="" class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Enter branding phone">{{ $branding->phone ?? '' }} </textarea>
                                        </div>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-3 form-label-title">branding email</div>
                                        <div class="col-sm-9">
                                            <textarea name="email" id="" class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter branding email">{{ $branding->email ?? '' }} </textarea>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-3 form-label-title">branding address</div>
                                        <div class="col-sm-9">
                                            <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Enter branding address">{{ $branding->address ?? '' }} </textarea>
                                        </div>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary ms-auto" type="submit">Submit</button>

                                </form>
                                <div class="container my-5">
                                    <h2>
                                        Withdraw Completed {{ $brandingWithdraws->where('status', 'completed')->sum('amount') }}
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#withdrawBranding">
                                        Withdraw Now
                                    </a>
                                    <!-- Delete Modal Box Start -->
                                    <div class="modal fade theme-modal remove-coupon"
                                        id="withdrawBranding" aria-hidden="true"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-block text-center">
                                                    <h5 class="modal-title w-100"
                                                        id="exampleModalLabel22">Withdraw Now</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"><i
                                                            class="fas fa-times"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if (blank($checkBrandingWithdraw))
                                                    <form
                                                    action="{{ route('admin.addBrandingPaymentType') }}"
                                                    method="POST" class="">
                                                    @csrf
                                                    <input type="hidden" name="branding_id" value="{{ $branding->id }}">
                                                    <div class="form-group">
                                                        <label for="method">Payment Method </label>
                                                        <select class="form-control" id="method" required name="payment_type">
                                                            <option value="">Select Payment Method</option>
                                                            <option value="easypaisa">EasyPaisa</option>
                                                            <option value="jazzcash">JazzCash</option>
                                                            <option value="bank">Bank</option>
                                                        </select>
                                                      </div>
                                                    <div class="form-group">
                                                        <label for="accNam">Account Name</label>
                                                        <input type="text" class="form-control" id="accNam" required name="account_title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="accNam">Account No</label>
                                                        <input type="text" class="form-control" id="accNam" required name="account_no">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="accNam">Bank Name</label>
                                                        <input type="text" class="form-control" id="accNam" required name="bank_name" value="n/a">
                                                    </div>
                                                    <button type="submit"
                                                        class="btn  my-5 btn-animation btn-md fw-bold"
                                                        >Submit</button>
                                                </form>
                                                    @else
                                                        @if ($nextWithdraw)
                                                        <form
                                                        action="{{ route('admin.withdrawBrandingPayment') }}"
                                                        method="POST" class="">
                                                        @csrf
                                                        <input type="hidden" name="branding_id" value="{{ $branding->id }}">
                                                        <div class="form-group">
                                                            <label for="method">Payment Method </label>
                                                            <select class="form-control" id="method" required name="payment_type">
                                                                <option value="">Select Payment Method</option>
                                                                <option {{ $checkBrandingWithdraw->payment_type == 'easypaisa'? 'selected': '' }} value="easypaisa">EasyPaisa</option>
                                                                <option {{ $checkBrandingWithdraw->payment_type == 'jazzcash'? 'selected': '' }} value="jazzcash">JazzCash</option>
                                                                <option {{ $checkBrandingWithdraw->payment_type == 'bank'? 'selected': '' }} value="bank">Bank</option>
                                                            </select>
                                                          </div>
                                                        <div class="form-group">
                                                            <label for="accNam">Account Name</label>
                                                            <input type="text" class="form-control" id="accNam" value="{{ $checkBrandingWithdraw->account_title }}" required name="account_title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="accNam">Account No</label>
                                                            <input type="text" class="form-control" id="accNam" value="{{ $checkBrandingWithdraw->account_no }}" required name="account_no">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="accNam">Bank Name</label>
                                                            <input type="text" class="form-control" id="accNam" value="{{ $checkBrandingWithdraw->bank_name }}" required name="bank_name" value="n/a">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="accNam">Enter Amount greater than or equal to 5000 </label>
                                                            <input type="number" class="form-control" id="accNam"  required name="amount" value="n/a">
                                                        </div>

                                                        <button type="submit"
                                                            class="btn  my-5 btn-animation btn-md fw-bold"
                                                            >Submit</button>
                                                    </form>
                                                        @else
                                                        <h2 class="text-danger">You have low amount than 5000 or you have already withdraw amount within 15days</h2>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </h2>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Method</th>
                                                        <th>Acc. Title</th>
                                                        <th>Acc. No</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($brandingWithdraws as $brandingWithdraw)
                                                        <tr>
                                                            <td>{{ $brandingWithdraw->payment_type }}</td>
                                                            <td>{{ $brandingWithdraw->account_title }}</td>
                                                            <td>{{ $brandingWithdraw->account_no }}</td>
                                                            <td>{{ $brandingWithdraw->amount }}</td>
                                                            <td>{{ $brandingWithdraw->status }}</td>
                                                            <td>{{ $brandingWithdraw->created_at }}</td>

                                                            <td>
                                                                <ul>


                                                                    <li>
                                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#edit{{ $brandingWithdraw->id }}">
                                                                        <i class="ri-pencil-line"></i>
                                                                         </a>
                                                                          <!-- Delete Modal Box Start -->
                                                                        <div class="modal fade theme-modal remove-coupon"
                                                                        id="edit{{ $brandingWithdraw->id }}" aria-hidden="true"
                                                                        tabindex="-1">
                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header d-block text-center">
                                                                                    <h5 class="modal-title w-100"
                                                                                        id="exampleModalLabel22">Edit Withdraw</h5>
                                                                                    <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"><i
                                                                                            class="fas fa-times"></i></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                        action="{{ route('admin.updateWithdrawBrandingPayment') }}"
                                                        method="POST" class="">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $brandingWithdraw->id }}">
                                                        <div class="form-group">
                                                            <label for="method">Payment Method </label>
                                                            <select class="form-control" id="method" required name="payment_type">
                                                                <option value="">Select Payment Method</option>
                                                                <option {{ $brandingWithdraw->payment_type == 'easypaisa'? 'selected': '' }} value="easypaisa">EasyPaisa</option>
                                                                <option {{ $brandingWithdraw->payment_type == 'jazzcash'? 'selected': '' }} value="jazzcash">JazzCash</option>
                                                                <option {{ $brandingWithdraw->payment_type == 'bank'? 'selected': '' }} value="bank">Bank</option>
                                                            </select>
                                                          </div>
                                                        <div class="form-group">
                                                            <label for="accNam">Account Name</label>
                                                            <input type="text" class="form-control" id="accNam" value="{{ $brandingWithdraw->account_title }}" required name="account_title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="accNam">Account No</label>
                                                            <input type="text" class="form-control" id="accNam" value="{{ $brandingWithdraw->account_no }}" required name="account_no">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="accNam">Bank Name</label>
                                                            <input type="text" class="form-control" id="accNam" value="{{ $brandingWithdraw->bank_name }}" required name="bank_name" value="n/a">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="accNam">Enter Amount greater than or equal to 5000 </label>
                                                            <input type="number" class="form-control" id="accNam"  required name="amount" value="{{ $brandingWithdraw->amount }}">
                                                        </div>

                                                        <button type="submit"
                                                            class="btn  my-5 btn-animation btn-md fw-bold"
                                                            >Submit</button>
                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-animation btn-md fw-bold"
                                                                                        data-bs-dismiss="modal">No</button>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </li>

                                                                    <li>
                                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                            data-bs-target="#delete{{ $brandingWithdraw->id }}">
                                                                            <i class="ri-delete-bin-line"></i>
                                                                        </a>
                                                                        <!-- Delete Modal Box Start -->
                                                                        <div class="modal fade theme-modal remove-coupon"
                                                                            id="delete{{ $brandingWithdraw->id }}" aria-hidden="true"
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
                                                                                        <form>

                                                                                            <a
                                                                                                href="{{ route('admin.deleteWithdrawBrandingPayment',$brandingWithdraw->id ) }}"
                                                                                                class="btn btn-animation btn-md fw-bold"
                                                                                                >Yes</a>
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
                                </div>
                                <div class="container my-5">
                                    <h2>Products</h2>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
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
                                </div>
                                <div class="container my-5">
                                    <h2>Orders</h2>
                                    <hr>
                                    <h3 class="text-danger">Delivered Order Amount {{ $orderDetails->where('status', 'delivered')->sum('amount') }}</h3>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Image</th>
                                                        <th>QTY</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDetails->where('status', 'delivered') as $orderDetal)
                                                        <tr>
                                                            <td>{{ $orderDetal->product->name }}</td>
                                                            <td>{{ $orderDetal->product->category->name }}</td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="{{ asset($orderDetal->product->image) }}" class="img-fluid" alt="">
                                                                </div>
                                                            </td>

                                                            <td>{{ $orderDetal->quantity }}    </td>
                                                            <td>{{ $orderDetal->amount }}    </td>
                                                            <td>{{ $orderDetal->status }}    </td>

                                                            <td>{{ $orderDetal->updated_at }}</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3 class="text-danger">New Order Amount {{ $orderDetails->where('status', 'pending')->sum('amount') }}</h3>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Image</th>
                                                        <th>QTY</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDetails->where('status', 'pending') as $orderDetal)
                                                        <tr>
                                                            <td>{{ $orderDetal->product->name }}</td>
                                                            <td>{{ $orderDetal->product->category->name }}</td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="{{ asset($orderDetal->product->image) }}" class="img-fluid" alt="">
                                                                </div>
                                                            </td>

                                                            <td>{{ $orderDetal->quantity }}    </td>
                                                            <td>{{ $orderDetal->amount }}    </td>
                                                            <td>{{ $orderDetal->status }}    </td>

                                                            <td>{{ $orderDetal->updated_at }}</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3 class="text-danger">Processing Order Amount {{ $orderDetails->where('status', 'processing')->sum('amount') }}</h3>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Image</th>
                                                        <th>QTY</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDetails->where('status', 'processing') as $orderDetal)
                                                        <tr>
                                                            <td>{{ $orderDetal->product->name }}</td>
                                                            <td>{{ $orderDetal->product->category->name }}</td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="{{ asset($orderDetal->product->image) }}" class="img-fluid" alt="">
                                                                </div>
                                                            </td>

                                                            <td>{{ $orderDetal->quantity }}    </td>
                                                            <td>{{ $orderDetal->amount }}    </td>
                                                            <td>{{ $orderDetal->status }}    </td>

                                                            <td>{{ $orderDetal->updated_at }}</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3 class="text-danger">On-Delivery Order Amount {{ $orderDetails->where('status', 'onDelivery')->sum('amount') }}</h3>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Image</th>
                                                        <th>QTY</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDetails->where('status', 'onDelivery') as $orderDetal)
                                                        <tr>
                                                            <td>{{ $orderDetal->product->name }}</td>
                                                            <td>{{ $orderDetal->product->category->name }}</td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="{{ asset($orderDetal->product->image) }}" class="img-fluid" alt="">
                                                                </div>
                                                            </td>

                                                            <td>{{ $orderDetal->quantity }}    </td>
                                                            <td>{{ $orderDetal->amount }}    </td>
                                                            <td>{{ $orderDetal->status }}    </td>

                                                            <td>{{ $orderDetal->updated_at }}</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3 class="text-danger">Cancelled Order Amount {{ $orderDetails->where('status', 'cancelled')->sum('amount') }}</h3>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Image</th>
                                                        <th>QTY</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDetails->where('status', 'cancelled') as $orderDetal)
                                                        <tr>
                                                            <td>{{ $orderDetal->product->name }}</td>
                                                            <td>{{ $orderDetal->product->category->name }}</td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="{{ asset($orderDetal->product->image) }}" class="img-fluid" alt="">
                                                                </div>
                                                            </td>

                                                            <td>{{ $orderDetal->quantity }}    </td>
                                                            <td>{{ $orderDetal->amount }}    </td>
                                                            <td>{{ $orderDetal->status }}    </td>

                                                            <td>{{ $orderDetal->updated_at }}</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3 class="text-danger">Return Order Amount {{ $orderDetails->where('status', 'return')->sum('amount') }}</h3>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Image</th>
                                                        <th>QTY</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDetails->where('status', 'return') as $orderDetal)
                                                        <tr>
                                                            <td>{{ $orderDetal->product->name }}</td>
                                                            <td>{{ $orderDetal->product->category->name }}</td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="{{ asset($orderDetal->product->image) }}" class="img-fluid" alt="">
                                                                </div>
                                                            </td>

                                                            <td>{{ $orderDetal->quantity }}    </td>
                                                            <td>{{ $orderDetal->amount }}    </td>
                                                            <td>{{ $orderDetal->status }}    </td>

                                                            <td>{{ $orderDetal->updated_at }}</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3 class="text-danger">Refund Order Amount {{ $orderDetails->where('status', 'refund')->sum('amount') }}</h3>
                                    <div class="table-responsive product-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Image</th>
                                                        <th>QTY</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDetails->where('status', 'refund') as $orderDetal)
                                                        <tr>
                                                            <td>{{ $orderDetal->product->name }}</td>
                                                            <td>{{ $orderDetal->product->category->name }}</td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="{{ asset($orderDetal->product->image) }}" class="img-fluid" alt="">
                                                                </div>
                                                            </td>

                                                            <td>{{ $orderDetal->quantity }}    </td>
                                                            <td>{{ $orderDetal->amount }}    </td>
                                                            <td>{{ $orderDetal->status }}    </td>

                                                            <td>{{ $orderDetal->updated_at }}</td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
