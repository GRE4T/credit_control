@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <ul class="d-flex align-items-center">
            <li>
                <img height="50px" src="{{asset('assets/images/icons/servidores.svg')}}" alt="">
            </li>
            <li class="h3 bold">Modulo de Recaudos</li>
        </ul>
    </div>
    <div class="row mb-2">
        <div class="col text-right">
            <a class="btn btn-success" href="{{ route('payments.create')}}">Añadir nuevo</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white h5">
            Recaudos
        </div>
        <div class="card-body">
            <div class="table-responsive-md">
                <table id="table_payments" class="table table-borderless table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Convenio</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Sede</th>
                        <th scope="col">C. Pos</th>
                        <th scope="col">#Credito</th>
                        <th scope="col">#Recibido</th>
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
@section('page-js')
    <script defer src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>

    <script type="text/javascript">
        'use strict'

        var table;

        $(document).ready(() => {
            table = $('#table_payments').DataTable({
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
                ajax: "{{ url('api/payments') }}",
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
                    },
                    {
                        data: 'id',
                        render(data) {
                            return `
                    <a href="{{ url('payments') }}/${data}/edit" class="text-success mr-2">
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
                    axios.delete("{{ url('api/payments') }}/" + id, null)
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
    </script>
@endsection

