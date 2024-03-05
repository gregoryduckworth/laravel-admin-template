<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'Admin') | {{ config('app.name') }}</title>

        <!-- Stylesheets -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        />
        <link
            rel="stylesheet"
            href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('admin/dist/css/adminlte.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        />

        <!-- Favicons -->
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="{{ asset('admin/favicon/apple-touch-icon.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="{{ asset('admin/favicon/favicon-32x32.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="{{ asset('admin/favicon/favicon-16x16.png') }}"
        />
        <link
            rel="manifest"
            href="{{ asset('admin/favicon/site.webmanifest') }}"
        />

        @yield('css')
    </head>

    <body class="hold-transition light-mode">
        <div class="wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 mt-4">
                            <div class="card card-primary">
                                <div class="card-body rounded-lg shadow">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>

        @include('components.alert')
        @yield('js')
    </body>
</html>
