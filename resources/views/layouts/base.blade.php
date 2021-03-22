<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="@yield('html-class', 'h-100')">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name'))</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="@yield('body-class', 'h-100 d-flex flex-column')">
        @yield('content')
        <footer class="@yield('footer-class', 'd-flex justify-content-center mt-auto border-top')">
        @section('footer-content')
            <p>Make with love</p>
        @show
        </footer>
        @section('scripts')
        <script defer type="text/javascript" src="{{ mix('js/app.js') }}"></script>
        @show
    </body>
</html>