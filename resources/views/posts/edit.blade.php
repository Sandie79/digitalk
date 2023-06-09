@extends ('layouts.app')

@section('title')
    Modification message
@endsection

@section('content')
    <main class="container">

        <h1>Mon message</h1>

        <h3 class="pb-3 text-center">Modifier mon message</h3>
        <div class="row">

            <form class="col-4 mx-auto" action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="content">Nouveau message</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="content"
                        value="{{ $post->content }}" id="content">
                </div>

                <div class="form-group mt-3">
                    <label for="tags">Nouveaux tags</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="tags"
                        value="{{ $post->tags }}" id="tags">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Valider les modifications</button>


            </form>

        </div>

    </main>
@endsection
