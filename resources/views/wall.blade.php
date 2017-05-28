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