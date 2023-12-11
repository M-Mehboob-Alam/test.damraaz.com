@extends('layouts.app')
@section('title')
    Buy Now Bundle
@endsection


@section('content')
<style>
    sup {
        top: -2.5rem;
        font-size: 1rem;
    }
    p{
        margin-top:2rem;
    }
    .linking{
        font-size:1rem !important;
        color:white !important;
        margin-top :1rem ;
        font-weight:bold !important;
    }
    .payment_containers{
        display:flex;
        margin:1rem auto;
    }
    .payment_containers img{

        margin-left:1rem;
    }
    .payment_containers .acc_name, .acc_no, .acc_bank{
        display:inline-block;
        font-size:1.5rem;
        font-weight:bold;
        margin-left:1rem;
    }
    .payment_containers .acc_no{

        font-size:2rem;

    }
    </style>
    <!-- Main Start -->
    <div class="main">
        <section class="page-body p-0 my-2">
            <br>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-8 py-5 my-3 container shadow rounded">
                        <div class="row">
                            <div class="container">
                                <a href="{{ url()->previous() }}" class="btn btn-primary mb-2">Back To Previous Page</a>
                            </div>
                            <br>
                            <h3 class="text-danger">Fill Out Correctly Working Phone number, Address and Payment Details Carefully! for Product Bundle Order's Name: <span class="text-primary"> <a href="{{ route('productBundleDetail', $bundles->product_bundle->id) }}"> {{ $bundles->product_bundle->name }}</span>  </a></h3>
                            <hr>
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                               <div class="text-danger">{{$error}}</div>
                            @endforeach
                           @endif
                            <form action="{{ route('repaymentProductBundleOrderDetail') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden"  name="amount"  value="{{$bundles->price}}">
                                <input type="hidden"  name="id"  value="{{$bundles->id}}">
                                <input type="hidden"  name="delivery_charges"  value="{{$bundles->product_bundle->delivery_charges}}">
                                <input type="hidden"  name="product_bundle_id"  value="{{$bundles->id}}">
                                <input type="hidden"  name="user_id"  value="{{auth()->user()->id}}">                           
                                

                                  <div class="form-group">
                                    <label for="">Payment Method</label>
                                    <select name="account_type"  required id="selectedMethod" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($accounts as $acc)
                                        <option value="{{ $acc->account_type }}">{{ $acc->account_type }}</option>
                                        @endforeach
                                    </select>
                                  </div>

                                  @foreach ($accounts as $item)
                                    <div class="{{ $item->account_type }} p-3 ">
                                        @if ($item->account_type == 'Bank')

                                        <h3>Bank Name : {{ $item->bank }}</h3>
                                        @endif
                                        <h3>Account Name : {{ $item->account_type }}</h3>
                                        <h3>Account Title : {{ $item->account_title }}</h3>
                                        <h3>Account No : {{ $item->account_no }}</h3>

                                    </div>
                                  @endforeach
                                <h3 class="text-primary">
                                    Reason: <span class="text-danger">{{ $bundles->message }}</span>
                                    {{-- Status: <span class="text-danger">{{ $bundles->status }}</span> --}}
                                </h3>
                                <h3 class="text-primary">
                                    {{-- Reason: <span class="text-dander">{{ $bundles->message }}</span> --}}
                                    Status: <span class="text-danger">{{ $bundles->status }}</span>
                                </h3>
                                <div class="w-25 h25">
                                    <img src="{{ asset($bundles->image) }}" alt="" class="img-fluid">
                                </div>
                                <h3 class="text-danger">Pay Delivery Charges Rs.{{$bundles->product_bundle->delivery_charges}} & Upload The Slip </h3>
                                  <div class="custom-file mb-3">
                                   <input type="file" required name="image" class="custom-file-input" id="validatedCustomFile" required>
                                   <label class="custom-file-label" for="validatedCustomFile">Upload The Slip ...</label>
                                   <div class="invalid-feedback">Example invalid custom file feedback</div>
                                 </div>
                                 <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" name="name"  class="form-control" required value="{{ $bundles->name }}">
                                 </div>
                                 <div class="form-group">
                                    <label for="">Working Mobile Number</label>
                                    <input type="number" name="phone" min="11" class="form-control" value="{{ $bundles->phone }}" required id="">

                                 </div>
                                 <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ $bundles->city }}" required id="">

                                 </div>
                                 <div class="form-group">
                                    <label for="">Province/State</label>
                                    <input type="text" name="state" class="form-control" value="{{ $bundles->state }}" required id="">

                                 </div>
                                 <div class="form-group">
                                    <label for="">Complete Address (with P/0 Box & Zip code if applicable)</label>
                                    <textarea name="address" required  class="form-control">{{ $bundles->address }}</textarea>
                                 </div>
                                 <div class="form-group">
                                    <label for="">Special Notes</label>
                                    <textarea name="notes"  class="form-control">{{ $bundles->notes }}</textarea>
                                 </div>
                           
                             <button type="submit" id="submit" class="btn btn-primary my-2">Submit</button>
                           </form>

                        </div>

                    </div>
                 
                </div>
            </div>



    </div>

    </div>
    </section>
    </div>
    <!-- Main End -->
    <style>
      /* ul{
        display: flex;
        flex-direction: row;
        justify-content: center;

      } */
        .card-img {
            padding-top: 100%;
            position: relative;
            height: 5rem;
        }
        .card-text{
            /* font-size: 1.2rem; */
        }

        .card {
            border: none !important;
            margin-bottom: 20px !important;
        }

        .card-img-top {
            height: 100%;
            width: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
        }
        h4{
            font-weight: 400;
        }
    </style>
    @push('scripts')

        <script>
            var check_sponsor = true;
            $(document).ready(function(){
                // alert('ready');
                $(".JazzCash").hide();
                $(".Bank").hide();
                $(".EasyPaisa").hide();

                $("#refer_by").on('keyup', function() {
                            var refer_by = $('#refer_by').val();
                            // console.log(refer_by);
                            if (refer_by !== "") {
                                // console.log(refer_by);
                                $.ajax({
                                    type: 'get',
                                    url: '{{ route('checkBundleSponsor') }}',
                                    data: {
                                        'refer_by': refer_by
                                    },
                                    success: function(data) {
                                        // console.log(data.msg);
                                        if (data.msg) {
                                            $("#refer_by_msg").text('sponsor is matched');
                                            $("#refer_by_msg").addClass("text-success");
                                            $("#refer_by_msg").removeClass("text-danger");
                                            check_sponsor = true;
                                        } else {
                                            $("#refer_by_msg").text('sponsor is not matched');
                                            $("#refer_by_msg").removeClass("text-success");
                                            $("#refer_by_msg").addClass("text-danger");
                                            check_sponsor = false;
                                        }

                                    }

                                });
                            }
                        });

                $('#selectedMethod').on('change', function() {
                    var selectedMethod = $('#selectedMethod').val();
                    if(selectedMethod == 'Bank'){
                        $('.Bank').show();
                        $(".JazzCash").hide();
                        $(".EasyPaisa").hide();
                    }else if(selectedMethod == 'JazzCash'){
                        $('.JazzCash').show();
                        $(".Bank").hide();
                        $(".EasyPaisa").hide();
                    }else{
                        $('.EasyPaisa').show();
                        $(".JazzCash").hide();
                        $(".Bank").hide();
                    }

                });

                $("#submit").on('click', function(e){
                    var check_refer_by = $("#refer_by").val();
                    if(check_refer_by == ''){
                        check_sponsor = true;
                        $("submit").removeAttr('disabled');
                    }else{
                        if (check_sponsor) {
                            $("submit").removeAttr('disabled');
                        } else {

                            $("submit").attr('disabled','disabled');
                            alert('please enter correct sponsor name');
                            e.preventDefault();
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
