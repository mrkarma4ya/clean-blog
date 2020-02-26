@extends('admin.layout')

@section('content')


<div class="col-md-12">
    <div class="card p-3">
        <div class="content">
            <div class="row">
                <div class="d-flex col-lg-12">                    
                    	<a class="btn btn-primary ml-auto" href="{{route('post-create')}}" >+New Post</a>
                </div>
            </div>
            <table class="table table-striped table-bordered table-full-width" id="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="text-center" width="120px">Publish Date</th>
                        <th class="text-center" width="120px">Categories</th>                        
                        <th class="text-center" width="80px">Image</th>
                        <th class="text-center" width="40px">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <td>
                            {{$post->title}}<br>
                            <small>{{$post->slug->slug}}</small>
                            @if ($post->status === 0)
                                <span class="text-danger">[Draft]</span>
                            @endif                            
                        </td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('M j, Y')}}
                        </td>
                        <td class="text-center">
                            @foreach ($post->categories as $category)
                        <a href="#" class="badge badge-success">{{$category->title}}</a>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <img src="/storage/{{$post->cover_image}}" alt="" width="80px">
                        </td>
                        <td>
                            <a href="{{route('post-toggle-status', ['post' => $post->id])}}" class="btn btn-sm btn-link px-2" data-toggle="tooltip" data-placement="bottom"
                                title="{{($post->status) === 0 ? 'Set to Published':'Set to Draft'}}">
                                <i class="fa fa-flag {{($post->status) === 0 ? 'text-danger':'text-success'}}"></i>
                            </a>
                            <a href="{{route('post-edit', ['post' => $post->id])}}" class="btn btn-sm btn-link px-2"
                                data-toggle="tooltip" data-placement="bottom" title="Edit">
                                <i class="fa fa-edit text-info"></i>
                            </a>
                            
                            <a href="{{route('post-show', ["post"=>!empty($post->slug->slug) ? $post->slug->slug:'no-slug'])}}" class="btn btn-sm btn-link px-2" data-toggle="tooltip" data-placement="bottom"
                                title="View" target="_blank">
                                <i class="fa fa-eye text-warning"></i>
                            </a>
                            <form class="d-inline" id="delete-form-{{$post->id}}" action="{{route('post-destroy', ['post' => $post->id])}}" method="POST" onsubmit="return confirm('Do you really want to delete the post?');">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-link px-2 mr-0" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="100%" class="text-center">No Posts to Display</td></tr>
                    @endforelse 
                </tbody>
            </table>
        </div>
    </div>
</div>




@endsection

@section('scripts')
<script>
    $(document).ready( function () {
        $('#table').DataTable({
             responsive: true,
             "order": [[ 1, "desc" ]],
             "columnDefs": [{ "orderable": false, "targets": [2,3,4] }]
        });
    } );

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@endsection