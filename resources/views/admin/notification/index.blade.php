

@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All Notifications </h5>
                            <a href="{{route('admin.markAllRead')}}" class="btn btn-solid">Mark  all read</a>
                        </div>
                        <div>
                            <div class="table-responsive">
                               
                                <table class="table all-package order-table theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Message</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($notifications as $notification)
                                        <tr>
                                            <td class="product-image">{{$notification->created_at->diffForHumans()??''}}</td>
                                            <td>
                                                <h6>{{$notification->name??''}}</h6>
                                            </td>
                                            <td>
                                                <h6 class="">{{$notification->message??''}}</h6>
                                            </td>
                                            <td><a href="{{route('admin.markOneRead',$notification->id)}}"> Mark as read</a></td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    {{$notifications->links()}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

