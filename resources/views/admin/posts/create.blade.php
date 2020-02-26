@extends('admin.layout')

@section('content')



<div class="content card p-3">

    <header class="mb-3">Create a new Post</header>

    <form action="{{route('post-create-submit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">

                <div class="form-group">
                    <label for="title">Title <small class="text-danger">*</small></label>
                    @error('title')
                    <div class="small text-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                    
                </div>
                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="body">Body <small class="text-danger">*</small></label>
                    @error('body')
                    <div class="small text-danger">{{ $message }}</div>
                    @enderror
                    <textarea name="body" id="ckeditor" rows="20" class="form-control @error('body') is-invalid @enderror" required></textarea>
                    
                </div>


            </div>
            <div class="col-md-3">
                <div class="jumbotron p-3">
                    <div class="form-check form-check-radio">
                        <label for="status"><strong>Status</strong></label>
                        <hr>
                        <label for="draft" class="form-check-label align-top">
                            <input type="radio" name="status" id="draft" class="form-check-input" value="0" >
                            Draft
                            <span class="form-check-sign"></span>
                        </label>

                    </div>
                    <div class="form-check form-check-radio">
                        <label for="publish" class="form-check-label">
                            <input type="radio" name="status" id="publish" class="form-check-input" value="1" checked>
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
                                    name="category[]">
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
                            <img id="img-preview" src="/storage/img/upload.png" width="100%">
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
            <input type="submit" value="Create Post" class="btn btn-success">
            <input type="reset" value="Reset" class="btn btn-danger">
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