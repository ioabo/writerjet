@extends('layouts.main_login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <img src="{{ asset('images/NationalEmblem6.png') }}" alt="" class="mx-auto d-block mt-5">
                <div class="mt-2">
                    <span class="text-light text-center">
                        <h3>Correspondence <b><i>WriterJet</i></b></h3>
                    </span>
                    <br>
                    <span class="text-light text-center">
                        <p>You have been registered, please liaise with System Administrator for
                            verification and activation of your account.
                        </p>
                    </span>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-light">Back to Login</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
