@extends('layouts.master')
@section('main-content')
    <div class="breadcrumb">
        <ul class="d-flex align-items-center">
            <li class="text-center">
                <img src="{{asset('assets/images/icons/recaudos.png')}}" alt="" class="w-75">
            </li>
            <li class="h3 bold">Corte de periodo</li>
        </ul>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white h5">
            Informe general
        </div>
        <div class="card-body">
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
                            <label for="percentage">Porcentaje <strong>(%)</strong></label>
                            <input type="number" class="form-control" id="percentage"  placeholder="Ingresar porcentaje"
                                   value="0" min="0" max="100" step=".1">
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-end">
                        <div class="form-group col-12 col-md-2">
                            <button id='apply_filter' type="submit" class="btn btn-primary btn-block">Aplicar filtro</button>
                        </div>
                    </div>
                </form>
            <div class="table-responsive-md">
                <table id="table_period_cut" class="table table-borderless table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Convenio</th>
                        <th scope="col">Recaudos</th>
                        <th scope="col">Facturado</th>
                        <th scope="col">P. Realizados</th>
                        <th scope="col">P. Recibidos</th>
                        <th scope="col">%</th>
                        <th scope="col">V. %</th>
                        <th scope="col">Saldo final</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.buttons.min.css')}}">
@endsection

@section('page-js')
    <script defer src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script defer src="{{asset('assets/js/vendor/datatables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/js/custom/helper.global.js') }}"></script>
@endsection

@section('bottom-js')
    <script type="text/javascript">
        'use strict'

        var table;
        var filters = [];
        var percentage = 0;

        $(document).ready(() => {
            table = $('#table_period_cut').DataTable({
                dom: 'Bfrtlip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Exportar Excel',
                        filename: 'corte_periodo_' + getDateToString()
                    }
                ],
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                ajax: (data, callback, settings) => {
                    $.get('{{ url('api/period-cut') }}', {
                        ...data,
                        filters: filters
                    }, function (response) {
                        callback(response);
                    });
                },
                columns: [
                    {
                        data: 'id',
                        render(data, type, row, meta) {
                            return meta.settings._iDisplayStart + meta.row + 1;
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'payments_sum_value',
                        render(data) {
                            return parseCurrency(data);
                        }
                    },
                    {
                        data: 'invoices_sum_value',
                        render(data) {
                            return parseCurrency(data);
                        }
                    },
                    {
                        data: 'payments_made_sum_value',
                        render(data) {
                            return parseCurrency(data);
                        }
                    },
                    {
                        data: 'payments_received_sum_value',
                        render(data) {
                            return parseCurrency(data);
                        }
                    },
                    {
                        render(){
                            return percentage + '%';
                        }
                    },
                    {
                        render(data, type, row){
                            return parseCurrency((row.invoices_sum_value * percentage ) / 100);
                        }
                    },
                    {
                        render(data, type, row) {
                            let rest = [
                                row.payments_sum_value,
                                ((row.invoices_sum_value * percentage ) / 100),
                                row.payments_received_sum_value
                            ].reduce((a, b) => a + b, 0);

                            let balance  = ( row.invoices_sum_value + row.payments_made_sum_value) - rest;

                            return `<span class="${ balance < 0 ? 'text-danger' : 'text-success'}" >${ parseCurrency(balance) }</span>`;
                        }
                    },
                ]
            });

            applyFilters();
        });

        function applyFilters() {
            $('#filters').on('submit', function (event) {
                event.preventDefault();
                let params =  {};

                $(this).serializeArray().forEach(function (item) {
                    if( item.value !== '' ){
                        params[item.name] = item.value;
                    }
                });

                filters = params;
                percentage = $("#percentage").val();

                return table.ajax.reload();
            });
        }
    </script>

    @stack('stack-script')
@endsection


