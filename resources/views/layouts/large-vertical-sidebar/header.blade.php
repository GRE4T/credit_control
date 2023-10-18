<div class="main-header">
    <div class="logo">
        <a href="/home">
            <img src="{{ asset($configuration->logo)  }}" alt="" class="border border-dark rounded-circle">
        </a>
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div style="margin: auto"></div>

    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>

        <!-- Notificaiton End -->

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <img class="border border-dark" src="{{ asset($configuration->logo)  }}" id="userDropdown" alt="" data-toggle="dropdown"
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
