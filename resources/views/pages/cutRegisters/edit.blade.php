@extends('layouts.master')
@section('main-content')

    <form action="{{  route('cut-registers.update', $cutRegister->id)  }}" method="POST">
        @method('PATCH')
        <div class="card">
            <div class="card-header bg-primary text-white h5">
                Editar registro de corte
            </div>
            @include('pages.cutRegisters.form')
            <div class="card-footer text-right">
                <button type="submit" class="btn  btn-primary m-1">Actualizar</button>
                <a href="{{ route('cut-registers.index') }}" class="btn btn-outline-secondary m-1">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
@section('bottom-js')
    @stack('stack-script')
@endsection
