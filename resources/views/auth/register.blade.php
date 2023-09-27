@extends('layouts.auth')
@section('main-content')
<div class="auth-content">
    <div class="card o-hidden">
        <div class="row">
            <div style="display: none" class="col-md-6 text-center " style="background-size: cover;background-image: url({{asset('assets/images/photo-long-3.jpg')}})">
                <div class="pl-3 auth-right">
                    <div class="auth-logo text-center mt-4">
                        <img src="{{asset('assets/images/logo.png')}}" alt="">
                    </div>
                    <div class="flex-grow-1"></div>
                    <div class="w-100 mb-4">
                        <a class="btn btn-outline-primary btn-outline-email btn-block btn-icon-text btn-rounded" href="{{ route('login') }}">
                            <i class=" i-Mail-with-At-Sign"></i> Sign in with Email
                        </a>
                        <a class="btn btn-outline-primary btn-outline-google btn-block btn-icon-text btn-rounded">
                            <i class="i-Google-Plus"></i> Sign in with Google
                        </a>
                        <a class="btn btn-outline-primary btn-outline-facebook btn-block btn-icon-text btn-rounded">
                            <i class="i-Facebook-2"></i> Sign in with Facebook
                        </a>
                    </div>
                    <div class="flex-grow-1"></div>
                </div>
            </div>

            <div class="col-12">
                <div class="p-4">
                    <div class="auth-logo text-center mb-4">
                        <img src="{{asset('assets/images/icons/logo.png')}}" alt="">
                    </div>
                    <h1 class="mb-3 text-18">Registrarse</h1>
                    @if (session('register-error'))
                    <div class="alert alert-card alert-danger" role="alert">
                        <strong class="text-capitalize">Mensaje: </strong> {{ session('register-error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" type="text" class="form-control-rounded form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control-rounded form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Nombre de usuario</label>
                            <input id="username" type="text" class="form-control-rounded form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input id="password" type="password" class="form-control-rounded form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirmar contraseña</label>
                            <input id="password-confirm" type="password" class="form-control-rounded form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-rounded mt-3">Registrarse</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a class="text-muted" href="{{ url('login') }}"><u>Iniciar session</u></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
