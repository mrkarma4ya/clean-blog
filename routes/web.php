<?php

//---------------------------------Front-End Routes-----------------------------------------------------------------------

//Auth Routes--------------------
Auth::routes();

//Page Routes--------------------
Route::get('/', 'PagesController@index')->name('index');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/admin/filemanager', 'PagesController@filemanager')->name('fmanager');

//Post Routes--------------------
Route::resource('/posts', 'PostController')
    ->only([
        'index', 'show'
    ])
    ->names([
        'index' => 'posts-index',
        'show' => 'post-show'
    ]);;

//Category Routes------------
Route::resource('/categories', 'CategoryController')
    ->only([
        'index', 'show'
    ])
    ->names([
        'index' => 'categories-index',
        'show' => 'category-show'
    ]);;

//User Routes------------------
Route::resource('/users', 'UserController')
    ->only([
        'show'
    ])
    ->names([
        'show' => 'users-show'
    ]);

//Comment Routes-----------------
Route::post('/storecomment', 'CommentController@store')->name('store-comment');
Route::post('/comments/best-comment/{comment}', 'BestCommentController@store')->name('best-comment');
Route::delete('/comments/delete/{comment}','CommentController@destroy')->name('comment-delete');
Route::post('/comments/edit/{comment}','CommentController@update')->name('comment-edit');

//Search Routes------------------
Route::get('/search','SearchController@index')->name('serarch-index');

//---------------------------------Dashoard Routes---------------------------------------------------------------------------
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//Post Routes-----------------------
Route::get('/dashboard/posts/', 'DashboardController@post')->name('dashboard-post');
Route::resource('/dashboard/posts', 'PostController')
    ->except([
        'index', 'show', 'destroy'
    ])
    ->names([
        'edit' => 'post-edit',
        'create' => 'post-create'
    ]);;
Route::delete('/dashboard/posts/{post}/destroy', 'PostController@destroy')->name('post-destroy');
Route::post('/dashboard/posts/create', 'PostController@store')->name('post-create-submit');
Route::post('/dashboard/posts/{post}/edit', 'PostController@update')->name('post-edit-submit');
Route::get('/dashboard/posts/{post}/togglestatus', 'PostController@togglestatus')->name('post-toggle-status');

//Category Routes--------------------
Route::get('/dashboard/categories', 'DashboardController@category')->name('dashboard-categories');
Route::resource('/dashboard/categories', 'CategoryController')
    ->except([
        'index', 'show', 'destroy'
    ])
    ->names([
        'edit' => 'category-edit',
        'create' => 'category-create'
    ]);;
Route::post('/dashboard/categories/create', 'CategoryController@store')->name('category-create-submit');
Route::delete('/dashboard/categories/{category}/destroy', 'CategoryController@destroy')->name('category-destroy');
Route::post('/dashboard/categories/{category}/edit', 'CategoryController@update')->name('category-edit-submit');



//Comment Routes------------------------
Route::get('/dashboard/comments/', 'DashboardController@comment')->name('dashboard-comments');


//User Routes---------------------------
Route::get('/dashboard/users', 'DashboardController@users')->name('dashboard-users');
Route::resource('/dashboard/users', 'UserController')
    ->only([
        'edit'
    ])
    ->names([
        'edit' => 'user-edit',
    ]);;
Route::post('/dashboard/users/{user}/edit', 'UserController@update')->name('user-edit-submit');


// Route::get('/sluggify','PostController@sluggify');
