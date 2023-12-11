@extends('layouts.app')
@section('title')
All Shop Sales
@endsection


@section('content')

<div class="order-tab dashboard-bg-box container">
        <h1 class="text-center">Your Shop Sales Commison</h1>
    <div class="table-responsive container p-5 border rounded my-5">
        <table class="table order-table">
            <thead>
                <tr>

                    <th scope="col">Amount</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date At</th>
                    <th scope="col">Update At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shopSales as $refer)
                    <tr>
                        <td>Rs. {{ $refer->amount * 88/100 }}</td>
                        <td>{{ $refer->order->orderId  }}</td>
                        <td class="text-uppercase text-danger">{{ $refer->status  }}</td>
                        <td>
                            {{ $refer->created_at  }}
                        </td>
                        <td>{{ $refer->updated_at  }}</td>

                    </tr>
                @empty
                    <tr>
                        <td>No Profit Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>
@endsection
