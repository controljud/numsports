<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Isaias Lima dos Santos">
        <meta name="description" content="Estatísticas dos Esportes">
        
        <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <link rel='stylesheet' href="{{ asset('css/bootstrap.css') }}" />
        <link rel='stylesheet' href="{{ asset('css/styles.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">

        <link rel="shortcut icon" href="{{ asset('images/stats.ico') }}">

        <title>{{ config('app.name') }}</title>
        
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'siteName'  => config('app.name'),
                'apiDomain' => config('app.url').'/api'
            ]) !!}
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div id="app">
                <app></app>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>