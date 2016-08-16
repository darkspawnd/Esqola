@extends('layouts/__admin')
@section('content')
    <div class="ui secondary pointing menu">
        <a class="active item">
            Usuarios
        </a>
        <a class="item" href="{!! action('Admin\GradesController@index') !!}">
            Grados
        </a>
        <a class="item" href="{!! action('Admin\CoursesController@index') !!}">
            Materias
        </a>
        <a class="item" href="{!! action('Admin\UnitController@index') !!}">
            Unidades
        </a>
        <div class="right menu">
            <div class="item">
                <h5 class="ui header"> {!! Breadcrumbs::renderIfExists() !!}</h5>
            </div>
        </div>
    </div>
    <div class="ui segments ">
        <div class="ui menu attached icon labeled aligned">
            <div class="ui header item borderless">
                Usuarios
            </div>
            <div class="right icon menu">
                <a class="ui icon labeled item right aligned primary" href="{!! action('Admin\UsersController@addUser') !!}">
                    <i class="icon add"></i>
                    Agregar
                </a>
                <div class="ui dropdown icon item" id="exceloptions">
                    <i class="icon teal  file excel outline"></i>
                    Excel
                    <div class="ui dropdown menu">
                        <a class="item" data-value="{!! action('Admin\UsersController@exportExcel') !!}">Exportar</a>
                        <a class="item" data-value="{!! action('Admin\UsersController@importExcel') !!}">Importar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui segment">
            <table class="ui fixed table selectable" id="users-table">
                <thead>
                    <th class="collapsing">#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="collapsing">Acciones</th>
                </thead>
                <tbody>
                    @foreach($users as $key => $current_user)
                        @if(!$current_user->hasRole('admin'))
                        <tr>
                            <td> {{{ $key+1 }}} </td>
                            <td> {{{ $current_user->full_name() }}} </td>
                            <td> {{{ $current_user->email }}} </td>
                            <td> {{{ $current_user->roles()->pluck('name') }}} </td>
                            <td>
                                <div class="ui floating labeled icon dropdown button" id="yesnodelete">
                                    <i class="wizard icon"></i>
                                    <span class="text">Acciones</span>
                                    <div class="menu">
                                        <div class="header">
                                            <i class="list layout icon"></i>
                                            Opciones
                                        </div>
                                        <div class="divider"></div>
                                        <div class="item" data-value="{!! action('Admin\UsersController@editUser',['uuid'=>$current_user->uuid]) !!}">
                                            Configuración
                                        </div>
                                        <div class="item" data-value="{!! action('Admin\UsersController@removeUser',['uuid'=>$current_user->uuid]) !!}">
                                            Eliminar
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
                Roles
            </div>
        </div>
        <div class="ui segment">
            <table class="ui fixed table selectable">
                <thead>
                <th class="collapsing">#</th>
                <th>Rol</th>
                </thead>
                <tbody>
                @foreach($roles as $key => $current_role)
                    <tr>
                        <td> {{{ $key+1 }}} </td>
                        <td> {{{ $current_role->name }}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="ui modal small" id="yesnodeletemodal">
        <div class="header">¿Desea continuar?</div>
        <div class="actions">
            <div class="ui cancel onDeny button">Cancelar</div>
            <div class="ui approve red button">Eliminar</div>
        </div>
    </div>
    <div class="ui modal small" id="importexcelmodal">
        <div class="header">Carga de Excel</div>
        <div class="content">
            <form method="post" id="excelsubmission">
                {!! csrf_field() !!}
                <input type="file" name='exceldocument' id="exceldocument" accept="application/vnd.ms-excel"/>
            </form>
        </div>
        <div class="actions">
            <div class="ui cancel onDeny button">Cancelar</div>
            <div class="ui approve green button">Añadir</div>
        </div>
    </div>
    <script type="application/javascript">
        $('.users-home').addClass('active');
        $('.ui.dropdown#yesnodelete').dropdown({
            onChange: function (value, text) {
                if(text === 'Eliminar') {
                    $('#yesnodeletemodal').modal('setting', {
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
        $('.ui.dropdown#exceloptions').dropdown({
            onChange: function (value, text) {
                if(text === 'Importar') {
                    $('#importexcelmodal').modal('setting', {
                        closable: false,
                        onApprove: function () {
                            var formdata = new FormData($('#excelsubmission')[0]);
                            $.ajax({
                                url: value,
                                type: 'post',
                                data: formdata,
                                success: function (data) {
                                    console.log(data);
                                },
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                            return false;
                        }
                    }).modal('show');
                }else if('Exportar'){
                    window.open(value);
                }
            }
        });
    </script>
@endsection