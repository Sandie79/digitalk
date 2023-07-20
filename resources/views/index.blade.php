@extends('layouts.app')

@section('title')
Digitalk - Accueil
@endsection

@section('content')

    <div class="container-fluid text-center">
        <h1 class="title text-white text-center">Bienvenue sur Digitalk</h1>

            <img src="images\logo_digitalk.png" alt="logo_digitalk" class="mt-5 w-25">

        <div class="row justify-content-center mt-5 my-auto w-50 mx-auto">

            <!-- BOUTON CONNEXION-->
            <div class="col-md-6 text-center">
                <a class="nav-link" href="{{ route('login') }}"><button type="submit"
                        class="btn_index btn btn-primary">Connexion</button></a>
            </div>

            <!-- BOUTON INSCRIPTION -->
            <div class="col-md-6 text-center">
                <a class="nav-link" href="{{ route('register') }}"><button type="submit"
                        class="btn_index btn btn-primary">Inscription</button></a>
            </div>
        
        </div>
    
    </div>

@endsection
