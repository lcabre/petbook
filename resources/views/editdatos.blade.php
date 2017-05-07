@extends('layouts.MasterPerfil')

@section("perfil")
    <div class="perfil rounded-border ">
        <div class="imgperfil">

        </div>
        <div class="avatar rounded-border">

        </div>
        <div class="nombre">
            Bingo
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

<?php /** @var App\Usuario $perfil */ ?>
@section("content")
    <div class="generalbox rounded-border ">
        <h1>
            Datos de Usuario
        </h1>
        <div class="content">
            <div class="fila"><div class="name">Email: </div> <span class="dato"><input type="text" name="email" id="email">{{ Auth::user()->email }}</span></div>
            <div class="fila"><div class="name">Nombre: </div>@if($perfil->nombre) <span class="dato">{{ $perfil->nombre }} @else No ingresado @endif</span></div>
            <div class="fila"><div class="name">Domicilio: </div>@if($perfil->domicilio) <span class="dato">{{ $perfil->domicilio }} @else No ingresado @endif</span></div>
            <div class="fila"><div class="name">Telefono: </div>@if($perfil->telefono) <span class="dato">{{ $perfil->telefono }} @else No ingresado @endif</span></div>
            <div class="fila"><div class="name">Género: </div>@if($perfil->sexo) <span class="dato">{{ $perfil->sexo }} @else No ingresado @endif</span></div>
            <div class="fila"><div class="name">Fecha de Nacimiento: </div>@if($perfil->fecha_nacimiento) <span class="dato">{{ $perfil->fecha_nacimiento }} @else No ingresado @endif</span></div>
            <a href="{{ route("editdatos") }}"><button type="submit" class="btn btn-default datos">Editar Datos</button></a>
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
@section("javascript")
    <script>
        $(document).ready(function(){
            /*$(".datos").click(function () {
               console.log("sarasa");
            });*/


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