<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    
    public function index(){

        $posts = Post::orderBy('created_at', 'desc')->where('status','1')->take(5)->get();
        return view('index')->with('posts', $posts);
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }
}
