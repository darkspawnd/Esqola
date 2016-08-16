@extends('layouts/__admin')
@section('content')
    <div class="ui text menu">
        <a class="item" href="{!! action('Admin\HomeworksController@index') !!}">
            <button class="ui button basic active"><i class="icon angle left ui"></i>Regresar</button>
        </a>
        <div class="right menu">
            <div class="item">
                <h5 class="ui header"> {!! Breadcrumbs::renderIfExists() !!}</h5>
            </div>
        </div>
    </div>

    <form method="post" class="ui form error" role="form" action="{!! action('Admin\ScoresController@create') !!}" onsubmit="return getStudents()">
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
                Agregar Notas
            </div>
        </div>
        <div class="ui segment">
            @include ('_partials.formerrors')
            @if(isset($status))
                <div class="ui {{$status->created}} message">
                    <li>{{ $status->message }}</li>
                </div>
            @endif
                {!! csrf_field() !!}
                <div class="ui grid">
                   <div class="four column row">
                       <div class="required field column">
                           <label class="ui"> Grado </label>
                           <select name="materia" id='grade' class="ui search fluid dropdown">
                               <option value=""> Grados </option>
                               @foreach($grades as $grade)
                                   <option value="{{{ $grade->uuid }}}"> {{{ $grade->name }}} </option>
                               @endforeach
                           </select>
                       </div>
                       <div class="required field column">
                           <label class="ui"> Materia </label>
                           <select name="materia" class="ui search fluid dropdown">
                               <option value=""> Materia </option>
                               @foreach($courses as $course)
                                   <option value="{{{ $course->uuid }}}"> {{{ $course->name }}} </option>
                               @endforeach
                           </select>
                       </div>
                       <div class="required field column">
                           <label class="ui"> Unidad </label>
                           <select name="materia" class="ui search fluid dropdown">
                               <option value=""> Unidades </option>
                               @foreach($units as $unit)
                                   <option value="{{{ $unit->id }}}"> {{{ $unit->common_name }}} </option>
                               @endforeach
                           </select>
                       </div>
                       <div class="field column">
                           <label class="ui"> Tareas </label>
                           <select name="materia" class="ui search fluid dropdown">
                               <option value=""> Tareas </option>
                               @foreach($homeworks as $homework)
                                   <option value="{{{ $homework->id  }}}"> {{{ $homework->title }}} </option>
                               @endforeach
                           </select>
                       </div>
                   </div>
                </div>
                <div class="ui grid">
                    <div class="field align-to-right sixteen column">
                        <button class="ui button orange active submit disabled">
                            Continuar <i class="icon chevron right"></i>
                        </button>
                    </div>
                </div>



        </div>
    </div>
    <div class="ui segment" id="studentlist">
        <table class="ui fixed table" id="users-table">
            <thead>
            <th class="collapsing">Alumno</th>
            <th class="collapsing">Nota</th>
            </thead>
            <tbody id="studentstable">
            </tbody>
        </table>
    </div>
    </form>
    <script type="application/javascript">
        $('.scores-home').addClass('active');
        $('.ui.dropdown')
                .dropdown({
                    allowAdditions: true,
                    onChange: function (value, text) {
                        var selected = $('.ui.dropdown').dropdown('get value'),
                            enable = false,
                            finished = false;
                        for(var i = 0; i < selected.length - 1; i++) {
                            if(selected[i] != '' && !finished) {
                                enable = true;
                            }
                            else {
                                enable = false;
                                finished = true;
                            }

                        }
                        if(enable)
                            $('button.disabled').removeClass('disabled');
                        else
                            $('button.disabled').addClass('disabled');
                    }
                })
        ;
        function getStudents() {
            $.ajax({
                URL: '{!! action('Admin\ScoresController@getStudents') !!}',
                method: 'post',
                datatype: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'grade': $('#grade').dropdown('get value')[0]
                },
                success: function (students) {

                    $('.button.submit').removeClass('loading');

                    var table = $('#studentstable');
                    var students = jQuery.parseJSON(students);

                    if(students.length > 0) {
                        $(table).find('tr').remove();
                    } else {
                        $(table).find('tr').remove();
                        var row = document.createElement('tr');
                        var nameCell = document.createElement('td');
                        var inputCell = document.createElement('td');

                        nameCell.innerHTML = 'No hay resultados.';

                        $(row).append(nameCell);
                        $(row).append(inputCell);
                        $(table).append(row);
                    }

                    for (var i = 0; i < students.length; i++) {
                        var row = document.createElement('tr');
                        var nameCell = document.createElement('td');
                        var inputCell = document.createElement('td');

                        nameCell.innerHTML = students[i].name;

                        $(row).append(nameCell);
                        $(row).append(inputCell);
                        $(table).append(row);
                    }

                }
            });
            return false;
        }
    </script>
@endsection