@extends('layouts.master')
@section('main-content')
    <form action="{{ isset($domain->id) ? route('domains.update', $domain->id) : route('domains.store') }}" method="POST">
        <div class="card">
            <div class="card-header bg-primary text-white h5">
                @if (isset($domain->id))
                    @method('PATCH')
                    Editar dominio
                @else
                    Añadir nuevo dominio
                @endif
            </div>
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group col-12">
                            <label for="client_id">Cliente<span class="text-danger">*</span> </label>

                            <select name="client_id" id="client_id"
                                class="form-control @error('client_id') is-invalid @enderror">
                                <option selected disabled>Seleccione un cliente</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        @if (old('client_id') && old('client_id') == $client->id) selected @elseif($domain->client_id == $client->id) selected @endif>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="domain">Nombre de dominio <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('domain') is-invalid @enderror" name="domain"
                                id="domain" value="{{ old('domain') ? old('domain') : $domain->domain }}" required>
                            @error('domain')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="website">Sitio Web </label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" name="website"
                                id="website" value="{{ old('website') ? old('website') : $domain->website }}">
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="nameserver1">Nameserver 1 </label>
                            <input type="text" class="form-control @error('nameserver1') is-invalid @enderror"
                                name="nameserver1" id="nameserver1"
                                value="{{ old('nameserver1') ? old('nameserver1') : $domain->nameserver1 }}">
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
                                value="{{ old('nameserver2') ? old('nameserver2') : $domain->nameserver2 }}">
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
                                value="{{ old('nameserver3') ? old('nameserver3') : $domain->nameserver3 }}">
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
                                value="{{ old('nameserver4') ? old('nameserver4') : $domain->nameserver4 }}">
                            @error('nameserver4')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="provider_id">Proveedor<span class="text-danger">*</span> </label>

                            <select name="provider_id" id="provider_id"
                                class="form-control @error('provider_id') is-invalid @enderror">
                                <option selected disabled>Seleccione un proveedor</option>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}"
                                        @if (old('provider_id') && old('provider_id') == $provider->id) selected @elseif($domain->provider_id == $provider->id) selected @endif>
                                        {{ $provider->name }}
                                    </option>
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
                                        @if (old('operating_system') && old('operating_system') == $item) selected @elseif($domain->operating_system == $item) selected @endif>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                            @error('operating_system')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="server_id">Servidor<span class="text-danger">*</span> </label>
                            <select name="server_id" id="server_id"
                                class="form-control @error('server_id') is-invalid @enderror">
                                <option selected disabled>Seleccione un servidor</option>
                                @foreach ($servers as $server)
                                    <option value="{{ $server->id }}"
                                        @if (old('server_id') && old('server_id') == $server->id) selected @elseif($domain->server_id == $server->id) selected @endif>
                                        {{ $server->server }}
                                    </option>
                                @endforeach
                            </select>
                            @error('server_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="authorization_code">Código de autorización</label>
                            <input type="text" class="form-control @error('authorization_code') is-invalid @enderror"
                                name="authorization_code" id="authorization_code"
                                value="{{ old('authorization_code') ? old('authorization_code') : $domain->authorization_code }}">
                            @error('authorization_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="annual_price">Precio anual <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('annual_price') is-invalid @enderror"
                                name="annual_price" id="annual_price"
                                value="{{ old('annual_price') ? old('annual_price') : $domain->annual_price }}"
                                min="0" required>
                            @error('annual_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="register_date">Fecha de registro <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('register_date') is-invalid @enderror"
                                name="register_date" id="register_date"
                                value="{{ old('register_date') ? old('register_date') : $domain->register_date }}"
                                required>
                            @error('register_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="expiration_date">Fecha de expiración <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('expiration_date') is-invalid @enderror"
                                name="expiration_date" id="expiration_date"
                                value="{{ old('expiration_date') ? old('expiration_date') : $domain->expiration_date }}"
                                required>
                            @error('expiration_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group col-12 col-md-12">
                            <label for="host_FTP">Host FTP </label>
                            <input type="text" class="form-control @error('host_FTP') is-invalid @enderror"
                                name="host_FTP" id="host_FTP"
                                value="{{ old('host_FTP') ? old('host_FTP') : $domain->host_FTP }}">
                            @error('host_FTP')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group col-12 col-md-12">
                            <label for="user_FTP">Usuario FTP</label>
                            <input type="text" class="form-control @error('user_FTP') is-invalid @enderror"
                                name="user_FTP" id="user_FTP"
                                value="{{ old('user_FTP') ? old('user_FTP') : $domain->user_FTP }}">
                            @error('user_FTP')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12 col-md-12">
                            <label for="password_FTP">Contraseña FTP </label>
                            <input type="password_FTP" class="form-control @error('password_FTP') is-invalid @enderror"
                                name="password_FTP" id="password_FTP"
                                value="{{ old('password_FTP') ? old('password_FTP') : $domain->password_FTP }}">
                            @error('password_FTP')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-md-12">
                            <label for="port_FTP">Puerto FTP</label>
                            <input type="number" class="form-control @error('port_FTP') is-invalid @enderror"
                                name="port_FTP" id="port_FTP"
                                value="{{ old('port_FTP') ? old('port_FTP') : $domain->port_FTP }}" max="9999"
                                step="1">
                            @error('port_FTP')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-md-12">
                            <label for="client_FTP">Cliente FTP </label>
                            <input type="text" class="form-control @error('client_FTP') is-invalid @enderror"
                                name="client_FTP" id="client_FTP"
                                value="{{ old('client_FTP') ? old('client_FTP') : $domain->client_FTP }}">
                            @error('client_FTP')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="observations">Observaciones</label>
                            <textarea name="observations" id="observations" class="form-control @error('observations') is-invalid @enderror"
                                cols="30" rows="10">{{ old('observations') ? old('observations') : $domain->observations }}</textarea>
                            @error('observations')
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
                <a href="{{ url('/domains') }}" class="btn btn-outline-secondary m-1">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
@section('page-js')
    <script type="text/javascript">
        $(document).ready(() => {
            let inputServer = $("#server_id");
            $("#operating_system").on('change', (event) => {

                axios.get('/servers/' + event.target.value + '/bySO', {
                    header: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(res => {
                    let data = res.data;
                    console.log(data);
                    inputServer.html(`<option selected disabled>Seleccione un servidor </option>`);
                    data.data.forEach(item => {
                        inputServer.append(`
                        <option value="${ item.id }">
                        ${ item.server }
                        </option>
                    `);
                    })
                }).catch(res => {

                })
            });
        });
    </script>
@endsection
