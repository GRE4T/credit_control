@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <ul class="d-flex align-items-center">
            <li>
                <img src="{{asset('assets/images/icons/user.png')}}" alt="" class="w-75">
            </li>
            <li class="h5 bold"> Usuarios</li>
        </ul>
    </div>
    <div class="row mb-2">
        <div class="col text-right">
            <a class="btn btn-success" href="{{ route('users.create')}}">Añadir nuevo</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white h5">
            Usuarios
        </div>
        <div class="card-body">
            <div class="table-responsive-md">
                <table id="table_users" class="table table-borderless table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo Electrónico</th>
                        <th scope="col">Nombre de usuario</th>
                        <th scope="col">Rol</th>
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
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.buttons.min.css')}}">
@endsection

@section('page-js')
    <script defer src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script defer src="{{asset('assets/js/vendor/datatables.responsive.min.js')}}"></script>
@endsection

@section('bottom-js')

    <script type="text/javascript">
        'use strict'

        var table;

        $(document).ready(() => {
            table = $('#table_users').DataTable({
                dom: 'Bfrtlip',
                buttons: [],
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                ajax: "{{ url('api/users') }}",
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
                        data: 'email'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'is_admin',
                        render(data) {
                            return data ? 'Administrador' : 'Estandar';
                        }
                    },
                    {
                        data: 'active',
                        render(data) {
                            return data ? 'Activado' : 'Desactivado';
                        }
                    },
                    {
                        data: 'id',
                        render(data, type, row) {
                            return `
                                <a href="javascript:void(0)" class="text-primary mr-2" onclick="changeStatus(${data})">
                                    <i class="nav-icon ${ row.active ? 'i-Remove-User' : 'i-Add-User'} font-weight-bold"></i>
                                </a>
                                <a href="{{ url('users') }}/${data}/edit" class="text-success mr-2">
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
                    axios.delete("{{ url('api/users') }}/" + id, null)
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

        function changeStatus(id) {
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
                    axios.put(`{{ url('api/users') }}/${id}/change-state`)
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
