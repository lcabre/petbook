@extends('layouts.MasterPerfil')

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
                <img src="/img/defaul_perfil_img.jpg" alt="">
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
            <div class="fila">
                <div class="name">Email</div>
                <div class="dato">
                    <span>{{ Auth::user()->email }}</span>
                    <div class="edit">Editar</div>
                </div>
                <div class="editdato">
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                    <div class="edit">Editar</div>
                    <div class="cancel">Cancelar</div>
                </div>
                <div class="error alert alert-danger"></div>
            </div>
            <div class="fila">
                <div class="name">Nombre</div>
                <div class="dato">
                    <span> @if($perfil->nombre) {{ $perfil->nombre }} @else No ingresado @endif</span>
                    <div class="edit">Editar</div>
                </div>
                <div class="error alert alert-danger"></div>
                <div class="editdato">
                    <input type="text" class="form-control" name="nombre" value="{{ $perfil->nombre }}">
                    <div class="edit">Editar</div>
                    <div class="cancel">Cancelar</div>
                </div>
            </div>
            <div class="fila">
                <div class="name">Domicilio</div>
                <div class="dato">
                    <span> @if($perfil->domicilio) {{ $perfil->domicilio }} @else No ingresado @endif</span>
                    <div class="edit">Editar</div>
                </div>
                <div class="error alert alert-danger"></div>
                <div class="editdato">
                    <input type="text" class="form-control" name="domicilio" value="{{ $perfil->domicilio }}">
                    <div class="edit">Editar</div>
                    <div class="cancel">Cancelar</div>
                </div>
            </div>
            <div class="fila">
                <div class="name">Telefono</div>
                <div class="dato">
                    <span> @if($perfil->telefono) {{ $perfil->telefono }} @else No ingresado @endif</span>
                    <div class="edit">Editar</div>
                </div>
                <div class="error alert alert-danger"></div>
                <div class="editdato">
                    <input type="text" class="form-control" name="telefono" value="{{ $perfil->telefono }}">
                    <div class="edit">Editar</div>
                    <div class="cancel">Cancelar</div>
                </div>
            </div>
            <div class="fila">
                <div class="name">Sexo</div>
                <div class="dato">
                    <span> @if($perfil->sexo) {{ $perfil->sexo }} @else No ingresado @endif</span>
                    <div class="edit">Editar</div>
                </div>
                <div class="error alert alert-danger"></div>
                <div class="editdato">
                    <select class="selectpicker" name="sexo">
                        <option value=""  @if($perfil->sexo=="") selected @endif>Seleccione su Sexo</option>
                        <option value="M" @if($perfil->sexo=="M") selected @endif>M</option>
                        <option value="F" @if($perfil->sexo=="F") selected @endif>F</option>
                    </select>
                    <div class="edit">Editar</div>
                    <div class="cancel">Cancelar</div>
                </div>
            </div>
            <div class="fila">
                <div class="name">Fecha de Nacimiento</div>
                <div class="dato">
                    <span>
                        @if($perfil->fecha_nacimiento)
                            {{ $perfil->fecha_nacimiento->format('d-m-Y') }}
                        @else
                            No ingresado
                        @endif
                    </span>
                    <div class="edit">Editar</div>
                </div>
                <div class="error alert alert-danger"></div>
                <div class="editdato">
                    <input type="text" class="form-control fecha_nacimiento" name="fecha_nacimiento" value="@if($perfil->fecha_nacimiento){{ $perfil->fecha_nacimiento->format('d-m-Y') }}@endif">
                    <div class="edit">Editar</div>
                    <div class="cancel">Cancelar</div>
                </div>
            </div>
         </div>
    </div>
    <div class="generalbox rounded-border">
        <h1>Imagen de Perfil</h1>
        <div class="content">
            <form action="" name="form" class="perfil_form">
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