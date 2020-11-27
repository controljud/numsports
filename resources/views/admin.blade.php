<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Isaias Lima dos Santos">
        <meta name="description" content="Estatísticas dos Esportes">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="css/adminlte.min.css">

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
                <admin></admin>
            </div>
        </div>
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
        <script src="js/adminlte.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>