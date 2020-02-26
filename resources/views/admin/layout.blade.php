<!--
=========================================================
 Paper Dashboard 2 - v2.0.0
=========================================================

 Product Page: https://www.creative-tim.com/product/paper-dashboard-2
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        {{ config('app.name', 'Laravel') }} - Dashboard
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> 
    <!-- CSS Files -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/css/paper-dashboard.css?v=2.0.0')}}" rel="stylesheet" />
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" />
    <!-- Datatables CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/datatables/datatables.min.css')}}" />
    <!--CKEditor4 JS-->
    <script src="{{asset('admin/plugins/ckeditor4/ckeditor.js')}}"></script>
    

</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="black" data-active-color="danger">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
                <a href="{{route('index')}}" class="simple-text logo-mini" target="_blank">
                    <div class="logo-image-small">
                        <img src="/storage/{{config('app.logo')}}" height="25px">
                    </div>
                </a>
                <a href="{{route('index')}}" class="simple-text logo-normal" target="_blank">
                    {{ config('app.name', 'Laravel') }}
                    <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="{{Request::path() === 'dashboard' ? 'active' : ''}} ">
                        <a href="{{route('dashboard')}}">
                            <i class="nc-icon nc-layout-11"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{Str::startsWith(Request::path(),'dashboard/posts') ? 'active' : ''}}">
                        <a href="{{route('dashboard-post')}}">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>Posts</p>
                        </a>
                    </li>
                    <li class="{{Str::startsWith(Request::path(),'dashboard/categories') ? 'active' : ''}}">
                        <a href="{{route('dashboard-categories')}}">
                            <i class="nc-icon nc-layout-11"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="{{Str::startsWith(Request::path(),'dashboard/comments') ? 'active' : ''}}">
                        <a href="{{route('dashboard-comments')}}">
                            <i class="nc-icon nc-ruler-pencil"></i>
                            <p>Comments</p>
                        </a>
                    </li>
                    <li class="{{Str::startsWith(Request::path(),'dashboard/users') ? 'active' : ''}}">
                        <a href="{{route('dashboard-users')}}">
                            <i class="nc-icon nc-single-02 "></i>
                            <p>Users</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">

                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="nc-icon nc-zoom-split"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="nc-icon nc-simple-add"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">New</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{route('post-create')}}">New Post</a>
                                    <a class="dropdown-item" href="{{route('category-create')}}">New Category</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="nc-icon nc-settings-gear-65"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{route('index')}}" target="_blank">Front-End</a>
                                    <a class="dropdown-item" href="{{route('user-edit',['user'=>auth()->user()->username])}}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{asset('admin/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/core/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('admin/js/plugins/chartjs.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('admin/js/plugins/bootstrap-notify.js')}}"></script>

    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('admin/js/paper-dashboard.min.js?v=2.0.0')}}" type="text/javascript"></script>

    <!--Datatables JS-->
    <script type="text/javascript" src="{{asset('admin/plugins/datatables/datatables.min.js')}}"></script>





    <script>
        function showNotification(from, align, color, message){
        color = color;

        $.notify({
            message: message

        },{
            type: color,
            delay: 2000,
            placement: {
                from: from,
                align: align
            }
        });
        }
    </script>
    @if(session()->has('success'))
    <script>
        message = "{{session('success')}}";
        showNotification('top','right','success',message);
    </script>
    @endif

    @if(session()->has('error'))
    <script>
        message = "{{session('error')}}";
        showNotification('top','right','danger',message);
    </script>
    @endif

    @yield('scripts')
</body>

</html>