@extends('layouts.app')
@section('title')
All Shop Sales
@endsection


@section('content')

<div class="order-tab dashboard-bg-box container">
        <h1 class="text-center">Your Withdraws</h1>
    <div class="table-responsive container p-5 border rounded my-5">
        <table class="table order-table">
            <thead>
                <tr>

                    <th scope="col">Amount</th>
                    <th scope="col">Acc. Title</th>
                    <th scope="col">Acc. No#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date At</th>
                    <th scope="col">Update At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($withdraws as $refer)
                    <tr>
                        <td>Rs. {{ $refer->amount }}</td>
                        <td>{{ $refer->account_title  }}</td>
                        <td>{{ $refer->account_no  }}</td>
                        <td class="text-uppercase text-danger">{{ $refer->status  }}</td>
                        <td >{{ $refer->message  }}</td>
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
