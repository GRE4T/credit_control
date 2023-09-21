<div class="table-responsive">
  <h4 class="bg-secondary text-center w-100 text-white p-2">Certificados</h4>
  <table id="table_certificates_expired" class="table table-borderless table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th>Tipo de certificado</th>
        <th scope="col">Certificado</th>
        <th scope="col">Dominio</th>
        <th scope="col">Dirección IP</th>
        <th scope="col">Llave privada</th>
        <th scope="col">Fecha de registro</th>
        <th scope="col">Fecha de expiración</th>
        <th scope="col">Acción</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@once
  @push('stack-script')
    <script text="text/javascript">
      $(document).ready(() => {
        let cont = 0;
        $('#table_certificates_expired').DataTable({
          dom: 'Bfrtip',
          buttons: [
            'excel', 'pdf'
          ],
          responsive: true,
              searching: false,
          autoWidth: false,
          processing: false,
          language: {
            url:'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
          },
          ajax: "{{ url('certificates/expired') }}",
          columns: [{
              data: 'id',
              render(data, type, row) {
                cont++;
                return cont;
              }
            },
            {
              data: 'type'
            },
            {
              data: 'certificate'
            },
            {
              data: 'domain.domain'
            },
          
            {
              data: 'IP_address'
            },
            {
              data: 'private_key'
            },
            {
              data: 'expiration_from'
            },
            {
              data:'expiration_to',
              render: function (data, type) {
                let now =  new Date().toISOString().slice(0, 10);
                let bg_color = 'success';

                if (data < now) {
                    bg_color = 'danger';
                } else if (data > now) {
                    bg_color = 'success';
                }

                return '<span class="bg-'+ bg_color+' p-2 rounded-pill text-white">' + data + '</span>'; 
              },
            },
            {
              data: 'id',
              render(data) {
                return `
                        <a href="{{ url('certificates') }}/${data}/edit" class="text-success mr-2">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                        </a>
                        <a href="javascript:void(0)" class="text-danger mr-2" onclick="deleteCertificate(${data})">
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