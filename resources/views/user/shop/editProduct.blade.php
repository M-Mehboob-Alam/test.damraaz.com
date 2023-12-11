@extends('layouts.app')
@section('title')
Edit The Product
@endsection
@section('content')
   <!-- New Product Add Start -->
   <style>
    .inner_image{
        width: 100px;
        height: 150px;
        display: inline-block;
        text-align:center;

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
                                <h3>Product Information
                                    @if ($shop->isAllowedMegaSale)
                                        @if ($products->isMegaSale)
                                            <a href="{{ route('userChangeMegaSale', $products->id) }}" class="btn btn-danger">Remove From Mega Sale</a>
                                           @else
                                            <a href="{{ route('userChangeMegaSale', $products->id) }}" class="btn btn-success">Add To Mega Sale</a>
                                        @endif
                                    @endif
                                </h3>
                            </div>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{$error}}</div>
                                @endforeach
                            @endif
                            <form class="theme-form theme-form-2 mega-form" action="{{route('userUpdateProduct')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{$products->id}}">
                                @csrf
                                <div class="row m-2">
                                    <div class="col-md-4 border p-2">
                                        <a href="{{asset($products->image)}}" target="_blank">
                                            <img src="{{asset($products->image)}}" width="200" height="200" style="object-fit: contain" alt="">
                                            </a>
                                    </div>

                                    <div class="col-md-8 border p-2">
                                        @if (!is_null($products->images))
                                        <div>
                                        @foreach ( json_decode($products->images) as $it)
                                            <div class="inner_image" style="">

                                                <a href="{{route('deleteProductImage', ['product'=>$products->id, 'image'=>substr($it,15)])}}"> <i class="text-danger" data-feather="trash"></i> </a>
                                               <br>
                                                <a href="{{asset($it)}}" target="_blank">
                                                   <img src="{{asset($it)}}" width="50" height="50" style="object-fit: contain"  alt="">
                                               </a>
                                            </div>




                                        @endforeach
                                    </div>
                                    @endif
                                    </div>
                                </div>


                                <div class="mb-4 row">
                                    <label class="form-label-title col-sm-3 mb-0">Change Product Thumbnail <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control"    name="image">
                                        <div class="form-text">Change Product Thumbnail</div>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Product  Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input name="name" required class="form-control" type="text" value="{{$products->name}}" placeholder="Product Name">
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label
                                        class="col-sm-3 col-form-label form-label-title">Category <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single form-select w-100" required name="category">
                                            @foreach ($categories as $cate)
                                                <option value="{{$cate->id}}" {{$cate->id == $products->id ? 'selected': ''}}>{{$cate->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label class="form-label-title col-sm-3 mb-0">Images <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control"  accept="image/*" multiple name="images[]">
                                        <div class="form-text">Upload multiple images</div>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 form-label-title">price <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required name="price" type="number" value="{{$products->price}}" placeholder="100">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 form-label-title">quantity <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required name="quantity" type="number" value="{{$products->quantity}}" placeholder="100">
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 form-label-title">Discount price <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="discount_price" required type="number" value="{{$products->discount_price}}" placeholder="80">
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 form-label-title">Delivery Days <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="delivery_days" required type="number" value="{{$products->delivery_days}}" placeholder="3">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 form-label-title">Delivery Charges<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="delivery_charges" required type="number" value="{{$products->delivery_charges}}" placeholder="10">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 form-label-title">Offer Name </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="offer" type="text" value="{{$products->offer}}" placeholder="Enter Your offer name(optional)">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 form-label-title">Deal Name </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="deal" type="text" value="{{$products->deal}}" placeholder="Enter Your deal name for week(optional)">
                                        <div class="form-text">for week</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label class="form-label-title col-sm-3 mb-0">Info <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" required name="info" rows="2" placeholder="Info about product">{{$products->info}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label class="form-label-title col-sm-3 mb-0">Detail <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="detail" required placeholder="Description about product" rows="3">{{$products->detail}}</textarea>
                                    </div>
                                </div>
                                <button class="btn theme-bg-color mt-sm-4 btn-md  text-white fw-bold ms-auto" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- New Product Add End -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">

    $(document).ready(function (e) {


       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
       });


       $('#multi-file-upload-ajax').submit(function(e) {

         e.preventDefault();

          var formData = new FormData(this);

          let TotalFiles = $('#files')[0].files.length; //Total files
          let files = $('#files')[0];
          for (let i = 0; i < TotalFiles; i++) {
              formData.append('files' + i, files.files[i]);
          }
          formData.append('TotalFiles', TotalFiles);

         $.ajax({
            type:'POST',
            url: "{{ url('store-multi-file-ajax')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (data) => {
               this.reset();
               alert('Files has been uploaded using jQuery ajax');
            },
            error: function(data){
               alert(data.responseJSON.errors.files[0]);
               console.log(data.responseJSON.errors);
             }
           });
       });
    });

    </script>
    <script type="text/javascript">

        $(document).ready(function (e) {

           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
           });


           $('#multi-file-upload-ajax').submit(function(e) {

             e.preventDefault();

              var formData = new FormData(this);

              let TotalFiles = $('#files')[0].files.length; //Total files
              let files = $('#files')[0];
              for (let i = 0; i < TotalFiles; i++) {
                  formData.append('files' + i, files.files[i]);
              }
              formData.append('TotalFiles', TotalFiles);

             $.ajax({
                type:'POST',
                url: "{{ url('store-multi-file-ajax')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                   this.reset();
                   alert('Files has been uploaded using jQuery ajax');
                },
                error: function(data){
                   alert(data.responseJSON.errors.files[0]);
                   console.log(data.responseJSON.errors);
                 }
               });
           });
        });

        </script>
@endsection
