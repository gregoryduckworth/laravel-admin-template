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
        <link
            rel="stylesheet"
            href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"
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

    <body
        class="hold-transition sidebar-mini layout-fixed {{ Auth::user()->mode }}-mode"
    >
        <div class="wrapper">
            @include('components.navbar')
            @include('components.sidebar')

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>@yield('title')</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a
                                            href="{{ route('admin.dashboard') }}"
                                        >
                                            {{ __('common.home') }}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        @yield('title')
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    @yield('content')
                </section>
            </div>
        </div>

        <footer class="main-footer">
            <strong>{{ __('common.copyright') }} © {{ date('Y') }}</strong>
            <div class="d-none d-sm-block float-right">
                <b>{{ __('common.version') }}</b>
                {{ config('app.version') }}
            </div>
        </footer>

        <!-- Scripts -->
        <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                // Define an array of routes you want to check
                var routesToCheck = [
                    '{{ route('admin.user.index') }}',
                    '{{ route('admin.role.index') }}',
                    '{{ route('admin.permission.index') }}',
                ];

                // Get the current path
                var currentPath = '{{ url()->current() }}';

                // Check if the current path matches any of the desired routes
                if (
                    routesToCheck.some((route) => currentPath.startsWith(route))
                ) {
                    // Add menu-open and active classes to the parent li
                    $('.nav-item.has-treeview').addClass('menu-open');
                    $('.nav-link.active')
                        .parents('.nav-item.has-treeview')
                        .addClass('menu-open');
                }
            });
        </script>
        @include('components.alert')
        @yield('js')
    </body>
</html>
