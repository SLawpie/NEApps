<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700&amp;display=swap&amp;subset=latin-ext"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="layoutAuthentication">

        <div id="layoutAuthentication_content">
            <main>
                
                @yield('content')
            </main>
        </div>

        <div id="layoutAuthentication_footer">
            <div class="footer fixed-bottom p-2 bg-secondary text-white-50 small">
                <div class="d-flex justify-content-between">
                    <div class="mr-auto">
                        &nbsp;
                    </div>
                    <div class="mx-3">
                        &copy; Noelle 2020
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
