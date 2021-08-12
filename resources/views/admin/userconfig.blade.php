@extends('plantilla.plantilla')

@section('titulo','Configuración del Usuario')


@section('crudtitulo')
<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-lock"></i>&nbsp; Editar credenciales de usuario</li>
@endsection

@section('contenido')
@if (session('error'))
   <div class="alert alert-danger">
      {{ session('error') }}
    </div>
@endif
@if (session('success'))
   <div class="alert alert-success">
    {{ session('success') }}
   </div>
@endif

<form method='POST' action="{{ route('admin.updateUserPassword') }}">
{{ csrf_field() }}

                    <div class="form-group">
                            <label for="new-password" class="col-md-4 control-label">Nombre de Usuario</label>

                            <div class="col-md-6">
                                <input value="{{ Auth::user()->name }}" type="text"  autocomplete="off" class="form-control" name="current-password" disabled>

                            </div>
                        </div>
        
                    <div class="form-group">
                            <label for="new-password" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input value="{{ Auth::user()->email }}" type="text"  autocomplete="off" class="form-control" name="current-password" disabled>

                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Contraseña actual*</label>

                            <div class="col-md-6">
                                <input id="current-password" value="{{old('current-password')}}" type="password"  autocomplete="off" class="form-control" name="current-password" required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Nueva contraseña*</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" value="{{old('new-password')}}" autocomplete="off" class="form-control" name="new-password" required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirmar nueva contraseña*</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password"  autocomplete="off" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>

    <br>
    <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Actualizar</button>
    <a href="{{ route('admin.cancelar','admin') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    
</form>
@endsection

@section('js')
    <script>

     
    </script>
@endsection