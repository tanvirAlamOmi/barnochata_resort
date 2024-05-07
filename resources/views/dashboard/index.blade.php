<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>@yield('title',config('app.name', 'AK Khan Securities'))</title>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('imgs/brncht-logo.jpg') }}" type="image/x-icon">

        <link href="{{ asset('dboard/css/simple-datatables-7.1.2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dboard/packages/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dboard/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('dboard/css/custom.css') }}" rel="stylesheet" />
        <script src="{{ asset('dboard/js/font-awesome-6.3.0.js') }}" crossorigin="anonymous"></script>

    @stack('styles')
    </head>
    <body class="sb-nav-fixed">

        @include('dashboard.includes.navbar')

        <div id="layoutSidenav">

            @include('dashboard.includes.sidebar')

            <div id="layoutSidenav_content">
                <ol class="breadcrumb mb-0 py-2 px-3">
                    @if(Route::currentRouteName() == 'dashboard')
                        <li class="breadcrumb-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">Dashboard</li>
                    @else
                        <li class="breadcrumb-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a class="btn-link" href="{{ Route::currentRouteName() == 'dashboard' ? '#' : route('dashboard') }}">Dashboard</a></li>
                    @endif

                    @yield('breadcrumbs')
                </ol>
                @include('dashboard.includes.toast-alert')
                <main>
                    @yield('dashboard_content')
                </main>
                <footer class="py-4  mt-auto">
                    <div class="container-fluid px-4">

                    </div>
                </footer>
            </div>
        </div>

        <script src="{{ asset('dboard/js/bootstrap-5.2.3.min.js') }}" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('dboard/js/jquery-3.7.0.min.js') }}"></script>
        <script src="{{ asset('dboard/js/simple-datatables-7.1.2.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('dboard/js/datatables-simple-demo.js') }}"></script>
        <script src="{{ asset('dboard/packages/ckeditor5/build/ckeditor.js') }}"></script>
        <script src="{{ asset('dboard/packages/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('dboard/js/scripts.js') }}"></script>

        <script type="text/javascript">
            $('.lv-alert').delay(3000).fadeOut('slow');
        </script>

        @stack('scripts')
    </body>
</html>
