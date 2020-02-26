@extends('admin.layout')

@section('content')

<div class="content card p-3">

    <header class="mb-3">Create a new Category</header>

    <form action="{{route('category-create-submit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">

                <div class="form-group">
                    <label for="title">Title <small class="text-danger">*</small></label>
                    @error('title')
                    <div class="small text-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" >
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="ckeditor" class="form-control" rows="7"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="jumbotron p-3">
                    <div class="form-group">
                        <label for="image"><strong>Cover Image</strong></label>
                        <hr>
                        <div class="col-md-12 mx-auto">
                            <img id="img-preview" src="/storage/img/upload.png" width="100%" />
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
            <input type="submit" value="Create Category" class="btn btn-success">
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