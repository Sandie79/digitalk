@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="card-title text-center mb-3">Bienvenue sur le profil de</h1>

        <p class="card-text text-center fs-5">{{ $user->pseudo }}</p>

        <div class="text-center">
            <img class="w-25 mb-3" src="{{ asset('images/' . $user->image) }} " alt="image du profil">
        </div>
        

        <div class="card mx-auto mb-3 w-50" style="width: 18rem;">
            <h3>Messages : </h3>
            @foreach ($user->posts as $post)
                <p>{{ $post->content }}</p>
                <p>{{ $post->tags }}</p>
            @endforeach
        </div>

    </div>
@endsection
