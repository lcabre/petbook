@extends('layouts.MasterPerfil')

<?php /** @var App\FotoPerfil $fotoPerfil */ ?>
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

<?php /** @var App\Usuario $mascota */ ?>
@section("content")
    <div class="generalbox rounded-border ">
        <h1>
            Mis Mascotas
        </h1>
        <div class="content">
            @if(isset($mascotas) && $mascotas->count() )

                @foreach($mascotas as $mascota)
                    <div class="row mascota">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            @if( $mascota->getFotoPerfil())
                                <img src="{{ $mascota->getFotoPerfil()->getUrl() }}" alt="">
                            @else
                                <img src="/img/defaul_perfil_img - copia.jpg" alt="">
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <a href="{{ route("wallMascota", $mascota->id) }}"> <div class="nombre">{{ $mascota->nombre }}</div></a>
                            <div class="">{{ ($mascota->sexo == "H")?"Macho":"Hembra" }}</div>
                            <div class="">{{ $mascota->edad." años" }}</div>
                            <div class=""><span>Clase: </span>{{ $mascota->getTipoMascota()->nombre }}</div>
                            <div class=""><span>Raza: </span>{{ $mascota->getRaza()->nombre }}</div>
                        </div>
                        <div class="botones">
                        <a href="{{ route("wallMascota",$mascota->id) }}"><button type="submit" class="btn btn-primary">Wall</button></a>
                        <a href="{{ route("view.editMascota",$mascota->id) }}"><button type="submit" class="btn btn-primary">Editar</button></a>
                        </div>
                    </div>
                @endforeach
            @else
                <article class="alert alert-warning">Usted no tiene ninguna mascota registrada</article>
            @endif
                <a href="{{ route("agregarMascotas") }}"><button type="submit" class="btn btn-default">Agregar Mascota</button></a>
         </div>
    </div>
@endsection

@section("anuncios")
    <div class="box rounded-border ">

    </div>
@endsection

@section("ranking")
    <div class="box rounded-border ">
        <div class="imgperfil">

        </div>
    </div>
@endsection

@section("menu")
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".fecha_nacimiento").datepicker({
                isRTL: false,
                format: 'dd-mm-yyyy',
                startView: 2,
                minViewMode: 0,
                autoclose:true,
                language: 'es'
            });

            $("#saveimage").click(function (e) {
                e.preventDefault();
                var file = new FormData($(".perfil_form")[0]);
                $.ajax({
                    url: "perfil/uploadperfilimage",
                    type: "POST",
                    data: file,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        var imgPerfil = $(".imgperfil").find("img");
                        if(imgPerfil.length){
                            imgPerfil.attr("src",data);
                        }else{
                            $(".imgperfil").append("<img src='"+data+"' />");
                        }
                        $('.fileinput').fileinput('reset');
                    },
                    error: function (data) {
                        console.log(data)
                    }
                });

            });

            $(".edit").click(function () {
               // console.log($(this).parent());
               $(this).parent().hide();
               $(this).parent().parent().find(".editdato").show();
               $(this).parent().parent().find(".error").text("").hide();
            });


            $(".cancel").click(function () {
                // console.log($(this).parent());
                $(this).parent().hide();
                $(this).parent().parent().find(".dato").show();
                $(this).parent().parent().find(".error").text("").hide();
            });

            $(".editdato .edit").click(function () {
                var parent = $(this).parent();

                if(parent.parent().find(".name").text()=="Sexo"){
                    var data = $(this).parent().find("select").serialize();
                }else{
                    var data = $(this).parent().find("input").serialize();
                }

                $.ajax({
                    url: "{{ route("perfil/editdata") }}",
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        if(!data)
                            data = "No ingresado";
                        parent.parent().find(".dato span").text(data);
                        parent.hide();
                        parent.parent().find(".dato").show();
                    },
                    error: function(data) {
                        if(data.status == 422){
                            if(typeof data.responseJSON.email !== 'undefined') {
                                parent.parent().find(".error").text(data.responseJSON.email);
                                parent.parent().find(".error").show();
                            }
                            if(typeof data.responseJSON.fecha_nacimiento !== 'undefined') {
                                parent.parent().find(".error").text(data.responseJSON.fecha_nacimiento);
                                parent.parent().find(".error").show();
                            }
                        }else console.log(data);
                    }
                });
            });


            $(".fa-chevron-down").click(function(){
                var userpanel = $('.userpanel');
                if(userpanel.is(":visible"))
                {
                    $(this).removeClass('fa-chevron-up');
                    $(this).addClass('fa-chevron-down');
                }else{
                    $(this).removeClass('fa-chevron-down');
                    $(this).addClass('fa-chevron-up');
                }
                userpanel.slideToggle("fast");
            });
        });
    </script>
@endsection