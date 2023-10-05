<div class="card-body">
    @csrf
    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label for="agreement_id">Convenio <span class="text-danger">(*)</span></label>
            <select name="agreement_id" id="agreement_id" class="form-control @error('agreement_id') is-invalid @enderror" required>
                <option selected>Seleccionar una opción </option>
                @foreach($agreements as $agreement)
                    <option value="{{ $agreement->id }}"
                            @if( old('agreement_id') && old('agreement_id') == $agreement->id) selected
                            @elseif($agreement->id == $payment->agreement_id) selected @endif
                    >{{ $agreement->name }}</option>
                @endforeach
            </select>
            @error('agreement_id')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="headquarter_id">Sede <span class="text-danger">(*)</span></label>
            <select name="headquarter_id" id="headquarter_id" class="form-control @error('headquarter_id') is-invalid @enderror" required>
                <option selected>Seleccionar una opción </option>
                @foreach($headquarters as $headquarter)
                    <option value="{{ $headquarter->id }}"
                            @if( old('headquarter_id') && old('headquarter_id') == $headquarter->id) selected
                            @elseif($headquarter->id == $payment->headquarter_id) selected @endif
                    >{{ $headquarter->name }}</option>
                @endforeach
            </select>
            @error('headquarter_id')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label for="credit_number">Numero de credito # <span class="text-danger">(*)</span></label>
            <input type="number" class="form-control @error('credit_number') is-invalid @enderror"
                   name="credit_number" id="credit_number"
                   value="{{ old('credit_number') ? old('credit_number') : $payment->credit_number }}" required min="1" step="1" placeholder="Ingresar numero de credito">
            @error('credit_number')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="credit_pos_number">Numero de credito pos # <span class="text-danger">(*)</span></label>
            <input type="number" class="form-control @error('credit_pos_number') is-invalid @enderror"
                   name="credit_pos_number" id="credit_pos_number"
                   value="{{ old('credit_pos_number') ? old('credit_pos_number') : $payment->credit_pos_number }}" required min="0" step="1" placeholder="Ingresar numero de credito pos">
            @error('credit_pos_number')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label for="number_received">Numero de recibo <span class="text-danger">(*)</span></label>
            <input type="number" class="form-control @error('number_received') is-invalid @enderror"
                   name="number_received" id="number_received"
                   value="{{ old('number_received') ? old('number_received') : $payment->number_received }}" required min="1" step="1" placeholder="Ingresar numero de recibo">
            @error('number_received')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
        @if(!isset($payment->id))
            <div class="form-group col-12 col-md-6">
                <label for="value">Valor <span class="text-danger">(*)</span></label>
                <input type="number" class="form-control @error('value') is-invalid @enderror"
                       name="value" id="value"
                       value="{{ old('value') ? old('value') : $payment->value }}" required min="0" step="1000" placeholder="Ingresar valor">
                @error('value')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
        @endif
    </div>
</div>
