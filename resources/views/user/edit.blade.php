@extends ('layouts.app')

@section('title')
    Digitalk - Mon compte
@endsection

@section('content')
    <main class="container">

        <h1 class="title text-white text-center">Mon compte</h1>

        <h3 class="pb-3 text-center text-white">Modifier mes informations</h3>
        <div class="row">

            <form class="col-4 mx-auto" action="{{ route('users.update', $user) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                <!-- MODIFICATION PSEUDO -->
                <div class="form-group">
                    <label for="pseudo" class="text-white fs-5">Nouveau pseudo</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="pseudo"
                        value="{{ $user->pseudo }}">
                </div>

                <!-- MODIFICATION IMAGE -->
                <div class="form-group">
                    <label for="image" class="text-white fs-5 mt-4">Nouvelle image</label>
                    <input required type="file" class="form-control" placeholder="modifier" name="image"
                        value="{{ $user->image }}" id="image">
                </div>

                <!-- BOUTON VALIDATION DES MODIFICATIONS -->
                <button type="submit" class="btn btn-primary mt-4">Valider</button>

            </form>

            <!-- BOUTON SUPPRESSION DU COMPTE -->
            <form action="{{ route('users.destroy', $user) }}" method="post" class="text-center mt-5">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Supprimer le compte</button>
            </form>

        </div>

    </main>
@endsection
