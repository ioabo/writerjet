@extends('layouts.main_login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <img src="{{ asset('images/NationalEmblem6.png') }}" alt="" class="mx-auto d-block mt-5">
                <div class="mt-2">
                    <span class="text-light text-center">
                        <h3>Correspondence <b><i>WriterJet</i></b></h3>
                    </span>
                </div>
                <div class="card shadow-lg border-0 rounded-lg mt-4 mb-5">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="form-floating mb-3">

                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required placeholder="name@example.com"
                                    autofocus>
                                <label for="email">{{ __('Name') }}</label>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">

                                <input id="type" type="jobTitle" class="form-control @error('type') is-invalid @enderror"
                                    name="type" value="{{ old('type') }}" required placeholder="jobTitle@example.com"
                                    autofocus>
                                <label for="email">{{ __('Job Title') }}</label>

                                <input id="registration_status" type="registration_status" class="form-control @error('registration_status') is-invalid @enderror"
                                    name="registration_status" value="Pending" hidden>

                                @error('jobTitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-floating mb-3">

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required placeholder="name@example.com"
                                    autofocus>
                                <label for="email">{{ __('E-Mail Address') }}</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    placeholder="Password">
                                <label for="password">Password</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">

                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                <label for="password-confirm">Password</label>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('login') }}" class="btn btn-primary">
                                        {{ __('Back to Login') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
