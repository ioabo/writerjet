@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card border-1 mt-5">
                <div class="card-header">
                    <div class="row">
                        <div class="row">
                            <div class="col">{{ __('Create Ministry') }}</div>
                            <div class="col"><a href="{{ route('ministries.index') }}" class="offset-md-11">{{ __('Back') }}</a></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('ministries.store') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            
                            <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required placeholder="name@example.com" autofocus>
                            <label for="code">{{ __('Enter Ministry Code') }}</label>

                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            
                            <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required placeholder="name@example.com" autofocus>
                            <label for="description">{{ __('Enter Ministry\'s full name description') }}</label>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-floating mb-3">
                            
                            <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required placeholder="name@example.com" autofocus>
                            <label for="address">{{ __('Enter Ministry\'s Address') }}</label>

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       
                        <div class="form-floating mb-3">
                            
                            <input id="SRO" type="SRO" class="form-control @error('SRO') is-invalid @enderror" name="SRO" value="{{ old('SRO') }}" required placeholder="name@example.com" autofocus>
                            <label for="SRO">{{ __('Senior Responsible Officer') }}</label>

                            @error('SRO')
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
    </div>
</div>
@endsection