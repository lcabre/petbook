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
    <header>
        <div class="container">
            <div class="logo">
                <a href="{{ route("home") }}">
                    <img src="/img/logo.png" alt="PetBook, Red Social de Mascotas">
                </a>
            </div>
            @if (Auth::check())
                <div class="user rounded-border"> {{ Auth::user()->email }} <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    <div class="userpanel">
                        <div><a href="{{ route("perfil") }}">Perfil</a></div>
                        <div><a href="{{ route("logout") }}">Salir</a></div>
                    </div>
                </div>
            @endif
            <div class="notificaciones">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <p>Notificaciones</p>
                <span class="badge">12</span>
            </div>
        </div>
    </header>
    <div class="container">
        <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-r">
            @yield("perfil")
        </aside>
        <section class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding">
            @yield("content")
        </section>
        <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-l">
            @yield("anuncios")
            @yield("ranking")
        </aside>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".fa-chevron-down").click(function(){
                console.log("dasasd");
                if($(".userpanel").is(":visible"))
                {
                    $(this).removeClass('fa-chevron-up');
                    $(this).addClass('fa-chevron-down');
                }else{
                    $(this).removeClass('fa-chevron-down');
                    $(this).addClass('fa-chevron-up');
                }
                $(".userpanel").slideToggle("fast");
            });
        });
    </script>
</body>
</html>