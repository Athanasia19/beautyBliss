@extends('layouts.master')


@section('content')
    <div class="container">
        <h1>Products</h1>

        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Create Product</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered" id="productID">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Original Price</th>
                    <th>Selling Price</th>
                    <th>Quantity</th>
                    <th>Trending</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" width="50">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->original_price }}</td>
                        <td>{{ $product->selling_price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->trending ? 'Trending' : 'Not Trending' }}</td>
                        <td>
                            <!-- Add your action buttons here -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#productID').DataTable();
            });
        </script>
    </div>
@endsection
