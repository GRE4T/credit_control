@extends('layouts.master')

@section('main-content')
<div class="breadcrumb">
  <ul class="d-flex align-items-center">
    <li>
      <img height="50px" src="{{asset('assets/images/icons/ayuda.svg')}}" alt="">
    </li>
    <li class="h5 bold"> Documentación</li>
  </ul>
</div>
<div class="row mb-2">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
            href="#list-home" role="tab" aria-controls="list-home">Introducción</a>
          <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
            href="#list-profile" role="tab" aria-controls="list-profile">Instalación de plantilla</a>
          <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
            href="#list-messages" role="tab" aria-controls="list-messages">Primero pasos</a>
          <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
            href="#list-settings" role="tab" aria-controls="list-settings">Copia de seguridad y actualización</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            Enable tabbable list item via JavaScript (each list item needs to be activated
            individually

            <br>
            <code>
$('#myList a').on('click', function (e) {
e.preventDefault()
$(this).tab('show')
})
</code>
          </div>
          <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">Cupidatat
            quis ad sint excepteur laborum in esse
            qui. Et excepteur consectetur ex nisi eu do cillum ad laborum. Mollit et eu officia
            dolore sunt Lorem culpa qui commodo velit ex amet id ex. Officia anim incididunt
            laboris deserunt anim aute dolor incididunt veniam aute dolore do exercitation. Dolor
            nisi culpa ex ad irure in elit eu dolore. Ad laboris ipsum reprehenderit irure non
            commodo enim culpa commodo veniam incididunt
            veniam ad.</div>
          <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">Cupidatat
            quis ad sint excepteur laborum in esse
            qui. Et excepteur consectetur ex nisi eu do cillum ad laborum. Mollit et eu officia
            dolore sunt Lorem culpa qui commodo velit ex amet id ex. Officia anim incididunt
            laboris deserunt anim aute dolor incididunt veniam aute dolore do exercitation. Dolor
            nisi culpa ex ad irure in elit eu dolore. Ad laboris ipsum reprehenderit irure non
            commodo enim culpa commodo veniam incididunt
            veniam ad.</div>
          <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">Cupidatat
            quis ad sint excepteur laborum in esse
            qui. Et excepteur consectetur ex nisi eu do cillum ad laborum. Mollit et eu officia
            dolore sunt Lorem culpa qui commodo velit ex amet id ex. Officia anim incididunt
            laboris deserunt anim aute dolor incididunt veniam aute dolore do exercitation. Dolor
            nisi culpa ex ad irure in elit eu dolore. Ad laboris ipsum reprehenderit irure non
            commodo enim culpa commodo veniam incididunt
            veniam ad.</div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection