@extends('layouts.app')

@section('content')
    <div class="container pt-3">
        <h1 class="title text-white text-center">Bienvenue sur Digitalk</h1>

        <main class="container mb-5">

            <!-- AJOUTER UN MESSAGE -->
            <h2 class="text-center text-white">Ajouter un message</h2>
            <div class="row">

                <form class="col-4 mx-auto" action="{{ route('posts.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <!-- AJOUTER UN MESSAGE -->
                    <div class="form-group mt-3">
                        <label class="text-white fs-5" for="content">Votre message</label>
                        <input required type="text" class="form-control" placeholder="Saisir votre message"
                            name="content" id="content">
                    </div>

                    <!-- AJOUTER TAGS -->
                    <div class="form-group mt-3">
                        <label class="text-white fs-5" for="tags">Tags</label>
                        <input required type="text" class="form-control" placeholder="#salut" name="tags"
                            id="content">
                    </div>

                    <!-- AJOUTER UNE IMAGE -->
                    <div class="row mb-3 mt-5">
                        <label for="image" class="text-white fs-5 col-md-4 col-form-label text-md-end">Image</label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                name="image" value="{{ old('image') }}" autofocus>

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- BOUTON AJOUT DU MESSAGE -->
                    <button type="submit" class="btn btn-success mt-3">Ajouter</button>

                </form>

            </div>

        </main>

        <!-- MESSAGES POSTES -->
        <div class="container mt-5">
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="card mx-auto mb-3 w-50" style="width: 18rem;">
                        <div class="card-body">

                            <!-- IMAGE DU POST -->
                            <div class="col">
                                @if ($post->user->image)
                                    <img src="{{ asset('images/' . $post->user->image) }} " class="rounded-circle"
                                        style="width: 5vw; height:5vw" alt="imageUtilisateur">
                                @else
                                    <img src="{{ asset('images/user.jpg') }} " class="m-1 rounded-circle"
                                        style="width: 5vw; height:5vw" alt="imageUtilisateur">
                                @endif
                            </div>

                            <a href="{{ route('users.show', $post->user) }}">{{ $post->user->pseudo }}</a>

                            <h3 class="mt-4">Messages : </h3>

                            <!-- CONTENU MESSAGE -->
                            <p class="card-text text-center">{{ $post->content }}</p>

                            <!-- TAGS MESSAGE -->
                            <p class="card-text text-center">{{ $post->tags }}</p>

                            <!-- IMAGE MESSAGE -->
                            <div class="text-center m-4">
                                @if ($post->image)
                                    <img src="{{ asset("images/$post->image") }}" style="width: auto; height:10vw"
                                        alt="imageUtilisateur">
                                @endif
                            </div>

                            <!-- BOUTON MODIFICATION MESSAGE -->
                            <div class="row mb-5 text-center">
                                <div class="col-md-6">
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}">
                                            <button class="btn btn-warning">Modifier</button>
                                        </a>
                                    @endcan
                                </div>

                                <!-- BOUTON SUPPRESSION MESSAGE -->
                                <div class="col-md-6">
                                    @can('delete', $post)
                                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>

                            <!-- COMMENTAIRES POSTES -->
                            <div class="card mx-auto mb-3 w-50" style="width: 18rem;">
                                <h3>Commentaires : </h3>
                                @foreach ($post->comments as $comment)
                                    <a href=''>{{ $comment->user->pseudo }} : </a>

                                    <!-- CONTENU COMMENTAIRE -->
                                    <p>{{ $comment->content }}</p>
                                    
                                    <!-- TAGS COMMENTAIRE -->
                                    <p>{{ $comment->tags }}</p>

                                    <!-- IMAGE COMMENTAIRE -->
                                    <div class="container-fluid text-center p-3">
                                        <div class="col">
                                            @if ($comment->image)
                                                <img src="{{ asset("images/$comment->image") }} "
                                                    style="width: auto; height:10vw" alt="imageUtilisateur">
                                            @else
                                                <img src="{{ asset('images/user.jpg') }} " style="width: auto; height:10vw"
                                                    alt="imageUtilisateur">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mb-5 text-center">

                                        <!-- BOUTON MODIFICATION COMMENTAIRE -->
                                        @can('update', $comment)
                                            <a href="{{ route('comments.edit', $comment) }}">
                                                <button class="btn btn-warning">Modifier</button>
                                            </a>
                                        @endcan

                                        <!-- BOUTON SUPPRESSION COMMENTAIRE -->
                                        @can('delete', $comment)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        @endcan

                                    </div>
                                @endforeach
                            </div>

                            <form class="col mx-auto" action="{{ route('comments.store') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <input type="hidden" value="{{ $post->id }}" name="post_id">
                                
                                <!-- CONTENU COMMENTAIRE -->
                                <div class="form-group">
                                    <label for="content">Votre commentaire</label>
                                    <input required type="text" class="form-control"
                                        placeholder="Saisir votre commentaire" name="content" id="content">
                                </div>

                                <!-- TAGS COMMENTAIRE -->
                                <div class="form-group mt-3">
                                    <label for="tags">Tags</label>
                                    <input required type="text" class="form-control" placeholder="#tags"
                                        name="tags" id="content">
                                </div>

                                <!-- IMAGE COMMENTAIRE -->
                                <div class="row mb-3 mt-5">
                                    <label for="image"
                                        class="text-white fs-5 col-md-4 col-form-label text-md-end">Image</label>

                                    <div class="col-md-6">
                                        <input id="image" type="file"
                                            class="form-control @error('image') is-invalid @enderror" name="image"
                                            value="{{ old('image') }}" required autocomplete="image" autofocus>

                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- BOUTON AJOUTER UN COMMENTAIRE -->
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
    </div>
@endsection
