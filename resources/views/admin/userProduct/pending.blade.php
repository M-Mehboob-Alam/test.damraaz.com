@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5> Products</h5>
                            {{-- <form class="d-inline-flex">
                                <a href="{{ route('admin.product.create') }}" class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Add New
                                </a>
                            </form> --}}
                        </div>

                        <div class="table-responsive product-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->user->username }}</td>
                                                <td>{{ $product->name }}
                                                    @if ($product->isMegaSale)
                                                    <span class="badge badge-danger">Mega Sale</span>
                                                    @endif
                                                </td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>

                                                    <div class="table-image">
                                                        <img src="{{asset($product->image)}}" class="img-fluid"
                                                            alt="">
                                                    </div>
                                                </td>

                                                <!--<td>{{ $product->detail }}    </td>-->

                                                <td>{{ $product->created_at }}</td>

                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('admin.product.show', $product->id) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class=" btn p-0 text-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#accept{{ $product->id }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Accept or Reject">
                                                                <i class="fa-regular fa-circle-check"></i>
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="accept{{ $product->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                aria-hidden="true">
                                                                <div
                                                                    class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="staticBackdropLabel">Accept/Reject</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="row" method="POST" action="{{ route('admin.userProduct.upload', $product->id) }}">
                                                                                @csrf
                                                                                <div class="col-12 mb-1 form-group">
                                                                                    <select class="select-option form-control" name="status">
                                                                                        <option value="accepted">Accept</option>
                                                                                        <option value="rejected">Reject</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12 form-group">
                                                                                    <textarea class="text-area form-control" name="message"></textarea>
                                                                                </div>
                                                                                <div class="col-12 fomr-group my-2">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Update</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li> --}}

                                                        <li>
                                                            <a href="{{ route('admin.product.edit', $product->id) }}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#delete{{ $product->id }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                            <!-- Delete Modal Box Start -->
                                                            <div class="modal fade theme-modal remove-coupon"
                                                                id="delete{{ $product->id }}" aria-hidden="true"
                                                                tabindex="-1">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header d-block text-center">
                                                                            <h5 class="modal-title w-100"
                                                                                id="exampleModalLabel22">Are You Sure ?</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"><i
                                                                                    class="fas fa-times"></i></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="remove-box">
                                                                                <p>You wanna delete this</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-animation btn-md fw-bold"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <form
                                                                                action="{{ route('admin.product.destroy', $product->id) }}"
                                                                                method="POST" class="">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-animation btn-md fw-bold"
                                                                                    data-bs-target="#exampleModalToggle2"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-dismiss="modal">Yes</button>
                                                                                {{-- <button type="submit" class=" text-danger btn" style="background-color: white; padding:3px;" title="Delete"><i class="fa fa-trash"></i></button> --}}
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        $(document).ready(function() {
            $('.text-area').text('Congrats! Your product accepted.');

            $(".select-option").change(function() {
                var $value = $(this).val(); // Use $(this) to get the selected value of the specific dropdown
                var $textArea = $(this).closest('.modal-body').find('.text-area'); // Find the associated text area

                if ($value == 'rejected') {
                $textArea.text('Your product is rejected.');
                } else {
                $textArea.text('Congrats! Your product accepted.');
                }
            });
        });


    </script>
@endsection
