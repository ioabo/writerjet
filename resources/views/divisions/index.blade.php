@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h3 class="mt-4">Divisions</h3>
        <div class="breadcrumb mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-2">
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('ministries.index') }}">Organisations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $ministry->code }} Divisions</li>
                </ol>
            </nav>
        </div>
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
        <div class="card border-1 mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('divisions.create', [$ministry->id]) }}" class="btn btn-primary mb-2 btn-small">Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-secondary">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name of Division</th>
                            <th scope="col" class="d-md-flex justify-content-md-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($divisions as $division)
                            <tr>
                                <td>{{ $division->code }}</td>
                                <td>{{ $division->name }}</td>
                                <td class="d-md-flex justify-content-md-center"><a href="{{ route('divisions.edit', [$division->id,$ministry->id]) }}" class="btn btn-warning btn-sm"> Edit
                                    </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
