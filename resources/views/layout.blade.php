<html>
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>

        <link rel='stylesheet' href="{{ asset('css/bootstrap.css') }}" />
        <link rel='stylesheet' href="{{ asset('css/styles.css') }}" />
    </head>
    <body>
    @yield('content')
    </body>
</html>