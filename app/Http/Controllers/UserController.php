<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
      /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user -> load('posts');        // je charge les posts du user
        return view('user.show', ['user' => $user]); // je renvoie les vues à l'internaute
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user/edit', ['user' => $user]);
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => 'required|max:40',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //on modifie les infos de l'utilisateur
        $user->pseudo = $request->input('pseudo');
        $user->image = isset($request['image']) ? uploadImage($request['image']) : null;

        //on sauvegarde les changements en bdd
        $user->save();

        //on redirige sur la page précédente
        return back()->with('message', 'Le compte a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //on vérifie que c'est bien l'utilisateur connecté qui fait la demande de suppression
        //(les id doivent être identiques)
        if (Auth::user()->id == $user->id) {
            $user->delete();
            return redirect()->route('index')->with('message', 'Le compte a bien été supprimé');
        } else {
            return redirect()->back()->withErrors(['erreur' => 'suppression du compte impossible']);
        }
    }
}
