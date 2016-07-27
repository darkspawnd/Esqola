@extends('layouts.__admin')
@section('content')
    <div class="ui text menu">
        <a class="item" href="{!! action('Admin\HomeworksController@index') !!}">
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
                Agregar Tarea
            </div>
        </div>
        <div class="ui segment">
            @include ('_partials.formerrors')
            @if(isset($status))
                <div class="ui {{$status->created}} message">
                    <li>{{ $status->message }}</li>
                </div>
            @endif
            <form method="post" class="ui form error" role="form" action="{!! action('Admin\HomeworksController@create') !!}">
                    {!! csrf_field() !!}
                <div class="field">
                    <label>Maestro</label>
                    <select id="teacher" class="ui dropdown normal" name="teacher">
                        @foreach($teachers as $teacher)
                            @foreach($teacher as $name)
                            <option class="ui" value="{{{$name->id}}}">{{{$name->name}}}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="required field">
                    <label class="ui"> Tarea </label>
                    <input type="text" name="homework" value="{{ old('homework') }}">
                </div>
                <div class="field align-to-right">
                    <button class="ui button orange active submit">
                        <i class="icon add"></i>Añadir
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script type="application/javascript">
        $('.homeworks-home').addClass('active');
        $(document).ready(function(){
            $('#teacher').change(function(){
                var teacher, token, url, data;
                token = $('input[name=_token]').val();
                teacher = $('#teacher').val();
                url = '{{route('getadd')}}';
                data = {teacher: teacher};
                $('#relaciones').empty();
                $.ajax({
                    url: url,
                    headers: {'X-CSRF-TOKEN': token},
                    data: data,
                    type: 'POST',
                    datatype: 'JSON',
                    success: function (resp) {
                        $.each(resp.relaciones, function (key, value) {
                            $('#relaciones').append('<option>'+ value.nombre_subramo +'</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection