@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Category Information</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form" method="post"
                                    action="{{ route('admin.category.update', $category->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Parent Category (Optional)</label>
                                        <div class="col-sm-9">
                                            <select name="parent_id"  class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $item)
                                                <option value="{{$item->id}}" {{is_null($category->parent_id) ? '' : ($category->parent_id == $item->id  ? 'selected' : '')   }}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Category Name</label>
                                        <div class="col-sm-9">
                                            <input value="{{ $category->name ?? '' }}"
                                                class="form-control  @error('name') is-invalid @enderror" name="name"
                                                type="text" placeholder="Category Name">
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Category Image</label>
                                        <div class="form-group col-sm-9">
                                            <input class="form-control @error('image') is-invalid @enderror" name="image"
                                                type="file" accept="image/*" placeholder="Category Name">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-3 form-label-title">Category Detail</div>
                                        <div class="col-sm-9">
                                            <textarea name="detail" id="" class="form-control @error('detail') is-invalid @enderror"
                                                placeholder="Enter Category Detail">{{ $category->detail ?? '' }} </textarea>
                                        </div>
                                        @error('detail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary ms-auto" type="submit">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
