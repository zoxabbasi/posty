<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function likedBy(User $user){
        // It will accept a user object
        return $this->likes->contains('user_id', $user->id);
        // we can access the likes relatioship internally, likes is a collection and use contains()
        // Contains() is a collection method, which will allow us to look inside of that collection of
        // objects at a particular key user_id and check if the $user_id is with in the likes of particular model

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}
