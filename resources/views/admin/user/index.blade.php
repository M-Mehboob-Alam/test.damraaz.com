@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->

    <!-- All User Table Start -->
    <div class="container-fluid">
            <form class="row">
                <label>Enter Name</label>
                <div class="col-md-6">
                    <input class="form-control" name="name" type="search" value="{{request()->name}}">
                </div>
                <div class="col-md-6">
                    <input class="btn btn-primary"  type="submit">
                </div>
            </form>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All Users</h5>
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
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Refer By</th>
                                        <th>Email</th>
                                        <th>Joined Date</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name??'' }}</td>
                                            <td>{{ $user->username??'' }}</td>
                                            <td>
                                                {{ $user->refer_by??'' }}
                                            </td>
                                            <td>
                                                {{ $user->email??'' }}
                                            </td>

                                            <td>{{ $user->created_at??'' }}</td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.user.detail', $user->id) }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-{{$user->deleted_at? 'success':'danger' }}" href="{{route('admin.user.deleted_at',$user->id)}}">{{$user->deleted_at? 'Unblock':"Block" }}</a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-{{$user->deleted_at? 'success':'danger' }}" href="{{route('admin.user.deleted_at',$user->id)}}">{{$user->deleted_at? 'Activate':"In Active" }}</a>

                                                    </li>

                                                    {{-- <li>
                                                    <a href="{{route('admin.category.edit',$category->id)}}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </li> 

                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalToggle">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                        </li>
                                                        --}}
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
                        <p class="mb-0">Copyright 2022 © Fastkart theme by pixelstrap</p>
                    </div>
                </div>
            </footer>
            <!-- footer end-->
        </div>
    </div>
@endsection
