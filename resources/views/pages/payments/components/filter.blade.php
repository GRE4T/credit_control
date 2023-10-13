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
                <label for="credit_number">Numero de credito</label>
                <input type="text" class="form-control"
                       name="credit_number" id="credit_number"
                       maxlength="50" placeholder="Ingresar numero de credito">
            </div>
            <div class="form-group col-12 col-md-4">
                <label for="receipt_number">Numero de recibo</label>
                <input type="number" class="form-control" name="receipt_number" id="receipt_number" min="1" step="1"
                       placeholder="Ingresar numero de recibo">
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
                    let params =  {};

                    $(this).serializeArray().forEach(function (item) {
                        if( item.value !== '' ){
                            params[item.name] = item.value;
                        }
                    });

                    callback(params);
                });

            });
        </script>
    @endpush
@endonce
