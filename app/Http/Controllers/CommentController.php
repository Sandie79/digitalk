<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'tags' => ['required', 'string', 'max:40'],
        ]);
    
        Comment::create([
            'user_id'=> Auth::user()->id,
            'post_id'=> $request->post_id,
            'content'=> $request->content,
            'tags' => $request->tags,
        ]);
    
        return redirect()->route('home')->with('message', 'Votre commentaire a été ajouté avec succès !');
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
    public function edit(Comment $comment)
    {
        {
            return view('comments/edit', ['comment' => $comment]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'tags' => ['required', 'string', 'max:40'],
        ]);

        $comment->update([
            'content'=> $request->content,
            'tags' => $request->tags,
        ]);

        return redirect()->route('home')->with('commentaire', 'Le commentaire a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $comment->delete();
        return redirect()->route('home')->with('commentaire', 'Le commentaire a bien été supprimé');
    }
}

