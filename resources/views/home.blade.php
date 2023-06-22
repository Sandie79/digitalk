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

                    <button type="submit" class="btn btn-success mt-3">Ajouter</button>
                </form>
            </div>
        </main>

        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="card mx-auto mb-3 w-50" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">{{ $post->content }}</p>
                        <p class="card-text">{{ $post->tags }}</p>

                        <p class="card-text">Pseudo : <a
                                href="{{ route('users.show', $post->user) }}">{{ $post->user->pseudo }}</a></p>

                        <div class="row mb-5 text-center">
                            <div class="col-md-6">
                                <a href="{{ route('posts.edit', $post) }}">
                                    <button class="btn btn-warning">Modifier</button>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <form action="{{ route('posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>

                        <div class="card mx-auto mb-3 w-50" style="width: 18rem;">
                            <h3>Commentaires : </h3>
                            @foreach ($post->comments as $comment)
                                <p><a href=''>{{ $comment->user->pseudo }} : </a></p>
                                <p>{{ $comment->content }}</p>
                                <p>{{ $comment->tags }}</p>

                                <div class="row mb-5 text-center">
                                    <div class="col">
                                        <a href="{{ route('comments.edit', $comment) }}">
                                            <button class="btn btn-warning">Modifier</button>
                                        </a>
                                    </div>

                                    <div class="col">
                                        <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                            @endforeach
                        </div>

                        <form class="col-4 mx-auto" action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $post->id }}" name="post_id">
                            <div class="form-group">
                                <label for="content">Votre commentaire</label>
                                <input required type="text" class="form-control" placeholder="Saisir votre commentaire"
                                    name="content" id="content">
                            </div>

                            <div class="form-group mt-3">
                                <label for="tags">Tags</label>
                                <input required type="text" class="form-control" placeholder="#tags" name="tags"
                                    id="content">
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Ajouter</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <span>Aucun message ne correspond à votre recherche</span>
        @endif


        <div class="row w-25 mx-auto">
            {{ $posts->links() }}
        </div>

    </div>

@endsection
