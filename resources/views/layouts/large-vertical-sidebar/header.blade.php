<div class="main-header">
    <div class="logo">
        <a href="/home" target="_blank">
            <img src="{{asset('assets/images/icons/logo.png')}}" alt="">
        </a>
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="d-flex align-items-center">
        <!-- Mega menu -->
        <div class="dropdown mega-menu d-none d-md-block" style="display: none !important">
            <a href="#" class="btn text-muted dropdown-toggle mr-3" id="dropdownMegaMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Mega Menu</a>
            <div class="dropdown-menu text-left" aria-labelledby="dropdownMenuButton">
                <div class="row m-0">
                    <div class="col-md-4 p-4 bg-img">
                        <h2 class="title">Mega Menu <br> Sidebar</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores natus laboriosam fugit,
                            consequatur.
                        </p>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem odio
                            amet eos dolore suscipit placeat.</p>
                        <button class="btn btn-lg btn-rounded btn-outline-warning">Learn More</button>
                    </div>
                    <div class="col-md-4 p-4">
                        <p class="text-primary text--cap border-bottom-primary d-inline-block">Features</p>
                        <div class="menu-icon-grid w-auto p-0">
                            <a href="#"><i class="i-Shop-4"></i> Home</a>
                            <a href="#"><i class="i-Library"></i> UI Kits</a>
                            <a href="#"><i class="i-Drop"></i> Apps</a>
                            <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                            <a href="#"><i class="i-Checked-User"></i> Sessions</a>
                            <a href="#"><i class="i-Ambulance"></i> Support</a>
                        </div>
                    </div>
                    <div class="col-md-4 p-4">
                        <p class="text-primary text--cap border-bottom-primary d-inline-block">Components</p>
                        <ul class="links">
                            <li><a href="accordion.html">Accordion</a></li>
                            <li><a href="alerts.html">Alerts</a></li>
                            <li><a href="buttons.html">Buttons</a></li>
                            <li><a href="badges.html">Badges</a></li>
                            <li><a href="carousel.html">Carousels</a></li>
                            <li><a href="lists.html">Lists</a></li>
                            <li><a href="popover.html">Popover</a></li>
                            <li><a href="tables.html">Tables</a></li>
                            <li><a href="datatables.html">Datatables</a></li>
                            <li><a href="modals.html">Modals</a></li>
                            <li><a href="nouislider.html">Sliders</a></li>
                            <li><a href="tabs.html">Tabs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Mega menu -->
        <div class="search-bar" style="display: none !important">
            <input type="text" placeholder="Search">
            <i class="search-icon text-muted i-Magnifi-Glass1"></i>
        </div>
    </div>

    <div style="margin: auto"></div>

    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>

        <!-- Notificaiton End -->

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <img src="{{asset('assets/images/icons/logo.png')}}" id="userDropdown" alt="" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{ Auth::user()->name }}
                    </div>
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{ Auth::user()->lastConnection() }}
                    </div>
                    <a class="dropdown-item" href="{{ route('user.profile') }}">Ajustes</a>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="
                        event.preventDefault();
                        document.getElementById('login-form').submit();
                    ">Salir</a>
                    <form id="login-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- header top menu end -->
