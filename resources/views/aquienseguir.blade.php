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
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
            <div class="success"><button type="button" class="btn btn-default small" id="success">Aceptar</button></div>
        </div>
    @endif
    <div class="publicaciones seguir rounded-border ">
        <h1>
            A quien seguir
        </h1>
        <div class="post">
            <div class="row">
            @foreach($listaNoSeguidas as $mascotaNoSeguida)
                <form action="{{ route("seguir") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_sigue" value="{{ $mascota->id }}">
                    <input type="hidden" name="id_seguida" value="{{ $mascotaNoSeguida->id }}">
                    <div class="seguir  col-xs-12 col-md-12 col-sm-12 col-lg-12">
                        <div class="avatar">
                            @if( $mascotaNoSeguida->getFotoPerfil())
                                <img src="{{ $mascotaNoSeguida->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="descripcion">
                                <div class="name">
                                    <a href="{{ route("view.wallseguido", $mascotaNoSeguida->id) }}"> {{ $mascotaNoSeguida->nombre }}</a>
                                </div>
                                <div class="tipo">
                                    {{ $mascotaNoSeguida->otras_caracteristicas }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary seguirbtn">Seguir</button>
                        </div>
                    </div>
                </form>
            @endforeach
            </div>
        </div>
    </div>
@endsection

@section("anuncios")
    <div class="box rounded-border ">
        <h1>Notificaciones</h1>
        @php
            $anuncio = false
        @endphp
        @if($citas = $mascota->getNotificaciones("citaconcretada"))
            @php
                $anuncio = true
            @endphp
            @foreach($citas as $cita)
                <form action="{{ route("citaInformada") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idcita" value="{{ $mascota->id }}">
                    <input type="hidden" name="idcitada" value="{{ $cita->id }}">
                    <div class="anuncio">
                        <div class="avatar">
                            @if( $cita->getFotoPerfil())
                                <img src="{{ $cita->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="name">
                                <a href="{{ route("view.wallseguido", $cita->id) }}"> {{ $cita->nombre }}</a>
                            </div>
                            <div class="tipo">
                                <span>Acepto tu cita!</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-xs">Aceptar</button>
                    </div>
                </form>
            @endforeach
        @endif
        @if($citas = $mascota->getNotificaciones("nuevacita"))
            @php
                $anuncio = true
            @endphp
            @foreach($citas as $cita)
                <form action="{{ route("aceptarCita") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idcita" value="{{ $cita->id }}">
                    <input type="hidden" name="idcitada" value="{{ $mascota->id }}">
                    <div class="anuncio">
                        <div class="avatar">
                            @if( $cita->getFotoPerfil())
                                <img src="{{ $cita->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="name">
                                <a href="{{ route("view.wallseguido", $cita->id) }}"> {{ $cita->nombre }}</a>
                            </div>
                            <div class="tipo">
                                <span>Te ha citado!</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-xs">Aceptar</button>
                    </div>
                </form>
            @endforeach
        @endif
        @if($adopciones = $mascota->getNotificaciones("nuevaadopcion"))
            @php
                $anuncio = true
            @endphp
            @foreach($adopciones as $adopcion)
                <form action="{{ route("aceptarAdopcion") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idusuario" value="{{ $adopcion->id }}">
                    <input type="hidden" name="idmascota" value="{{ $mascota->id }}">
                    <div class="anuncio">
                        <div class="avatar">
                            @if( $adopcion->getFotoPerfil())
                                <img src="{{ $adopcion->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="name">
                                <a href="#{{-- route("wallMascota", $adopcion->id) --}}"> {{ $adopcion->nombre }}</a>
                            </div>
                            <div class="tipo">
                                <span>Quiere adoptar a {{$mascota->nombre}}</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-xs">aceptar</button>
                    </div>
                </form>
            @endforeach
        @endif
        @if($adopciones = $mascota->getNotificaciones("adopcionconcretada"))
            @php
                $anuncio = true
            @endphp
            @foreach($adopciones as $adopcion)
                <form action="{{ route("adopcionInformada") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idusuario" value="{{ $adopcion->id }}">
                    <input type="hidden" name="idmascota" value="{{ $mascota->id }}">
                    <div class="anuncio">
                        <div class="avatar">
                            @if( $adopcion->getFotoPerfil())
                                <img src="{{ $adopcion->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="name">
                                <a href="#{{-- route("wallMascota", $adopcion->id) --}}"> {{ $adopcion->nombre }}</a>
                            </div>
                            <div class="tipo">
                                <span>Has adoptado a {{$mascota->nombre}}</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-xs">aceptar</button>
                    </div>
                </form>
            @endforeach
        @endif
        @if(!$anuncio)
            <span>No posee notificaciones</span>
        @endif
    </div>
    <div class="box rounded-border ">
        <h1>Anuncios</h1>
        @php
            $anuncio = false
        @endphp
        @if($aptocitas = $mascota->getAptoCitas())
            @php
                $anuncio = true
            @endphp
            @foreach($aptocitas as $aptocita)
                <form action="{{ route("cita") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idcita" value="{{ $mascota->id }}">
                    <input type="hidden" name="idcitada" value="{{ $aptocita->mascota()->first()->id }}">
                    <div class="anuncio">
                        <div class="avatar">
                            @if( $aptocita->mascota()->first()->getFotoPerfil())
                                <img src="{{ $aptocita->mascota()->first()->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="name">
                                <a href="{{ route("view.wallseguido", $aptocita->mascota()->first()->id) }}"> {{ $aptocita->mascota()->first()->nombre }}</a>
                            </div>
                            <div class="tipo">
                                <span>Busca Cita</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-xs">Citar</button>
                    </div>
                </form>
            @endforeach
        @endif
        @if($aptoAdopciones = $mascota->usuario()->first()->getAptoAdopcion())
            @php
                $anuncio = true
            @endphp
            @foreach($aptoAdopciones as $aptoAdopcion)
                <form action="{{ route("pedirAdopcion") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idusuario" value="{{ $mascota->usuario()->first()->id }}">
                    <input type="hidden" name="idmascota" value="{{ $aptoAdopcion->mascota()->first()->id }}">
                    <div class="anuncio">
                        <div class="avatar">
                            @if( $aptoAdopcion->mascota()->first()->getFotoPerfil())
                                <img src="{{ $aptoAdopcion->mascota()->first()->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img.jpg" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <div class="name">
                                <a href="{{ route("view.wallseguido", $aptoAdopcion->mascota()->first()->id) }}"> {{ $aptoAdopcion->mascota()->first()->nombre }}</a>
                            </div>
                            <div class="tipo">
                                <span>Busca Adopcion</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-xs">Adoptar</button>
                    </div>
                </form>
            @endforeach
        @endif
        @if(!$anuncio)
            <span>No posee anuncios</span>
        @endif
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
                <a href="{{ route("home") }}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Mi Dueño</li></a>
                <a href="{{ route("mascotas") }}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Mascotas</li></a>
                 <a href="{{ route("view.editMascota", $mascota->id) }}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Editar información</li></a>
                <a href="{{ route("view.seguidos", $mascota->id) }}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Seguidos</li></a>
            </ul>
        </div>
    </div>
@endsection

@section("javascript")
    <script>
        $(document).ready(function(){
            $("#success").click(function () {
                console.log($(this).parent().parent().fadeOut());
            });
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