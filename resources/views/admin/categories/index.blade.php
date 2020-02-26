@extends('admin.layout')

@section('content')

@if (count($categories)>0)
<div class="col-md-12">
    <div class="card p-3">
        <div class="content">
            <div class="row">
                <div class="d-flex col-lg-12">                    
                    	<a class="btn btn-primary ml-auto" href="{{route('category-create')}}" >+New Category</a>
                </div>
            </div>

            <table class="table table-striped table-bordered table-full-width" id="table">
                <thead>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="text-center" width="80px">Posts</th>
                    <th class="text-center" width="80px">Image</th>
                    <th class="text-center" width="100px">Actions</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->title}}</td>
                        <td>{!!$category->description!!}</td>
                        <td class="text-center">{{$category->posts->count()}}</td>
                        <td class="text-center"><img src="/storage/{{$category->cover_image}}" alt="" width="50px"></td>
                        <td>
                            <a href="{{route('category-show', ['category' => $category->id])}}" class="btn btn-sm btn-link px-2" data-toggle="tooltip" data-placement="bottom"
                                title="View" target="_blank">
                                <i class="fa fa-eye text-warning"></i>
                            </a>
                            <a href="{{route('category-edit', ['category' => $category->id])}}" class="btn btn-sm btn-link px-2"
                                data-toggle="tooltip" data-placement="bottom" title="Edit">
                                <i class="fa fa-edit text-info"></i>
                            </a>
                            <form class="d-inline" id="delete-category" action="{{route('category-destroy', ['category' => $category->id])}}" method="POST" onsubmit="return confirm('Do you really want to delete the category?');">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-link px-2 mr-0" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
No Categories to Display
@endif

@endsection

@section('scripts')
<script>
    $(document).ready( function () {
        $('#table').DataTable({
             responsive: true,
             "order": [[ 0, "asc" ]],
             "columnDefs": [{ "orderable": false, "targets": [3,4] }]
        });
    } );

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@endsection