@extends('admin.layouts.app')
@section('content')
    <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">
        <form action="{{route('admin.storeBundle')}}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="row mt-4">
                <h1 class="bg-success">Add New Product Bundle</h1>
              <div class="col">
                  <label>Feature/Cover Photo</label>
                <input type="file" name="photo" required class="form-control" >
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <input type="text" name="name" required class="form-control" placeholder="Product Bundle Name">
              </div>
              <div class="col">
                <input type="number" required name="price" step="any" class="form-control" placeholder="Bundle Price">
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <input type="number" name="points" required class="form-control" placeholder="Points">
              </div>
              <div class="col">
                <input type="number" required name="level"  class="form-control" placeholder="Maximum Level">
              </div>
              <div class="col">
                <input type="number" required name="commission"  class="form-control" placeholder="Commission">
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <input type="number" required name="delivery_days"  class="form-control" placeholder="delivery days">
              </div>
              <div class="col">
                <input type="number" required name="delivery_charges"  class="form-control" placeholder="delivery charges">
              </div>
            </div>

            <button type="submit" class="btn btn-success mt-4">Add Product Bundle</button>
          </form>
    </div>
@endsection
