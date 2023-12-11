@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>All branding</h5>
                            <form class="d-inline-flex">
                                <a href="{{ route('admin.create.branding') }}"
                                    class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Add New
                                </a>
                            </form>
                        </div>

                        <div class="table-responsive branding-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Branding Name</th>
                                            <th>Image</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            {{-- <th>Address</th> --}}
                                            <th>Date</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($categories as $branding)
                                            <tr>
                                                <td>{{ $branding->name }}</td>
                                                <td>
                                                    <div class="table-image">
                                                        <img src="{{ asset($branding->image) }}" class="img-fluid"
                                                            alt="">
                                                    </div>
                                                </td>

                                                <td>{{ $branding->phone }}</td>
                                                <td>{{ $branding->email }}</td>
                                                {{-- <td>{{ $branding->address }}</td> --}}

                                                <td>{{ $branding->created_at }}</td>

                                                <td>
                                                    <ul>
                                                        {{-- <li>
                                                    <a href="order-detail.html">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                </li> --}}

                                                        <li>
                                                            <a href="{{ route('admin.branding.edit', $branding->id) }}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                            <a href="{{ route('admin.branding.view', $branding->id) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>

                                                        {{-- <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#delete{{ $branding->id }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                            <!-- Delete Modal Box Start -->
                                                            <div class="modal fade theme-modal remove-coupon"
                                                                id="delete{{ $branding->id }}" aria-hidden="true"
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
                                                                            <div class="remove-box">If you delete this
                                                                                branding, the products <br> associated with
                                                                                it will also be deleted </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-animation btn-md fw-bold"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <form
                                                                                action="{{ route('admin.branding.destroy', $branding->id) }}"
                                                                                method="POST" class="">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-animation btn-md fw-bold"
                                                                                    data-bs-target="#exampleModalToggle2"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-dismiss="modal">Yes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li> --}}
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
