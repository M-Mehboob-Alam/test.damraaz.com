@extends('layouts.app')
@section('title')
   View All Commission
@endsection

@section('content')
   <div class="container my-3 p-5 rounded shadow">
        <h1 class="text-center">All Circle Commissions <a href="{{ url()->previous() }}" class="btn btn-warning">Back To Home</a></h1>
    <div class="table-responsive" id="contentToPrint">
        <table class="table order-table">
            <thead>
                <tr>
                   
                    <th scope="col">Reward Amount </th>
                    <th scope="col">Status</th>                    
                    <th scope="col">Date At</th>                    
                    {{-- <th scope="col">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse($bundles as $returned)
                    <tr>
                       
                         <td>
                            <!--<label class="success">Shipped</label>-->
                           Rs.{{ $returned->amount }}
                        </td>
                        @if ($returned->isAssign)
                         <td>
                            Assigned
                        </td>
                        @else
                        <td>
                            <form action="{{ route('claimedNowCircleCommission') }}" method="POST">
                                <input type="hidden" name="id" value="{{ $returned->id }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Claim Now</button>
                            </form>
                        </td>
                        @endif
                       
                        
                        <td>{{ $returned->created_at->format('d-m-Y H:i:s') }}
                        </td>
                      
                    </tr>
                @empty
                    <tr>
                        <td>No Commission </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   </div>

@endsection
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick-theme.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bulk-style.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}"> --}}
