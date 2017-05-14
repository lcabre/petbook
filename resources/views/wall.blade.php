@extends('layouts.MasterWall')

@section("perfil")
    <div class="perfil rounded-border ">
        <div class="imgperfil">
            @if(isset($fotoPerfil))
                <img src="{{$fotoPerfil->getUrl()}}" alt="">
            @endif
        </div>
        <div class="avatar rounded-border">
            @if(isset($avatar))
                <img src="{{$avatar}}" alt="">
            @else
                <img src="/img/defaul_perfil_img.jpg" alt="">
            @endif
        </div>
        <div class="nombre">
            @if(auth()->user()->getPerfil()->mascotas())
                {{ auth()->user()->getPerfil()->mascotas()->first()->nombre }}
            @endif
        </div>
        <div class="numeros">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="tittle">Siguiendo
                    <div class="total">55</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
               <div class="tittle">Seguidores
                   <div class="total">55</div>
               </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="tittle">Posts
                    <div class="total">55</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("content")
    <div class="publicaciones rounded-border ">
        <h1>
            Publicaciones
        </h1>
        <div class="post">
            <div class="avatar rounded-border">

            </div>
            <div class="content">
                <div class="name">
                    Post Tittle
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat viverra lacus, ac congue nisl scelerisque et. Etiam sed pulvinar orci, eu blandit ligula. Curabitur pellentesque ante augue, et commodo odio tempus ac. Nunc eu magna quis risus venenatis suscipit. Cras a justo mi. Ut vitae dolor vitae dui hendrerit euismod a eu ex. Sed feugiat scelerisque augue vitae imperdiet. Phasellus hendrerit at ipsum a vestibulum.</p>
                <img src="https://www.lamborghini.com/es-en/sites/es-en/files/DAM/lamborghini/share%20img/huracan-coupe-facebook-og.jpg" alt="">
            </div>
        </div>
        <div class="post">
            <div class="avatar rounded-border">

            </div>
            <div class="content">
                <div class="name">
                    Post Tittle
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat viverra lacus, ac congue nisl scelerisque et. Etiam sed pulvinar orci, eu blandit ligula. Curabitur pellentesque ante augue, et commodo odio tempus ac. Nunc eu magna quis risus venenatis suscipit. Cras a justo mi. Ut vitae dolor vitae dui hendrerit euismod a eu ex. Sed feugiat scelerisque augue vitae imperdiet. Phasellus hendrerit at ipsum a vestibulum.</p>
                <img src="https://www.lamborghini.com/es-en/sites/es-en/files/DAM/lamborghini/share%20img/huracan-coupe-facebook-og.jpg" alt="">
            </div>
        </div>
    </div>
@endsection
@section("anuncios")
    <div class="box rounded-border ">
        <h1>Anuncios</h1>
        <div class="anuncio">
            <div class="avatar">

            </div>
            <div class="content">
                <div class="name">
                    Bingo
                </div>
                <div class="tipo">
                    Buscando cita
                </div>
            </div>
        </div>
        <div class="anuncio">
            <div class="avatar">

            </div>
            <div class="content">
                <div class="name">
                    Pepe
                </div>
                <div class="tipo">
                    Buscando cita
                </div>
            </div>
        </div>
    </div>
@endsection
@section("ranking")
    <div class="box rounded-border ">
        <div class="imgperfil">

        </div>


        qweqwe
    </div>
@endsection

<?php /** @var App\Usuario $mascota */ ?>
@section("menumascotas")
    <div class="box rounded-border ">
        <h1>Mis Mascotas</h1>
        @if($mascotas->count())
        <div class="lista">
            <ul>
                @foreach($mascotas as $mascota)
                    <a href="#{{-- $mascota->id --}}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>{{ $mascota->nombre }}</li></a>
                @endforeach
            </ul>
        </div>
        @else
            <div class="alert alert-warning">No posee mascotas</div>
            Ingrese <a href="{{ route("agregarMascotas") }}">Aquí</a> para agregar una.
        @endif
    </div>
@endsection