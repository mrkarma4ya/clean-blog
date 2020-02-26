@extends('admin.layout')

@section('content')

<form action="{{route('user-edit-submit',['user'=>$user->username])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12">
        <div class="card p-3">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image form-group">
                                <img src="/storage/{{$user->cover_image}}" alt="..." class="cover_image"
                                    id="cover-image-preview">
                                <button class="btn edit-cover">
                                    <i class="fa fa-edit">
                                        <input type="file" name="cover_image" id="cover_image" style="cursor: pointer;"
                                            onchange="document.getElementById('cover-image-preview').src = window.URL.createObjectURL(this.files[0])">
                                    </i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <div class="avatar-area mx-auto form-group" width="100%">
                                        <img class="avatar border-gray" src="/storage/{{$user->avatar}}" alt="..."
                                            id="avatar-image-preview" style="object-fit:cover">
                                        <button class="btn edit-avatar">
                                            <i class="fa fa-edit">
                                                <input type="file" name="avatar" id="avatar" style="cursor: pointer;"
                                                    onchange="document.getElementById('avatar-image-preview').src = window.URL.createObjectURL(this.files[0])">
                                            </i>
                                        </button>
                                    </div>
                                    <a href="{{route('users-show',['user'=>$user->username])}}" target="_blank">
                                        <h5 class="title">{{$user->name}}</h5>
                                    </a>
                                    <p class="description">
                                        @ {{$user->username}}
                                    </p>
                                </div>
                                <p class="description text-center">
                                    {{$user->quote}}
                                </p>
                                <p class="small text-center small">
                                    <strong>Joined</strong>:
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('M j, Y')}}
                                </p>

                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="button-container">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6 ml-auto">
                                            <h5>{{$user->posts()->count()}}
                                                <br>
                                                <small>Posts</small>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6 ml-auto">
                                            <h5>23
                                                <br>
                                                <small>Comments</small>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('cover_image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        @error('avatar')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <div class="card card-user">
                            <div class="card-header">
                                <h5 class="card-title">Edit Profile</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>Username (Not Editable)</label>
                                            <input type="text" name="username" class="form-control" name="username"
                                                disabled="" placeholder="username" value="{{$user->username}}">
                                        </div>
                                        @error('username')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-8 pl-1">
                                        
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" class="name" placeholder="name"
                                                name="name" value="{{$user->name}}" required>
                                            @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pr-1">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email"
                                                value="{{old('email',$user->email)}}" required>
                                            @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Change Password</label>
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                            @error('password')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                            @error('password_confirmation')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Quote</label>
                                            <textarea class="form-control textarea"
                                                name="quote">{{$user->quote}}</textarea>
                                            @error('quote')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>About Me</label>
                                            <textarea class="form-control textarea"
                                                name="about">{{$user->about}}</textarea>
                                            @error('about')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="update ml-auto mr-auto">
                                        <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



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