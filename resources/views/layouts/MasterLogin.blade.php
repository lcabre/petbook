<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/png" href="/img/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/img/favicon-16x16.png" sizes="16x16" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <title>Document</title>
</head>
<body>
    <header class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="logo">
                <a href="{{ route("home") }}"><img src="/img/logo.png" alt="PetBook, Red Social de Mascotas"></a>
            </div>
            <div class="user rounded-border">
                <a href="{{ route("register") }}">Registrate</a>
            </div>
        </div>
    </header>
    @yield("content")
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>