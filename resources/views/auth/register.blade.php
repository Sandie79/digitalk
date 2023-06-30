@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="title text-white text-center">Inscription</h1>
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- PSEUDO -->
                        <div class="row mb-3">
                            <label for="pseudo" class="text-white fs-5 col-md-4 col-form-label text-md-end">Pseudo</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('pseudo') is-invalid @enderror" name="pseudo" value="{{ old('pseudo') }}" required autocomplete="pseudo" autofocus>

                                @error('pseudo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- IMAGE -->
                        <div class="row mb-3">
                            <label for="image" class="text-white fs-5 col-md-4 col-form-label text-md-end">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="row mb-3">
                            <label for="email" class="text-white fs-5 col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- MOT DE PASSE -->
                        <div class="row mb-3">
                            <label for="password" class="text-white fs-5 col-md-4 col-form-label text-md-end">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- CONFIRMATION DU MOT DE PASSE -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="text-white fs-5 col-md-4 col-form-label text-md-end">Confirmez le mot de passe</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- BOUTON VALIDATION DE L'INSCRIPTION -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Valider
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
