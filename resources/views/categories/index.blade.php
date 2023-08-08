@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">Categories</h1>
        <div class="mt-5">

            {{ $dataTable->table() }}
            {{ $dataTable->scripts() }}

        </div>
    </div>
@endsection
