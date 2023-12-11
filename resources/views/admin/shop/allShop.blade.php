@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->

    <!-- All User Table Start -->
    <div class="container-fluid">
            <form class="row">
                <label>Enter Name</label>
                <div class="col-md-6">
                    <input required class="form-control" name="name" type="search" value="{{request()->name}}">
                </div>
                <div class="col-md-6">
                    <input required class="btn btn-primary"  type="submit">
                </div>
            </form>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All {{$shop}} Shop</h5>
                            <!--<form class="d-inline-flex">-->
                            <!--    <a href="add-new-user.html" class="align-items-center btn btn-theme d-flex">-->
                            <!--        <i data-feather="plus"></i>Add New-->
                            <!--    </a>-->
                            <!--</form>-->
                        </div>

                        <div class="table-responsive table-product">
                            <table class="table all-package theme-table" id="table_id">
                                <thead>
                                    <tr>
                                        <th>ShopName</th>
                                        <th>Username</th>
                                        <th>Refer By</th>
                                        <th>Mobile</th>
                                        <th>Date</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($shops as $user)
                                        <tr>
                                            <td>{{ $user->name??'' }}</td>
                                            <td>{{ $user->user->username??'' }}</td>
                                            <td>
                                                {{ $user->user->refer_by??'Direct' }}
                                            </td>
                                            <td>
                                                {{ $user->mobile??'' }}
                                            </td>

                                            <td>{{ $user->created_at??'' }}</td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                                                            Edit Shop</i>
                                                          </button>

                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-danger" href="{{route('admin.viewShopDetail',['shop'=>$user->user_id])}}">Shop Details</a>
                                                    </li>
                                                    {{-- <li>
                                                        <a class="btn btn-sm btn-{{$user->deleted_at? 'success':'danger' }}" href="{{route('admin.user.deleted_at',$user->id)}}">{{$user->deleted_at? 'Activate':"In Active" }}</a>

                                                    </li> --}}


                                                </ul>
                                            </td>
                                        </tr>

                                        <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Shop Name {{$user->name}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.approvedNewShop')}}" method="POST">
                <input required type="hidden" name="id" value="{{$user->id}}">
                @csrf
                <div class="mb-3 text-center">
                  <label for="exampleInputPassword1" class="form-label">Shop Image</label>
                  <br>
                    <img src="{{asset($user->image)}}" alt="" class="" style="height: 300px; width: 300px; object-fit:contain">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Shop Name</label>
                  <input required type="text" class="form-control" name="name" value="{{$user->name}}" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <h6>Do You Have Products Available At WholeSale Rate?:</h6>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" {{$user->wholesale ? 'checked' : ''}} required name="wholesale" id="inlineRadio1" value=1>
                      <label class="form-check-label" for="inlineRadio1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" {{$user->wholesale ? '' : 'checked'}} name="wholesale" id="inlineRadio2" value=0>
                      <label class="form-check-label" for="inlineRadio2">No</label>
                    </div>
                 </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Change Shop Status</label>
                  <select class="form-control" name="status" required >
                    <option value="">Select Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="blocked">Blocked</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Message</label>
                    <textarea name="message" required class="form-control"></textarea>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Shop Mobile</label>
                  <input required type="number" class="form-control" name="mobile" value="{{$user->mobile}}" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">WhatsApp</label>
                  <input required type="number" class="form-control" name="whatsapp" value="{{$user->whatsapp}}" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Shop State/Province</label>
                  <input required type="text" class="form-control" name="province" value="{{$user->province}}" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Shop City</label>
                  <input required type="text" class="form-control" name="city" value="{{$user->city}}" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Shop Address</label>
                  <input required type="text" class="form-control" name="address" value="{{$user->address}}" id="exampleInputPassword1">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All User Table Ends-->

        <div class="container-fluid">
            <!-- footer start-->
            <footer class="footer">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">Copyright 2022 © Fastkart theme by pixelstrap</p>
                    </div>
                </div>
            </footer>
            <!-- footer end-->
        </div>
    </div>
@endsection
