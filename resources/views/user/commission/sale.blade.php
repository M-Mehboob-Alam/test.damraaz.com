@extends('layouts.app')
@section('title')
Sale Commission
@endsection


@section('content')

<div class="order-tab dashboard-bg-box container">
        <h1 class="text-center">Your Profit Commison</h1>
    <div class="table-responsive">
        <table class="table order-table">
            <thead>
                <tr>

                    <th scope="col">Amount</th>
                    <th scope="col">Name</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Is Claimed</th>
                    <th scope="col">Date At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sale_com as $refer)
                    <tr>
                        <td>Rs. {{ $refer->amount }}</td>
                        <td>{{ $refer->name  }}</td>
                        <td>{{ $refer->order_details->order->orderId  }}</td>
                        <td>
                            @if ($refer->isAssign)
                                Claimed

                            @else
                                Not Claimed
                            @endif
                        </td>
                        <td>{{ $refer->created_at  }}</td>

                    </tr>
                @empty
                    <tr>
                        <td>No Profit Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        <h1 class="text-center">Referral Commison</h1>
    <div class="table-responsive">
        <table class="table order-table">
            <thead>
                <tr>

                    <th scope="col">Amount</th>
                    <th scope="col">Level User Name</th>
                    <th scope="col">Level </th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Is Claimed</th>
                    <th scope="col">Date At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sale_referral_com as $refer)
                    <tr>
                        <td>Rs. {{ $refer->amount }}</td>
                        <td>{{ $refer->level_user_name  }}</td>
                        <td>{{ $refer->level  }}</td>
                        <td>{{ $refer->order_details->order->orderId  }}</td>
                        <td>
                            @if ($refer->isAssign)
                                Claimed

                            @else
                                Not Claimed
                            @endif
                        </td>
                        <td>{{ $refer->created_at  }}</td>

                    </tr>
                @empty
                    <tr>
                        <td>No Profit Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- <nav class="custome-pagination">
        <ul class="pagination justify-content-center">

            <li class="page-item">
                {!! $products->links() !!}
            </li>
    </nav> --}}
</div>
@endsection
