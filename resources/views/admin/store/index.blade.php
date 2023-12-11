@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">



            <form action="{{route('admin.uploadStoreInformation')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="id" value="{{$store->id}}" >



                <h1 class="text-canter text-success">Store Information Setting</h1>
                <div class="row mt-4">
                <div class="col">
                    <label for="">Support Email</label>
                    <input type="text" name="email" required class="form-control" value="{{$store->email}}"  placeholder="Enter Support Email">
                </div>
                </div>
                <div class="row mt-4">
                <div class="col">
                    <label for="">Support Phone No</label>
                    <input type="text" name="phone" required class="form-control" value="{{$store->phone}}" placeholder="Enter Phone">
                </div>
                </div>
                <div class="row mt-4">
                <div class="col">
                    <label for="">Address Location</label>
                    <textarea name="location" required class="form-control">{{$store->location}}</textarea>
                </div>
                </div>


                <button type="submit" class="btn btn-success mt-4">Submit</button>
            </form>

        </div>

    </div>
@endsection
