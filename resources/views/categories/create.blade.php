@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h3 class="mt-4">New Category</h3>
        <div class="breadcrumb mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-2">
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('New Category') }}</li>
                </ol>
            </nav>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="row">
                        <div class="col">{{ __('Add New Category') }}</div>
                        <div class="col"><a href="{{ route('categories.index') }}"
                                class="offset-md-11">{{ __('Back') }}</a></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <div class="form-floating mb-3">

                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required placeholder="name@example.com" autofocus>
                        <label for="name">{{ __('Enter new category') }}</label>

                        @error('description')
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
    </div>
@endsection
