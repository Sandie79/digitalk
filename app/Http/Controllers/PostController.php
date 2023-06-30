<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(10);
        return view('admin.posts.index', ['posts' => $posts]);
    }


    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'tags' => ['required', 'string', 'max:40'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Post::create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'tags' => $request->tags,
            'image' => isset($request['image']) ? uploadImage($request['image']) : null,
        ]);

        return redirect()->route('home')->with('message', 'Votre message a été ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts/edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); // double sécurité pour vérifier que seul un admin ou l'auteur du post accède à cette page

        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'tags' => ['required', 'string', 'max:40'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post->update([
            'content' => $request->content,
            'tags' => $request->tags,
            'image' => isset($request['image']) ? uploadImage($request['image']) : null,
        ]);

        return redirect()->route('home')->with('message', 'Le message a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // double sécurité pour vérifier que seul un admin ou l'auteur du post accède à cette page

        $post->delete();
        return redirect()->route('home')->with('message', 'Le message a bien été supprimé');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string', 'max:20', 'min:3'],
        ]);

        $posts = Post::where('content', 'LIKE', '%' . $request->search . '%')
            ->orWhere('tags', 'LIKE', '%' . $request->search . '%')
            ->latest()->paginate();

        return view('home', compact('posts'));
    }
}
