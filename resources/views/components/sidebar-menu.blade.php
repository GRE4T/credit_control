<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('home')}}">
                    <img src="{{ asset('assets/images/icons/home.png') }}" alt="icon-home" class="w-40">
                    <span class="nav-text">Inicio</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('agreements') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('agreements.index')}}">
                    <img src="{{ asset('assets/images/icons/convenio.png') }}" alt="icon-agreement" class="w-40">
                    <span class="nav-text">Convenios</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('headquarters') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('headquarters.index')}}">
                    <img src="{{ asset('assets/images/icons/sedes.png') }}" alt="icon-headquarter" class="w-40">
                    <span class="nav-text">Sedes</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('payments') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('payments.index')}}">
                    <img src="{{ asset('assets/images/icons/recaudos.png') }}" alt="icon-payment" class="w-40">
                    <span class="nav-text">Recaudo</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('invoices') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('invoices.index')}}">
                    <img src="{{ asset('assets/images/icons/facturas.png') }}" alt="icon-invoice" class="w-40">
                    <span class="nav-text">Facturas</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('paymentsmade') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('paymentsmade.index')}}">
                    <img src="{{ asset('assets/images/icons/pagos_realizados.png') }}" alt="icon-payments-made" class="w-40">
                    <span class="nav-text">Pagos <br> Realizados</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('paymentsreceived') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('paymentsreceived.index')}}">
                    <img src="{{ asset('assets/images/icons/pagos_recibidos.png') }}" alt="icon-payment-received" class="w-40">
                    <span class="nav-text">Pagos <br> Recibidos</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('payments/report') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('payments.report')}}">
                    <img src="{{ asset('assets/images/icons/informe_recaudos.png') }}" alt="icon-collection-report" class="w-40">
                    <span class="nav-text">Informe de <br> Recaudo</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('invoices/report') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('invoices.report')}}">
                    <img src="{{ asset('assets/images/icons/informe_facturas.png') }}" alt="icon-collection-invoice" class="w-40">
                    <span class="nav-text">Informe de <br> Facturas</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('period-cut') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{route('periodCut')}}">
                    <img src="{{ asset('assets/images/icons/corte.png') }}" alt="icon-court" class="w-40">
                    <span class="nav-text">Corte</span>
                </a>
                <div class="triangle"></div>
            </li>
            @if(auth()->user()->is_admin)
                <li class="nav-item {{ request()->is('cut-registers') ? 'active' : '' }}" >
                    <a class="nav-item-hold" href="{{route('cut-registers.index')}}">
                        <img src="{{ asset('assets/images/icons/balance.png') }}" alt="icon-court" class="w-40">
                        <span class="nav-text">Saldos</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item {{ request()->is('users') ? 'active' : '' }}" >
                    <a class="nav-item-hold" href="{{route('users.index')}}">
                        <img src="{{ asset('assets/images/icons/user.png') }}" alt="icon-court" class="w-40">
                        <span class="nav-text">Usuarios</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endif
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->
