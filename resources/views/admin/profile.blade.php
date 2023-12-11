@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->
    <!-- All User Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Admin Profile</h5>
                        </div>
                         @foreach($errors->all() as $error)
                            <li class="bg-danger">{{ $error}}</li>
                        @endforeach 

                        <div class="row">
                            <div class="col-6 my-1">Name</div>
                            <div class="col-6 my-1">{{$user->name}}</div>
                            <div class="col-6 my-1">Email</div>
                            <div class="col-6 my-1">{{$user->email}}</div>
                            <div class="col-6 my-1"><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#change-password">Change Password</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All User Table Ends-->

        
        
    </div>
    
    
    <!-- change password modal box start -->
    <div class="modal fade theme-modal" id="change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('admin.change.password') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="password" class="form-control"  required name="old_password" id="OldPass"
                                placeholder="Old Password" autocomplete="false">
                            <label for="OldPass">Old Password</label>
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="password" class="form-control" required autocomplete="true" name="password"
                                id="newPass" placeholder="New Password">
                            <label for="newPass">New Password</label>
                        </div>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="password" class="form-control" required autocomplete="true" name="password_confirmation"
                                id="fname" placeholder="Confirm Password">
                            <label for="fname">Confirm Password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn theme-bg-color btn-md text-white">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- change password modal box end -->
@endsection
