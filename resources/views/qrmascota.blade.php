@extends('layouts.MasterQr')

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


    </div>
@endsection
<?php /** @var App\Post $post */ ?>
@section("content")
    <div class="publicaciones rounded-border ">
        <div class="post">
            <div class="content">
                <p class="alert alert-info">Si encontraste esta mascota, por favor comunicate por mail con {{ $perfil->nombre }} a su correo electronico: {{$perfil->user()->first()->email}}<br>
                Muchas Gracias!
                </p>
            </div>
        </div>
    </div>
@endsection

<?php /** @var App\Usuario $mascota */ ?>
@section("menumascotas")
    <div class="box rounded-border ">
        <h1>Datos de contacto</h1>
        <div class="lista">
            <ul>
                <li><span>Dueño: {{ $perfil->nombre }}</span></li>
            </ul>
            @if(isset($perfil->telefono))
                <ul>
                    <li><span>Telefono: {{ $perfil->telefono }}</span></li>
                </ul>
            @endif
            @if(isset($perfil->domicilio))
                <ul>
                    <li><span>Domicilio: {{ $perfil->domicilio }}</span></li>
                </ul>
            @endif
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