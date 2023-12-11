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
        <section class="page-body p-0 my-5">
            <br>
            <div class="container mt-3">
                <div class="row m-3">
                    <div class="col-12 py-5 col-sm-8 col-md-8 shadow rounded">
                        <div class="row">
                            <h3 class="text-danger">Fill Out Correctly Address & Payment Now </h3>
                            <hr>
                            <form action="{{ route('paymentNowProductBundle') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden"  name="amount"  value="{{$bundles->price}}">
                                <input type="hidden"  name="product_bundle_id "  value="{{$bundles->id}}">
                                <input type="hidden"  name="user_id "  value="{{auth()->user()->id}}">

                                  <div class="form-group">
                                    <label for="">Sponsor Name</label>
                                    @if (is_null(auth()->user()->refer_by))
                                        <input type="text" class="form-control"  id="refer_by" name="refer_by" placeholder="Enter Your Sponsor Name Optional"  >
                                        <span id="refer_by_msg"></span>
                                    @else
                                        <input type="text" class="form-control" name="already_refer_by" readonly value="{{ auth()->user()->refer_by }}">
                                    @endif

                                  </div>
                                  @php
                                      $checkWalletBalance = $totalBalance - $bundles->price;
                                  @endphp

                                  <div class="form-group">
                                    <label for="">Payment Method <span class="text-danger">You have Rs.{{ $totalBalance }} in your P-Wallet</span></label>
                                    <select name="account_type"  required id="selectedMethod" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($accounts as $acc)
                                        <option value="{{ $acc->account_type }}">{{ $acc->account_type }}</option>
                                        @endforeach
                                        @if ($checkWalletBalance >= 0)
                                            <option value="Wallet">Wallet</option>
                                        @endif
                                    </select>
                                  </div>

                                  <div class="all_accounts">

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
    
                                    <h3 class="text-danger">Pay Rs.{{$bundles->price}} & Upload The Slip </h3>
                                      <div class="custom-file mb-3">
                                       <input type="file"  name="image" class="custom-file-input" id="validatedCustomFile" required>
                                       <label class="custom-file-label" for="validatedCustomFile">Upload The Slip ...</label>
                                       <div class="invalid-feedback">Example invalid custom file feedback</div>
                                     </div>
                                  </div>
                            {{--    <div class="form-group">
                               <label for="exampleInputEmail1">UserName</label>
                               <input type="text" class="form-control" readonly id="exampleInputEmail1" value="{{auth()->user()->username}}" aria-describedby="emailHelp">

                             </div>
                                <div class="form-group">
                               <label for="exampleInputEmail1">Phone Number</label>
                               <input type="number" class="form-control" required   name="phone" placeholder="030.....">

                             </div>
                                 <div class="form-group">
                                   <label for="exampleFormControlSelect2">Province/State</label>
                                   <select required class="form-control" name="province" id="exampleFormControlSelect2">
                                     <option value="">Select </option>
                                     <option value="Punjab">Punjab </option>
                                     <option value="Balochistan">Balochistan </option>
                                     <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa </option>
                                     <option value="Sindh">Sindh </option>
                                     <option value="Islamabad Capital">Islamabad Capital </option>
                                     <option value="Azad Jammu and Kashmir">Azad Jammu and Kashmir </option>
                                     <option value="Gilgit-Baltistan">Gilgit-Baltistan </option>


                                   </select>
                                 </div>
                             <div class="form-group">
                               <label for="exampleInputEmail1">Enter City Name</label>
                               <input type="text" required name="city" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                             </div>
                             <div class="form-group">
                               <label for="exampleInputPassword1">Enter Complete Address</label>
                               <textarea required class="form-control" name="address" id="exampleInputPassword1"></textarea>
                             </div>
                             <div class="form-group">
                               <label for="exampleInputPassword1">Special Note if any</label>
                               <textarea  class="form-control" name="notes" id="exampleInputPassword1"></textarea>
                             </div> --}}

                             <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                             <a href="{{ url()->previous() }}" class="btn btn-danger my-2">Back</a>

                            </form>

                        </div>

                    </div>
                    {{-- <div class="col-12 col-sm-4 col-md-4 ">
                        <div class="controller shadow rounded">


                            <h3 class="text-center">{{ $bundles->name }}</h3>
                                    <div class="description_controller ml-2 text-center">

                                        <h3>Price Rs.{{ $bundles->price }}</h3>

                                        <h3>Commission Rs.{{ $bundles->commission }}</h3>

                                        <h3>Points {{ $bundles->points }}</h3>

                                        <h3>Points {{ $bundles->points }}</h3>
                                        <h3>Maximum Levels {{ $bundles->level }}</h3>
                                        <table class="table my-5 " border="1">
                                            <thead>
                                              <tr>
                                                <th scope="col">Level No</th>
                                                <th scope="col">Commission</th>


                                              </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Rs.{{ $bundles->commission }}</td>

                                                  </tr>
                                                @foreach($bundles->levels as $acc)
                                              <tr>
                                                <th scope="row">{{ $acc->level }}</th>
                                                <td>Rs.{{ $acc->commission }}</td>

                                              </tr>

                                              @endforeach

                                            </tbody>
                                          </table>
                                         <a href="{{ route('buyNowProductBundle', $bundles->id) }}" class="btn btn-danger my-2">Buy Now</a>
                                        <a href="{{ url()->previous() }}" class="btn btn-danger my-2">Back</a>
                                    </div>

                        </div>


                    </div> --}}

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
                        $(".all_accounts").show();
                        
                        $("#validatedCustomFile").prop('required',true);
                    }else if(selectedMethod == 'JazzCash'){
                        $('.JazzCash').show();
                        $(".Bank").hide();
                        $(".EasyPaisa").hide();
                        $(".all_accounts").show();
                        $("#validatedCustomFile").prop('required',true);

                    }else if(selectedMethod == 'EasyPaisa'){
                        $('.EasyPaisa').show();
                        $(".JazzCash").hide();
                        $(".Bank").hide();
                        $(".all_accounts").show();
                        $("#validatedCustomFile").prop('required',true);

                    }else{
                        $(".all_accounts").hide();
                        $("#validatedCustomFile").prop('required',false);

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
