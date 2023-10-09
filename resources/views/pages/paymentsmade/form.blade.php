<div class="card-body">
    @csrf
    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label for="agreement_id">Convenio <span class="text-danger">(*)</span></label>
            <select name="agreement_id" id="agreement_id" class="form-control @error('agreement_id') is-invalid @enderror" required>
                <option value="" selected disabled>Seleccionar una opción </option>
                @foreach($agreements as $agreement)
                    <option value="{{ $agreement->id }}"
                            @if( old('agreement_id') && old('agreement_id') == $agreement->id) selected
                            @elseif($agreement->id == $paymentmade->agreement_id) selected @endif
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
                <option value="" selected disabled>Seleccionar una opción </option>
                @foreach($headquarters as $headquarter)
                    <option value="{{ $headquarter->id }}"
                            @if( old('headquarter_id') && old('headquarter_id') == $headquarter->id) selected
                            @elseif($headquarter->id == $paymentmade->headquarter_id) selected @endif
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
            <label for="receipt_number">Numero de recibo <span class="text-danger">(*)</span></label>
            <input type="number" class="form-control @error('receipt_number') is-invalid @enderror"
                   name="receipt_number" id="receipt_number"
                   value="{{ old('receipt_number') ? old('receipt_number') : $paymentmade->receipt_number }}" required min="1" step="1" placeholder="Ingresar numero de recibo">
            @error('receipt_number')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="type_payment">Tipo de pago<span class="text-danger">(*)</span></label>
            <input type="text" class="form-control @error('type_payment') is-invalid @enderror"
                   name="type_payment" id="type_payment"
                   value="{{ old('type_payment') ? old('type_payment') : $paymentmade->type_payment }}" required min="1" step="1" placeholder="Ingresar tipo de pago ">
            @error('type_payment')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        @if(!isset($paymentmade->id))
            <div class="form-group col-12 col-md-6">
                <label for="value">Valor<span class="text-danger">(*)</span></label>
                <input type="number" class="form-control @error('value') is-invalid @enderror"
                       name="value" id="value"
                       value="{{ old('value') ? old('value') : $paymentmade->value }}" required min="0" step="1000" placeholder="Ingresar valor">
                @error('value')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
        @else
            <div class="form-group col-12 col-md-6">
                <label for="value">Valor</label>
                <input type="number" class="form-control" id="value"
                       value="{{ $paymentmade->value }}"  disabled>
            </div>
        @endif
        <div class="form-group col-12 col-md-6">
            <label for="detail">Detalle </label>
            <textarea name="detail" id="detail" cols="30" rows="3" class="form-control @error('detail') is-invalid @enderror" placeholder="Ingresar detalle">{{ old('detail') ? old('detail') : $paymentmade->detail  }}</textarea>
            @error('detail')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
    </div>
</div>
