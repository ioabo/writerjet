@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h3 class="mt-4">Categories</h3>
        <div class="mt-4">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>

            @endif
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        {{ __('List') }}
                    </div>
                    <div class="col">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2 offset-md-10">Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 60%">Category</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success"> Edit
                                    </a></td>
                                <td><a href="{{ route('categories.show', $category->id) }}" class="btn btn-success">
                                        {{ $category->count_rows($category->id) }} - Templates </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
