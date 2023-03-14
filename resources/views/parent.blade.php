<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/ekko-lightbox/ekko-lightbox.css') }}">

    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">

    @yield('style')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('index')}}" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                 <span class="brand-text font-weight-light">
                    {{Auth::user()->name}}
                    {{-- @if (Auth::user())
                        Employee
                    @endif
                    @if (Auth::user() )
                        HR Officer
                    @endif
                    @if (Auth::user() )
                        Manager
                    @endif --}}
                </span> 
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{-- <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image"> --}}
                             @if (Auth::user())
                                <a href="{{ route('index') }}" class="d-block">
                                 </a>
                            @else
                            <a href="{{ route('index') }}" class="d-block">
                                <img src="{{ asset('user.png') }}" class="img-circle elevation-1" alt="User Image">
                            </a>
                            @endif 
                    </div>
                    <div class="info">
                        <a href="{{route('index')}}" class="d-block">{{ Auth::user()->name ?? '' }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                        role="menu" data-accordion="false">
                         @if (Auth::user() || Auth::user())
                            <li class="nav-item menu-is-opening menu-open">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-sitemap text-success"></i>
                                    <p>
                                        Departments
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                    @if (Auth::user())
                                        <li class="nav-item">
                                            <a href="{{ route('category.create') }}" class="nav-link">
                                                <i class="nav-icon fas fa-plus text-success"></i>
                                                <p>Create</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user() )
                                        <li class="nav-item">
                                            <a href="{{ route('category.index') }}" class="nav-link">
                                                <i class="nav-icon fas fa-list-ol text-success"></i>
                                                <p>Read</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user())
                            <li class="nav-item menu-is-opening menu-open">
                                <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-users-cog text-primary"></i>
                                    <p>
                                        Products
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                    <li class="nav-item">
                                        <a href="{{ route('products.create') }}" class="nav-link">
                                            <i class="nav-icon fas fa-plus text-primary"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('products.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-list-ol text-primary"></i>
                                            <p>Read</p>
                                        </a>
                                    </li>
                                </ul>


                            </li>
                            <li class="nav-item menu-is-opening menu-open">
                                <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-users-cog text-primary"></i>
                                    <p>
                                        Orders
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                     <li class="nav-item">
                                        <a href="{{ route('orders.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-list-ol text-primary"></i>
                                            <p>Read</p>
                                        </a>
                                    </li>
                                </ul>


                            </li>
                            <li class="nav-item menu-is-opening menu-open">
                                <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-users-cog text-primary"></i>
                                    <p>
                                        Users
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                     <li class="nav-item">
                                        <a href="{{ route('users.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-list-ol text-primary"></i>
                                            <p>Read</p>
                                        </a>
                                    </li>
                                </ul>


                            </li>
                        @endif 
                        <li class="nav-header">
                            {{-- @if (Auth::user()->is_manager == 1)
                                Manager
                            @elseif (Auth::user()->is_hr == 1)
                                HR Officer
                            @else
                                Employee
                            @endif --}}
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>

                                @if (Auth::user())
                                    <p>Actions</p>
                                @elseif (Auth::user())
                                    <p>Profile</p>
                                @else
                                    <p>Profile</p>
                                @endif
                                
                            </a>
                        </li>



                        <li class="nav-header">setting</li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page_name')</h1>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023 <span class="text-red">Company System</span></strong>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- Ekko Lightbox -->
    <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: false
                });
            });
        })
    </script>

    @yield('scripts')

</body>

</html>
