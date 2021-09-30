@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-11">
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
                        <div class="col">
                            <a href="{{ route('ministries.create') }}" class="btn btn-primary mb-2 offset-md-10">Create</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Name of Ministry</th>
                        <th scope="col">Address</th>
                        <th scope="col">SRO</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                        <tbody>
                            @foreach ($ministries as $ministry)
                                <tr>
                                    <td>{{ $ministry->code }}</td>
                                    <td>{{ $ministry->description }}</td>
                                    <td>{{ $ministry->address }}</td>
                                    <td>{{ $ministry->SRO }}</td>
                                    <td><a href="{{ route('ministries.edit', $ministry->id)}}" class="btn btn-success"> Edit </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection