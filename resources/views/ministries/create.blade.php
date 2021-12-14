@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="mt-4">Add New Organisation</h4>
        <div class="breadcrumb mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-2">
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('ministries.index') }}">Organisations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Entry</li>
                </ol>
            </nav>
        </div>
        <div class="card border-1 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="row">
                        <div class="col">{{ __('Create Ministry') }}</div>
                        <div class="col"><a href="{{ route('ministries.index') }}"
                                class="offset-md-11">{{ __('Back') }}</a></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('ministries.store') }}">
                    @csrf

                    <div class="form-floating mb-3">

                        <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code"
                            value="{{ old('code') }}" required placeholder="name@example.com" autofocus>
                        <label for="code">{{ __('Code') }}</label>

                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">

                        <input id="description" type="description"
                            class="form-control @error('description') is-invalid @enderror" name="description"
                            value="{{ old('description') }}" required placeholder="name@example.com" autofocus>
                        <label for="description">{{ __('Full name description') }}</label>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">

                        <input id="address" type="address" class="form-control @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address') }}" required placeholder="name@example.com"
                            autofocus>
                        <label for="address">{{ __('Address') }}</label>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-floating mb-3">

                        <input id="p_o_box" type="p_o_box" class="form-control @error('p_o_box') is-invalid @enderror"
                            name="p_o_box" value="{{ old('p_o_box') }}" required placeholder="name@example.com"
                            autofocus>
                        <label for="p_o_box">{{ __('P.O. Box') }}</label>

                        @error('p_o_box')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">

                        <input id="phone" type="phone"
                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" required placeholder="name@example.com" autofocus>
                        <label for="phone">{{ __('Main phone contact') }}</label>

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">

                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required placeholder="name@example.com" autofocus>
                        <label for="email">{{ __('Enquiry email address') }}</label>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">

                        <input id="website" type="website"
                            class="form-control @error('website') is-invalid @enderror" name="website"
                            value="{{ old('website') }}" required placeholder="name@example.com" autofocus>
                        <label for="website">{{ __('Website') }}</label>

                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">

                        <input id="SRO" type="SRO" class="form-control @error('SRO') is-invalid @enderror" name="SRO"
                            value="{{ old('SRO') }}" required placeholder="name@example.com" autofocus>
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
@endsection
