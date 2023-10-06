@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <ul class="d-flex align-items-center">
            <li class="text-center">
                <img src="{{asset('assets/images/icons/facturas.png')}}" alt="" class="w-75">
            </li>
            <li class="h3 bold">Modulo de Facturas</li>
        </ul>
    </div>
    <div class="row mb-2">
        <div class="col text-right">
            <a class="btn btn-success" href="{{ route('invoices.create')}}">Añadir nuevo</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white h5">
            Facturas
        </div>
        <div class="card-body">
            <div class="table-responsive-md">
                <table id="table_invoices" class="table table-borderless table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Convenio</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Fact. Pos</th>
                        <th scope="col">Fact. Convenio</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Afectación</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acción</th>
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
@endsection

@section('page-js')
    <script defer src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script defer src="{{asset('assets/js/vendor/datatables.responsive.min.js')}}"></script>

    <script type="text/javascript">
        'use strict'

        var table;

        $(document).ready(() => {
            table = $('#table_invoices').DataTable({
                dom: 'Bfrtip',
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
                ajax: "{{ url('api/invoices') }}",
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
                            return '$' + data;
                        }
                    },
                    {
                        data: 'invoice_pos_number'
                    },
                    {
                        data: 'invoice_agreement'
                    },
                    {
                        data: 'headquarter.name'
                    },
                    {
                        data: 'detail'
                    },
                    {
                        data: 'id',
                        render(data, type, row) {
                            if(row.state.key === '{{ config('agreements.state_1') }}')
                            {
                                return `
                                    <button class="bg-success mr-2 btn text-white" onclick="changeStatus(${data}, '{{ config('agreements.state_2') }}')">
                                        Pagar
                                    </button>
                                    <button class="bg-danger mr-2 btn text-white" onclick="changeStatus(${data}, '{{ config('agreements.state_3') }}')">
                                        Anular
                                    </button>
                                `;
                            }
                            return null;
                        }
                    },
                    {
                        data: 'state.name'
                    },
                    {
                        data: 'id',
                        render(data) {
                            return `
                    <a href="{{ url('invoices') }}/${data}/edit" class="text-success mr-2">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                    </a>
                    <a href="javascript:void(0)" class="text-danger mr-2" onclick="deleteServer(${data})">
                        <i class="nav-icon i-Close font-weight-bold"></i>
                    </a>
                    `;
                        }
                    }
                ]
            });
        });

        function deleteServer(id) {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete("{{ url('api/invoices') }}/" + id, null)
                        .then((res) => {
                            Swal.fire(
                                '¡Eliminado!',
                                'Registro borrado exitosamente ',
                                'success'
                            );
                            table.ajax.reload();
                        })
                        .catch((error) => {
                            if (error) {
                                Swal.fire(
                                    'Cancelado',
                                    'Este registro no puede ser eliminado :(',
                                    'error'
                                )
                            }
                        })
                }
            })
        }

        function changeStatus(id, state) {
            Swal.fire({
                title: '¿Estas seguro de actualizar el estado?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Actualizar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let data = {
                        invoice_state_key: state
                    };
                    axios.put(`{{ url('api/invoices') }}/${id}/change-state`, data)
                        .then((res) => {
                            Swal.fire(
                                '¡Actualización de estado!',
                                'Registro borrado exitosamente ',
                                'success'
                            );
                            table.ajax.reload();
                        })
                        .catch((error) => {
                            if (error) {
                                Swal.fire(
                                    'Cancelado',
                                    'No fue posible actualizar el estado  :(',
                                    'error'
                                )
                            }
                        })
                }
            })
        }
    </script>
@endsection

