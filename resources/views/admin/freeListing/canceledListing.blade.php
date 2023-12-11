@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->

    <!-- All User Table Start -->
    <div class="container-fluid">
            {{-- <form class="row">
                <label>Enter Name</label>
                <div class="col-md-6">
                    <input required class="form-control" name="name" type="search" value="{{request()->name}}">
                </div>
                <div class="col-md-6">
                    <input required class="btn btn-primary"  type="submit">
                </div>
            </form> --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All Canceled Ads</h5>
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
                                        <th>Status</th>
                                        <th>Actions</th>
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

                                            <td>{{ $ad->status }}</td>

                                            <td>
                                                <ul>
                                                    {{-- <li>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$ad->id}}">
                                                            <i class="ri-eye-line"></i>
                                                          </button>

                                                    </li> --}}
                                                    <li>
                                                        <form action="{{ route('admin.adDestroy', ['ad' => $ad->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </li>
                                                    {{-- <li>
                                                        <a class="btn btn-sm btn-{{$user->deleted_at? 'success':'danger' }}" href="{{route('admin.user.deleted_at',$user->id)}}">{{$user->deleted_at? 'Activate':"In Active" }}</a>

                                                    </li> --}}
                                                </ul>
                                            </td>
                                        </tr>
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
