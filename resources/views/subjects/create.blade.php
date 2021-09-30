@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h3 class="mt-4">New Template</h3>
        <div class="breadcrumb mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-2">
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('New Subject') }}</li>
                </ol>
            </nav>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="row">
                        <div class="col">{{ __('Template Form for ') . $category->name }}</div>
                        <div class="col"><a href="" class="offset-md-11">{{ __('Back') }}</a></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('subjects.store') }}">
                    @csrf

                    <div class="form-floating mb-3">

                        <input id="category_id" type="category_id" class="form-control" name="category_id"
                            value="{{ old('category_id', $category->id) }}" required placeholder="name@example.com"
                            readonly hidden>

                    </div>

                    <div class="form-floating mb-3">

                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required placeholder="name@example.com" autofocus
                            autocomplete="off">
                        <label for="name">{{ __('Enter new subject identifier') }}</label>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">

                        <textarea id="content" type="textbox" class="form-control" name="content"></textarea>


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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
