@extends('layouts.app')
@section('title')
Circle Commission
@endsection


@section('content')

<div class="order-tab dashboard-bg-box container">
        <h1 class="text-center">Circle Commison</h1>
    <div class="table-responsive">
        <table class="table order-table">
            <thead>
                <tr>

                    <th scope="col">Amount</th>
                    <th scope="col">Name</th>
                    <th scope="col">Is Claimed</th>
                    <th scope="col">Date At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($circle_com as $refer)
                    <tr>
                        <td>Rs. {{ $refer->amount }}</td>
                        <td>{{ $refer->name  }}</td>
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
                        <td>No Circle Commision Found</td>
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
