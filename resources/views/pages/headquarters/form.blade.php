<div class="card-body">
    @csrf
    <div class="form-row">
        <div class="form-group col-12">
            <label for="nameserver1">Nombre Sede</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" id="name"
                   value="{{ old('name') ? old('name') : $headquarter->name }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
    </div>
</div>
