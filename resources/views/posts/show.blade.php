@extends('layout')
@section('content')

<!-- Page Header -->
<header class="masthead" style="background-image: url('/storage/{{$post->cover_image}}')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-heading">
          <h1>{{$post->title}}</h1>
          <h2 class="subheading">{{$post->excerpt}}</h2>
          <span class="meta">Posted by
            <a href="{{route('users-show',['user'=>$post->user()->first()->username])}}">{{$post->user->name}}</a>
            on {{ \Carbon\Carbon::parse($post->created_at)->format('M j, Y')}}</span>
        </div>
      </div>
    </div>
  </div>
</header>


<div class="container">
  <div class="row">
    <div class="col-lg-9 col-md-10">
      <article>
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
              {{-- {!!str_replace('["<script>","</script>"]', '["",""]', $post->body)!!} --}}
                {!! htmlPurify($post->body) !!}
              </div>
          </div>
        </div>
      </article>
    </div>
    <div class="col-lg-3 col-md-2">
      
        @include('sidebar')
       
    </div>
  </div>
</div>


<hr>
@endsection