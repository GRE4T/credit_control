@extends('layouts.master')
@section('main-content')
<form action="{{ isset($provider->id) ? route('providers.update', $provider->id ) : route('providers.store') }}"
    method="POST">
    <div class="card">
        <div class="card-header bg-primary text-white h5">
            @if (isset($provider->id))
            @method('PATCH')
            Editar proveedor
            @else
            Añadir nuevo proveedor
            @endif
        </div>
        <div class="card-body">
            @csrf
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Proveedor <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                        value="{{ old('name') ? old('name') : $provider->name }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label for="url_access">URL de acceso </label>
                    <input type="url" class="form-control @error('url_access') is-invalid @enderror" name="url_access"
                        id="url_access" value="{{ old('url_access') ? old('url_access') : $provider->url_access }}">
                    @error('url_access')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-12">
                    <label for="username">Nombre de usuario </label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                        id="username" value="{{ old('username') ? old('username') : $provider->username }}">
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label for="password">Contraseña </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" value="{{ old('password') ? old('password') : $provider->password }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label for="annotations">Notas adicionales</label>
                    <textarea name="annotations" id="annotations"
                        class="form-control @error('annotations') is-invalid @enderror" cols="30"
                        rows="10">{{ old('annotations') ? old('annotations') : $provider->annotations }}</textarea>
                    @error('annotations')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn  btn-primary m-1">Guardar</button>
            <a href="{{ url('/providers')}}" class="btn btn-outline-secondary m-1">Cancelar</a>
        </div>
    </div>
</form>
@endsection