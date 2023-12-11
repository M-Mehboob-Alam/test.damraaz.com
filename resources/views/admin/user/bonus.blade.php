@extends('admin.layouts.app')
@section('content')
    <!-- Container-fluid starts-->
    <!-- All User Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Bonus</h5>
                            {{-- <div class="d-inline-flex">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#change-password" class="align-items-center btn btn-theme d-flex">Change Password</a>
                            </div> --}}
                        </div>
                        <hr>
                        <div class="table-responsive table-product">
                            <table class="table all-package theme-table" id="table_id">
                                <thead>
                                    <tr>
                                        <th>User Email</th>
                                        <th>Username</th>
                                        <th>Commission Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Updated Date</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($commissions as $com)
                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td> {{ $com->user->email }} </td>
                                            <td> {{ $com->user->username }} </td>
                                            <td> {{ $com->name }} </td>
                                            <td>{{ $com->amount }}</td>

                                            <td>
                                                @if ($com->isAssign)
                                                    <span class="text-success"> Assigned</span>
                                                @else
                                                    <span class="text-danger"> Pending </span>
                                                @endif
                                            </td>
                                            {{-- <td> {{ $com->status }}</td> --}}
                                            <td>{{ $com->created_at }}</td>
                                            <td>{{ $com->updated_at }}</td>
                                            <td>
                                                <ul>
                                                    {{-- <li>
                                                        <a href="{{ route('admin.view.order', ['order' => $ordr->id]) }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li> --}}

                                                    <li>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalCommission{{ $com->id }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('admin.user.delete.commission', ['commission' => $com->id]) }}">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCommission{{ $com->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Commission
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form  action="{{ route('admin.user.change.commission') }}"  method="POST" class="theme-form theme-form-2 mega-form">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $com->user_id }}">
                                                            <input type="hidden" name="id"
                                                                value="{{ $com->id }}">
                                                            <div class="row">
                                                                <div class="mb-4 row align-items-center">
                                                                    <label class="form-label-title col-sm-4 mb-0">Commission Amount</label>
                                                                    <div class="col-sm-6">
                                                                        <input class="form-control" type="number"  value="{{ $com->amount }}" required  name="amount">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 row align-items-center">
                                                                    <label class="form-label-title col-sm-4 mb-0">Commission Name</label>
                                                                    <div class="col-sm-6">
                                                                        <input readonly class="form-control" type="text" name="name" value="{{ $com->name }}"  required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 row align-items-center">
                                                                    <label class="form-label-title col-sm-4 mb-0">Commission Status</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="isAssign" required>
                                                                            <option value=1 {{ $com->isAssign ? 'selected' : '' }}>Assigned</option>
                                                                            <option value=0 {{ $com->isAssign ? '' : 'selected' }}>Pending</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 row align-items-center">
                                                                    <label class="form-label-title col-sm-4 mb-0">Message</label>
                                                                    <div class="col-sm-6">
                                                                        <textarea class="form-control" type="text" name="message" required>{{ $com->message }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <button type="submit"    class="btn btn-primary">Submit</button>


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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
