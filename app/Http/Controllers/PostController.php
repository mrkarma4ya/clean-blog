<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Slug;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;

class PostController extends Controller
{
    protected $post, $category, $slug;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]); //Make all functions pass through auth middleware, except those mentioned
        $this->post = new Post;
        $this->category = new Category;
        $this->slug = new Slug;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('posts.index', ['posts' => $this->post->getAllPosts(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create', ['categories' => $this->category->getAllCategories()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        //
        $request->validated(); //Validate Requests

        //dd($this->getUniqueSlug(Str::slug($request->title, '-')));

        $newPost = $this->post->create([
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body'),
            'status' => request('status'),
            'cover_image' => $this->handleImageUpload($request->file('cover_image'), 'posts'),
            'user_id' => auth()->user()->id,
        ]); //Create New Post through Mass Assignment

        //Following must be done after creating post, because we need the ID of the new post
        $newPost->categories()->attach($this->getPostCategories($request->category)); //Attach Categories
        $this->slug->slug = $this->getUniqueSlug(Str::slug($request->title, '-')); //Get Unique Slug and add it to slug table
        $newPost->slug()->save($this->slug); //Save the slug table

        //Redirect to the edit page of the new post
        return redirect()->route('post-edit', ['post' => $newPost->id])
            ->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function show($slug)
    {
        $post = $this->slug->findPostBySlug($slug);

        if ($post->status === 1) {
            return view('posts.show', ['post' => $post]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = $this->post->findPostById($id);
        if (auth()->user()->id != $posts->user_id) {
            abort('401');
        }
        return view('admin.posts.edit', ['post' => $posts, 'categories' => $this->category->getAllCategories()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        //

        $request->validated(); //Validate Request

        //Handle image upload if request has file, else set cover_image to same as old
        if ($request->hasFile('cover_image')) {
            $cover_image = $this->handleImageUpload($request->file('cover_image'), 'posts');
        } else {
            $cover_image = $this->post->findPostById($id)->cover_image;
        }

        $updatedPost = $this->post->findPostById($id); //Instantiate current post object

        // Attach slug if there's no slug at all 
        // if (!isset($updatedPost->slug->slug)){            
        //     $this->slug->slug = $this->getUniqueSlug(Str::slug($request->title, '-')); //Get Unique Slug and add it to slug table
        //     $updatedPost->slug()->save($this->slug); //Save the slug table
        // }

        //Update slug only if title has changed
        if ($updatedPost->title != $request->title){
            $updatedPost->slug()->update(['slug'=>$this->getUniqueSlug(Str::slug($request->title, '-'))]); //Update the slug table
        }

        

        $updatedPost->update([
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body'),
            'status' => request('status'),
            'cover_image' => $cover_image,
        ]);

        $updatedPost->categories()->sync($this->getPostCategories($request->category)); //Attach Categories

        

        return back()
            ->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = $this->post->findPostById($id);


        //Check if logged in user id matches post id
        if (auth()->user()->id != $post->user_id) {
            abort(404);
        } else {
            $post->delete();
            return back()
                ->with('success', 'Post Deleted');
        }
    }

    public function toggleStatus($id)
    {
        $post = $this->post->findPostById($id);
        $post->status = !$post->status;
        $post->save();
        return back()
            ->with('success', 'Status Updated');
    }

    // public function sluggify(){
    //     $posts = $this->post->getAllPosts(0);
    //     foreach($posts as $post){
    //         $slug = Str::slug($post->title, '-');
    //         $post->slug = $slug;
    //         $post->save();
    //     }
    // }
}
