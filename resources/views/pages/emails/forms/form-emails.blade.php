@extends('layouts.master')
@section('main-content')
<form action="{{ isset($email->id) ? route('emails.update', $email->id ) : route('emails.store') }}" method="POST">
  <div class="card">
    <div class="card-header bg-primary text-white h5">
      @if (isset($email->id))
      @method('PATCH')
      Editar correo
      @else
      Añadir nuevo correo
      @endif
    </div>
    <div class="card-body">
      @csrf
      <div class="form-row">

        <div class="form-group col-12">
          <label for="type">Tipo de correo <span class="text-danger">*</span> </label>
          <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
            <option value="Free" @if(old('type') && old('type')=='Free' ) selected @elseif($email->type == 'Free')
              selected @endif >Correo gratuito</option>
            <option value="Pay" @if(old('type') && old('type')=='Pay' ) selected @elseif($email->type == 'Pay') selected
              @endif >Correo corporativo de pago</option>
          </select>
          @error('type')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="email">Correo electronico</label>
          <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
            value="{{ old('email') ? old('email') : $email->email }}" required>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="username">Usuario <span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username"
            value="{{ old('username') ? old('username') : $email->username }}" required>
          @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="password">Contraseña <span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
            value="{{ old('password') ? old('password') : $email->password }}" required>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="provider_id">
            Proveedor<span class="text-danger">*</span>
          </label>

          <select name="provider_id" id="provider_id" class="form-control @error('provider_id') is-invalid @enderror">
            <option selected disabled>Seleccione un proveedor</option>
            @foreach ($providers as $provider)
            <option value="{{ $provider->id }}" @if(old('provider_id') && old('provider_id')==$provider->id) selected
              @elseif($email->provider_id == $provider->id) selected @endif >
              {{ $provider->name }}</option>
            @endforeach
          </select>
          @error('provider_id')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="expiration_from">Fecha de registro<span class="text-danger">*</span> </label>
          <input type="date" class="form-control @error('expiration_from') is-invalid @enderror" name="expiration_from"
            id="expiration_from" value="{{ old('expiration_from') ? old('expiration_from') : $email->expiration_from }}"
            required>
          @error('expiration_from')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-12">
          <label for="expiration_to">Fecha de expiración<span class="text-danger">*</span> </label>
          <input type="date" class="form-control @error('expiration_to') is-invalid @enderror" name="expiration_to"
            id="expiration_to" value="{{ old('expiration_to') ? old('expiration_to') : $email->expiration_to }}"
            required>
          @error('expiration_to')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-12">
          <label for="url_access">URL de acceso<span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('url_access') is-invalid @enderror" name="url_access"
            id="url_access" value="{{ old('url_access') ? old('url_access') : $email->url_access }}" required>
          @error('url_access')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="security_question">Preguntas de seguridad</label>
          <textarea name="security_question" id="security_question"
            class="form-control @error('security_question') is-invalid @enderror" cols="30"
            rows="10">{{ old('security_question') ? old('security_question') : $email->security_question }}</textarea>
          @error('security_question')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="annotations">Notas adicionales</label>
          <textarea name="annotations" id="annotations" class="form-control @error('annotations') is-invalid @enderror"
            cols="30" rows="10">{{ old('annotations') ? old('annotations') : $email->annotations }}</textarea>
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
      <a href="{{ url('/emails')}}" class="btn btn-outline-secondary m-1">Cancelar</a>
    </div>
  </div>
</form>
@endsection