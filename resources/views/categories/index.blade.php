@extends('layout')
@section('content')
<header class="masthead" style="background-image: url('storage/img/category-bg.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Categories</h1>
          <span class="subheading"></span>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">

      @foreach ($categories as $category)
      <div class="row">
        <div class="col-md-3">
          <img src="/storage/{{$category->cover_image}}" alt="" style="width: 100%; margin-top: 30px">
        </div>
        <div class="col-md-9">
          <div class="post-preview">
            <a href="categories/{{$category->id}}">
              <h2 class="post-title">
                {{$category->title}}
              </h2>
              <h3 class="post-subtitle">
                {!!$category->description!!}
              </h3>
              
            </a>
            <span class="badge badge-secondary p-2"><i class="fa fa-newspaper"></i> {{$category->posts->count()}}</span>
          </div>
        </div>
      </div>
      <hr>
      @endforeach



      <hr>
      <!-- Pager -->
      <div class="clearfix float-right">
        {{$categories->links()}}
      </div>

    </div>
    <div class="col-lg-3 col-md-2 mx-auto">
      <p>
        @include('sidebar')
      </p>
    </div>
  </div>
</div>

<hr>

@endsection