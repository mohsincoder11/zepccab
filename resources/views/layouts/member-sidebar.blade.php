
<div id="slide-out" class="side-nav fixed sn-bg-4">
    <ul class="custom-scrollbar list-unstyled">

        @php
            $id = Auth::id();

            $route_name = Request::route()->getName();
            $route_path = Request::path();
        @endphp
        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                        <a href="{{url('member/home')}}" class="waves-effect {{ ($route_path =='member/home' ? 'active' : '') }}"><i class="fa fa-home"></i>Home</a>
                </li>

            </ul>
        </li>
        <!--/. Side navigation links -->
    </ul>

    <!-- Mask -->
    <div class="sidenav-bg mask-strong"></div>

</div>
