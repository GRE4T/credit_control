@extends('layouts.master')
@section('main-content')

    <form action="{{  route('paymentsreceived.store')  }}" method="POST">

        <div class="card">
            <div class="card-header bg-primary text-white h5">
                Añadir nuevo pago recibido
            </div>
            @include('pages.paymentsreceived.form')
            <div class="card-footer text-right">
                <button type="submit" class="btn  btn-primary m-1">Guardar</button>
                <a href="{{ route('paymentsreceived.index') }}" class="btn btn-outline-secondary m-1">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
