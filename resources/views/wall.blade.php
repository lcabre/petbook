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
                <img src="/img/defaul_human_perfil_img.jpg" alt="">
            @endif
        </div>
        <div class="nombre">
            @if($perfil->nombre)
                {{ $perfil->nombre }}
            @else
                <br>
            @endif

        </div>
        <div class="numeros">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="tittle">Mascotas
                    <div class="total">{{$perfil->mascotas()->count()}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("content")
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
            <div class="success"><button type="button" class="btn btn-default small" id="success">Aceptar</button></div>
        </div>
    @endif
    <div class="publicaciones rounded-border ">
        <h1>
            Publicaciones
        </h1>
        @if($postDeMascotas->isNotEmpty())
            @foreach($postDeMascotas as $post )
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
                                @if($perfil->mascotas->find($post->getMascota()->id))
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
                                            @if($perfil->mascotas->find($comentario->id))
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

@section("anuncios")
    <div class="box rounded-border ">
        <h1>Notificaciones</h1>
        @php
            $anuncio = false
        @endphp
        @if($mascotas->count())
            @foreach($mascotas as $mascota)
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
                                        <a href="{{ route("wallMascota", $cita->id) }}"> {{ $cita->nombre }}</a>
                                    </div>
                                    <div class="tipo">
                                        <span>Acepto tu cita!</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-xs">aceptar</button>
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
                                        <a href="{{ route("wallMascota", $cita->id) }}"> {{ $cita->nombre }}</a>
                                    </div>
                                    <div class="tipo">
                                        <span>Cito a {{$mascota->nombre}}</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-xs">aceptar</button>
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
            @endforeach
        @endif
        @if(!$anuncio)
            <span>No posee notificaciones</span>
        @endif
    </div>

    <div class="box rounded-border ">
        <h1>Anuncios</h1>
        @if($mascotas->count())
            @if($aptoAdopciones = $mascota->usuario()->first()->getAptoAdopcion())
                @foreach($aptoAdopciones as $aptoAdopcion)
                    <form action="{{ route("pedirAdopcion") }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="idusuario" value="{{ $perfil->id }}">
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
            @else
                <span>No posee anuncios</span>
            @endif
        @else
            <span>No posee anuncios</span>
        @endif
    </div>
@endsection

@section("ranking")

@endsection

<?php /** @var App\Usuario $mascota */ ?>
@section("menumascotas")

    <div class="box rounded-border ">
        <h1>Mis Mascotas</h1>
        @if($mascotas->count())
        <div class="lista">
            <ul>
                @foreach($mascotas as $mascota)
                    <a href="{{ route("wallMascota", $mascota->id) }}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>{{ $mascota->nombre }}</li></a>
                @endforeach
                    <a href="{{route("mascotas")}}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Administrar</li></a>
            </ul>

        </div>
        @else
            <div class="alert alert-warning">No posee mascotas</div>
            Ingrese <a href="{{ route("agregarMascotas") }}">Aquí</a> para agregar una.
        @endif
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
            })

        });

        function textAreaAdjust(ta) {
            ta.style.height = "1px";
            ta.style.height = (1+ta.scrollHeight)+"px";
        }
    </script>
@endsection