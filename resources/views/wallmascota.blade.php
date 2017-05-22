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
@section("content")
    <div class="publicaciones rounded-border ">
        <!--<h1>
            Publicaciones
        </h1>-->
        <div class="post newpost">
            <div class="content">
                <form action="{{ route("newPost") }}" method="post" class="post_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $mascota->id }}">
                    <textarea name="post_mensaje" class="form-control" rows="3" placeholder="¿Que estas pensando?"></textarea>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview fileinput-exists thumbnail" ></div>
                        <div>
                            <div class="newimage fileinput-new"></div>
                            <span class="btn btn-primary btn-file inline">
                                <span class="fileinput-new"><i class="fa fa-camera-retro" aria-hidden="true"></i></span>
                                <span class="fileinput-exists">Cambiar</span>
                                <input type="file" name="post_image" class="perfil_image">

                            </span>
                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                            <div class="inline">
                                <button type="submit" class="btn btn-primary small" id="newpost">Publicar</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        @foreach($posts as $post )
        <div class="post">
            <div class="avatar rounded-border">
                @if($fotoPerfil = $post->getMascota()->getFotoPerfil())
                    <img src="{{$fotoPerfil->getUrl()}}" alt="">
                @endif
            </div>
            <div class="content">
                <div>
                    <div  class="name">{{ $post->getMascota()->nombre }}<div class="fecha">{{ $post->created_at->format("j m Y - H:i:s \h\s.") }}</div></div>

                    <span>{{ $post->getMascota()->getRaza()->nombre }}</span>
                </div>
                <p>{{ $post->descripcion }}</p>
                @if($post->getFoto())
                    <img src="{{ $post->getFoto()->getUrl() }}" alt="">
                @endif
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section("seguir")
    <div class="box rounded-border">
        <h1>A quien Seguir</h1>
        <div class="row">
        @foreach($mascotasParaSeguir as $mascotaParaSeguir)
            <form action="">

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
            <div class="seguir col-xs-6 col-md-12 col-sm-12 col-lg-12"><a href="#">ver todos</a></div>
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
        </div>
    </div>
@endsection

@section("javascript")
    <script>
        $(document).ready(function(){
            /*$("#newpost").click(function (e) {
                e.preventDefault();
                console.log("entre");
                var formData = new FormData($(".post_form")[0]);
                var other_data = $(".post_form").serializeArray();
                $.each(other_data,function(key,input){
                    formData.append(input.name,input.value);
                });
                //formData.append("post_mensaje",$("input[type='textarea']").serialize());
                console.log(formData);
                $.ajax({
                    url: "{{ route("newPost") }}",
                    type: "POST",
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);

                    },
                    error: function (data) {
                        console.log(data)
                    }
                });

            });*/

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