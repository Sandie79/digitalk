@extends('layouts.app')

@section('content')

    <div class="container-fluid text-center">
        <h1 class="title text-white text-center">Bienvenue sur Digitalk</h1>

            <img src="images\logo_digitalk.png" alt="logo_digitalk" class="w-25">


        <div class="row justify-content-center mt-5 my-auto w-50 mx-auto">

            <div class="col-md-6 text-center">
                <a class="nav-link" href="{{ route('login') }}"><button type="submit"
                        class="btn_index btn btn-primary">Connexion</button></a>
            </div>

            <div class="col-md-6 text-center">
                <a class="nav-link" href="{{ route('register') }}"><button type="submit"
                        class="btn_index btn btn-primary">Inscription</button></a>
            </div>
        
        </div>
    
    </div>

@endsection
