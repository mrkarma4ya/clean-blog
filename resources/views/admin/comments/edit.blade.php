@extends('admin.layout')

@section('content')



<div class="content card p-3">

    <header class="mb-3">Edit Post</header>
    <form id="delete-form" class="d-inline" id="delete-form-{{$post->id}}"
        action="{{route('post-destroy', ['post' => $post->id])}}" method="POST"
        onsubmit="return confirm('Do you really want to delete the post?');">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
    </form>

    <form action="{{route('post-edit-submit',['post'=>$post->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">

                <div class="form-group">
                    <label for="title">Title <small class="text-danger">*</small></label>
                    @error('title')
                    <div class="small text-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{$post->title}}" required>
                    <small>Slug: {{isset($post->slug->slug) ? $post->slug->slug:'Slug Error: no slug' }}</small>
                </div>

                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="2">{{$post->excerpt}}</textarea>
                </div>
                <div class="form-group">
                    <label for="body">Body <small class="text-danger">*</small></label>
                    @error('body')
                    <div class="small text-danger">{{ $message }}</div>
                    @enderror
                    <textarea name="body" id="ckeditor" rows="10"
                        class="form-control @error('body') is-invalid @enderror" required>{{$post->body}}</textarea>
                </div>


            </div>
            <div class="col-md-3">
                <div class="form-group">

                    <input type="submit" value="Update Post" class="btn btn-success btn-block">
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <a href="{{route('post-show', ["post"=>!empty($post->slug->slug) ? $post->slug->slug:'no-slug'])}}"
                                value="" class="btn btn-warning btn-block " target="_blank">View Post</a>
                        </div>
                        <div class="col-md-6 pl-1">

                            <button type="submit" class="btn  btn-danger btn-block " data-toggle="tooltip"
                                data-placement="bottom" title="Delete" form="delete-form">
                                Delete
                            </button>

                        </div>
                    </div>
                </div>
                <div class="jumbotron p-3">
                    <div class="form-check form-check-radio">
                        <label for="status"><strong>Status</strong></label>
                        <hr>
                        <label for="draft" class="form-check-label align-top">
                            <input type="radio" name="status" id="draft" class="form-check-input" value="0"
                                {{$post->status === 0 ? 'checked' : ''}}>
                            Draft
                            <span class="form-check-sign"></span>
                        </label>

                    </div>
                    <div class="form-check form-check-radio">
                        <label for="publish" class="form-check-label">
                            <input type="radio" name="status" id="publish" class="form-check-input" value="1"
                                {{$post->status === 1? 'checked' : ''}}>
                            Publish
                            <span class="form-check-sign"></span>
                        </label>
                    </div>
                </div>
                <div class="jumbotron p-3">
                    <div class="form-group">
                        <label for="categories"><strong>Categories</strong></label>
                        <hr>

                        @foreach ($categories as $category)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="{{$category->id}}"
                                    name="category[]"
                                    {{($post->categories->firstWhere('id' , $category->id))  ? 'checked': ''}}>
                                {{$category->title}}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="jumbotron p-3">
                    <div class="form-group">
                        <label for="image"><strong>Cover Image</strong></label>
                        <hr>
                        <div class="col-md-12 mx-auto">
                            <img id="img-preview"
                                src="{{($post->cover_image)!=null ? '/storage/'.$post->cover_image:'/storage/img/upload.png'}}"
                                width="100%" />
                            <input name="cover_image" type="file"
                                onchange="document.getElementById('img-preview').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div>
                </div>
                @error('cover_image')
                <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Update Post" class="btn btn-success">


        </div>
    </form>


</div>

@endsection

@section('scripts')

<script>
    CKEDITOR.replace( 'ckeditor',{
        height:400
    });
</script>

@endsection