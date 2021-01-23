@extends('layout')
@section('content')

<!-- Page Header -->
<header class="masthead" style="background-image: url('/storage/{{$user->cover_image}}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="row post-heading">
                    <div class="col-md-2 mt-2"><img src="/storage/{{$user->avatar}}" alt="" width="100%" class="avatar"></div>
                    <div class="col-md-10">
                        <h1>{{$user->name}}</h1>
                        <h2 class="subheading">&commat;{{$user->username}}</h2>
                        <span class="meta"> {{$user->quote}}</span>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
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

            No Posts Yet!

            @endforelse

            <div class="jumbotron">
                {{$user->about}}
            </div>

            <hr>
            <!-- Pager -->
            <div class="clearfix float-right">
                {{$posts->links()}}
            </div>

        </div>

        <div class="col-lg-3 col-md-2">

            @include('sidebar')

        </div>
    </div>
</div>


<hr>
@endsection