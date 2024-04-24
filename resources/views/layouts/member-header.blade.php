<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark double-nav  fixed-top scrolling-navbar">

    <!-- SideNav slide-out button -->
    @if(Auth::guard('member')->check())
     @elseif(Auth::guard('admin')->check())
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    @else

@endif
    <!-- Breadcrumb-->
    <div class="breadcrumb-dn mr-auto align-content-center">
        <a href="{{url('member/home')}}"><p><b>LABHESH MARKETING</b></p></a>
    </div>

    <!-- Links -->
    <ul class="nav navbar-nav nav-flex-icons ml-auto">

        @php
            $id = Auth::guard('member')->user()->student_id;
            $student_info = \App\Student::find($id);
            $plan_id = $student_info->plan_id;
            $get = new \App\Member();
            $referral_code = \App\Student::find($id);
            $subscription_days = $get->getRemainingSubscription($id);
            $referral_code =$referral_code->referral_code;
        @endphp
        @if(Auth::guard('member')->check())
            @if($subscription_days<=7 || $plan_id == 1)
                <a href="{{route('payment',$id)}}" class="btn btn-green btn-sm">Upgrade plan</a>
            @endif

            @if($plan_id == 2)
            <span class="badge badge-pill badge-dark m-l-1 m-r-1" style="padding-top: 10px">Remaining Day : {{$subscription_days}} Days</span>
            @endif

            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::guard('member')->user()->name }} <span class="caret">

                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                    <a class="dropdown-item" href="https://api.whatsapp.com/send?phone=whatsappphonenumber&text=Join me on Mathearon, Click here {{route('StudentRegister')}} to sign up with my referral code {{$referral_code}} and get 1 month free access to gold plan" >Share To WhatsApp</a>

                    <a class="dropdown-item" href="{{ url('/member/logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url('/member/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @elseif(Auth::guard('admin')->check())
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="{{ url('/admin/logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @else
            <li>
                <a href="{{ url('/member/login') }}" id="navbar-static-login" class="btn btn-info btn-rounded btn-sm waves-effect waves-light"
                >Log In
                    <i class="fa fa-sign-in ml-2"></i>
                </a>
            </li>
            <li>
                <a href="{{ url('/member/register') }}" id="navbar-static-login" class="btn btn-info btn-rounded btn-sm waves-effect waves-light"
                >Register
                    <i class="fa fa-sign-in ml-2"></i>
                </a>
            </li>
         @endif

    </ul>

</nav>
