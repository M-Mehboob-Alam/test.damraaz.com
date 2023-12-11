@extends('layouts.app')
@section('title')
All Shop Sales
@endsection


@section('content')

<div class="order-tab dashboard-bg-box container">
        <h1 class="text-center">Pending Sales Commison</h1>
    <div class="table-responsive container p-5 border rounded my-5">
        <table class="table order-table">
            <thead>
                <tr>

                    <th scope="col">Amount</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date At</th>
                    <th scope="col">Update At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pending_sale_com as $refer)
                    <tr>
                        <td>Rs. {{ $refer->amount * 80/100 }}</td>
                        <td>{{ $refer->name  }}</td>
                        <td class="text-uppercase text-danger">{{ $refer->status  }}</td>
                        <td>
                            {{ $refer->created_at  }}
                        </td>
                        <td>{{ $refer->updated_at  }}</td>

                    </tr>
                @empty
                    <tr>
                        <td>No Pending Commission Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>
<div class="order-tab dashboard-bg-box container">
        <h1 class="text-center">Pending Circle Commison</h1>
    <div class="table-responsive container p-5 border rounded my-5">
        <table class="table order-table">
            <thead>
                <tr>

                    <th scope="col">Amount</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date At</th>
                    <th scope="col">Update At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pending_circle_com as $refer)
                    <tr>
                        <td>Rs. {{ $refer->amount * 80/100 }}</td>
                        <td>{{ $refer->name  }}</td>

                        <td>
                            {{ $refer->created_at  }}
                        </td>
                        <td>{{ $refer->updated_at  }}</td>

                    </tr>
                @empty
                    <tr>
                        <td>No Circle Commission Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>
<div class="order-tab dashboard-bg-box container">
        <h1 class="text-center">Pending Referral Commison</h1>
    <div class="table-responsive container p-5 border rounded my-5">
        <table class="table order-table">
            <thead>
                <tr>

                    <th scope="col">Amount</th>
                    <th scope="col">Level</th>
                    <th scope="col">Level Username</th>
                    <th scope="col">Date At</th>
                    <th scope="col">Update At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pending_circle_com as $refer)
                    <tr>
                        <td>Rs. {{ $refer->amount * 80/100 }}</td>
                        <td>{{ $refer->level + 1  }}</td>
                        <td>{{ $refer->level_user_name  }}</td>

                        <td>
                            {{ $refer->created_at  }}
                        </td>
                        <td>{{ $refer->updated_at  }}</td>

                    </tr>
                @empty
                    <tr>
                        <td>No Circle Commission Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>
@endsection
