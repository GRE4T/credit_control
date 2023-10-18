@extends('layouts.master')
@section('main-content')
<div class="breadcrumb mt-5">
    <h1>Información de perfil</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="card user-profile o-hidden mb-4">
    <div class="header-cover" style="background-image: url({{asset('assets/images/photo-wide-2.jpg')}}"></div>
    <div class="user-info">
        <img class="profile-picture bg-white avatar-lg mb-2" src="{{ asset($configuration->logo)  }}" alt="">
        <p class="m-0 text-24">{{ Auth::user()->name }}</p>
    </div>
    <div class="card-body">
        <div class="px-5" id="profile">
            <h4>Información personal</h4>

            <hr>
            <div class="row">
                <div class="col px-5">
                    <form action="{{ route('user.updateProfile')}}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="text-center">
                            <h4 class="mb-4">Actualizar información</h4>
                        </div>
                        <div class="mb-4 form-group">
                            <label class="text-primary mb-1" for="name"><i class="i-Calendar text-16 mr-1"></i> Nombre
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name') ? old('name') : $user->name }}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group mb-4">
                            <label class="text-primary mb-1" for="email"><i class="i-Edit-Map text-16 mr-1"></i>Correo
                                electrónico <span class="text-danger">*</span> </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email') ? old('email') : $user->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="username" class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i>Nombre
                                de usuario <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username"
                                value="{{ old('username') ? old('username') : $user->username }}" required>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn  btn-primary m-1">Guardar</button>
                            <button type="button" onclick='resetFormInformation({
                                "name": "{{ $user->name}}",
                                "email": "{{ $user->email}}",
                                "username": "{{ $user->username}}"
                            })' class="btn btn-outline-secondary m-1">Cancelar</button>
                        </div>
                    </form>
                </div>
                <div class="col px-5 border-left">
                    <form id="change_password" action="{{ route('user.password')}}" method="POST">
                        @csrf
                        <div class="text-center">
                            <h4 class="mb-4">Actualizar contraseña</h4>
                        </div>
                        <div class="form-group mb-4">
                            <label for="password_current" class="text-primary mb-1"><i
                                    class="i-MaleFemale text-16 mr-1"></i>Contraseña actual<span
                                    class="text-danger">*</span> </label>
                            <input type="password" class="form-control @error('password_current') is-invalid @enderror"
                                name="password_current" id="password_current" required>
                            @error('password_current')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password" class="text-primary mb-1"><i
                                    class="i-MaleFemale text-16 mr-1"></i>Nueva contraseña<span
                                    class="text-danger">*</span> </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="text-primary mb-1"><i
                                    class="i-MaleFemale text-16 mr-1"></i>Confirmar contraseña<span
                                    class="text-danger">*</span> </label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation" required>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn  btn-primary m-1">Guardar</button>
                            <button type="button" onclick="resetFormPassword()"
                                class="btn btn-outline-secondary m-1">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
        </div>
        @if($user->is_admin)
            <div class="px-5" id="setting-site">
                <h4>Configuración del sitio</h4>
                <hr>
                <div class="row">
                    <div class="col px-5">
                        <form action="{{ route('configurations.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="text-center">
                                <h4 class="mb-4">Actualizar información</h4>
                            </div>
                            <div class="form-group mb-4">
                                <label class="text-primary mb-1" for="logo"><i class="i-File-Text--Image text-16 mr-1"></i>Logo</label>
                                <div class="p-0 border">
                                    <div style="height: 230px" class="d-flex justify-content-center my-2">
                                        <img id="image" class="border img-fluid"  src="{{ asset($configuration->logo) }}" alt="logo" />
                                    </div>
                                    <label class="btn border btn-block mb-0 text-30 text-primary">
                                        <i class="i-Pen-2 font-weight-bold"></i>
                                        <input id="logo" name="logo" data-info="image" type="file"  onchange="readImage(event)" >
                                    </label>
                                </div>
                                @error('logo')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn  btn-primary m-1">Guardar</button>
                                <button type="button" onclick='' class="btn btn-outline-secondary m-1">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
            </div>
        @endif
    </div>
</div>



@endsection

@section('page-js')
<script type="text/javascript">
    function resetFormInformation(user) {
        $('#name').val(user.name);
        $('#email').val(user.email);
        $('#username').val(user.username);
    }

    function resetFormPassword() {
        $('#change_password')[0].reset();
    }

    function readImage(event) {
        let input = event.target;
        let id = $(input).data("info");
        let element = $(`#${id}`);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                element.attr("src", e.target.result);
                element.removeClass("w-50");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
