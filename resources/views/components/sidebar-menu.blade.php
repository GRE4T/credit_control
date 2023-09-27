<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon escritorio"></i>
                    <span class="nav-text">Escritorio</span>
                </a>
                <div class="triangle"></div>
            </li>
            @if (Auth::user()->is_admin)
            <li class="nav-item {{ request()->is('users') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon clientes"></i>
                    <span class="nav-text">Usuarios</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            <li class="nav-item {{ request()->is('providers') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon proveedores"></i>
                    <span class="nav-text">Proveedores</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('servers') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon servidores"></i>
                    <span class="nav-text">Hosting <br> Servidores</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('domains') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon dominios"></i>
                    <span class="nav-text">Dominios</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('certificates') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon certificates"></i>
                    <span class="nav-text">Certificados</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon clientes"></i>
                    <span class="nav-text">Clientes</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item {{ request()->is('social-media') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon redes-sociales"></i>
                    <span class="nav-text">Redes sociales</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('emails') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon emails"></i>
                    <span class="nav-text">Correos electrónicos</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('subscriptions') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon clientes"></i>
                    <span class="nav-text">Suscripciones</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item {{ request()->is('help') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('help')}}">
                    <i class="nav-icon ayuda"></i>
                    <span class="nav-text">Ayuda</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->
