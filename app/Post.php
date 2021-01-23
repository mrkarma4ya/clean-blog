<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable = ['title', 'excerpt', 'body', 'status', 'cover_image', 'user_id','slug_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function slug()
    {
        return $this->morphOne('App\Slug','sluggable');
    }

    public function getAllPosts($paginate)
    {
        return $this->orderBy('created_at', 'desc')->where('status', '1')->paginate($paginate);
    }

    public function findPostById($id)
    {
        return $this->findOrFail($id);
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }

    public function setBestReply($comment_id){
        $this->best_comment_id = $comment_id;
        $this->save();
    }

    
}
