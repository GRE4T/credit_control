@extends('layouts.master')
@section('main-content')
<form
  action="{{ isset($certificate->id) ? route('certificates.update', $certificate->id ) : route('certificates.store') }}"
  method="POST">
  <div class="card">
    <div class="card-header bg-primary text-white h5">
      @if (isset($certificate->id))
      @method('PATCH')
      Editar certificado
      @else
      Añadir nuevo certificado
      @endif
    </div>
    <div class="card-body">
      @csrf
      <div class="form-row">

        <div class="form-group col-12">
          <label for="client_id">Cliente<span class="text-danger">*</span> </label>
          <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror">
            <option selected disabled>Seleccione un cliente</option>
            @foreach ($clients as $client)
            <option value="{{ $client->id }}" @if(old('client_id') && old('client_id')==$client->id) selected
              @elseif($certificate->client_id == $client->id) selected @endif >
              {{ $client->name }}</option>
            @endforeach
          </select>
          @error('client_id')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="provider_id">Proveedor<span class="text-danger">*</span> </label>
          <select name="provider_id" id="provider_id" class="form-control @error('provider_id') is-invalid @enderror">
            <option selected disabled>Seleccione un proveedor</option>
            @foreach ($providers as $provider)
            <option value="{{ $provider->id }}" @if(old('provider_id') && old('provider_id')==$provider->id) selected
              @elseif($certificate->provider_id == $provider->id) selected @endif >
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
          <label for="domain_id">Dominio<span class="text-danger">*</span> </label>

          <select name="domain_id" id="domain_id" class="form-control @error('domain_id') is-invalid @enderror">
            <option selected disabled>Seleccione un dominio</option>
            @foreach ($domains as $domain)
            <option value="{{ $domain->id }}" @if(old('domain_id') && old('domain_id')==$domain->id) selected
              @elseif($certificate->domain_id == $domain->id) selected @endif >
              {{ $domain->domain }}</option>
            @endforeach
          </select>
          @error('domain_id')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="IP_address">Dirección IP<span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('IP_address') is-invalid @enderror" name="IP_address"
            id="IP_address" value="{{ old('IP_address') ? old('IP_address') : $certificate->IP_address }}" required>
          @error('IP_address')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="type">Tipo de certificado <span class="text-danger">*</span> </label>
          <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" id="type"
            value="{{ old('type') ? old('type') : $certificate->certificate }}" required>
          @error('type')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="certificate">Certificado</label>
          <textarea name="certificate" id="certificate" class="form-control @error('certificate') is-invalid @enderror"
            cols="30" rows="10">{{ old('certificate') ? old('certificate') : $certificate->certificate }}</textarea>
          @error('certificate')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="private_key">Private Key <span class="text-danger">*</span> </label>
          <textarea name="private_key" id="private_key" class="form-control @error('private_key') is-invalid @enderror"
            cols="30" rows="10">{{ old('private_key') ? old('private_key') : $certificate->private_key }}</textarea>
          @error('private_key')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-12">
          <label for="CA_bundle">CA bundle </label>
          <textarea name="CA_bundle" id="CA_bundle" class="form-control @error('CA_bundle') is-invalid @enderror"
            cols="30" rows="10">{{ old('CA_bundle') ? old('CA_bundle') : $certificate->CA_bundle }}</textarea>
          @error('CA_bundle')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="expiration_from">Fecha de registro<span class="text-danger">*</span> </label>
          <input type="date" class="form-control @error('expiration_from') is-invalid @enderror" name="expiration_from"
            id="expiration_from"
            value="{{ old('expiration_from') ? old('expiration_from') : $certificate->expiration_from }}" required>
          @error('expiration_from')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="expiration_to">Fecha de expiración<span class="text-danger">*</span> </label>
          <input type="date" class="form-control @error('expiration_to') is-invalid @enderror" name="expiration_to"
            id="expiration_to" value="{{ old('expiration_to') ? old('expiration_to') : $certificate->expiration_to }}"
            required>
          @error('expiration_to')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group col-12">
          <label for="annotations">Notas adicionales</label>
          <textarea name="annotations" id="annotations" class="form-control @error('annotations') is-invalid @enderror"
            cols="30" rows="10">{{ old('annotations') ? old('annotations') : $certificate->annotations }}</textarea>
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
      <a href="{{ url('/certificates')}}" class="btn btn-outline-secondary m-1">Cancelar</a>
    </div>
  </div>
</form>
@endsection