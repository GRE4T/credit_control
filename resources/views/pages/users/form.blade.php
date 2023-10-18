<div class="card-body">
    @csrf
    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label for="name">Nombre <span class="text-danger">*</span> </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                   value="{{ old('name') ? old('name') : $user->name }}" required placeholder="Ingresar nombre">
            @error('name')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="email">Correo electrónico <span class="text-danger">*</span> </label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                   value="{{ old('email') ? old('email') : $user->email }}" placeholder="Ingresar email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="username">Nombre de usuario <span class="text-danger">*</span> </label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                   id="username" value="{{ old('username') ? old('username') : $user->username }}" required
                   placeholder="Ingresar nombre de usuario">
            @error('username')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="password">Contraseña <span class="text-danger">*</span> </label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                   id="password" @if (!isset($user->id)) required @endif placeholder="Ingresar contraseña">
            @error('password')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="is_admin" class="switch switch-primary mr-3">
                <span>Administrador</span>
                <input type="checkbox" class="form-control @error('is_admin') is-invalid @enderror" name="is_admin"
                       id="is_admin" @if($user->is_admin) checked @endif value="1">
                <span class="slider"></span>
            </label>
            @error('is_admin')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
    </div>
</div>
