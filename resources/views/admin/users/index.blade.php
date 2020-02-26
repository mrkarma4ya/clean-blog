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
                        <th>Name</th>
                        <th>username</th>
                        <th>Email</th>
                        <th class="text-center" width="120px">Joined At</th>
                        <th class="text-center" width="120px">Posts</th>                        
                        <th class="text-center" width="80px">Comments</th>
                        <th class="text-center" width="80px">Avatar</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($user->created_at)->format('M j, Y')}}
                        </td>
                        <td class="text-center">
                            {{$user->posts()->count()}}
                        </td>
                        <td class="text-center">
                           23
                        </td>
                        <td class="text-center">
                            <img src="/storage/{{$user->avatar}}" alt="" class="avatar" >
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="100%" class="text-center">No Users to Display</td></tr>
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
             "columnDefs": [{ "orderable": false, "targets": [5] }]
        });
    } );

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@endsection