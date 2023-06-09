<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'tags',
        'user_id',
        'image',
    ];

    // je charge automatiquement l'utilisateur à chaque fois que je récupère un message
    protected $with = ['user', 'comments'];

    // nom de la fonction au singulier car un seul user en relation
    // cardinalités 1,1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // nom au pluriel car un message peut regrouper plusieurs commentaires
    // cardinalité 0,n
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
