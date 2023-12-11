@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>New Contact Us</h5>
                        </div>

                        <div class="table-responsive category-table">
                            <div>
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Mark as read</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->name ?? '' }}</td>
                                                <td>{{ $contact->email ?? '' }}</td>
                                                <td>{{ $contact->phone ?? '' }}</td>
                                                <td class="text-start text-wrap">{{ $contact->message ?? '' }}</td>

                                                <td>
                                                    <ul>
                                                        <li>
                                                            <form method="post"
                                                                action="{{ route('admin.contact.save', $contact->id) }}">
                                                                @csrf
                                                                <button type="submit" class="btn" title="mark as read">
                                                                    <i class="ri-chat-3-line"></i>
                                                                </button>
                                                            </form>
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
