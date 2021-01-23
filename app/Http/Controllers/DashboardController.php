<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_name = Auth::user()->name;
        $post_count = Auth::user()->posts->count();
        $category_count = Category::count();
        $user_count = User::count();
        //$recent_posts = Post::orderBy('created_at','desc')->take(4)->get();
        $recent_posts = Auth::user()->posts->sortByDesc('created_at')->take(4)->all();
        $recent_categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        //$last_post_on = Post::orderBy('created_at','desc')->first();
        $last_post_on = null;
        if (Auth::user()->posts->count() > 0) {
            $last_post_on = Auth::user()->posts->sortByDesc('created_at')->first();
        }
        $most_popular_category = Category::withCount('posts')->orderBy('posts_count', 'desc')->first();
        // $all_categories = Category::orderBy('created_at','desc')->get();
        // $category_posts_count = $all_categories->posts->count()

        $data = array(
            'user_name' => $user_name,
            'post_count' => $post_count,
            'category_count' => $category_count,
            'user_count' => $user_count,
            'recent_posts' => $recent_posts,
            'recent_categories' => $recent_categories,
            'last_post_on' => $last_post_on,
            'most_popular_category' => $most_popular_category
        );

        return view('admin.index')
            ->with($data);
    }

    public function post()
    {
        $posts = Auth::user()->posts;
        return view('admin.posts.index')
            ->with('posts', $posts);
    }

    public function comment()
    {
        $comments = Auth::user()->comments;
        
        // $posts = Post::with('comments')->where('user_id',"=",Auth::user()->id)->get();

        // foreach ($posts as $post) {
        //     $post_comment = ($post->comments);
            
        // }

        $comment_others = Comment::whereHas('post', function($q) {
            return $q->where('user_id', auth()->id());
        })->get();
        
        return view('admin.comments.index')
            ->with('comments', $comments)
            ->with('comment_others', $comment_others);
    }

    public function category()
    {
        $categories = Category::orderBy('title', 'asc')->get();
        return view('admin.categories.index')
            ->with('categories', $categories);
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index')
            ->with('users', $users);
    }
}
