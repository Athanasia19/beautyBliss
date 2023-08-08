@extends('layouts.master')


@section('content')
    <div class="container">
        <h1>Brands</h1>




        <a href="{{ route('brand.create') }}" class="btn btn-success mb-3">Create Brand</a>




        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif




        <table class="table table-bordered" id="brandID">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brand as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->slug }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-secondary">Edit</a>
                                </div>
                        </td>
                        <td>
                            <div class="col-md-4">
                                <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#brandID').DataTable();
            });
        </script>
    </div>
@endsection
