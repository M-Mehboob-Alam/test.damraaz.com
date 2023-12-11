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

                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Commission</th>
                    <th scope="col">Join Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $refer)
                    <tr>
                        <td>{{ $refer->username ?? '-' }}</td>
                        <td>{{ $refer->email ?? '-' }}</td>
                        <td>Rs.2</td>


                        <td>{{ $refer->created_at ?? '-' }} </td>
                    </tr>
                @empty
                    <tr>
                        <td>No Referral Found</td>
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
