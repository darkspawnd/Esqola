@extends('layouts.__admin')
@section('content')
    <div class="ui secondary pointing menu">
        <a class="active item" href="{!! action('Admin\HomeworksController@index') !!}">
            Tareas
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
                Tareas
            </div>
            <a class="ui icon labeled item right aligned primary" href="{!! action('Admin\ScoresController@add') !!}">
                <i class="icon add"></i>
                Agregar
            </a>
        </div>
        <div class="ui segment">
            <table class="ui fixed table" id="users-table">
                <thead>
                <th class="collapsing">#</th>
                <th>Tareas</th>
                <th class="collapsing">Acciones</th>
                </thead>
                <tbody>
                @foreach($scores as $key => $score)
                    <tr>
                        <td> {{{ $key+1 }}} </td>
                        <td> {{{ $score->title }}} </td>
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
                                    <div class="item" data-value="{!! action('Admin\HomeworksController@edit',['id'=>$homework_current->id]) !!}">
                                        Editar
                                    </div>
                                    <div class="item" data-value="{!! action('Admin\HomeworksController@remove',['id'=>$homework_current->id]) !!}">
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
        $('.scores-home').addClass('active');
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