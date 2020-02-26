<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $category;


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]); //Make all functions pass through auth middleware, except those mentioned
        $this->category = new Category;
    }

    public function index()
    {
        return view('categories.index')->with('categories', $this->category->getAllCategories());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $request->validated();

        $this->category->create([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $this->handleImageUpload($request->file('cover_image'),'categories')
        ]);

        return back()
            ->with('success', 'Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('categories.show', ["category" => $this->category->findCategoryById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('admin.categories.edit', ["category" => $this->category->findCategoryById($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, $id)
    {
        $request->validated(); //Validate the Request

        
        if ($request->hasFile('cover_image')) {
            $cover_image = $this->handleImageUpload($request->file('cover_image'), 'categories');
        } else {
            $cover_image = $this->category->findCategoryById($id)->cover_image;
        }

        $this->category->findCategoryById($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $cover_image
        ]);

        return back()
            ->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category->findCategoryById($id)->delete();
        return back()
            ->with('success', 'Category Deleted');
    }
}
