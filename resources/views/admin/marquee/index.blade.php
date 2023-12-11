@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>News</h5>
                        </div>

                        <form method="post" action="{{ route('admin.marquee.update') }}">
                            @csrf
                            <div class="col-md-12 my-2">
                                <label for="message">News</label>
                                <textarea name="message" rows="5" class="form-control">{{ $marquee->message ?? '' }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
