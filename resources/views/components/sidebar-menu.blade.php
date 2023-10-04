<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon escritorio"></i>
                    <span class="nav-text">Inicio</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('providers') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon convenios"></i>
                    <span class="nav-text">Convenios</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon sedes"></i>
                    <span class="nav-text">Sedes</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon recaudo"></i>
                    <span class="nav-text">Recaudo</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon factura"></i>
                    <span class="nav-text">Facturas</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon realizados"></i>
                    <span class="nav-text">Pagos <br> Realizados</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon recibidos"></i>
                    <span class="nav-text">Pagos <br> Recibidos</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon informerecaudo"></i>
                    <span class="nav-text">Informe de <br> Recaudo</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon informefacturas"></i>
                    <span class="nav-text">Informe de <br> Facturas</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('clients') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('home')}}">
                    <i class="nav-icon corte"></i>
                    <span class="nav-text">Corte</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->
