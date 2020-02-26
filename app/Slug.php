<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    //
    public $timestamps = false;

    public function sluggable()
    {
        return $this->morphTo();
    }

    public function findPostBySlug($slug)
    {
        $slug = $this->where('slug',$slug)->firstOrFail();
        $post = $slug->sluggable;
        return $post;
    }
}
