@extends('layouts.MasterWallMascota')

@section("perfil")
    <div class="perfil rounded-border ">
        <div class="imgperfil">
            @if( $mascota->getFotoPerfil())
                <img src="{{ $mascota->getFotoPerfil()->getUrl() }}" alt="">
            @else
                <!--<img src="/img/defaul_perfil_img_mascota.jpg" alt="">-->
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
                                    <a href="{{ route("view.wallseguido", $amigo->id) }}"> {{ $amigo->nombre }}</a>
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
                                <a href="{{ route("view.wallseguido", $mascotaParaSeguir->id) }}">{{ $mascotaParaSeguir->nombre }}</a>
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
        <div id="ranking">
            <canvas id="chart"></canvas>
        </div>
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
                <li class="active"><span><i class="fa fa-paw" aria-hidden="true"></i></span>Seguidos</li>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: "{{ route("datosChart") }}",
                method:"POST",
                dataType: "json",
                data: {"id": "{{$mascota->id}}" },
                success: function(result){
                    var data = Array();
                    var labels = Array();
                    for(var i in result){
                        console.log(result[i]);
                        if(parseInt(result[i].id_mascota) == {{ $mascota->id }}){
                            labels.push("Vos");
                            data.push(result[i].total);
                        }else{
                            labels.push(result[i].nombre);
                            data.push(result[i].total);
                        }
                    }
                    makeChart(data, labels);
                }
            });

            function makeChart(data, labels) {
                var chartCanvas = $("#chart");
                var ctx = document.getElementById("chart").getContext('2d');
                chartCanvas.attr('height',250);
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Ranking',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

            }
        });
    </script>
@endsection