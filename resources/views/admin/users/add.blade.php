@extends('layouts/__admin')
@section('content')
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
               Agregar Usuario
            </div>
        </div>
        <div class="ui segment">
            @if(count($errors) > 0)
                <div class="ui error message">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </div>
            @endif
            @if(isset($status))
                <div class="ui {{$status->created}} message">
                    <li>{{ $status->message }}</li>
                </div>
            @endif
            <form method="post" class="ui form error" role="form" action="{!! action('Admin\UsersController@createUser') !!}">
                {!! csrf_field() !!}
                <div class="two fields">
                    <div class="required field">
                        <label class="ui"> Nombre </label>
                        <input type="text" name="Nombre" value="{{ old('Nombre') }}">
                    </div>
                    <div class="required field">
                        <label class="ui"> Apellido </label>
                        <input type="text" name="Apellido" value="{{ old('Apellido') }}">
                    </div>
                </div>
                <div class="two fields">
                    <div class="required field">
                        <label class="ui"> Email </label>
                        <input type="text" name="Email" value="{{ old('Email') }}">
                    </div>
                    <div class="field">
                        <label class="ui"> Teléfono </label>
                        <input type="number" name="Telefono" value="{{ old('Telefono') }}">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label class="ui"> Dirección </label>
                        <input type="text" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="field">
                        <label class="ui"> Edad </label>
                        <input type="number" name="Edad" value="{{ old('Edad') }}">
                    </div>
                </div>
                <div class="two fields">
                    <div class="required field">
                        <label class="ui"> Contraseña (6 caracteres mínimo) </label>
                        <input type="password" name="Contraseña">
                    </div>
                    <div class="required field">
                        <label class="ui"> Confirmar Contraseña </label>
                        <input type="password" name="Contraseña_confirmation">
                    </div>
                </div>
                <div class="field">
                    <label>Rol</label>
                    <select class="ui dropdown" name="role">
                        <option class="ui" value="student">Estudiante</option>
                        <option class="ui" value="teacher">Maestro</option>
                    </select>
                </div>
                <div class="field align-to-right">
                    <button class="ui basic button">
                        <i class="icon add"></i>Añadir
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script type="application/javascript">
        $('.users-home').addClass('active');
    </script>
@endsection