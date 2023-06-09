@extends('layouts.app')

@section('content')

    <div class="container mt-3">
        <h1 class="card-title text-center mb-3">Bienvenue sur Digitalk</h1>

        <main class="container mb-5">
            <h2 class="text-center">Ajouter un message</h2>
            <div class="row">

                <form class="col-4 mx-auto" action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="content">Votre message</label>
                        <input required type="text" class="form-control" placeholder="Saisir votre message"
                            name="content" id="content">
                    </div>

                    <div class="form-group mt-3">
                        <label for="tags">Tags</label>
                        <input required type="text" class="form-control" placeholder="#salut" name="tags"
                            id="content">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
                </form>
            </div>
        </main>

        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="card mx-auto mb-3 w-50" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">{{ $post->content }}</p>
                        <p class="card-text">{{ $post->tags }}</p>

                        <a href="{{ route('posts.edit', $post) }}">
                            <button class="btn btn-info">modifier</button>
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">Supprimer</button>
                        </form>

                        <a href="#" class="btn btn-primary">Commenter</a>
                    </div>
                </div>
            @endforeach
        @else
            <span>Aucun message en base de données</span>
        @endif


        <div class="row w-25 mx-auto">
            {{ $posts->links() }}
        </div>

    </div>

@endsection
