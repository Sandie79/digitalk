<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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
        'post_id',
        'image',
    ];

    // je charge automatiquement l'utilisateur à chaque fois que je récupère un message
    // protected $with = ['user', 'post'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // idem
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
