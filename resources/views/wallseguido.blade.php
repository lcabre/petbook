@extends('layouts.MasterWallSeguido')

@section("perfil")
    @if(Session('idMascotaActiva'))
        <!--<div class="alert alert-danger">
            {{--Session('idMascotaActiva')--}}
        </div>-->
    @endif
    <div class="perfilwall rounded-border ">

        <div class="imgperfil">
            @if( $mascota->getFotoPerfil())
                <img src="{{ $mascota->getFotoPerfil()->getUrl() }}" alt="">
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
                    <div class="total">{{$mascota->sigo()->count()}}</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
               <div class="tittle">Seguidores
                   <div class="total">{{$mascota->seguidores()->count()}}</div>
               </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="tittle">Posts
                    <div class="total">{{$mascota->posts()->count()}}</div>
                </div>
            </div>
        </div>
        @if($miMascota->sigo()->find($mascota->id) && $mascota->aptoCita() && !$miMascota->cito()->where("concretado",0)->first())
            @if($mascota->aptoCita()->id_raza == $miMascota->getRaza()->id)

                <form action="{{ route("cita") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idcita" value="{{ $miMascota->id }}">
                    <input type="hidden" name="idcitada" value="{{ $mascota->id }}">
                    <button type="submit" class="btn btn-primary pedircita">Pedir Cita</button>
                </form>

            @endif
        @endif
        @if($miMascota->sigo->find($mascota->id))
            <button type="button" class="btn btn-primary siguiendo">Siguiendo</button>
        @else
            <form action="{{ route("seguir") }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id_sigue" value="{{ $miMascota->id }}">
                <input type="hidden" name="id_seguida" value="{{ $mascota->id }}">
                <button type="submit" class="btn btn-primary ">Seguir</button>
            </form>
        @endif
    </div>
