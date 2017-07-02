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
            @if(auth()->user()->getPerfil()->nombre)
                {{ auth()->user()->getPerfil()->nombre }}
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

<?php /** @var App\Raza $raza */ ?>
<?php /** @var App\TipoMascota $tipo */ ?>
@section("content")
    <div class="generalbox rounded-border ">
        <h1>
            Agregar Mascota
        </h1>
        <div class="content">
            <form action="{{ route("addMascota") }}" method="post">
                {{ csrf_field() }}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="form-group {{ ($errors->has('nombre'))?"has-error":"" }}">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">
                </div>
                <div class="form-group {{ ($errors->has('sexo'))?"has-error":"" }}">
                    <label>Sexo:</label>
                    <select name="sexo" class="form-control">
                        <option value="">Seleccione un Sexo</option>
                        <option value="H" {{ (old("sexo") == "H" ? "selected":"") }}>Hembra</option>
                        <option value="M" {{ (old("sexo") == "M" ? "selected":"") }}>Macho</option>
                    </select>
                </div>
                <div class="form-group {{ ($errors->has('edad'))?"has-error":"" }}">
                    <label>Edad:</label>
                    <select name="edad" class="form-control">
                        <option value="" selected>Seleccione una Edad</option>
                        @for($i = 0; $i < 36; $i++)
                            <option value="{{ $i }}" {{ (old("edad")!="" && old("edad") == $i)? "selected":"" }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group {{ ($errors->has('otras_caracteristicas'))?"has-error":"" }}">
                    <label>Otras Caracteristicas:</label>
                    <textarea name="otras_caracteristicas" class="form-control" cols="30" rows="10">{{ old("otras_caracteristicas") }}</textarea>
                </div>
                <div class="form-group {{ ($errors->has('apto_adopcion'))?"has-error":"" }}">
                    <label>Apto Adopcion</label>
                    <div class="radio">
                        <label class="control-label">
                            <input type="radio" name="apto_adopcion" value="si" {{ (old("apto_adopcion") == "si" ? "checked":"") }}>Si
                        </label>
                    </div>
                    <div class="radio">
                        <label class="control-label">
                            <input type="radio" name="apto_adopcion" value="no" {{ (old("apto_adopcion") == "no" ? "checked":"") }}>No
                        </label>
                    </div>
                </div>
                <div class="form-group {{ ($errors->has('clase'))?"has-error":"" }}">
                    <label>Clase</label>
                    <select name="clase" class="form-control" id="clase">
                        <option value="">Seleccione una Clase</option>
                        @foreach($tipos as $clase)
                            <option value="{{$clase->id}}" {{ (old("clase") == $clase->id ? "selected":"") }}>{{$clase->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{ ($errors->has('raza'))?"has-error":"" }}">
                    <label>Raza</label>
                    <select name="raza" class="form-control" id="raza">
                        <option value="">Seleccione una Raza</option>
                    </select>
                </div>
                <div class="btn btn-group">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a href="{{ route("mascotas") }}"><button type="button" class="btn btn-primary">Cancelar</button></a>
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
            $("#raza").prop('disabled', true);
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