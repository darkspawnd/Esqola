@extends('layouts/__admin')
@section('content')
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
               Editar Usuario
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
            <form method="post" class="ui form error" role="form" action="{!! action('Admin\UsersController@updateUser') !!}">
                {!! csrf_field() !!}
                <div class="two fields">
                    <div class="required field">
                        <label class="ui"> Nombre </label>
                        <input type="text" name="Nombre" value="{{{ $update_user->name or ""}}}">
                    </div>
                    <div class="required field">
                        <label class="ui"> Apellido </label>
                        <input type="text" name="Apellido" value="{{{ $update_user->lastname or "" }}}">
                    </div>
                </div>
                <div class="two fields">
                    <div class="required field">
                        <label class="ui"> Email </label>
                        <input type="text" readonly name="Email" value="{{{ $update_user->email or "" }}}">
                    </div>
                    <div class="field">
                        <label class="ui"> Teléfono </label>
                        <input type="number" name="Telefono" value="{{{ $update_user->telephone or "" }}}">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label class="ui"> Dirección </label>
                        <input type="text" name="address" value="{{{ $update_user->address or "" }}}">
                    </div>
                    <div class="field">
                        <label class="ui"> Edad </label>
                        <input type="number" name="Edad" value="{{{ $update_user->age or "" }}}">
                    </div>
                </div>
                <div class="field">
                    <label>Rol</label>
                    <select class="ui dropdown normal" name="role" selected="1">
                        <option class="ui" value="student">Estudiante</option>
                        <option class="ui" value="teacher">Maestro</option>
                    </select>
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
    </script>
@endsection