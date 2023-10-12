@extends('layouts.master')
@section('main-content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @method('PATCH')
        <div class="card">
            <div class="card-header bg-primary text-white h5">
                Editar usuario
            </div>
            @include('pages.users.form')
            <div class="card-footer text-right">
                <button type="submit" class="btn  btn-primary m-1">Actualizar</button>
                <a href="{{ route('users.index')}}" class="btn btn-outline-secondary m-1">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
