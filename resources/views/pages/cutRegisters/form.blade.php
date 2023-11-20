<div class="card-body">
    @csrf
    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label for="value">Valor <span class="text-danger">(*)</span> <span id="parse_current_value" class="font-weight-bold"></span></label>
            <input type="number" class="form-control @error('value') is-invalid @enderror"
                   name="value" id="value"
                   value="{{ old('value') ? old('value') : $cutRegister->value }}" required step="1" placeholder="Ingresar valor">
            @error('value')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="date">Fecha de corte <span class="text-danger">(*)</span></label>
            <input type="date" class="form-control @error('date') is-invalid @enderror"
                   name="date" id="date"
                   value="{{ old('date') ? old('date') : $cutRegister->date }}"
                   required >
            @error('date')
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


