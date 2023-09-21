@extends('layouts.master')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('message'))
            <div class="alert alert-card alert-success" role="alert">
                <strong class="text-capitalize">Mensaje: </strong> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card mb-4 o-hidden">
                <img class="card-img-top img-fluid" src="{{asset('assets/images/photo-wide-3.jpg')}}" alt="">
                <div class="card-body">
                    <h5 class="card-title">Verificación de correo electrónico</h5>
                    <p class="card-text">Antes de continuar, compruebe su correo electrónico para ver si hay un enlace de verificación.</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Haga click aquí para solicitar otro</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection