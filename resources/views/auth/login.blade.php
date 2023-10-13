@extends('layouts.auth')

@section('main-content')
<div class="auth-content">
    <div class="o-hidden">
        <div class="row">
            <div class="col-md-12">
                <div class="p-4">
                    <div class="auth-logo text-center mb-4">
                        <img src="{{asset('assets/images/logo_random.png')}}" alt="">
                    </div>
                    <h1 class="mb-3 p-2 text-18 bg-primary text-white rounded rounded-pill text-center">
                        Nombre Web Site</h1>
                    @if (session('register-success'))
                    <div class="alert alert-card alert-success" role="alert">
                        <strong class="text-capitalize">Mensaje: </strong> {{ session('register-success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Correo electronico</label>
                            <input id="email" type="email" class="form-control form-control-rounded @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-rounded btn-primary btn-block mt-2">Entrar</button>

                    </form>

                    <p class="mt-3 mb-2 text-center load"> -- O -- </p>
                    <div class="mt-3 text-center">
                        <a href="{{ route('password.forgot') }}" class="text-muted"><u>¿Olvidaste tu contraseña?</u></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
