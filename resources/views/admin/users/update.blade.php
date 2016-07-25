@extends('layouts/__admin')
@section('content')
    <div class="ui text menu">
        <a class="item" href="{!! action('Admin\UsersController@index') !!}">
            <button class="ui button basic active"><i class="icon angle left ui"></i> Regresar</button>
        </a>
        <div class="right menu">
            <div class="item">
                <h5 class="ui header"> {!! Breadcrumbs::renderIfExists() !!}</h5>
            </div>
        </div>
    </div>
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
               Editar Usuario
            </div>
        </div>
        <div class="ui segment">
            @include ('_partials.formerrors')
            @if(isset($status))
                <div class="ui {{$status->created}} message">
                    <li>{{ $status->message }}</li>
                </div>
            @endif
            <form method="post" class="ui form error" role="form" action="{!! action('Admin\UsersController@updateUser') !!}">
                {!! csrf_field() !!}
                <h4 class="ui horizontal header divider">
                    General
                </h4>
                <input type="hidden" name="auth" value="{!! $update_user->uuid !!}"/>
                <div class="field">
                    <label class="ui"> Código </label>
                    <input type="text" name="bk" value="{{{ $update_user->BK or ""}}}">
                </div>
                <div class="required field">
                    <label class="ui"> Nombre </label>
                    <input type="text" name="Nombre" value="{{{ $update_user->name or ""}}}">
                </div>
                <div class="required field">
                    <label class="ui"> Apellido </label>
                    <input type="text" name="Apellido" value="{{{ $update_user->lastname or "" }}}">
                </div>
                <div class="required field">
                    <label class="ui"> Email </label>
                    <input type="text"  name="Email" value="{{{ $update_user->email or "" }}}">
                </div>
                <div class="field">
                    <label class="ui"> Teléfono </label>
                    <input type="number" name="Telefono" value="{{{ $update_user->telephone or "" }}}">
                </div>
                <div class="field">
                    <label class="ui"> Dirección </label>
                    <input type="text" name="address" value="{{{ $update_user->address or "" }}}">
                </div>
                <div class="field">
                    <label class="ui"> Edad </label>
                    <input type="number" name="Edad" value="{{{ $update_user->age or "" }}}">
                </div>
                <div class="field">
                    <label>Rol</label>
                    <select id="rol" class="ui dropdown normal" name="role" onchange="cambio()" selected="1">
                        <option class="ui" value="Estudiante">Estudiante</option>
                        <option class="ui" value="Maestro">Maestro</option>
                    </select>
                </div>
                <!-- Select Grado Estudiante-->
                <div id="gradeE" style="display:none;" class="field">
                    <label>Grado</label>
                    <select  class="ui dropdown normal" name="gradeStudent">
                        @foreach($grades as $grades)
                            <option class="ui" id="{{{$grades->id}}}" value="{{{$grades->name}}}">{{{$grades->name}}}</option>
                        @endforeach
                    </select>
                </div>
                <p id="show"></p>
                <!-- Select Grado Estudiante-->
                <!-- Select Grado Maestro-->
                <div id="gradeM" style="display:none;" class="ui form">
                    <div class="grouped fields">
                        <div class="field">
                            @foreach($grados as $grad)
                                <div class="ui checkbox">
                                    <input type="checkbox" id="one" name="gradesTeacher[]" value="{{{$grad->name}}}">
                                    <label>{{{$grad->name}}}</label>
                                </div>
                                </br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Select Grado Mestro-->
                <h4 class="ui horizontal header divider">Información </h4>
                <div class="field">
                    <label class="ui"> Encargado </label>
                    <input type="text" name="encargado" value="{{{ $update_user->attribute->incharge  }}}">
                </div>
                <div class="field">
                    <label class="ui"> Información encargado </label>
                    <textarea rows="2" name="infoEncargado">{{{$update_user->attribute->incharge_info}}}</textarea>
                </div>
                <div class="field align-to-right">
                    <button class="ui basic submit button">
                        <i class="icon add"></i>Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script type="application/javascript">
        $('.users-home').addClass('active');

        function cambio(){
            var x = document.getElementById("rol").value;
            if (x == 'Estudiante')
            {
                document.getElementById('gradeE').style.display = "block";
                document.getElementById('gradeM').style.display = "none";
                //document.getElementById("show").innerHTML = "You selected: " + x;
            }
            if (x == 'Maestro')
            {
                document.getElementById('gradeE').style.display = "none";
                document.getElementById('gradeM').style.display = "block";
                //document.getElementById("show").innerHTML = "You selected: " + x;
            }
        }
    </script>
@endsection