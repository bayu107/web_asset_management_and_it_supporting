<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav" >
    <div class="wrapper">
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{-- <section class="content-header">
                <div class="container">
                    <h1>@yield('title')</h1>
                </div>
            </section> --}}

            <!-- Main content -->
            <section class="content">
                <div class="container">
                    @include('partials.flash-message')

                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Main Footer -->
        {{-- <footer class="main-footer">
            <div class="container">
                <div class="text-center">
                    <b>Version</b> 1.0.0
                </div>
            </div>
        </footer> --}}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>

</html>
