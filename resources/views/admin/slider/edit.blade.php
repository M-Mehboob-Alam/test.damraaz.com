@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Edit Slider</h5>
                        </div>

                        <form method="post" action="{{ route('admin.slider.update', $slider->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="col-md-12">
                                <img width="50px" height="50px" src="{{ asset($slider->image ?? '') }}">
                            </div>
                            <div class="col-md-12 my-2">
                                <label for="slider">Image</label>
                                <input type="file" name="image" accept="image/*" id="formFile"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
