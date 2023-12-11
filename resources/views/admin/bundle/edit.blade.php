@extends('admin.layouts.app')
@section('content')
    <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">
        <form action="{{route('admin.update.package.view')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$package->id}}">
            <div class="row mt-4">
              <div class="col">
                <input type="text" name="name" required value="{{$package->name}}" class="form-control" placeholder="Package Name">
              </div>
              <div class="col">
                <input type="number" name="price" step="any" value="{{$package->price}}" class="form-control" placeholder="Package Price">
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <input type="number" name="bv" value="{{$package->bv}}" required class="form-control" placeholder="Enter BV">
              </div>
              <div class="col">
                <input type="number" name="course" value="{{$package->course}}" required class="form-control" placeholder="Max Courses">
              </div>
              <div class="col">
                <input type="number" name="pdf" value="{{$package->pdf}}" required class="form-control" placeholder="Max Books">
              </div>
              <div class="col">
                <input type="number" name="level" value="{{$package->level}}" class="form-control" required placeholder="Enter Maximum Level">
              </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">Update Package</button>
          </form>
    </div>
@endsection
