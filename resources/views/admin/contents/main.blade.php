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
                <th class="collapsing">Usuario</th>
                <th>Log</th>
                <th>Descripción</th>
                <th class="collapsing">Tipo</th>
                <th class="collapsing">Fecha</th>
                </thead>
                <tbody>
                @foreach($contents as $key => $content)
                    <tr>
                        <td> {{$key+1}} </td>
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