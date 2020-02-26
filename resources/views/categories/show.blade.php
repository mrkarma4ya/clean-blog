@extends('layout')
@section('content')

<!-- Page Header -->
<header class="masthead" style="background-image: url('/storage/{{$category->cover_image}}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>{{$category->title}}</h1>
                    <h2 class="subheading">{!!$category->description!!}</h2>
                    <span class="meta"><a href="{{route('index')}}">Home</a> / <a
                            href="{{route('categories-index')}}">Categories</a> / {{$category->title}}</span>
                </div>
            </div>
        </div>
    </div>
</header>

<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-10">
                <article>
                    <div class="container">
                        <div class="row">

                            @foreach ($category->posts as $post)
                            <div class="col-lg-6 col-md-6 p-3 mt-3">
                                <img src="/storage/{{$post->cover_image}}" alt="" width="100%" height="250px"
                                    style="object-fit:cover">
                                <div class="post-preview pt-3">
                                <a href="{{route('post-show',["post"=>!empty($post->slug->slug) ? $post->slug->slug:'no-slug'])}}">
                                        <h4 class="post-title">
                                            {{$post->title}}
                                        </h4>
                                        <h5 class="post-subtitle">
                                            {{$post->excerpt}}
                                        </h5>
                                    </a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-3 col-md-2">
                <p>
                    @include('sidebar')
                </p>
            </div>
        </div>
    </div>
</article>


<hr>
@endsection