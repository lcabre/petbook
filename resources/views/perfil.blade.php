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
            </div>
            <div class="fila">
                <div class="name">Nombre</div>
                <div class="dato">
                    <span> @if($perfil->nombre) {{ $perfil->nombre }} @else No ingresado @endif</span>
                    <div class="edit">Editar</div>
                </div>
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
            asdasd
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

            $(".fecha_nacimiento").datepicker({
                isRTL: false,
                format: 'dd-mm-yyyy',
                startView: 2,
                minViewMode: 0,
                autoclose:true,
                language: 'es'
            });

            $(".edit").click(function () {
               // console.log($(this).parent());
               $(this).parent().hide();
               $(this).parent().parent().find(".editdato").show();
            });

            $(".cancel").click(function () {
                // console.log($(this).parent());
                $(this).parent().hide();
                $(this).parent().parent().find(".dato").show();
            });

            $(".editdato .edit").click(function () {
                var parent = $(this).parent();

                if(parent.parent().find(".name").text()=="Sexo"){
                    var data = $(this).parent().find("select").serialize();
                }else{
                    var data = $(this).parent().find("input").serialize();
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
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
                        console.log(data);
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