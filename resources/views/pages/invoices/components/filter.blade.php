<div>
    <form id="filters">
        <div class="form-row">
            <div class="form-group col-12 col-md-4">
                <label for="start_date">Desde</label>
                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Ingresar fecha">
            </div>

            <div class="form-group col-12 col-md-4">
                <label for="end_date">Hasta</label>
                <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Ingresar fecha">
            </div>

            <div class="form-group col-12 col-md-4">
                <label for="agreement_id">Convenio</label>
                <select name="agreement_id" id="agreement_id" class="form-control">
                    <option value="" selected>Seleccionar una opción</option>
                    @foreach($agreements as $agreement)
                        <option value="{{ $agreement->id }}">{{ $agreement->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-4">
                <label for="headquarter_id">Sede </label>
                <select name="headquarter_id" id="headquarter_id" class="form-control">
                    <option value="" selected>Seleccionar una opción</option>
                    @foreach($headquarters as $headquarter)
                        <option value="{{ $headquarter->id }}">{{ $headquarter->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12 col-md-4">
                <label for="invoice_state_id">Estado</label>
                <select name="invoice_state_id" id="invoice_state_id" class="form-control">
                    <option value="" selected>Seleccionar una opción</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12 col-md-4">
                <label for="payment_status">Estado de pago</label>
                <div class="input-group">
                    <div class="input-group-prepend col-12 col-md-6 p-0">
                        <select name="payment_status" id="payment_status" class="form-control">
                            <option value="" selected>Seleccionar una opción</option>
                            @foreach($paymentStatus as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group-append col-12 col-md-6 p-0">
                        <label for="expiration_date_end" class="input-group-text mb-0">Hasta <span class="ml-1"><i class="i-Calendar"></i></span></label>
                        <input class="form-control" type="date" name="expiration_date_end" id="expiration_date_end" >
                    </div>
                </div>

            </div>
        </div>
        <div class="form-row d-flex justify-content-end">
            <div class="form-group col-12 col-md-2">
                <button id='apply_filter' type="submit" class="btn btn-primary btn-block">Aplicar filtro</button>
            </div>
        </div>

    </form>
</div>

@once
    @push('stack-script')

        <script>
            'use strict';

            $(document).ready(function () {
                const callback = eval(' {{ $callback }}');
                $('#filters').on('submit', function (event) {
                    event.preventDefault();
                    let params = {};

                    $(this).serializeArray().forEach(function (item) {
                        if (item.value !== '') {
                            params[item.name] = item.value;
                        }
                    });

                    callback(params);
                });

            });
        </script>
    @endpush
@endonce
