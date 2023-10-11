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
            <x-payments-filter  callback="callbackFilter" />
            <div class="table-responsive-md">
                <table id="table_payments" class="table table-borderless table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Convenio</th>
                        <th scope="col">Recaudos</th>
                        <th scope="col">Facturado</th>
                        <th scope="col">C. Realizados</th>
                        <th scope="col">C. Recibidos</th>
                        <th scope="col">%</th>
                        <th scope="col">V. %</th>
                        <th scope="col">Cruce</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            </p>
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

        $(document).ready(() => {
            table = $('#table_payments').DataTable({
                dom: 'Bfrtlip',
                buttons: [
                    'excel'
                ],
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                ajax: (data, callback, settings) => {
                    $.get('{{ url('api/payments') }}', {
                        ...data,
                        filters: filters
                    }, function (response) {
                        let totalLabel = parseCurrency(response.data.total);
                        $('#total_value').text(totalLabel);
                        callback(response.data.grid.original);
                    });
                },
                columns: [{
                    data: 'id',
                    render(data, type, row, meta) {
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'agreement.name'
                    },
                    {
                        data: 'value',
                        render(data){
                            return parseCurrency(data);
                        }
                    },
                    {
                        data: 'headquarter.name'
                    },
                    {
                        data: 'credit_pos_number'
                    },
                    {
                        data: 'credit_number'
                    },
                    {
                        data: 'receipt_number'
                    }
                ]
            });
        });

        function callbackFilter(params = null) {
            filters  = params;
            return table.ajax.reload();
        }
    </script>

    @stack('stack-script')
@endsection


