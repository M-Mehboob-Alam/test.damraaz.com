@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">
            <h1 class=" text-center">Bundle Levels
                <!-- Button trigger modal -->
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
            </h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Level No</th>
                    <th scope="col">Commission</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach($levels as $acc)
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

        </div>

    </div>
    <style>
        label{
            font-size: 1rem;
        }
    </style>
@endsection
