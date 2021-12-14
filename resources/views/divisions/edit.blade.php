@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="mt-4">Edit Division</h4>
        <div class="breadcrumb mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-2">
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('ministries.index') }}">Organisations</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('divisions.index', $ministry->id) }}">{{ $ministry->code }} Divisions</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $ministry->code }}</li>
                </ol>
            </nav>
        </div>
        <div class="card border-1 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col">{{ __('Edit ' . $ministry->code . ' Division') }}</div>
                    <div class="col"><a href="{{ route('divisions.index', $ministry->id) }}"
                            class="offset-md-11">{{ __('Back') }}</a></div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('divisions.update', [$division->id, $ministry->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-floating mb-3">
                        <input id="ministry_id" type="ministry_id" class="form-control" name="ministry_id"
                            value="{{ $ministry->id }}" hidden>
                    </div>

                    <div class="form-floating mb-3">

                        <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code"
                            value="{{ old('code', $division->code) }}" required placeholder="name@example.com" autofocus>
                        <label for="code">{{ __('Enter Ministry Code') }}</label>

                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">

                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', $division->name) }}" required placeholder="name@example.com" autofocus>
                        <label for="name">{{ __('Division Name') }}</label>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-1 offset-md-11">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="m-2 p-2">
            <form method="POST" action="{{ route('divisions.destroy', [$division->id,$ministry->id]) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete {{ $division->code }}
            </form>
        </div>
    </div>
@endsection
