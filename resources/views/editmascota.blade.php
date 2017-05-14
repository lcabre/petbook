@extends('layouts.MasterPerfil')

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
            {{ auth()->user()->getPerfil()->nombre }}
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

@section("menu")
    <div class="box rounded-border ">
        <h1>Menu</h1>
        <div class="lista">
            <ul>
                <a href="#"><li><span><i class="fa fa-bell" aria-hidden="true"></i></span>Notificaciones<span class="badge">12</span></li></a>
                <li class="active"><span><i class="fa fa-user" aria-hidden="true"></i></span>Mis Datos</li>
                <a href="{{route("mascotas")}}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Mis Mascotas</li></a>
            </ul>
        </div>
    </div>
@endsection

<?php /** @var App\Usuario $mascota */ ?>
@section("content")
    <div class="generalbox rounded-border ">
        <h1>
            Datos de Usuario
        </h1>
        <div class="content mascotas">
            <form action="{{ route("editMascota") }}" method="post">
                <input type="hidden" name="id" value="{{ $mascota->id }}">
                {{ csrf_field() }}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="form-group {{ ($errors->has('nombre'))?"has-error":"" }}">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="{{  (old('nombre'))?old("nombre"):$mascota->nombre }}">
                </div>
                <div class="form-group {{ ($errors->has('sexo'))?"has-error":"" }}">
                    <label>Sexo:</label>
                    <select name="sexo" class="form-control">
                        <option value="">Seleccione un Sexo</option>
                        <option value="H" {{ old("sexo") == "H" ? "selected":($mascota->sexo == "H"?"selected":"") }}>Hembra</option>
                        <option value="M" {{ old("sexo") == "M" ? "selected":($mascota->sexo == "M"?"selected":"") }}>Macho</option>
                    </select>
                </div>
                <div class="form-group {{ ($errors->has('edad'))?"has-error":"" }}">
                    <label>Edad:</label>
                    <select name="edad" class="form-control">
                        <option value="" selected>Seleccione una Edad</option>
                        @for($i = 0; $i < 36; $i++)
                            <option value="{{ $i }}" {{ old("edad")!="" && old("edad") == $i ? "selected":($mascota->edad == $i?"selected":"") }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group {{ ($errors->has('otras_caracteristicas'))?"has-error":"" }}">
                    <label>Otras Caracteristicas:</label>
                    <textarea name="otras_caracteristicas" class="form-control" cols="30" rows="10">{{ old("otras_caracteristicas")? old("otras_caracteristicas"):$mascota->otras_caracteristicas}}</textarea>
                </div>
                <div class="form-group {{ ($errors->has('apto_adopcion'))?"has-error":"" }}">
                    <label>Apto Adopcion</label>
                    <div class="radio">
                        <label class="control-label">
                            <input type="radio" name="apto_adopcion" value="si" {{ old("apto_adopcion") == "si" ? "checked":($mascota->apto_adopcion == 1?"checked":"") }}>Si
                        </label>
                    </div>
                    <div class="radio">
                        <label class="control-label">
                            <input type="radio" name="apto_adopcion" value="no" {{ old("apto_adopcion") == "no" ? "checked":($mascota->apto_adopcion == 0?"checked":"") }}>No
                        </label>
                    </div>
                </div>
                <div class="form-group {{ ($errors->has('clase'))?"has-error":"" }}">
                    <label>Clase</label>
                    <select name="clase" class="form-control" id="clase">
                        <option value="">Seleccione una Clase</option>
                        @foreach($tipos as $clase)
                            <option value="{{$clase->id}}" {{ (old("clase") == $clase->id ? "selected":($mascota->getTipoMascota()->id == $clase->id?"selected":"")) }}>{{$clase->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{ ($errors->has('raza'))?"has-error":"" }}">
                    <label>Raza</label>
                    <select name="raza" class="form-control" id="raza">
                        <option value="">Seleccione una Raza</option>
                        @foreach($razas as $raza)
                            <option value="{{$raza->id}}" {{ (old("clase") == $raza->id ? "selected":($mascota->getRaza()->id == $raza->id?"selected":"")) }}>{{$raza->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="btn btn-group">
                    <button type="submit" class="btn btn-success">Editar</button>
                    <a href="{{ route("mascotas") }}"><button type="button" class="btn btn-primary">Cancelar</button></a>
                </div>
            </form>
            <form action="{{ route("removeMascota") }}" method="post" id="eliminar">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $mascota->id }}">
                <div class="btn btn-group">
                    <button type="button" class="btn btn-danger" id="eliminarbutton">Eliminar</button>
                </div>
            </form>
         </div>
    </div>
    <div class="generalbox rounded-border">
        <h1>Imagen de Perfil</h1>
        <div class="content">
            <form action="" name="form" class="perfil_form">
                <input type="hidden" name="id" value="{{ $mascota->id }}">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" >
                        <img src="/img/default-perfil.jpg" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" ></div>
                    <div>
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new">Seleccionar Imagen</span>
                            <span class="fileinput-exists">Cambiar</span>

                                <input type="file" name="perfil_image" class="perfil_image">

                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Cancelar</a>
                        <button class="btn  btn-default" id="saveimage">Guardar</button>
                    </div>
                </div>
            </form>
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

@section("menu")
    <div class="box rounded-border ">
        <h1>Menu</h1>
        <div class="lista">
            <ul>
                <a href="#"><li><span><i class="fa fa-bell" aria-hidden="true"></i></span>Notificaciones<span class="badge">12</span></li></a>
                <li class="active"><span><i class="fa fa-user" aria-hidden="true"></i></span>Mis Datos</li>
                <a href="{{route("mascotas")}}"><li><span><i class="fa fa-paw" aria-hidden="true"></i></span>Mis Mascotas</li></a>
            </ul>
        </div>
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

            $("#saveimage").click(function (e) {
                e.preventDefault();
                var file = new FormData($(".perfil_form")[0]);
                $.ajax({
                    url: "{{ route("mascotas/uploadperfilimage") }}",
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

            $("#eliminarbutton").click(function (event){
                event.preventDefault();
                console.log("entre");
                var conf = confirm("Si acepta se borrara la mascota");
                if (conf == true) {
                    $( "#eliminar" ).submit();
                }
            });

            $("#clase").change(function () {
                var clase = this.value;
                $("#raza").prop('disabled', true);
                $.ajax({
                    url: "/raza/tipo/"+clase,
                    type: "get",
                    success: function (data) {
                        $('#raza').empty();
                        var opciones = '<option value="">Seleccione una Raza</option>';
                        $.each(data,function(index,value){
                            console.log(index,value);
                            opciones += '<option value="'+value.id+'">'+value.nombre+'</option>';
                        });

                        $('#raza').append(opciones);
                        $("#raza").prop('disabled', false);
                    },
                    error: function (data) {
                        console.log(data)
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