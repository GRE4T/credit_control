@extends('layouts.auth')
@section('main-content')
<div class="auth-content">
    <div class="card o-hidden">
        <div class="row">
            <div class="col-12">
                <div class="p-4">
                    <div class="auth-logo text-center mb-4">
                        <img src="{{asset('assets/images/icons/logo.png')}}" alt="">
                    </div>
                    <h1 class="mb-3 text-18">Olvidaste tu contraseña</h1>
                    @if (session('status'))
                    <div class="alert alert-card alert-success" role="alert">
                        <strong class="text-capitalize">Mensaje: </strong> {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" class="form-control form-control-rounded @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-block btn-rounded mt-3" type="submit" value="Restablecer contraseña">
                        </div>

                    </form>
                    <div class="mt-3 text-center">
                        <a class="text-muted" href="{{ url('login') }}"><u>Iniciar session</u></a>
                    </div>
                </div>
            </div>
            <div class="col-12 d-none text-center " style="background-size: cover;background-image: url({{asset('assets/images/photo-long-3.jpg')}}">
                <div class="pr-3 auth-right">
                    <a class="btn btn-outline-primary btn-outline-email btn-block btn-icon-text btn-rounded" href="signup.html">
                        <i class="i-Mail-with-At-Sign"></i> Sign up with Email
                    </a>
                    <a class="btn btn-outline-primary btn-outline-google btn-block btn-icon-text btn-rounded">
                        <i class="i-Google-Plus"></i> Sign in with Google
                    </a>
                    <a class="btn btn-outline-primary btn-outline-facebook btn-block btn-icon-text btn-rounded">
                        <i class="i-Facebook-2"></i> Sign in with Facebook
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
