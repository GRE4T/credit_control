@extends('layouts.master')
@section('main-content')

    <form action="{{  route('headquarters.store')  }}" method="POST">

        <div class="card">
            <div class="card-header bg-primary text-white h5">
                Añadir nueva sede
            </div>
            @include('pages.headquarters.form')
            <div class="card-footer text-right">
                <button type="submit" class="btn  btn-primary m-1">Guardar</button>
                <a href="{{ route('headquarters.index') }}" class="btn btn-outline-secondary m-1">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
