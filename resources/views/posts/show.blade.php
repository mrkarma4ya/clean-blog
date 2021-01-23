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
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 mx-auto mt-3">
            <strong>Comments</strong>
            <form method="post" action="{{route('store-comment')}}">
              @csrf
              <input type="hidden" value={{$post->id}} name="post_id">
              <div class="card p-3 form-group d-block">
                @error('body')
                <div class="small text-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                  <div class="col-md-10">
                    <textarea name="body" rows="2" class="form-control" placeholder="Post your Comment"></textarea>
                  </div>
                  <div class="col-md-2 pl-0">
                    <input type="submit" value="submit" class="btn btn-sm btn-primary mt-1">
                  </div>
                </div>
              </div>
            </form>

            @foreach ($comments as $comment)
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-1">
                    <img src="/storage/{{$comment->user->avatar}}" alt="" width="50px" class="avatar">
                  </div>
                  <div class="col-md-11">
                    <h5 class="card-title"> <a href="/users/{{$comment->user->name}}">{{$comment->user->name}}</a></h5>
                    <p class="card-subtitle text-muted small">{{$comment->created_at}}

                      @if ($comment->isAuthor())
                      <span data-toggle="tooltip" data-placement="bottom" title="Author">✍️</span>
                      @endif
                      @if ($comment->isBestComment())
                      <span data-toggle="tooltip" data-placement="bottom" title="Best Comment">⭐</span>
                      @endif

                    </p>
                  </div>
                </div>


                <p class="card-text">
                  {{-- @if ($comment->parent_id != null)
                  <small><a href="/users/{{$comment->parent->user->name}}"
                  class="text-primary">&commat;{{$comment->parent->user->name}}</a><br></small>
                  @endif --}}

                  @if ($comment->parent_id != null)
                  <small><a href="/users/{{$comment->parent->user->name}}"
                      class="text-primary">&commat;{{$comment->parent->user->name}}</a><br></small>
                  @endif

                  {{$comment->body}}

                  @can('update', $comment)
                  <div id="commentcontrols" class="d-flex">
                    {{-- <form action="">
                      @csrf
                      <input type="submit" value="Edit" class="btn p-0 text-muted">
                    </form> --}}

                    <form action="{{route('comment-delete',['comment'=>$comment->id])}}" class="p-0" method="POST" onsubmit="return confirm('Do you really want to delete the comment?');">
                      @csrf
                      @method('DELETE')

                      <button type="button" class="btn p-0 text-muted" data-toggle="modal"
                        data-target="#editComment-{{$comment->id}}">
                        Edit
                      </button>

                      <input type="submit" value="Delete" class="btn p-0 text-danger" >
                    </form>
                    <div class="modal fade" id="editComment-{{$comment->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="editComment-{{$comment->id}}Label" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editComment-{{$comment->id}}Label">Edit your comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{route('comment-edit',['comment'=>$comment->id])}}" method="POST">
                            <div class="modal-body">

                              @csrf
                              <div class="row">
                                <div class="col-md-12">
                                  <textarea name="body" rows="2" class="form-control"
                                    placeholder="Edit your Comment">{{$comment->body}}</textarea>
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" class="btn btn-primary" value="Save changes">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endcan

                  @can('update', $post)
                  <form action="{{route('best-comment',['comment'=>$comment->id])}}" method="POST">
                    @csrf
                    <input type="submit" value="Best Comment?" class="btn p-0 text-primary">
                  </form>
                  @endcan


                </p>



                <form method="post" action="{{route('store-comment')}}">
                  @csrf
                  <input type="hidden" value={{$post->id}} name="post_id">
                  <input type="hidden" value={{$comment->id}} name="parent_id">

                  @error('body')
                  <div class="small text-danger">{{ $message }}</div>
                  @enderror
                  <div class="row">
                    <div class="col-md-10">
                      <textarea name="body" rows="2" class="form-control"
                        placeholder="Reply to this Comment"></textarea>
                    </div>
                    <div class="col-md-2 pl-0">
                      <input type="submit" value="Reply" class="btn btn-sm btn-primary mt-1">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            @endforeach


          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-2">

      @include('sidebar')

    </div>
  </div>
</div>


<hr>
@endsection