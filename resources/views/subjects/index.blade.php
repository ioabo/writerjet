@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h3 class="mt-4">Templates</h3>
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
        <div class="breadcrumb mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-2">
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>

                </ol>
            </nav>
        </div>
        <div class="card mb-4">

            <div class="card-header">
                <div class="row">
                    <div class="col">
                        {{ __('Pre-Defined Subjects List') }}
                    </div>
                    <div class="col">
                        <a href="{{ route('subjects.create', $category->id) }}"
                            class="btn btn-primary mb-2 offset-md-10">Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->name }}</td>
                                <td><a href="{{ route('subjects.edit', [$category->id, $subject->id]) }}"
                                        class="btn btn-success"> Edit </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
