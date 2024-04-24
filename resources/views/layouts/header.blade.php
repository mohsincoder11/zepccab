<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark double-nav white  fixed-top scrolling-navbar">

    <!-- SideNav slide-out button -->
    @if(Auth::guard('member')->check())
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse">
                <i class="fa fa-bars"></i>
            </a>
        </div>
     @elseif(Auth::guard('admin')->check())
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    @else

@endif

@php
    $id = Auth::id();

    $route_name = Request::route()->getName();
    $route_path = Request::path();
       $route =  str_after($route_name,'.');
@endphp
    <!-- Breadcrumb-->
    <div class="breadcrumb-dn mr-auto">
        <a href="{{route($route_name)}}"><p><b>{{strtoupper(str_replace(['-', '_'], ' ', $route))}}</b></p></a>
    </div>

    <!-- Links -->
    <ul class="nav navbar-nav nav-flex-icons ml-auto">

        @if(Auth::guard('member')->check())
            <a class="btn-floating btn-sm btn-navbar" href="{{ url('/member/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
            <form id="logout-form" action="{{ url('/member/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @elseif(Auth::guard('admin')->check())

            <a class="btn-floating btn-sm btn-navbar" href="{{ url('/admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
            <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
         @endif

    </ul>

</nav>
