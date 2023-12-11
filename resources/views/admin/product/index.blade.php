@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All Products</h5>
                            <form class="d-inline-flex">
                                <a href="{{ route('admin.product.create') }}" class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Add New
                                </a>
                            </form>
                        </div>

                        <div class="table-responsive product-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <!--<th>info</th>-->
                                            <th>Date</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}
                                                    @if ($product->isMegaSale)
                                                    <span class="badge badge-danger ">Mega Sale</span>
                                                    @endif
                                                </td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>
                                                    @php
                                                        $image = json_decode($product->images);
                                                    @endphp
                                                    <div class="table-image">
                                                        <img src="{{ asset($image[0]) }}" class="img-fluid" alt="">
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
