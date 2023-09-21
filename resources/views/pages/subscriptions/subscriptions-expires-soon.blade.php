<div class="table-responsive">
  <h4 class="bg-secondary text-center w-100 text-white p-2">Suscripciones</h4>
  <table id="table_subscriptions_expires_soon" class="table table-borderless table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Proveedor</th>
        <th scope="col">URL</th>
        <th scope="col">Usuario</th>
        <th scope="col">Contraseña</th>
        <th scope="col">Precio</th>
        <th scope="col">Fecha de registro</th>
        <th scope="col">Fecha de vencimiento</th>
        <th scope="col">Días</th>
        <th scope="col">Acción</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@once
  @push('stack-script')
    <script type="text/javascript">
      'use strict'
      $(document).ready(() => {
        let cont = 0;
        $('#table_subscriptions_expires_soon').DataTable({
          dom: 'Bfrtip',
          buttons: [
            'excel', 'pdf'
          ],
          responsive: true,
          autoWidth: false,
          processing: true,
          language: {
            url:'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
          },
          ajax: "{{ url('subscriptions/expires-soon') }}",
          columns: [
            {
              data: 'id',
              render(data, type, row) {
                cont++;
                return cont;
              }
            },
            {
              data: 'provider.name'
            },
            {
              data: 'url'
            },
            {
              data: 'username'
            },
            {
              data: 'password'
            },
            {
              data: 'cost'
            },
            {
              data: 'expiration_from'
            },
            {
              data: 'expiration_to',
              render: function(data, type) {
                let now = new Date().toISOString().slice(0, 10);
                let bg_color = 'white';

                if (data < now) {
                  bg_color = 'danger';
                } else if (data > now) {
                  bg_color = 'success';
                }

                return '<span class="bg-' + bg_color + ' p-2 rounded-pill text-white">' + data + '</span>';
              },
            },
            
            {
              data: 'days'
            },      
            {
              data: 'id',
              render(data) {
                return `
                        <a href="{{ url('subscriptions') }}/${data}/edit" class="text-success mr-2">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                        </a>
                        <a href="javascript:void(0)" class="text-danger mr-2" onclick="deleteSubscription(${data})">
                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                        </a>
                        `;
              }
            }
          ]
        });
      });
    </script>
  @endpush
@endonce