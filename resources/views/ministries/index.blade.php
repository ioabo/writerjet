@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h3 class="mt-4">Organisations</h3>
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
                        {{ __('Ministries') }}
                    </div>
                    <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('ministries.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-secondary" >
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name of Ministry</th>
                            <th scope="col">Address</th>
                            <th scope="col" colspan="2">Contacts</th>
                            <th scope="col">SRO</th>
                            <th scope="col" colspan="2">Links and Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ministries as $ministry)
                            <tr>
                                <td>{{ $ministry->code }}</td>
                                <td>{{ $ministry->description }}</td>
                                <td>{{ $ministry->address }}</td>
                                <td>{{ $ministry->phone }}</td>
                                <td>{{ $ministry->email }}</td>
                                <td>{{ $ministry->SRO }}</td>
                                <td><a
                                        href="{{ route('divisions.index', $ministry->id) }}"
                                        class="btn btn-secondary btn-sm">
                                        <span
                                            class="badge rounded-pill bg-light text-dark">{{ $ministry->count_divisions($ministry->id) }}</span>
                                        Divisions
                                    </a></td>
                                <td><a href="{{ route('ministries.edit', $ministry->id) }}"
                                        class="btn btn-warning btn-sm"> Edit
                                    </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
