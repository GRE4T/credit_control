@extends('layouts.master')
@section('main-content')
<form
  action="{{ isset($socialMedium->id) ? route('social-media.update', $socialMedium->id ) : route('social-media.store') }}"
  method="POST">
  <div class="card">

    <div class="card-header bg-primary text-white h5">
      @if (isset($socialMedium->id))
      @method('PATCH')
      Editar red social y/o plataforma
      @else
      Añadir nueva red social y/o plataforma
      @endif
    </div>
    <div class="card-body">
      @csrf
      <div class="form-row">
        <div class="form-group col-12">
          <label for="social_media">Red Social <span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('social_media') is-invalid @enderror" name="social_media"
            id="social_media" value="{{ old('social_media') ? old('social_media') : $socialMedium->social_media }}"
            required>
          @error('social_media')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-12">
          <label for="username">Nombre de usuario <span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username"
            value="{{ old('username') ? old('username') : $socialMedium->username }}" required>
          @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-12">
          <label for="password">Contraseña <span class="text-danger">*</span> </label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            id="password" value="{{ old('password') ? old('password') : $socialMedium->password }}" required>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-12">
          <label for="security_code">Código o pregunta de seguridad </label>
          <input type="text" class="form-control @error('security_code') is-invalid @enderror" name="security_code"
            id="security_code" value="{{ old('security_code') ? old('security_code') : $socialMedium->security_code }}">
          @error('security_code')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-12">
          <label for="password">Anotaciones </label>
          <textarea name="annotations" class="form-control" id=" annotations" cols="30" rows="10"
            value="{{ old('annotations') ? old('annotations') : $socialMedium->annotations }}" @error('annotations')
            is-invalid @enderror></textarea>
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
      <a href="{{ url('/social-media')}}" class="btn btn-outline-secondary m-1">Cancelar</a>
    </div>
  </div>
</form>
@endsection