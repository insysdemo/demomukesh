<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('admin.layouts.styles')
    @yield('style')


    <style>
        .dark-form-input:focus {
            background-color: #454d55 !important;
            color: white !important
        }

        .dark-form-input::placeholder {
            color: white;
        }

        .btn-sidebar:hover i {
            color: white;
            transition: all 5s;

        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="flex justify-content-end">
        <div class="position-fixed m-2 " id="alerts"
            style="right: 0; z-index: 99999; border-radius: 10px;  box-shadow: 3px 3px 6px #0000009e; ">
        </div>
    </div>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            {{-- <img class="animation__shake" src="{{ asset('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="150" width="150"> --}}
        </div>

        <!-- Navbar -->
        <div class="container-fluid">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('/admin/' . app()->getLocale() . '/dashboard') }}"
                            class="nav-link">{{ trans('app.Dashboard') }}</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        @yield('nav-link')
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route('logout', ['id' => auth('admin')->id()]) }}" role="button">
                            LogOut
                        </a>

                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control dark-form-input form-control-sidebar" type="search"
                            placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                @include('admin.layouts.sidebar')
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            @yield('content')
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('admin.layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('admin.layouts.commonModal')

    @include('admin.layouts.scripts')
    <script>
        var base_url = "{{ url('/') }}";
        var token = "{{ csrf_token() }}";
    </script>
    @yield('script')
</body>

</html>
