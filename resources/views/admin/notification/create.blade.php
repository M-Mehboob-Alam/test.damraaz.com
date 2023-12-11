

@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Send Notification to all Users </h5>
                            {{-- <a href="{{route('admin.markAllRead')}}" class="btn btn-solid">Mark  all read</a> --}}
                        </div>
                        <div>
                            <form method="POST" action="{{route('admin.notification.store')}}" class="row">
                                @csrf
                                <div class="col-md-12 my-1">
                                    <label for="name" class="form-label">Notification name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="col-md-12 my-1">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea type="text" name="message" id="message" class="form-control"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

