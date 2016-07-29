@extends('layouts/__admin')
@section('content')
    <div class="ui secondary pointing menu">
        <a class="active item">
            Contenidos
        </a>
        <div class="right menu">
            <div class="item">
                <h5 class="ui header"> {!! Breadcrumbs::renderIfExists() !!}</h5>
            </div>
        </div>
    </div>
    <div class="ui segments ">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
                Contenidos
            </div>
            <a class="ui icon labeled item right aligned primary" href="{!! action('Admin\ContentsController@add') !!}">
                <i class="icon add"></i>
                Agregar
            </a>
        </div>
        <div class="ui segment">
            <table class="ui fixed table selectable" id="users-table">
                <thead>
                <th class="collapsing">#</th>
                <th class="collapsing">Contenido</th>
                <th>Descripción</th>
                <th class="">Grado</th>
                <th class="collapsing">Materia</th>
                <th class="">Unidad</th>
                <th class="collapsing">Maestro</th>
                <th class="collapsing">Archivo</th>
                <th class="collapsing">Acciones</th>
                </thead>
                <tbody>
                @foreach($contents as $key => $content)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$content->title}} </td>
                        <td> {{$content->description}} </td>
                        <td> {{$content->grade}} </td>
                        <td> {{$content->course}} </td>
                        <td> {{$content->unit}} </td>
                        <td> {{$content->user}} </td>
                        <td> <a href="{{$content->file_path}}" target="_blank">Archivo</a> </td>
                        <td class="collapsing">
                            <div class="ui floating labeled icon dropdown button">
                                <i class="wizard icon"></i>
                                <span class="text">Acciones</span>
                                <div class="menu">
                                    <div class="header">
                                        <i class="list layout icon"></i>
                                        Opciones
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item" data-value="{!! action('Admin\UnitController@edit',['id'=>$content->id]) !!}">
                                        Editar
                                    </div>
                                    <div class="item" data-value="{!! action('Admin\ContentsController@remove',['uuid'=>$content->uuid]) !!}">
                                        Eliminar
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="ui modal small">
        <div class="header">¿Desea continuar?</div>
        <div class="actions">
            <div class="ui cancel onDeny button">Cancelar</div>
            <div class="ui approve red button">Eliminar</div>
        </div>
    </div>
    <script type="application/javascript">
        $('.contents-home').addClass('active');
        $('.ui.dropdown').dropdown({
            onChange: function (value, text) {
                if(text === 'Eliminar') {
                    $('.ui.modal').modal('setting', {
                        closable: false,
                        onApprove: function () {
                            window.location = value;
                        }
                    }).modal('show');
                }else {
                    window.location.href = value;
                }
            }
        });
    </script>
@endsection