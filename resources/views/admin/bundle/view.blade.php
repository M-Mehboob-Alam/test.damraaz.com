@extends('admin.layouts.app')
@section('content')
    <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">
        <form>
            @csrf
            <div class="row mt-4">
                <div class="col-6">
                    <img src="{{ asset($bundle->photo) }}" height="400px" with="600px" style="object-fit:contain;">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <label>Bundle Name</label>
                    <input type="text" name="name" required value="{{ $bundle->name }}" class="form-control"
                        placeholder="Bundle Name">
                </div>
                <div class="col">
                    <label>Bundle Price</label>
                    <input type="number" name="price" step="any" value="{{ $bundle->price }}" class="form-control"
                        placeholder="Bundle Price">
                </div>
                <div class="col">
                    <label>Level </label>
                    <input type="number" name="level" value="{{ $bundle->level }}" class="form-control"
                        placeholder="Bundle Price">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <label>Commission</label>
                    <input type="number" name="commission" value="{{ $bundle->commission }}" class="form-control"
                        placeholder="Bundle Price">
                </div>
                <div class="col">
                    <label>Bundle Points</label>
                    <input type="number" name="points" value="{{ $bundle->points }}" class="form-control"
                        placeholder="Bundle Price">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <label>Delivery Charges</label>
                    <input type="number" name="delivery_charges" value="{{ $bundle->delivery_charges }}" class="form-control"
                        placeholder="Bundle Price">
                </div>
                <div class="col">
                    <label>Delivery Days</label>
                    <input type="number" name="delivery_days" value="{{ $bundle->delivery_days }}" class="form-control"
                        placeholder="Bundle Price">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
        </form>
    </div>
    </div>
    <hr>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalPackage">Add New
        Product</button>
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="myModalPackage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storeNewProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Text Input -->
                        <input type="hidden" name="id" value="{{ $bundle->id }}">
                        <div class="form-group">
                            <label for="text-input">Product Name</label>
                            <input type="text" class="form-control" id="text-input" required name="name">
                        </div>
                        <div class="form-group">
                            <label for="text-input">Image </label>
                            <input type="file" class="form-control" id="text-input" required name="photo">
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">close</button>

                </div>
            </div>
        </div>
    </div>


        <hr>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New Level
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Level title</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('admin.newLevelCommissionBundle')}}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="product_bundle_id" value="{{ $bundle->id }}">
                        <div class="form-group">
                            <label for="">Enter Level No</label>
                            <input type="number" name="level" required class="form-control" >

                        </div>

                        <div class="form-group">
                            <label for="">Enter Commission</label>
                            <input type="number" name="commission" required class="form-control" >

                        </div>
                        <button type="submit" class="btn btn-success mt-4">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
              </div>
            </div>
          </div>
<hr>
<h1 class="my-5">Levels</h1>
<table class="table my-5">
    <thead>
      <tr>
        <th scope="col">Level No</th>
        <th scope="col">Commission</th>
        <th scope="col">Action</th>

      </tr>
    </thead>
    <tbody>
        @foreach($bundle->levels as $acc)
      <tr>
        <th scope="row">{{ $acc->level }}</th>
        <td>Rs.{{ $acc->commission }}</td>
        <td>
            <a href="{{ route('admin.deleteLevelCommissionBundle', $acc->id) }}" class="btn btn-danger btn-block">Delete Level</a>
            <button type="button" class="btn btn-primary btn-block lg" data-bs-toggle="modal" data-bs-target="#editLevel{{ $acc->id }}">
                Edit Level
            </button>
        </td>
      </tr>
      <!-- Modal -->
<div class="modal fade" id="editLevel{{ $acc->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Level title</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<form action="{{route('admin.editLevelCommissionBundle')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="id" value="{{ $acc->id }}">
    <div class="form-group">
        <label for="">Enter Level No</label>
        <input type="number" name="level" required value="{{ $acc->level }}" class="form-control" >

    </div>

    <div class="form-group">
        <label for="">Enter Commission</label>
        <input type="number" name="commission" required value="{{ $acc->commission }}" class="form-control" >

    </div>
    <button type="submit" class="btn btn-success mt-4">Submit</button>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
      @endforeach

    </tbody>
  </table>

<style>
label{
font-size: 1rem;
}
</style>
            <h1 class="my-5">Products</h1>
        <table class="table my-5">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bundle->product_bundle_detail as $key => $p)
                    <tr>
                        <td scope="row">{{ $p->name }}</td>
                        <td><img height="100px" width="300px" style="object-fit:contain;"
                                src="{{ asset($p->photo) }}"></td>
                        <td>

                            @if ($p->isHide)
                                <a href="{{ route('admin.hideSubProductPackage', ['id' => $p->id]) }}"
                                    class="btn my-1 btn-success">Set To  Show</a>
                            @else
                                <a href="{{ route('admin.hideSubProductPackage', ['id' => $p->id]) }}"
                                    class="btn my-1 btn-danger">Set To Hide</a>
                            @endif
                            <a type="button" class="btn my-1 btn-primary" data-bs-toggle="modal" data-bs-target="#myModalEdit{{ $p->id }}">Edit</a>
                            <form action="{{ route('admin.deleteSubProduct', $p->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn my-1 btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal" id="myModalEdit{{ $p->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal content here -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Edit Product</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form -->
                                    <form action="{{ route('admin.editSubProductDetail') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!-- Text Input -->
                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                        <div class="form-group">
                                            <label for="text-input">Product Name</label>
                                            <input type="text" class="form-control" value="{{ $p->name }}"
                                                id="text-input" required name="name">
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="form-group">
                                            <img src="{{ asset($p->photo) }}" class="img-fluid m-2">
                                            <br>
                                            <label for="image-input">Image Upload</label>
                                            <input type="file" class="form-control-file" id="image-input"
                                                name="photo">
                                        </div>
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    {{-- @endforeach --}}
    <a href="{{ route('admin.allProductBundle') }}" class="btn btn-primary mt-4">Back To All Bundles</a>
    </div>
@endsection
<style>
    .modal-backdrop {
        display: none !important;
    }
</style>
