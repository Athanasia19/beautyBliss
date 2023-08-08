@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Edit Product</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="{{ $product->slug }}" required>
                    </div>
                    <br>
                    <label for="image">Image</label>
                    <div class="image-preview">
                        @if ($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" width="100">
                        @else
                            <p>No image</p>
                        @endif
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <select name="brand_id" id="brand" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="original_price">Original Price</label>
                        <input type="number" name="original_price" id="original_price" class="form-control"
                            value="{{ $product->original_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" name="selling_price" id="selling_price" class="form-control"
                            value="{{ $product->selling_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                            value="{{ $product->quantity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="trending">Trending</label>
                        <select name="trending" id="trending" class="form-control">
                            <option value="0" {{ $product->trending == 0 ? 'selected' : '' }}>Not Trending</option>
                            <option value="1" {{ $product->trending == 1 ? 'selected' : '' }}>Trending</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
