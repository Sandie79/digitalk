<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('home');
        $this->middleware('guest')->only('index'); // permet de gérer les accès, je dois être authentifiée pour accéder à la home
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function home()
    {
    // Afficher les 10 derniers message par page du plus récent au plus ancien

    // Récupérer les 10 derniers messages
    //$posts = Post::orderBy('created_at', 'desc')->take(10)->get();
    $posts = Post::latest()->paginate(10);
    $posts->load('user','comments.user'); // permet d'ajouter à chaque post une propriété user

    //dd($posts);

    return view('home', ['posts' => $posts]);
    }
}

//public function home()
    {
        // syntaxe de base : on récupère tous les messages
        // $posts = Post::all();

        // syntaxe avec le + récent en 1er +
        // $posts = Post::latest()->get();

        // syntaxe avec le + récent en 1er + la pagination (5 messages par page)
        //$posts = Post::latest()->paginate(5);

        // eager loading 1
        //$posts = Post::with('comments', 'user')->latest()->paginate(10);
        
        //eager loading 2
        //$posts->load('comments', 'user');

        //return view('home', compact('posts'));
        // autre syntaxe
        //return view('home', ['posts' => $posts]);
    }
