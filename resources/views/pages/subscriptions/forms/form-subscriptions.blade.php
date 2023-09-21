@extends('layouts.master')
@section('main-content')
<form action="{{ isset($subscription->id) ? route('subscriptions.update', $subscription->id ) : route('subscriptions.store') }}" method="POST">
  <div class="card">
    <div class="card-header bg-primary text-white h5">
      @if (isset($subscription->id))
      @method('PATCH')
      Editar suscripción
      @else
      Añadir nueva suscripción
      @endif
    </div>
    <div class="card-body">
      @csrf
      <div class="form-row">


        <div class="form-group col-12">
          <label for="username">Usuario <span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username"
            value="{{ old('username') ? old('username') : $subscription->username }}" required>
          @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="password">Contraseña <span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
            value="{{ old('password') ? old('password') : $subscription->password }}" required>
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
              @elseif($subscription->provider_id == $provider->id) selected @endif >
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
          <label for="cost">Precio </label>
          <input type="number" class="form-control @error('cost') is-invalid @enderror"
              name="cost" id="cost"
              value="{{ old('cost') ? old('cost') : $subscription->cost }}"
              min="0">
          @error('cost')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="days">Días </label>
          <input type="number" class="form-control @error('days') is-invalid @enderror"
              name="days" id="days"
              value="{{ old('days') ? old('days') : $subscription->days }}"
              min="0">
          @error('days')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="expiration_from">Fecha de registro<span class="text-danger">*</span> </label>
          <input type="date" class="form-control @error('expiration_from') is-invalid @enderror" name="expiration_from"
            id="expiration_from" value="{{ old('expiration_from') ? old('expiration_from') : $subscription->expiration_from }}"
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
            id="expiration_to" value="{{ old('expiration_to') ? old('expiration_to') : $subscription->expiration_to }}"
            required>
          @error('expiration_to')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-12">
          <label for="url">URL<span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('url') is-invalid @enderror" name="url"
            id="url" value="{{ old('url') ? old('url') : $subscription->url }}" required>
          @error('url')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="annotations">Notas adicionales</label>
          <textarea name="annotations" id="annotations" class="form-control @error('annotations') is-invalid @enderror"
            cols="30" rows="10">{{ old('annotations') ? old('annotations') : $subscription->annotations }}</textarea>
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
      <a href="{{ url('/subscriptions')}}" class="btn btn-outline-secondary m-1">Cancelar</a>
    </div>
  </div>
</form>
@endsection