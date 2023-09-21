@extends('layouts.master')
@section('main-content')
<form action="{{ isset($user->id) ? route('users.update', $user->id ) : route('users.store') }}" method="POST">
    <div class="card">
        <div class="card-header bg-primary text-white h5">
            @if (isset($user->id))
            @method('PATCH')
            Editar usuario
            @else
            Añadir nuevo usuario
            @endif
        </div>
        <div class="card-body">
            @csrf
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ? old('name') : $user->name }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="email">Correo electrónico <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') ? old('email') : $user->email }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="username">Nombre de usuario <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') ? old('username') : $user->username }}" required>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="role">Rol<span class="text-danger">*</span> </label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                        <option selected disabled>Seleccione un rol</option>
                        @foreach ($roles as $item)
                        <option value="{{ $item->id }}" @if(old('role') && old('role') == $item->id) selected @elseif($user->role_id == $item->id) selected @endif >
                            {{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="password">Contraseña <span class="text-danger">*</span> </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"  @if (!isset($user->id)) required @endif>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12 mt-2">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" @if($user->active) checked @endif>
                        <label class="custom-control-label" for="active">Activar</label>
                    </div>
                </div>
                @if (!isset($user->id))
                <div class="form-group col-12 mt-2">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="verified" name="verified" value="1">
                        <label class="custom-control-label" for="verified">Registrar como verificado</label>
                    </div>
                </div>
                @endif

            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn  btn-primary m-1">Guardar</button>
            <a href="{{ url('/users')}}" class="btn btn-outline-secondary m-1">Cancelar</a>
        </div>
    </div>
</form>
@endsection