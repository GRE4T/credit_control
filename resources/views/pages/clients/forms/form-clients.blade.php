@extends('layouts.master')
@section('main-content')
<form action="{{ isset($client->id) ? route('clients.update', $client->id ) : route('clients.store') }}" method="POST">
    <div class="card">
        <div class="card-header bg-primary text-white h5">
            @if (isset($client->id))
            @method('PATCH')
            Editar cliente
            @else
            Añadir nuevo cliente
            @endif
        </div>
        <div class="card-body">
            @csrf
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Cliente <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                        value="{{ old('name') ? old('name') : $client->name }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-4">
                    <label for="type_document">Tipo de documento <span class="text-danger">*</span> </label>
                    <select name="type_document" id="type_document"
                        class="form-control @error('type_document') is-invalid @enderror">
                        <option value="CC" @if(old('type_document') && old('type_document')=='CC' ) selected
                            @elseif($client->type_document == 'CC') selected @endif >Cédula</option>
                        <option value="NIT" @if(old('type_document') && old('type_document')=='NIT' ) selected
                            @elseif($client->type_document == 'NIT') selected @endif >NIT</option>
                    </select>
                    @error('type_document')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-8">
                    <label for="document">Documento <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('document') is-invalid @enderror" name="document"
                        id="document" value="{{ old('document') ? old('document') : $client->document }}" required>
                    @error('document')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label for="email">Correo electrónico <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" value="{{ old('email') ? old('email') : $client->email }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-12">
                    <label for="phone">Teléfono <span class="text-danger">*</span> </label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                        value="{{ old('phone') ? old('phone') : $client->phone }}" required>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label for="organization">Organización </label>
                    <input type="text" class="form-control @error('organization') is-invalid @enderror"
                        name="organization" id="organization"
                        value="{{ old('organization') ? old('organization') : $client->organization }}">
                    @error('organization')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label for="iva">Impuesto </label>
                    <input type="number" class="form-control @error('iva') is-invalid @enderror" name="iva" id="iva"
                        value="{{ old('iva') ? old('iva') : $client->iva }}" step="0.1" min="0">
                    @error('iva')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn  btn-primary m-1">Guardar</button>
            <a href="{{ url('/clients')}}" class="btn btn-outline-secondary m-1">Cancelar</a>
        </div>
    </div>
</form>
@endsection