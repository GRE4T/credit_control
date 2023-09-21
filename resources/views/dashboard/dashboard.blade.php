@extends('layouts.master')

@section('main-content')
<div class="breadcrumb">
  <ul class="d-flex align-items-center">
    <li>
      <img height="50px" src="{{asset('assets/images/icons/escritorio.svg')}}" alt="">
    </li>
    <li class="h5 bold"> Escritorio</li>
  </ul>
</div>
<div class="row">
  <div class="col-lg-6 col-sm-12">
    <div class="card mb-4">
      <div class="card-header bg-primary text-white h5">
        Acceso rápido
      </div>
      <div class="card-body">
        <a class="btn btn-raised ripple btn-raised-secondary m-1" href="{{ route('domains.create')}}">Agregar
          dominios</a>
        <a class="btn btn-raised ripple btn-raised-secondary m-1" href="{{ route('clients.create')}}">Clientes</a>
        <a class="btn btn-raised ripple btn-raised-secondary m-1" href="{{ route('servers.create')}}">Servidores</a>
        <a class="btn btn-raised ripple btn-raised-secondary m-1" href="{{ route('user.profile')}}">Configuración</a>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-header bg-primary text-white h5">
        Sus servicios
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-icon mb-4">
              <div class="card-body text-center">
                <p class="lead text-22 m-0">{{ $domains->number_domains }}</p>
                <p class="text-muted mt-2 mb-2">Dominios</p>

              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-icon mb-4">
              <div class="card-body text-center">
                <p class="lead text-22 m-0">{{ $servers->number_servers }}</p>
                <p class="text-muted mt-2 mb-2">Servidores</p>

              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-icon mb-4">
              <div class="card-body text-center">
                <p class="lead text-22 m-0">{{ $clients->number_clients }}</p>
                <p class="text-muted mt-2 mb-2">Clientes</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-icon mb-4">
              <div class="card-body text-center">
                <p class="lead text-22 m-0">{{ $providers->number_providers }}</p>
                <p class="text-muted mt-2 mb-2">Proveedores</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-icon mb-4">
              <div class="card-body text-center">
                <p class="lead text-22 m-0">{{ $social_media->number_social_media }}</p>
                <p class="text-muted mt-2 mb-2">Redes Sociales</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-icon mb-4">
              <div class="card-body text-center">
                <p class="lead text-22 m-0">{{ $emails->number_emails }}</p>
                <p class="text-muted mt-2 mb-2">Correos electronicos</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-icon mb-4">
              <div class="card-body text-center">
                <p class="lead text-22 m-0">{{ $certificates->number_certificates }}</p>
                <p class="text-muted mt-2 mb-2">Certificados</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="card-title">Estadísticas y resumen dominios</div>
        <div id="echartPie" style="height: 300px;"></div>
      </div>
    </div>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header bg-primary text-white h5">
    Proximos a vencer
  </div>
  <div class="card-body">
    <div class="card-body">
      @include('pages.domains.domains-expires-soon')
      <hr>
      @include('pages.certificates.certificates-expires-soon')
      <hr>
      @include('pages.emails.emails-expires-soon')
      <hr>
      @include('pages.servers.servers-expires-soon')
      <hr>
      @include('pages.subscriptions.subscriptions-expires-soon')
    </div>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header bg-primary text-white h5">
    Servicios expirados
  </div>
  <div class="card-body">
    @include('pages.domains.domains-expired')
    <hr>
    @include('pages.certificates.certificates-expired')
    <hr>
    @include('pages.emails.emails-expired')
    <hr>
    @include('pages.servers.servers-expired')
    <hr>
    @include('pages.subscriptions.subscriptions-expired')
  </div>
</div>

@endsection

@section('page-js')
  <!-- Expired and expiring -->
  @stack('stack-script')
<script type="text/javascript">
  'use strict'


</script>
@endsection
