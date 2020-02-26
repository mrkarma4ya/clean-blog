@extends('layout')
@section('content')


<!-- Page Header -->
<header class="masthead" style="background-image: url('https://source.unsplash.com/daily')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Clean Blog</h1>
          <span class="subheading">A Laravel Powered Blog</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">

      @foreach ($posts as $post)
      
      <div class="row">
        <div class="col-md-3">
          <img src="/storage/{{$post->cover_image}}" alt="" style="width: 100%; margin-top: 30px">
        </div>
        <div class="col-md-9">
          <div class="post-preview">
            <a href="{{route('post-show',["post"=>!empty($post->slug->slug) ? $post->slug->slug:'no-slug']) }}">
              <h2 class="post-title">
                {{$post->title}}
              </h2>
              <h3 class="post-subtitle">
                {{$post->excerpt}}
              </h3>
            </a>
            <div class="post-meta">Posted by
              <a href="{{route('users-show',['user'=>$post->user()->first()->username])}}">{{$post->user->name}}</a>
              on {{ \Carbon\Carbon::parse($post->created_at)->format('M j, Y')}}</div>
            @foreach ($post->categories as $category)
            <span class="badge badge-secondary">{{$category->title}}</span>
            @endforeach
          </div>
        </div>
      </div>
      <hr>
      @endforeach




      <!-- Pager -->
      <div class="clearfix">
        <a class="btn btn-primary float-right" href="/posts">Older Posts &rarr;</a>
      </div>
    </div>
    <div class="col-lg-3 col-md-2 mx-auto">

      @include('sidebar')

    </div>
  </div>
</div>

<hr>

@endsection