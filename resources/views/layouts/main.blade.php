<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>@yield('page_title', 'InventoryAPP')</title>

    @include('partials.styles')
    @yield('additional_styles', '')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('partials.navbar')
        @include('partials.sidebar')

        <div class="content-wrapper">

            @yield('content-header')

            <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                </section>

        </div>

        @include('partials.footer')

    </div>

    @include('partials.scripts')
    @yield('additional_scripts', '')
    @include('sweetalert::alert')
</body>
