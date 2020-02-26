@extends('admin.layout')
@section('content')
{{-- <div class="row">
  <div class="col-md-12">
    <div class="card card-stats">
      <div class="card-body">
        <h3>Welcome, {{$user_name}}</h2>
</div>
</div>
</div>
</div> --}}
<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6" onclick="window.location='{{route('dashboard-post')}}';" >
    <div class="card card-stats stat-cards">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-single-copy-04 text-warning"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Posts</p>
              <p class="card-title">{{$post_count}}
                <p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">

          @if ($last_post_on != null)
          Last Post on <span
          class="text-warning">{{ \Carbon\Carbon::parse($last_post_on->created_at)->format('M j, Y')}}</span>
          @else
          No Last Post
          @endif

          
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6" onclick="window.location='{{route('dashboard-categories')}}';">
    <div class="card card-stats stat-cards">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-layout-11 text-success"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Categories</p>
              <p class="card-title">{{$category_count}}
                <p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
        Most Popular: <a href="#" class="badge badge-success">{{$most_popular_category->category}}</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats stat-cards">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-ruler-pencil text-danger"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Comments</p>
              <p class="card-title">23
                <p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <i class="fa fa-clock-o"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats stat-cards">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-favourite-28 text-primary"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Users</p>
              <p class="card-title">{{$user_count}}
                <p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <i class="fa fa-refresh"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header ">
        <h5 class="card-title">Recent Posts</h5>
        {{-- <p class="card-category">24 Hours performance</p> --}}
      </div>
      <div class="card-body ">
        <table class="table table-bordered table-striped">
          <thead>
            <th>Title</th>
            <th class="text-center" width="150px">Publish Date</th>
            <th class="text-center" width="160px">Categories</th>
            {{-- <th class="text-center" width="80px">Image</th>
          <th class="text-center" width="40px">Actions</th> --}}
          </thead>
          <tbody>
            @forelse ($recent_posts as $post)
            <tr>
              <td>{{$post->title}}</td>
              <td class="text-center">
                {{ \Carbon\Carbon::parse($post->created_at)->format('M j, Y')}}
              </td>
              <td class="text-center">
                @foreach ($post->categories as $category)
                <a href="#" class="badge badge-success">{{$category->title}}</a>
                @endforeach
              </td>

            </tr>
            @empty
              <tr>
                <td colspan="3" class="text-center">
                  No Posts to Display
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <a href="{{route('dashboard-post')}}" class="btn btn-primary mr-2">View All</a><a
            href="{{route('post-create')}}" class="btn btn-success">+Add New</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="card ">
      <div class="card-header ">
        <h5 class="card-title">Categories</h5>
        {{-- <p class="card-category">Last Campaign Performance</p> --}}
      </div>
      <div class="card-body ">
        <table class="table table-bordered table-striped">
          @foreach ($recent_categories as $category)
          <tr><td>{{$category->title}} <a href="#" class="badge badge-primary float-right p-2"><i class="fa fa-newspaper-o"></i> {{$category->posts->count()}}</a></td></tr>
          @endforeach
        </table>
      </div>
      <div class="card-footer ">
        {{-- <div class="legend">
          <i class="fa fa-circle text-primary"></i> Opened
          <i class="fa fa-circle text-warning"></i> Read
          <i class="fa fa-circle text-danger"></i> Deleted
          <i class="fa fa-circle text-gray"></i> Unopened
        </div> --}}
        <hr>
        <div class="stats">
          <a href="#" class="btn btn-primary mr-2">View All</a><a href="#" class="btn btn-success">+Add New</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-title">Recent Comments</h5>
        {{-- <p class="card-category">Line Chart with Points</p> --}}
      </div>
      <div class="card-body">
        <canvas id="speedChart" width="400" height="100"></canvas>
      </div>
      <div class="card-footer">
        <div class="chart-legend">
          <i class="fa fa-circle text-info"></i> Published
          <i class="fa fa-circle text-warning"></i> Draft
          <i class="fa fa-circle text-danger"></i> Spam
        </div>
        <hr />
        <div class="card-stats">
          <a href="#" class="btn btn-primary mr-2">View All</a><a href="#" class="btn btn-success">+Add New</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection