<div class="card-body">
    @csrf
    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label for="agreement_id">Convenio <span class="text-danger">(*)</span></label>
            <select name="agreement_id" id="agreement_id"
                    class="form-control @error('agreement_id') is-invalid @enderror" required>
                <option value="" selected disabled>Seleccionar una opción</option>
                @foreach($agreements as $agreement)
                    <option value="{{ $agreement->id }}"
                            @if( old('agreement_id') && old('agreement_id') == $agreement->id) selected
                            @elseif($agreement->id == $invoice->agreement_id) selected @endif
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
            <select name="headquarter_id" id="headquarter_id"
                    class="form-control @error('headquarter_id') is-invalid @enderror" required>
                <option value="" selected disabled>Seleccionar una opción</option>
                @foreach($headquarters as $headquarter)
                    <option value="{{ $headquarter->id }}"
                            @if( old('headquarter_id') && old('headquarter_id') == $headquarter->id) selected
                            @elseif($headquarter->id == $invoice->headquarter_id) selected @endif
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
            <label for="invoice_pos_number">Numero de factura pos # <span class="text-danger">(*)</span></label>
            <input type="text" class="form-control @error('invoice_pos_number') is-invalid @enderror"
                   name="invoice_pos_number" id="invoice_pos_number"
                   value="{{ old('invoice_pos_number') ? old('invoice_pos_number') : $invoice->invoice_pos_number }}"
                   required maxlength="50" placeholder="Ingresar numero de factura pos">
            @error('invoice_pos_number')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="invoice_agreement">Numero de factura convenio <span class="text-danger">(*)</span></label>
            <input type="text" class="form-control @error('invoice_agreement') is-invalid @enderror"
                   name="invoice_agreement" id="invoice_agreement"
                   value="{{ old('invoice_agreement') ? old('invoice_agreement') : $invoice->invoice_agreement }}"
                   required maxlength="50" placeholder="Ingresar numero de factura convenio">
            @error('invoice_agreement')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        @if(!isset($invoice->id) || auth()->user()->is_admin )
            <div class="form-group col-12 col-md-6">
                <label for="value">Valor <span class="text-danger">(*)</span> <span id="parse_current_value" class="font-weight-bold"></span></label>
                <input type="number" class="form-control @error('value') is-invalid @enderror"
                       name="value" id="value"
                       value="{{ old('value') ? old('value') : $invoice->value }}" required min="0" step="1"
                       placeholder="Ingresar valor">
                @error('value')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
        @else
            <div class="form-group col-12 col-md-6">
                <label for="value">Valor <span id="parse_current_value" class="font-weight-bold"></span></label>
                <input type="number" class="form-control" id="value"
                       value="{{ $invoice->value }}" disabled>
            </div>
        @endif

        <div class="form-group col-12 col-md-6">
            <label for="detail">Detalle </label>
            <textarea name="detail" id="detail" cols="30" rows="10" class="form-control @error('detail') is-invalid @enderror" placeholder="Ingresar detalle">{{ old('detail') ? old('detail') : $invoice->detail  }}</textarea>
            @error('detail')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
    </div>
</div>
@once
    @push('stack-script')
        <script src="{{ asset('assets/js/custom/helper.global.js') }}"></script>
        <script type="text/javascript">
            'use strict';

            $(document).ready(() => {
                let valueInput = $('#value');
                let labelParseValue = $('#parse_current_value');

                labelParseValue.html(parseCurrency(valueInput.val()));

                valueInput.on('keyup', function () {
                    let value = $(this).val();
                    labelParseValue.html(parseCurrency(value));
                });
            });

        </script>

    @endpush
@endonce
