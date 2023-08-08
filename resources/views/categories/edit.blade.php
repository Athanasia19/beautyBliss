@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categories.update', $category->category_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $category->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ $category->slug }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $category->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="image-preview">
                                    @if ($category->image)
                                        <img src="{{ asset('images/' . $category->image) }}" alt="Category Image"
                                            width="100">
                                    @else
                                        <p>No image</p>
                                    @endif
                                </div>
                                <input type="file" name="image" id="image" class="form-control-file mt-2">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