@endsection
<?php /** @var App\Post $post */ ?>
@section("content")
    <div class="publicaciones rounded-border ">
        <!--<h1>
            Publicaciones
        </h1>-->
        @if($posts->isNotEmpty())
            @foreach($posts as $post )
                <div class="post">
                    <div class="avatar rounded-border">
                        @if($fotoPerfil = $post->getMascota()->getFotoPerfil())
                            <img src="{{$fotoPerfil->getUrl()}}" alt="">
                        @else
                            <img src="/img/defaul_perfil_img.jpg" alt="">
                        @endif
                    </div>
                    <div class="content">
                        <div>
                            <div  class="name">
                                @if($miPerfil->mascotas->find($post->getMascota()->id))
                                    <a href="{{ route("wallMascota", $post->getMascota()->id) }}">
                                @else
                                    <a href="{{ route("view.wallseguido", $post->getMascota()->id) }}">
                                @endif
                                {{ $post->getMascota()->nombre }}</a>
                                <div class="fecha">{{ $post->created_at->format("j m Y - H:i:s \h\s.") }}</div>
                            </div>
                            <span>{{ $post->getMascota()->getRaza()->nombre }}</span>
                        </div>
                        @if($post->getFoto())
                            <img src="{{ $post->getFoto()->getUrl() }}" alt="">
                        @endif
                        <p>{{ $post->descripcion }}</p>
                        <div class="social">
                            @if($post->isLikedBy($miMascota->id))
                                <span class="megusta"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Me gusta</span>
                            @else
                                <form action="{{ route("meGusta") }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="idmascota" value="{{ $miMascota->id }}">
                                    <input type="hidden" name="idpost" value="{{ $post->id }}">
                                    <span class="nomegusta"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Me gusta</span>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="comentarios">
                        @if($comentarios = $post->getComentarios())
                            @foreach($comentarios as $comentario)
                                <div class="comentario">
                                    <div class="avatar rounded-border">
                                        @if($fotoPerfil = $comentario->getFotoPerfil())
                                            <img src="{{$fotoPerfil->getUrl()}}" alt="">
                                        @else
                                            <img src="/img/defaul_perfil_img.jpg" alt="">
                                        @endif
                                    </div>
                                    <div class="content">
                                        <div class="name">
                                            @if($miPerfil->mascotas->find($comentario->id))
                                                <a href="{{ route("wallMascota", $comentario->id) }}">
                                            @else
                                                <a href="{{ route("view.wallseguido", $comentario->id) }}">
                                            @endif
                                            {{ $comentario->nombre }}</a>
                                            <div class="fecha">{{ $comentario->pivot->created_at->format("j m Y - H:i:s \h\s.") }}</div>
                                        </div>
                                        {{ $comentario->pivot->comentario }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="content">
                            <form action="{{ route("newComentario") }}" method="post" class="post_form" id="form-comentario" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="idmascota" value="{{ $miMascota->id }}">
                                <input type="hidden" name="idpost" value="{{ $post->id }}">
                                <textarea name="comentario" class="form-control comentariotext" rows="1" placeholder="Escribe tu comentario" onkeyup="textAreaAdjust(this)"></textarea>
                                <button type="submit" class="btn btn-primary small" id="newpost">Comentar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="post">
                <div class="content">
                    <div class="alert alert-warning">No posee Comentarios Aun</div>
                </div>
            </div>
        @endif
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
            <div class="seguir col-xs-6 col-md-12 col-sm-12 col-lg-12"><a href="{{ route("view.aquienseguir", $miMascota->id) }}">ver todos</a></div>
        </div>
    </div>
@endsection

@section("anuncios")
    <div class="box rounded-border ">
        <h1>Notificaciones</h1>
        @php
            $anuncio = false
        @endphp
        @if($citas = $miMascota->getNotificaciones("citaconcretada"))
            @php
                $anuncio = true
            @endphp
            @foreach($citas as $cita)
                <form action="{{ route("citaInformada") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idcita" value="{{ $miMascota->id }}">
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
        @if($citas = $miMascota->getNotificaciones("nuevacita"))
            @php
                $anuncio = true
            @endphp
            @foreach($citas as $cita)
                <form action="{{ route("aceptarCita") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idcita" value="{{ $cita->id }}">
                    <input type="hidden" name="idcitada" value="{{ $miMascota->id }}">
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
        @if($adopciones = $miMascota->getNotificaciones("nuevaadopcion"))
            @php
                $anuncio = true
            @endphp
            @foreach($adopciones as $adopcion)
                <form action="{{ route("aceptarAdopcion") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idusuario" value="{{ $adopcion->id }}">
                    <input type="hidden" name="idmascota" value="{{ $miMascota->id }}">
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
                                <span>Quiere adoptar a {{$miMascota->nombre}}</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-xs">aceptar</button>
                    </div>
                </form>
            @endforeach
        @endif
        @if($adopciones = $miMascota->getNotificaciones("adopcionconcretada"))
            @php
                $anuncio = true
            @endphp
            @foreach($adopciones as $adopcion)
                <form action="{{ route("adopcionInformada") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idusuario" value="{{ $adopcion->id }}">
                    <input type="hidden" name="idmascota" value="{{ $miMascota->id }}">
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
                                <span>Has adoptado a {{$miMascota->nombre}}</span>
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
        @if($aptocitas = $miMascota->getAptoCitas())
            @php
                $anuncio = true
            @endphp
            @foreach($aptocitas as $aptocita)
                <form action="{{ route("cita") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idcita" value="{{ $miMascota->id }}">
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
        @if($aptoAdopciones = $miMascota->usuario()->first()->getAptoAdopcion())
            @php
                $anuncio = true
            @endphp
            @foreach($aptoAdopciones as $aptoAdopcion)
                <form action="{{ route("pedirAdopcion") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idusuario" value="{{ $miMascota->usuario()->first()->id }}">
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
                <a href="{{route("wallMascota", $miMascota->id)}}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Mi Wall</li></a>
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
            $(".nomegusta").click(function () {
               $(this).parent().submit();
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