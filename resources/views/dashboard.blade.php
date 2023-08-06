<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
</head>

<body class="sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light bg-white">
            {{-- <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul> --}}

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container">
                    <h1>@yield('title', 'Dashboard')</h1>
                </div>
            </section>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.users.index') }}"
                                class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Daftar User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('m_category_reports.index') }}"
                                class="nav-link {{ Request::is('m_category_reports*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Daftar Kategori Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.index') }}"
                                class="nav-link {{ Request::is('report*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Daftar Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('m_category_assets.index') }}"
                                class="nav-link {{ Request::is('m_category_assets*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Daftar Kategori Asset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('asset.index') }}"
                                class="nav-link {{ Request::is('asset*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cube"></i>
                                <p>Daftar Asset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('usedasset.index') }}"
                                class="nav-link {{ Request::is('usedasset*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Daftar Pemakaian Asset</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    @include('partials.flash-message')

                    @yield('content')
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /.wrapper -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            var activeMenu = "{{ Request::path() }}";
            var activeMenuLink = $('.nav-sidebar a[href="' + activeMenu + '"]');
            if (activeMenuLink.length) {
                activeMenuLink.addClass('active');
                var navBarTitle = activeMenuLink.find('.nav-icon + p');
                if (navBarTitle.length) {
                    $('.navbar-brand').text(navBarTitle.text());
                }
            }
        });
    </script>
</body>

</html>
