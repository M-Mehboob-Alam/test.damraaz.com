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
                                    <h5>Branding Information</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form" method="POST"
                                    action="{{ route('admin.branding.update' ) }}"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="{{ $branding->id }}">

                                    @csrf

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
                                        <a href="{{ asset($branding->image) }}" target="_blank">
                                        <img src="{{ asset($branding->image) }}" height="200px" width="200px" alt="">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
