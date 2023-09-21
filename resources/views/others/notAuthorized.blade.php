@extends('layouts.master')
@section('main-content')
<div class="not-found-wrap text-center">
        <h1 class="text-60">
            403
        </h1>
        <p class="text-36 subheading mb-3">!Error no autorizado!</p>
        <p class="mb-5  text-muted text-18">¡Lo siento! No puedes acceder a esta pagina</p>
        <a class="btn btn-lg btn-primary btn-rounded" href="{{url('home')}}">Regresar a escritorio</a>
    </div>
@endsection
