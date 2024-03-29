@extends ('layouts.app')

@section('title')
    Digitalk - Profil de {{ $user->pseudo }}
@endsection

@section('content')
    <div class="container mb-3">
        
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                    <div class="col pt-3"><h1 class="title text-white text-center">Bienvenue sur le profil de</h1>
                           <h2 class="text-center text-white" id="pseudo"> {{ $user->pseudo }} </h2>
                    </div>

                    <!-- IMAGE USER -->
                    <div class="container-fluid text-center p-3">
                        <div class="col">
                            @if ($user->image)
                                <img src="{{ asset("images/$user->image") }} " class="m-1 rounded-circle"
                                    style="width: 20vw; height:20vw" alt="imageUtilisateur">
                            @else
                                <img src="{{ asset('images/user.jpg') }} " class="m-1 rounded-circle"
                                    style="width: 20vw; height:20vw" alt="imageUtilisateur">
                            @endif
                        </div>

                    <div class="container w-50">
                        <div class="row justify-content-between m-4">

                            <!-- DATE ET HEURE INSCRIPTION USER -->
                            <div class="col-6 text-white">
                                inscrit(e) le {{ date('d-m-Y à H:i:s', strtotime($user->created_at)) }}
                            </div>

                            <!-- NOMBRE DE POSTS DU USER -->
                            <div class="col-6 text-white">
                                {{ count($user->posts) }} post(s) posté(s)
                            </div>

                        </div>
                    </div>

                    <!-- ***********************************AFFICHER LES postS*****************************-->
                    @foreach ($user->posts as $post)
                        <div class="card mb-4 mt-3 pb-2">
                            <div class="card-header bg-primary">
                                <div class="row">
                                    <div class="col">
                                        @if ($user->image)
                                            <img class="m-1 rounded-circle" style="width: 5vw; height:5vw"
                                                src="{{ asset("images/$user->image") }}" alt="imageUtilisateur">
                                        @else
                                            <img class="m-1 rounded-circle" style="width: 5vw; height:5vw"
                                                src="{{ asset('images/default_user.jpg') }}" alt="imageUtilisateur">
                                        @endif

                                        <h5><a href="{{ route('users.show', $post->user_id) }}">
                                                <strong class="text-white">{{ $user->pseudo }}</strong>
                                            </a>
                                        </h5>

                                    </div>
                                    <div class="col m-auto">
                                        <h4>#{{ $post->tags }} </h4>
                                    </div>
                                    <div class="col m-auto">
                                        <div class="row">posté {{ $post->created_at->diffForHumans() }}</div>
                                        @if ($post->created_at != $post->updated_at)
                                            <div class="row">modifié {{ $post->updated_at->diffForHumans() }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($post->image !== null)
                                <div class="card-img p-3">
                                    <img class="m-1" style="width: 45vw" src="{{ asset("images/$post->image") }}"
                                        alt="imagepost">
                                </div>
                            @endif
                            <div class="card-body ml-5 mr-5">
                                <p>{{ $post->content }}</p>


                                <!--  ******************************OPTIONS : MASQUER, COMMENTER, MODIFIER, SUPPRIMER******************   -->
                                <div class="row mt-2">
                                    <div class="col"><a class="btn btn-info"
                                            onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'block'">Commenter
                                        </a>
                                    </div>

                                    <!-- si l'utilisateur connecté a posté le post, il peut le modifier et le supprimer-->
                                    @if ($post->user_id == Auth::user()->id)
                                        <div class="col">
                                            <a href="{{ route('posts.edit', $post) }}">
                                                <button class="btn btn-secondary">Modifier</button>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- **********************************************AJOUTER UN COMMENTAIRE**********************************************-->
                        <form style="display:none;" id="formulairecommentaire{{ $post->id }}"
                            class="col-12 mx-auto mb-2" action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="content">Tapez votre message</label>
                                <textarea required class="container-fluid" type="text" name="content" id="content"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4 form-group">
                                    <label for="nom">image (facultatif)</label>
                                    <input type="text" class="form-control" name="image" id="image">
                                </div>
                                <input class="form-control" type="hidden" id="post_id" name="post_id"
                                    value="{{ $post->id }}">
                            </div>
                            <button class="btn btn-danger"
                                onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'none'">
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-warning">Valider</button>
                        </form>

                        <!-- ********************************************* AFFICHER LES COMMENTAIRES **********************************************-->
                        @foreach ($post->comments as $comment)
                            <div class="container w-75">
                                <div class="card mb-2">
                                    <div class="card-header text-light bg-secondary">
                                        <div class="row">
                                            <div class="col">{{ $comment->user->pseudo }}</div>
                                            <div class="col">posté le {{ $comment->created_at }}</div>
                                        </div>
                                    </div>
                                    <div class="card-body">{{ $comment->content }}
                                        @if ($post->user_id === Auth::id() || $comment->user_id === Auth::id())
                                        
                                            <!--            si l'utilisateur connecté est l'auteur du post ou du commentaire, il peut supprimer le commentaire -->
                                            <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
