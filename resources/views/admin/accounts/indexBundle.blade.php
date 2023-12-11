@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">

            @foreach($accounts as $acc)

            <form action="{{route('admin.store_accounts_bundle')}}" method="POST" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="account_type" value="{{$acc->account_type}}" >
                <input type="hidden" name="id" value="{{$acc->id}}" >
                @if($acc->account_type == 'EasyPaisa')
                <h1>Change EasyPaisa Account </h1>
                <a class="btn btn-sm btn-primary mt-2" href="{{ route('admin.account_toggle_bundle', $acc->id) }}">
                    @if($acc->status == 1)
                        Set To Hide
                    @else
                        Set To Show
                    @endif
                </a>


                @elseif($acc->account_type == 'JazzCash')
                <h1>Change JazzCash Account</h1>
                <a class="btn btn-sm btn-primary mt-2" href="{{ route('admin.account_toggle_bundle', $acc->id) }}">
                    @if($acc->status == 1)
                    Set To Hide
                    @else
                    Set To Show
                    @endif
                </a>
                @else
                <h1>Change Bank Account</h1>
                <a class="btn btn-sm btn-primary mt-2" href="{{ route('admin.account_toggle_bundle', $acc->id) }}">
                    @if($acc->status == 1)
                    Set To Hide
                    @else
                    Set To Show
                    @endif
                </a>
                @endif

                @if($acc->account_type == 'Bank')
                <div class="row mt-4">
                <div class="col">
                    <input type="text" name="bank" required class="form-control" value="{{$acc->bank}}"  placeholder="Enter Bank Name">
                </div>
                </div>
                @endif
                <div class="row mt-4">
                <div class="col">
                    <input type="text" name="account_title" required class="form-control" value="{{$acc->account_title}}"  placeholder="Enter Account Title">
                </div>
                </div>
                <div class="row mt-4">
                <div class="col">
                    <input type="text" name="account_no" required class="form-control" value="{{$acc->account_no}}" placeholder="Enter Account Number">
                </div>
                </div>


                <button type="submit" class="btn btn-success mt-4">Submit</button>
            </form>
            @endforeach
        </div>

    </div>
@endsection
