<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['title','description','slug','cover_image'];

    public function posts(){
        return $this->belongstoMany('App\Post');
    }

    public function slug(){
        return $this->morphOne('App\Slug','sluggable');
    }

    public function getAllCategories(){
        return $this->orderBy('title', 'asc')->paginate(10);
    }

    public function findCategoryById($id){
        return $this->findOrFail($id);
    }
}
