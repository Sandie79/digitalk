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
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
        'content' => ['required', 'string', 'max:1000'],
        'tags' => ['required', 'string', 'max:40'],
    ]);

    Post::create([
        'user_id'=> Auth::user()->id,
        'content'=> $request->content,
        'tags' => $request->tags,
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
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'tags' => ['required', 'string', 'max:40'],
        ]);

        $post->update([
            'content'=> $request->content,
            'tags' => $request->tags,
        ]);

        return redirect()->route('home')->with('message', 'Le message a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->route('home')->with('message', 'Le message a bien été supprimé');
    }
}
