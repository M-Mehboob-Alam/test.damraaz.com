@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">

            @foreach($accounts as $acc)
               
               
                <h1>{{$acc->method}} </h1>
                <a class="btn btn-sm btn-primary mt-2" href="{{ route('admin.changePaymentGateway', $acc->id) }}">
                    @if($acc->isHide == 1)
                        Show Now
                    @else
                        Hide Now
                    @endif
                </a>

            @endforeach
        </div>

    </div>
@endsection
