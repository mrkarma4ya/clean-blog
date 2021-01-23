@extends('layout')

@section('content')
<header class="masthead" style="background-image: url('https://images.unsplash.com/photo-1586769852836-bc069f19e1b6?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjF9')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Search</h1>
            <span class="subheading"></span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
  
        @forelse ($posts as $post)
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

        @empty

        <h2>
            No Posts to Show
        </h2>

        @endforelse
  
       
  
  
        <hr>
        <!-- Pager -->
        <div class="clearfix float-right">
          {{$posts->links()}}
        </div>
  
      </div>
      <div class="col-lg-3 col-md-2 mx-auto">
  
        @include('sidebar')
  
      </div>
    </div>
  </div>
  
  <hr>
@endsection