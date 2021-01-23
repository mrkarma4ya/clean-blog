@extends('admin.layout')

@section('content')

{{------------------------------------------ My Comments Section ----------------------------------------------------}}
    <div class="col-md-12">
        
        <div class="card p-3">
            <div class="content">
                <div class="row">
                    <div class="d-flex col-lg-12">
                        <h5>
                            My Comments
                        </h5>
                    </div>
                </div>

                <table class="table table-striped table-bordered table-full-width" id="my_comments">
                    <thead>
                        <tr>
                            <th>Comment</th>
                            <th class="text-center" width="15%">Publish Date</th>
                            <th class="text-center" width="20%">Post</th>
                            <th class="text-center" width="5%">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($comments as $comment)
                            <tr>
                                {{-- Comment Body --}}
                                <td>
                                    {{ $comment->body }}<br>
                                </td>

                                {{-- Comment Created Date --}}
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($comment->created_at)->format('M j, Y') }}
                                </td>

                                {{-- Comment Post --}}
                                <td class="text-center">
                                    <a href="/posts/{{ $comment->post->slug->slug }}" class="text-danger"
                                        target="_blank">{{ $comment->post->title }}</a>
                                </td>

                                {{-- Comment User --}}
                                {{-- <td class="text-center">
                                    <a href="#" class="badge badge-success">{{ $comment->user->name }}</a>
                                </td> --}}

                                {{-- Actions --}}
                                <td>
                                    <form class="d-inline" id="delete-form-{{ $comment->id }}"
                                        action="{{ route('comment-delete', ['comment' => $comment->id]) }}" method="POST"
                                        onsubmit="return confirm('Do you really want to delete the comment?');">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-link px-2 w-100 h6" data-toggle="tooltip"
                                            data-placement="bottom" title="Delete">
                                            <i class="fa fa-trash text-danger" alt="delete"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">No Posts to Display</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- --------------------------------- Comments on my Posts Section -----------------------------------}}
    <div class="col-md-12">
        
        <div class="card p-3">
            <div class="content">
                <div class="row">
                    <div class="d-flex col-lg-12">
                        <h5>
                            Comments on my Posts
                        </h5>
                    </div>
                </div>

                <table class="table table-striped table-bordered table-full-width" id="my_posts_comments">
                    <thead>
                        <tr>
                            <th>Comment</th>
                            <th class="text-center" width="15%">Publish Date</th>
                            <th class="text-center" width="20%">Post</th>
                            <th class="text-center" width="5%">User</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($comment_others as $comment)
                            <tr>
                                {{-- Comment Body --}}
                                <td>
                                    {{ $comment->body }}<br>
                                </td>

                                {{-- Comment Created Date --}}
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($comment->created_at)->format('M j, Y') }}
                                </td>

                                {{-- Comment Post --}}
                                <td class="text-center">
                                    <a href="/posts/{{ $comment->post->slug->slug }}" class="text-danger"
                                        target="_blank">{{ $comment->post->title }}</a>
                                </td>

                                {{-- Comment User --}}
                                 <td class="text-center">
                                    <a href="/users/{{ $comment->user->username }}" target="_blank">{{ $comment->user->name }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">No Comments to Display</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#my_comments').DataTable({
            responsive: true,
            "order": [
                [1, "desc"]
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": [3]
            }]
        });
    });

    $(document).ready(function() {
        $('#my_posts_comments').DataTable({
            responsive: true,
            "order": [
                [1, "desc"]
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": []
            }]
        });
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

</script>
@endsection
