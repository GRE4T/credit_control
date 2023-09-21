@extends('layouts.master')
@section('main-content')
    <form action="{{ isset($server->id) ? route('servers.update', $server->id) : route('servers.store') }}" method="POST">
        <div class="card">
            <div class="card-header bg-primary text-white h5">
                @if (isset($server->id))
                    @method('PATCH')
                    Editar servidor
                @else
                    Añadir nuevo servidor
                @endif
            </div>
            <div class="card-body">
                @csrf
                <div class="form-row">
                    <div class="col-lg-6">

                        <div class="form-group col-12">
                            <label for="provider_id">Proveedor<span class="text-danger">*</span> </label>

                            <select name="provider_id" id="provider_id"
                                class="form-control @error('provider_id') is-invalid @enderror">
                                <option selected disabled>Seleccione un proveedor</option>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}"
                                        @if (old('provider_id') && old('provider_id') == $provider->id) selected @elseif($server->provider_id == $provider->id) selected @endif>
                                        {{ $provider->name }}</option>
                                @endforeach
                            </select>
                            @error('provider_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="operating_system">Hosting<span class="text-danger">*</span> </label>
                            <select name="operating_system" id="operating_system"
                                class="form-control @error('operating_system') is-invalid @enderror">
                                <option selected disabled>Seleccione sistema Operativo</option>
                                @foreach ($sos as $item)
                                    <option value="{{ $item }}"
                                        @if (old('operating_system') && old('operating_system') == $item) selected @elseif($server->operating_system == $item) selected @endif>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                            @error('operating_system')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="path_server">Server <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('path_server') is-invalid @enderror"
                                name="path_server" id="path_server"
                                value="{{ old('path_server') ? old('path_server') : $server->server }}" required>
                            @error('path_server')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="nameserver1">Nameserver 1 </label>
                            <input type="text" class="form-control @error('nameserver1') is-invalid @enderror"
                                name="nameserver1" id="nameserver1"
                                value="{{ old('nameserver1') ? old('nameserver1') : $server->nameserver1 }}">
                            @error('nameserver1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="nameserver2">Nameserver 2 </label>
                            <input type="text" class="form-control @error('nameserver2') is-invalid @enderror"
                                name="nameserver2" id="nameserver2"
                                value="{{ old('nameserver2') ? old('nameserver2') : $server->nameserver2 }}">
                            @error('nameserver2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="nameserver3">Nameserver 3 </label>
                            <input type="text" class="form-control @error('nameserver3') is-invalid @enderror"
                                name="nameserver3" id="nameserver3"
                                value="{{ old('nameserver3') ? old('nameserver3') : $server->nameserver3 }}">
                            @error('nameserver3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="nameserver4">Nameserver 4 </label>
                            <input type="text" class="form-control @error('nameserver4') is-invalid @enderror"
                                name="nameserver4" id="nameserver4"
                                value="{{ old('nameserver4') ? old('nameserver4') : $server->nameserver4 }}">
                            @error('nameserver4')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group col-12">
                            <label for="client_id">Clientes<span class="text-danger">*</span> </label>

                            <select name="client_id" id="client_id"
                                class="form-control @error('client_id') is-invalid @enderror">
                                <option selected disabled>Seleccione un cliente</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        @if (old('client_id') && old('client_id') == $client->id) selected @elseif($server->client_id == $client->id) selected @endif>
                                        {{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="username">Nombre de usuario <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username"
                                value="{{ old('username') ? old('username') : $server->username }}" required>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="password">Contraseña <span class="text-danger">*</span> </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password"
                                value="{{ old('password') ? old('password') : $server->password }}" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="url">Url </label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                                id="url" value="{{ old('url') ? old('url') : $server->url }}">
                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="annual_cost">Precio anual </label>
                            <input type="number" class="form-control @error('annual_cost') is-invalid @enderror"
                                name="annual_cost" id="annual_cost"
                                value="{{ old('annual_cost') ? old('annual_cost') : $server->annual_cost }}"
                                min="0">
                            @error('annual_cost')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="register_date">Fecha de registro<span class="text-danger">*</span> </label>
                            <input type="date" class="form-control @error('register_date') is-invalid @enderror"
                                name="register_date" id="register_date"
                                value="{{ old('register_date') ? old('register_date') : $server->register_date }}"
                                required>
                            @error('register_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="expiration_date">Fecha de expiración<span class="text-danger">*</span> </label>
                            <input type="date" class="form-control @error('expiration_date') is-invalid @enderror"
                                name="expiration_date" id="expiration_date"
                                value="{{ old('expiration_date') ? old('expiration_date') : $server->expiration_date }}"
                                required>
                            @error('expiration_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="annotations">Notas adicionales</label>
                            <textarea name="annotations" id="annotations" class="form-control @error('annotations') is-invalid @enderror"
                                cols="30" rows="10">{{ old('annotations') ? old('annotations') : $server->annotations }}</textarea>
                            @error('annotations')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn  btn-primary m-1">Guardar</button>
                <a href="{{ url('/servers') }}" class="btn btn-outline-secondary m-1">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
