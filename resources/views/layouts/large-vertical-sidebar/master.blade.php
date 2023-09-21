<!-- ============ Large SIdebar Layout start ============= -->

<div class="app-admin-wrap layout-sidebar-large clearfix">
    @include('layouts.large-vertical-sidebar.header')

    <!-- ============ end of header menu ============= -->

     {{-- @include('layouts.large-vertical-sidebar.sidebar') --}}
     <x-sidebar-menu /> 

    <!-- ============ end of left sidebar ============= -->

    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column flex-grow-1">

        <div class="breadcrumb h2 mb-3">
            Bienvenido a &nbsp;<b>Bodega cloud</b>
        </div>

        <div class="main-content">
            @yield('main-content')
        </div>

        <div class="flex-grow-1"></div>
        @include('layouts.common.footer')
    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->

<!-- ============ Search UI Start ============= -->
@include('layouts.common.search')
<!-- ============ Search UI End ============= -->




<!-- ============ Large Sidebar Layout End ============= -->