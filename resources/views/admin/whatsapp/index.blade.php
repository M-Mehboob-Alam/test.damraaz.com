@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">



            <form action="{{route('admin.uploadStoreWhatsapp')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="id" value="{{$store->id}}" >

                <h1 class="text-canter text-success">WhatsApp Setting</h1>

                <div class="row mt-4">
                <div class="col">
                    <label for="">WhatsApp +923123456789</label>
                    <input type="text" name="whatsapp" required class="form-control" value="{{$store->whatsapp}}" placeholder="Enter Phone">
                </div>
                </div>
                <div class="row mt-4">
                <div class="col">
                    <label for="">WhatsApp Message Show</label>
                    <input type="text" name="message" required class="form-control" value="{{$store->message}}" placeholder="Enter Phone">
                </div>
                </div>



                <button type="submit" class="btn btn-success mt-4">Submit</button>
            </form>

        </div>

    </div>
@endsection
