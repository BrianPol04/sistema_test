<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> Sistema | @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/logo-sm-1.png') }}">
        @yield('styles')
        <!-- Layout config Js -->
        <script src="{{ asset('assets/js/layout.js') }}"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    </head>

    <body>
        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('admin.layouts.header')
            @include('admin.layouts.sidebar')

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © tarea completo.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    desarrollador
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
        </div>
        {{-- configuracion --}}
        <div class="d-none">
            @include('admin.layouts.config')
        </div>
        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        @yield('scripts')
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
    </body>

</html>
