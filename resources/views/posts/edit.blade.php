@extends ('layouts.app')

@section('title')
    Digitalk - Modification message
@endsection

@section('content')
    <main class="container">

        <h1 class="title text-white text-center">Mon message</h1>

        <h3 class="pb-3 text-center text-white">Modifier mon message</h3>
        <div class="row">

            <form class="col-4 mx-auto" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                <!-- MODIFICATION MESSAGE -->
                <div class="form-group">
                    <label for="content" class="text-white fs-5">Nouveau message</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="content"
                        value="{{ $post->content }}" id="content">
                </div>

                <!-- MODIFICATION TAGS -->
                <div class="form-group mt-3">
                    <label for="tags" class="text-white fs-5">Nouveaux tags</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="tags"
                        value="{{ $post->tags }}" id="tags">
                </div>

                <!-- MODIFICATION IMAGE -->
                <div class="row mb-3 mt-5">
                    <label for="image" class="text-white fs-5 col-md-4 col-form-label text-md-end">Image</label>

                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                            name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- BOUTON VALIDATION DES MODIFICATIONS -->
                <button type="submit" class="btn btn-primary mt-3">Valider les modifications</button>


            </form>

        </div>

    </main>
@endsection
