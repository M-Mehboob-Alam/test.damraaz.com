@extends('admin.layouts.app')
@section('content')
    <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">
        <h5>All bundles</h5>
        <div class="table-responsive-sm">
            <table class="table">
                <caption class="" ><b>All bundles</b></caption>
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Bundle Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Commission</th>
                    <th scope="col">Points</th>
                    <th scope="col">Level</th>
                    <th scope="col">Status</th>

                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bundles as $key=> $bundle )
                    <tr>
                        <th scope="row"><img height="100px" width="100px" src="{{asset($bundle->photo)}}"></th>
                        <th >{{$bundle->name}}</th>
                        <td>{{$bundle->price}}</td>
                        <td>{{$bundle->commission}}</td>
                        <td>{{$bundle->points}}</td>
                        <td>{{$bundle->level}}</td>
                        <td>
                            @if($bundle->isHide)
                            <a href="{{route('admin.hideProductPackage',['bundle_id'=>$bundle->id])}}" class="btn text-success">Set To Show</a>
                            @else
                            <a href="{{route('admin.hideProductPackage',['bundle_id'=>$bundle->id])}}" class="btn text-danger">Set To Hide</a>
                            @endif
                        </td>
                        <td>

                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#myModalEdit{{$key}}"><i class="ri-pencil-line"></i></a>  <a href="{{route('admin.viewProductBundle', ['bundle_id'=>$bundle->id])}}" ><i class="ri-eye-line"></i></a></td>
                        </tr>
                          <!-- Modal -->
                          <div class="modal fade" id="myModalEdit{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{route('admin.editBundle')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Text Input -->
                                        <input type="hidden" name="id" value="{{$bundle->id}}">


                                        <!-- Image Upload -->
                                        <div class="form-group">
                                            <img src="{{asset($bundle->photo)}}" class="img-fluid m-2" >
                                            <br>
                                          <label for="image-input">Image Upload</label>
                                          <input type="file" class="form-control-file" id="image-input"  name="photo">
                                        </div>
                                        <div class="form-group">
                                            <label for="text-input">Bundle Name</label>
                                            <input type="text" class="form-control" value="{{$bundle->name}}" id="text-input" required name="name">
                                          </div>
                                          <div class="form-group">
                                            <label for="text-input">Bundle Price</label>
                                            <input type="number" class="form-control" value="{{$bundle->price}}" id="text-input" required name="price">
                                          </div>
                                          <div class="form-group">
                                            <label for="text-input">Bundle Points</label>
                                            <input type="number" class="form-control" value="{{$bundle->points}}" id="text-input" required name="points">
                                          </div>
                                          <div class="form-group">
                                            <label for="text-input">Level</label>
                                            <input type="number" class="form-control" value="{{$bundle->level}}" id="text-input" required name="level">
                                          </div>
                                          <div class="form-group">
                                            <label for="text-input">Bundle Commission</label>
                                            <input type="number" class="form-control" value="{{$bundle->commission}}" id="text-input" required name="commission">
                                          </div>
                                          <div class="form-group">
                                            <label for="text-input">Bundle Delivery Charges</label>
                                            <input type="number" class="form-control" value="{{$bundle->delivery_charges}}" id="text-input" required name="delivery charges">
                                          </div>
                                          <div class="form-group">
                                            <label for="text-input">Bundle Delivery Days</label>
                                            <input type="number" class="form-control" value="{{$bundle->delivery_days}}" id="text-input" required name="delivery days">
                                          </div>
                                          <br>
                                          <br>
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </form>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-primary"
                                      data-bs-dismiss="modal">close</button>

                                  </div>
                              </div>
                          </div>
                      </div>

                    @endforeach
                </tbody>
            </table>
          </div>
    </div>
@endsection
<style>
    .modal-backdrop {
  display: none !important;
}
</style>
