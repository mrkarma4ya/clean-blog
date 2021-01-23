<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'body'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function children(){
        return $this->hasMany('App\Comment', 'parent_id');
    }

    public function parent(){
        return $this->belongsTo('App\Comment', 'parent_id');
    }

    public function isAuthor(){
        return $this->user->id === $this->post->user->id;
    }

    public function isBestComment(){
        return $this->id === $this->post->best_comment_id ;
    }
}


