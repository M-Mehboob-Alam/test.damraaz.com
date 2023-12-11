@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->

    <!-- All User Table Start -->
    <div class="container-fluid">
            <form class="row" action="{{ route('admin.searchAds') }}" method="GET" >
                <label>Enter Title</label>
                <div class="col-md-6">
                    <input required class="form-control" name="search" type="search" >
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
                            <h5>All New Ads</h5>
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
                                        <th>Item Title</th>
                                        <th>Username</th>
                                        <th>Refer By</th>
                                        <th>Mobile</th>
                                        <th>Created At</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($ads as $ad)
                                        <tr>
                                            <td>{{ $ad->item_title??'' }}</td>
                                            <td>{{ $ad->user->username??'' }}</td>
                                            <td>
                                                {{ $ad->user->refer_by??'Direct' }}
                                            </td>
                                            <td>
                                                {{ $ad->user->phone??'' }}
                                            </td>

                                            <td>{{ $ad->created_at??'' }}</td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$ad->id}}">
                                                            <i class="ri-eye-line"></i>
                                                          </button>

                                                    </li>
                                                    {{-- <li>
                                                        <a class="btn btn-sm btn-{{$user->deleted_at? 'success':'danger' }}" href="{{route('admin.user.deleted_at',$user->id)}}">{{$user->deleted_at? 'Unblock':"Block" }}</a>
                                                    </li> --}}
                                                    <li>
                                                        <form action="{{ route('admin.adDestroy', ['ad' => $ad->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                        {{-- <a class="btn btn-sm btn-{{$user->deleted_at? 'success':'danger' }}" href="{{route('admin.user.deleted_at',$user->id)}}">{{$user->deleted_at? 'Activate':"In Active" }}</a> --}}

                                                    </li>
                                                </ul>
                                                
                                            </td>
                                        </tr>

                                        <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$ad->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ad Title: {{$ad->item_title}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.adApprove')}}" method="POST">
                <input required type="hidden" name="id" value="{{$ad->id}}">
                @csrf
                <div class="mb-3 text-center">
                  <label for="exampleInputPassword1" class="form-label">Ad Image</label>
                  <br>
                  <img src="{{ asset('images/listing/'.$ad->image) }}" style="height: 300px; width: 300px; object-fit:contain" class="card-img-top" alt="Ad Image">
                    {{-- <img src="{{asset(json_decode($ad->image))}}" alt="" class="" style="height: 300px; width: 300px; object-fit:contain"> --}}
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Item Title</label>
                  <input required type="text" class="form-control" name="item_title" value="{{$ad->item_title}}" id="exampleInputPassword1">
                </div>
               
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Change Ad Status</label>
                  <select class="form-control" name="status" required >
                    <option value="">Select Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="completed">Completed</option>

                  </select>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Address</label>
                    <textarea name="address" required class="form-control">{{$ad->address}}</textarea>
                </div>
                {{-- <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Phone</label>
                  <input required type="number" class="form-control" name="mobile" value="{{$user->mobile}}" id="exampleInputPassword1">
                </div> --}}
                {{-- <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">WhatsApp</label>
                    <input required type="number" class="form-control" name="whatsapp" value="{{$user->whatsapp}}" id="exampleInputPassword1">
                  </div> --}}
                {{-- <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Shop State/Province</label>
                  <input required type="text" class="form-control" name="province" value="{{$user->province}}" id="exampleInputPassword1">
                </div> --}}
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Ad City</label>
                  <input required type="text" class="form-control" name="city" value="{{$ad->city}}" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Ad Address</label>
                  <input required type="text" class="form-control" name="address" value="{{$ad->address}}" id="exampleInputPassword1">
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
                        <p class="mb-0">Copyright 2023 © Damraaz</p>
                    </div>
                </div>
            </footer>
            <!-- footer end-->
        </div>
    </div>
@endsection
