@extends('admin.layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
body{
    background: #eee;
}
.signupdiv{
    background: #fff;
    border: 1px solid #ddd;
    box-shadow: 1px 2px 3px #ccc;
    padding: 10px;
    margin-top: 100px;
}
.form-group{
    margin-bottom: 10px;
}
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Add New Product In Branding </h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form" method="post"
                                    action="{{ route('admin.branding.storeNewProduct') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Please Select Branding</label>
                                        <select class="form-control" required name="branding" id="country">
                                         <option value="">Select Branding</option>
                                            @foreach ($branding as $br)
                                             <option value="{{ $br->id }}">{{ $br->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Please Select Category</label>
                                        <select class="form-control" required name="category" id="category">
                                         <option value="">Select Category</option>
                                            @foreach ($category as $cat)
                                             <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input required class="form-control @error('name') is-invalid @enderror" name="name"
                                                type="text" placeholder="Product Name">
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Product Image</label>
                                        <div class="form-group col-sm-9">
                                            <input class="form-control    @error('image') is-invalid @enderror" accept="image/x-png,image/gif,image/jpeg" name="image"
                                                type="file" required placeholder="Branding Name" />
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Product Multiple Image</label>
                                        <div class="form-group col-sm-9">
                                            <input class="form-control @error('images')    is-invalid @enderror" accept="image/x-png,image/gif,image/jpeg" multiple required name="images[]"
                                                type="file" required placeholder="Branding Name" />
                                            @error('images')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Purchased Price</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('purchased_price') is-invalid @enderror" required name="purchased_price"
                                                type="number" placeholder="purchased_price">
                                        </div>
                                        @error('purchased_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Retail Price</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('price') is-invalid @enderror" required name="price"
                                                type="number" placeholder="price">
                                        </div>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Quantity</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('quantity') is-invalid @enderror" required name="quantity"
                                                type="number" placeholder="quantity">
                                        </div>
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Discount Price</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('discount_price') is-invalid @enderror"  name="discount_price"
                                                type="number" placeholder="discount_price">
                                        </div>
                                        @error('discount_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Delivery Days</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('delivery_days') is-invalid @enderror" required name="delivery_days"
                                                type="number" placeholder="delivery_days">
                                        </div>
                                        @error('delivery_days')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Delivery Charges</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('delivery_charges') is-invalid @enderror" required name="delivery_charges"
                                                type="number" placeholder="delivery_charges">
                                        </div>
                                        @error('delivery_charges')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Offer's Name</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('offer') is-invalid @enderror"  name="offer"
                                                type="text" placeholder="Enter offer">
                                        </div>
                                        @error('offer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Deal's Name</label>
                                        <div class="col-sm-9">
                                            <input  class="form-control @error('deal') is-invalid @enderror"  name="deal"
                                                type="text" placeholder="Enter deal">
                                        </div>
                                        @error('deal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                          <textarea name="info" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                          <textarea name="detail" class="form-control" required></textarea>
                                        </div>
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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
            $(document).ready(function(){

                $(function(){
                 $("#country").select2();
                });
                $(function(){
                 $("#category").select2();
                });
            })
        </script>
    @endpush
@endsection
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

