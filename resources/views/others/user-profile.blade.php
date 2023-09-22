@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">
@endsection

@section('main-content')
<div class="breadcrumb mt-5">
    <h1>Información de perfil</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="card user-profile o-hidden mb-4">
    <div class="header-cover" style="background-image: url({{asset('assets/images/photo-wide-2.jpg')}}"></div>
    <div class="user-info">
        <img class="profile-picture bg-white avatar-lg mb-2" src="{{asset('assets/images/icons/logo.svg')}}" alt="">
        <p class="m-0 text-24">{{ Auth::user()->name }}</p>
        <p class="text-muted m-0">{{ Auth::user()->role->name}}</p>
    </div>
    <div class="card-body">
        <div class="px-5" id="profile">
            <h4>Información personal</h4>

            <hr>
            <div class="row">
                @php
                $user = Auth::user();
                @endphp
                <div class="col px-5">
                    <form action="{{ route('user.update')}}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="text-center">
                            <h4 class="mb-4">Actualizar información</h4>
                        </div>
                        <div class="mb-4 form-group">
                            <label class="text-primary mb-1" for="name"><i class="i-Calendar text-16 mr-1"></i> Nombre
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name') ? old('name') : $user->name }}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group mb-4">
                            <label class="text-primary mb-1" for="email"><i class="i-Edit-Map text-16 mr-1"></i>Correo
                                electrónico <span class="text-danger">*</span> </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email') ? old('email') : $user->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="username" class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i>Nombre
                                de usuario <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username"
                                value="{{ old('username') ? old('username') : $user->username }}" required>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn  btn-primary m-1">Guardar</button>
                            <button type="button" onclick='resetFormInformation({
                                "name": "{{ $user->name}}",
                                "email": "{{ $user->email}}",
                                "username": "{{ $user->username}}"
                            })' class="btn btn-outline-secondary m-1">Cancelar</button>
                        </div>
                    </form>
                </div>
                <div class="col px-5 border-left">
                    <form id="change_password" action="{{ route('user.password')}}" method="POST">
                        @csrf
                        <div class="text-center">
                            <h4 class="mb-4">Actualizar contraseña</h4>
                        </div>
                        <div class="form-group mb-4">
                            <label for="password_current" class="text-primary mb-1"><i
                                    class="i-MaleFemale text-16 mr-1"></i>Contraseña actual<span
                                    class="text-danger">*</span> </label>
                            <input type="password" class="form-control @error('password_current') is-invalid @enderror"
                                name="password_current" id="password_current" required>
                            @error('password_current')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password" class="text-primary mb-1"><i
                                    class="i-MaleFemale text-16 mr-1"></i>Nueva contraseña<span
                                    class="text-danger">*</span> </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="text-primary mb-1"><i
                                    class="i-MaleFemale text-16 mr-1"></i>Confirmar contraseña<span
                                    class="text-danger">*</span> </label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation" required>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn  btn-primary m-1">Guardar</button>
                            <button type="button" onclick="resetFormPassword()"
                                class="btn btn-outline-secondary m-1">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <h4 class="w-100 text-center mb-4">Accesos rápidos</h4>
            <div class="row">
                <div class="col-md-2 col-sm-4 col-6 text-center">
                    <a href="{{route('clients.index')}}">
                        <i class="i-Business-ManWoman text-32 text-primary"></i>
                        <h6 class="text-16 mt-1">Clientes</h6>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4 col-6 text-center">
                    <a href="{{route('providers.index')}}">
                        <i class="i-Mens text-32 text-primary"></i>
                        <h6 class="text-16 mt-1">Proveedores</h6>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4 col-6 text-center">
                    <a href="{{route('servers.index')}}">
                        <i class="i-Big-Data text-32 text-primary"></i>
                        <h6 class="text-16 mt-1">Servidores</h6>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4 col-6 text-center">
                    <a href="{{route('domains.index')}}">
                        <i class="i-URL-Window text-32 text-primary"></i>
                        <h6 class="text-16 mt-1">Dominios</h6>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4 col-6 text-center">
                    <a href="{{route('certificates.index')}}">
                        <i class="i-Security-Check text-32 text-primary"></i>
                        <h6 class="text-16 mt-1">Certificados</h6>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4 col-6 text-center">
                    <a href="{{route('social-media.index')}}">
                        <i class="i-Like-2 text-32 text-primary"></i>
                        <h6 class="text-16 mt-1">Redes sociales</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- <ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="false">Timeline</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">Friends</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Photos</a>
            </li>
        </ul>

        <div class="tab-content" id="profileTabContent">
            <div class="tab-pane fade active show" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                <ul class="timeline clearfix">
                    <li class="timeline-line"></li>
                    <li class="timeline-item">
                        <div class="timeline-badge">
                            <i class="badge-icon bg-primary text-white i-Cloud-Picture"></i>
                        </div>
                        <div class="timeline-card card">
                            <div class="card-body">
                                <div class="mb-1">
                                    <strong class="mr-1">Timothy Carlson</strong> added a new photo
                                    <p class="text-muted">3 hours ago</p>
                                </div>
                                <img class="rounded mb-2" src="{{asset('assets/images/photo-wide-1.jpg')}}" alt="">
                                <div class="mb-3">
                                    <a href="#" class="mr-1">Like</a>
                                    <a href="#">Comment</a>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Write comment" aria-label="comment">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="button-comment1">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-badge">
                            <img class="badge-img" src="{{asset('assets/images/faces/1.jpg')}}" alt="">
                        </div>
                        <div class="timeline-card card">
                            <div class="card-body">
                                <div class="mb-1">
                                    <strong class="mr-1">Timothy Carlson</strong> updated his sattus
                                    <p class="text-muted">16 hours ago</p>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi dicta beatae illo illum iusto iste mollitia explicabo quam officia. Quas ullam, quisquam architecto aspernatur enim iure debitis dignissimos suscipit
                                    ipsa.
                                </p>
                                <div class="mb-3">
                                    <a href="#" class="mr-1">Like</a>
                                    <a href="#">Comment</a>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Write comment" aria-label="comment">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="button-comment">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="timeline clearfix">
                    <li class="timeline-line"></li>
                    <li class="timeline-group text-center">
                        <button class="btn btn-icon-text btn-primary"><i class="i-Calendar-4"></i> 2018</button>
                    </li>
                </ul>
                <ul class="timeline clearfix">
                    <li class="timeline-line"></li>
                    <li class="timeline-item">
                        <div class="timeline-badge">
                            <i class="badge-icon bg-danger text-white i-Love-User"></i>
                        </div>
                        <div class="timeline-card card">
                            <div class="card-body">
                                <div class="mb-1">
                                    <strong class="mr-1">New followers</strong>
                                    <p class="text-muted">2 days ago</p>
                                </div>
                                <p><a href="#">Henry krick</a> and 16 others followed you</p>
                                <div class="mb-3">
                                    <a href="#" class="mr-1">Like</a>
                                    <a href="#">Comment</a>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Write comment" aria-label="comment">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="button-comment3">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-badge">
                            <i class="badge-icon bg-primary text-white i-Cloud-Picture"></i>
                        </div>
                        <div class="timeline-card card">
                            <div class="card-body">
                                <div class="mb-1">
                                    <strong class="mr-1">Timothy Carlson</strong> added a new photo
                                    <p class="text-muted">2 days ago</p>
                                </div>
                                <img class="rounded mb-2" src="{{asset('assets/images/photo-wide-2.jpg')}}" alt="">
                                <div class="mb-3">
                                    <a href="#" class="mr-1">Like</a>
                                    <a href="#">Comment</a>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Write comment" aria-label="comment">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="button-comment4">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="timeline clearfix">
                    <li class="timeline-line"></li>
                    <li class="timeline-group text-center">
                        <button class="btn btn-icon-text btn-warning"><i class="i-Calendar-4"></i> Joined
                            in 2013</button>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                <h4>Personal Information</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, commodi quam! Provident quis voluptate asperiores ullam, quidem odio pariatur. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem, nulla eos?
                    Cum non ex voluptate corporis id asperiores doloribus dignissimos blanditiis iusto qui repellendus deleniti aliquam, vel quae eligendi explicabo.
                </p>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Birth Date</p>
                            <span>1 Jan, 1994</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Birth Place</p>
                            <span>Dhaka, DB</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i> Lives In</p>
                            <span>Dhaka, DB</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Gender</p>
                            <span>1 Jan, 1994</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Email</p>
                            <span>example@ui-lib.com</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i> Website</p>
                            <span>www.ui-lib.com</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Profession</p>
                            <span>Digital Marketer</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Experience</p>
                            <span>8 Years</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> School</p>
                            <span>School of Digital Marketing</span>
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Other Info</h4>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum dolore labore reiciendis ab quo ducimus reprehenderit natus debitis, provident ad iure sed aut animi dolor incidunt voluptatem. Blanditiis, nobis aut.</p>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-6 text-center">
                        <i class="i-Plane text-32 text-primary"></i>
                        <p class="text-16 mt-1">Travelling</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center">
                        <i class="i-Camera text-32 text-primary"></i>
                        <p class="text-16 mt-1">Photography</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center">
                        <i class="i-Car-3 text-32 text-primary"></i>
                        <p class="text-16 mt-1">Driving</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center">
                        <i class="i-Gamepad-2 text-32 text-primary"></i>
                        <p class="text-16 mt-1">Gaming</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center">
                        <i class="i-Music-Note-2 text-32 text-primary"></i>
                        <p class="text-16 mt-1">Music</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center">
                        <i class="i-Shopping-Bag text-32 text-primary"></i>
                        <p class="text-16 mt-1">Shopping</p>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-profile-1 mb-4">
                            <div class="card-body text-center">
                                <div class="avatar box-shadow-2 mb-3">
                                    <img src="{{asset('assets/images/faces/16.jpg')}}" alt="">
                                </div>
                                <h5 class="m-0">Jassica Hike</h5>
                                <p class="mt-0">UI/UX Designer</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.
                                </p>
                                <button class="btn btn-primary btn-rounded">Contact Jassica</button>
                                <div class="card-socials-simple mt-4">
                                    <a href="">
                                        <i class="i-Linkedin-2"></i>
                                    </a>
                                    <a href="">
                                        <i class="i-Facebook-2"></i>
                                    </a>
                                    <a href="">
                                        <i class="i-Twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-profile-1 mb-4">
                            <div class="card-body text-center">
                                <div class="avatar box-shadow-2 mb-3">
                                    <img src="{{asset('assets/images/faces/2.jpg')}}" alt="">
                                </div>
                                <h5 class="m-0">Frank Powell</h5>
                                <p class="mt-0">UI/UX Designer</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.
                                </p>
                                <button class="btn btn-primary btn-rounded">Contact Frank</button>
                                <div class="card-socials-simple mt-4">
                                    <a href="">
                                        <i class="i-Linkedin-2"></i>
                                    </a>
                                    <a href="">
                                        <i class="i-Facebook-2"></i>
                                    </a>
                                    <a href="">
                                        <i class="i-Twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-profile-1 mb-4">
                            <div class="card-body text-center">
                                <div class="avatar box-shadow-2 mb-3">
                                    <img src="{{asset('assets/images/faces/3.jpg')}}" alt="">
                                </div>
                                <h5 class="m-0">Arthur Mendoza</h5>
                                <p class="mt-0">UI/UX Designer</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.
                                </p>
                                <button class="btn btn-primary btn-rounded">Contact Arthur</button>
                                <div class="card-socials-simple mt-4">
                                    <a href="">
                                        <i class="i-Linkedin-2"></i>
                                    </a>
                                    <a href="">
                                        <i class="i-Facebook-2"></i>
                                    </a>
                                    <a href="">
                                        <i class="i-Twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="card card-profile-1 mb-4">
                            <div class="card-body text-center">
                                <div class="avatar box-shadow-2 mb-3">
                                    <img src="{{asset('assets/images/faces/4.jpg')}}" alt="">
                                </div>
                                <h5 class="m-0">Jacqueline Day</h5>
                                <p class="mt-0">UI/UX Designer</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.
                                </p>
                                <button class="btn btn-primary btn-rounded">Contact Jacqueline</button>
                                <div class="card-socials-simple mt-4">
                                    <a href="">
                                        <i class="i-Linkedin-2"></i>
                                    </a>
                                    <a href="">
                                        <i class="i-Facebook-2"></i>
                                    </a>
                                    <a href="">
                                        <i class="i-Twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white o-hidden mb-3">
                            <img class="card-img" src="{{asset('assets/images/products/headphone-1.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="p-1 text-left card-footer font-weight-light d-flex">
                                    <span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>
                                        12 </span>
                                    <span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-white o-hidden mb-3">
                            <img class="card-img" src="{{asset('assets/images/products/headphone-2.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="p-1 text-left card-footer font-weight-light d-flex">
                                    <span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>
                                        12 </span>
                                    <span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-white o-hidden mb-3">
                            <img class="card-img" src="{{asset('assets/images/products/headphone-3.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="p-1 text-left card-footer font-weight-light d-flex">
                                    <span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>
                                        12 </span>
                                    <span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white o-hidden mb-3">
                            <img class="card-img" src="{{asset('assets/images/products/iphone-1.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="p-1 text-left card-footer font-weight-light d-flex">
                                    <span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>
                                        12 </span>
                                    <span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white o-hidden mb-3">
                            <img class="card-img" src="{{asset('assets/images/products/iphone-2.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="p-1 text-left card-footer font-weight-light d-flex">
                                    <span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>
                                        12 </span>
                                    <span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white o-hidden mb-3">
                            <img class="card-img" src="{{asset('assets/images/products/watch-1.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="p-1 text-left card-footer font-weight-light d-flex">
                                    <span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>
                                        12 </span>
                                    <span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>



@endsection

@section('page-js')
<script src="{{asset('assets/js/vendor/spin.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/ladda.js')}}"></script>
<script src="{{asset('assets/js/ladda.script.js')}}"></script>
<script type="text/javascript">
    function resetFormInformation(user) {
        $('#name').val(user.name);
        $('#email').val(user.email);
        $('#username').val(user.username);
    }

    function resetFormPassword() {
        $('#change_password')[0].reset();
    }
</script>
@endsection