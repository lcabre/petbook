@extends('layouts.MasterWallMascota')

@section("perfil")
    <div class="perfil rounded-border ">
        <div class="imgperfil">
            @if( $mascota->getFotoPerfil())
                <img src="{{ $mascota->getFotoPerfil()->getUrl() }}" alt="">
            @else
                <img src="/img/defaul_perfil_img_mascota.jpg" alt="">
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
            @if($mascota)
                {{ $mascota->nombre }}
            @else
                <br>
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
<?php /** @var App\Post $post */ ?>
<?php /** @var App\Mascota $mascotaNoSeguida */ ?>
@section("content")
    <div class="publicaciones seguir rounded-border ">
        <h1>
            Seguidos
        </h1>
        <div class="post">
            <div class="row">
            @foreach($listaAmigos as $amigo)
                         <div class="seguir  col-xs-12 col-md-12 col-sm-12 col-lg-12">
                        <div class="avatar">
                            @if( $amigo->getFotoPerfil())
                                <img src="{{ $amigo->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="descripcion">
                                <div class="name">
                                    {{ $amigo->nombre }}
                                </div>
                                <div class="tipo">
                                    {{ $amigo->otras_caracteristicas }}
                                </div>
                            </div>
                            <a href="{{ route("view.wallseguido", $amigo->id) }}"><button type="submit" class="btn btn-primary seguirbtn">Ver Perfil</button></a>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection

@section("seguir")
    <div class="box rounded-border">
        <h1>A quien Seguir</h1>
        <div class="row">
            @foreach($mascotasParaSeguir as $mascotaParaSeguir)
                <form action="{{ route("seguir") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_sigue" value="{{ $mascota->id }}">
                    <input type="hidden" name="id_seguida" value="{{ $mascotaParaSeguir->id }}">
                    <div class="seguir  col-xs-6 col-md-12 col-sm-12 col-lg-12">
                        <div class="avatar">
                            @if( $mascotaParaSeguir->getFotoPerfil())
                                <img src="{{ $mascotaParaSeguir->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="name">
                                {{ $mascotaParaSeguir->nombre }}
                            </div>
                            <div class="tipo">
                                <button type="submit" class="btn btn-primary btn-xs">Seguir</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
            <div class="seguir col-xs-6 col-md-12 col-sm-12 col-lg-12"><a href="{{ route("view.aquienseguir", $mascota->id) }}">ver todos</a></div>
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
        <h1>Menú</h1>
        <div class="lista">
            <ul>
                <a href="{{ route("view.editMascota", $mascota->id) }}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Editar informaciónn</li></a>
            </ul>
            <ul>
                <a href="{{ route("view.seguidos", $mascota->id) }}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Seguidos</li></a>
            </ul>
        </div>
    </div>
@endsection

@section("javascript")
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
@endsection