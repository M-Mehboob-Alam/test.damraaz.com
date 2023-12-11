@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Add New Branding </h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form" method="post"
                                    action="{{ route('admin.store.branding') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Branding Name</label>
                                        <div class="col-sm-9">
                                            <input required class="form-control @error('name') is-invalid @enderror" name="name"
                                                type="text" placeholder="Branding Name">
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Branding Image</label>
                                        <div class="form-group col-sm-9">
                                            <input class="form-control @error('image') is-invalid @enderror" name="image"
                                                type="file" required placeholder="Branding Name">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Email</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('email') is-invalid @enderror" name="email"
                                                type="text" placeholder="Branding email">
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Phone</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                type="text" placeholder="Branding phone">
                                        </div>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Address</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('address') is-invalid @enderror" name="address"
                                                type="text" placeholder="Branding address">
                                        </div>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button class="btn btn-primary ms-auto" type="submit">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
